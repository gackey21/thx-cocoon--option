<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
//親テーマstyle.cssの読み込み＆置き換え
if ( ! function_exists( 'wp_enqueue_style_theme_style' ) ) :
	function wp_enqueue_style_theme_style() {
		$preg_match_array = json_decode( thx_Cocoon_Option::$replace_cocoon_css, true );
		//バッファリング
		ob_start();
		require( get_template_directory() . '/style.css' );
		$css = ob_get_clean();
		if ( isset( $preg_match_array ) ) {
			$css = thx_Customize_Core::str_preg_replace( $css, $preg_match_array );
		}
		//ファイル書き出し
		$path = __DIR__ . '/../../dest/thx-style.css';
		thx_Customize_Core::str_to_file( $path, $css );
		wp_enqueue_style(
			THEME_NAME . '-style',
			plugins_url( '../../dest/thx-style.css', __FILE__ )
		);
	}
endif;//!function_exists( 'wp_enqueue_style_theme_style' )

//HTMLにインラインでスタイルを書く
if ( ! function_exists( 'wp_add_css_custome_to_inline_style' ) ) :
	function wp_add_css_custome_to_inline_style() {
		// $preg_match_array = array(
		// 	// '/.*?(}\.header{background).*?/uis'=>'.header-container-in{background'
		// );
		ob_start();//バッファリング
		get_template_part( 'tmp/css-custom' );
		// thx_Cocoon_Option::minimum_css();
		require( thx_Cocoon_Option::$_var );
		// foreach (thx_Cocoon_Option::$push_amp_dir as $dir) {
		// 	require_once( $dir );
		// }
		foreach ( thx_Cocoon_Option::$push_css_dir as $dir ) {
			require_once( $dir );
		}
		$css_custom = ob_get_clean();
		// if (isset($preg_match_array)) {
		// 	$css_custom = thx_Customize_Core::str_preg_replace($css_custom, $preg_match_array);
		// }
		// CSSの縮小化
		$css_custom = minify_css( $css_custom );
		//HTMLにインラインでスタイルを書く
		if ( get_skin_url() ) {
			//スキンがある場合
			wp_add_inline_style( THEME_NAME . '-skin-style', $css_custom );
		} else {
			//スキンを使用しない場合
			wp_add_inline_style( THEME_NAME . '-style', $css_custom );
		}
	}
endif;//!function_exists( 'wp_add_css_custome_to_inline_style' )
