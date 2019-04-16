<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//amp処理クラス
if ( ! class_exists( 'Thx_Cocoon_Amp' ) ) {
	class Thx_Cocoon_Amp {
		public function __construct() {
		}//__construct()__construct()__construct()

		//親テーマamp.cssの読み込み＆置き換え
		public static function echo_amp_parent_css( $css ) {
			$preg_match_array = json_decode( Thx_Cocoon_Option::$replace_cocoon_amp, true );
			$css_url          = get_template_directory_uri() . '/amp.css';
			$css              = css_url_to_css_minify_code( $css_url );
			$css              = str_replace( '}', "}\n", $css );
			if ( isset( $preg_match_array ) ) {
				$css = Thx_Customize_Core::str_preg_replace( $css, $preg_match_array );
			}

			// //ファイル書き出し（差分検証用）
			// $path = __DIR__.'/../../dest/thx-amp.css';
			// $tcc = new thx_Customize_Core();
			// $tcc -> str_to_file($path, $css);

			$css = minify_css( $css );
			return $css;
		}//echo_amp_parent_css($css)

		//amp_all_cssにecho
		public static function echo_amp_all_css( $css ) {
			//tCCのスタイルを追加
			foreach ( Thx_Customize_Core::$push_css_url as $url ) {
				$css .= css_url_to_css_minify_code( $url );
			}
			//バッファ開始
			ob_start();
			require( Thx_Cocoon_Option::$_var );
			foreach ( Thx_Cocoon_Option::$push_amp_dir as $dir ) {
				require_once( $dir );
			}
			$minimum = ob_get_clean();
			$css    .= minify_css( $minimum );
			echo $css;
		}//echo_amp_all_css($css)
	}//class Thx_Cocoon_Amp
}//! class_exists( 'Thx_Cocoon_Amp' )
