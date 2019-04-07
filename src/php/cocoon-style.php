<?php if ( ! defined( 'ABSPATH' ) ) exit;

//amp処理クラス
if ( ! class_exists( 'thx_Cocoon_amp' ) ) {
	class thx_Cocoon_amp {
		public function __construct() {
		}//__construct()

		//親テーマamp.cssの読み込み＆置き換え
		public static function echo_amp_parent_css($css) {
			$preg_match_array = json_decode( thx_Cocoon_Option::$replace_cocoon_amp , true ) ;
			$css_url = get_template_directory_uri().'/amp.css';
			$css = css_url_to_css_minify_code($css_url);
			$css = str_replace('}',"}\n",$css);
			if (isset($preg_match_array)) {
				$css = thx_Customize_Core::str_preg_replace($css, $preg_match_array);
			}

			// //ファイル書き出し（差分検証用）
			// $path = __DIR__.'/../../dest/thx-amp.css';
			// $tcc = new thx_Customize_Core();
			// $tcc -> str_to_file($path, $css);

			$css = minify_css($css);
			echo $css;
		}//echo_amp_parent_css($css)

		//amp_all_cssにecho
		public static function echo_amp_all_css($css) {
			//tCCのスタイルを追加
			foreach (thx_Customize_Core::$push_css_url as $url) {
				$css .= css_url_to_css_minify_code($url);
			}
			//バッファ開始
			ob_start();
			require( thx_Cocoon_Option::$_var );
			foreach (thx_Cocoon_Option::$push_amp_dir as $dir) {
				require_once( $dir );
			}
			$minimum = ob_get_clean();
			$css .= minify_css($minimum);
			echo $css;
		}//echo_amp_all_css($css)
	}//class thx_Cocoon_amp
}//! class_exists( 'thx_Cocoon_amp' )

//親テーマstyle.cssの読み込み＆置き換え
if ( !function_exists( 'wp_enqueue_style_theme_style' ) ):
function wp_enqueue_style_theme_style(){
	$preg_match_array = json_decode( thx_Cocoon_Option::$replace_cocoon_css , true ) ;
	//バッファリング
	ob_start();
	require (get_template_directory() . '/style.css');
	$css = ob_get_clean();
	if (isset($preg_match_array)) {
		$css = thx_Customize_Core::str_preg_replace($css, $preg_match_array);
	}
	//ファイル書き出し
	$path = __DIR__.'/../../dest/thx-style.css';
	thx_Customize_Core::str_to_file($path, $css);
	wp_enqueue_style(
		THEME_NAME.'-style',
		plugins_url( '../../dest/thx-style.css', __FILE__ )
	);
}
endif;//!function_exists( 'wp_enqueue_style_theme_style' )
