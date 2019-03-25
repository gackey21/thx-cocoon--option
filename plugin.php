<?php
/*
Plugin Name: thx.jp/ Cocoon Option
Plugin URI:
Description: Cocoon設定の利用
Version: 0.0.1
Author:Gackey.21
Author URI: https://thx.jp
License: GPL2
*/
?>
<?php
/*  Copyright 2019 Gackey.21 (email : gackey.21@gmail.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as
		 published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
if ( ! class_exists( 'thx_Cocoon_Option' ) ) {
	class thx_Cocoon_Option {
		public function __construct() {
			require_once( __DIR__.'/src/hsla.php' );//hsla変調
			require_once( __DIR__.'/src/is-mobile.php' );//スマホ判別
			//amp_all_cssにecho_amp_css()をフック
			add_filter(
				'amp_all_css',
				array( $this, 'echo_amp_css' )
			);
			// コンテンツ変更　フック
			// add_filter(
			// 	'the_content',
			// 	array( $this, 'content_replace' ),
			// 	20900
			// );
		}//__construct()

		static $_var = __DIR__.'/src/_var.php';//変数ファイル
		static $src = __DIR__.'/src/';

		//ファイル書き出し
		// public function str_to_file($path, $str) {
		// 	require_once( ABSPATH.'wp-admin/includes/file.php' );
		// 	if ( WP_Filesystem() ) {
		// 		global $wp_filesystem;
		// 		$wp_filesystem -> put_contents( $path, $str );
		// 	}
		// }
		//ミニマムなcss
		public static function minimum_css() {
			require( thx_Cocoon_Option::$_var );
			require_once( thx_Cocoon_Option::$src.'initial.php' );
			require_once( thx_Typography::$css_amp_dir.'_typography.php' );
			require_once( thx_Typography::$css_amp_dir.'amp.php' );
			require_once( thx_Typography::$css_amp_dir.'h.php' );
			require_once( thx_Typography::$css_amp_dir.'kaereba.php' );
		}
		//amp_all_cssにecho
		public function echo_amp_css($css) {
			ob_start();
			thx_Cocoon_Option::minimum_css();
			$minimum = ob_get_clean();
			$css .= minify_css($minimum);
			echo $css;
		}
		//コンテンツ変更
		// public function content_replace($the_content) {
		// 	$match = '{(<div class="shoplinkyahoo">.*?)(Yahooショッピング)(.*?</div>)}uis';
		// 	$replece = '$1Yahoo!$3';
		// 	$the_content = preg_replace(
		// 		$match,
		// 		$replece,
		// 		$the_content
		// 	);
		// 	return $the_content;
		// }
	}//class
}//! class_exists
//設定変更CSSを読み込む
if ( !function_exists( 'wp_add_css_custome_to_inline_style' ) ):
function wp_add_css_custome_to_inline_style(){
	$preg_match_array = array(
		// '/.*?(}\.header{background).*?/uis'=>'.header-container-in{background'
	);
	ob_start();//バッファリング
	get_template_part('tmp/css-custom');
	thx_Cocoon_Option::minimum_css();
	$css_custom = ob_get_clean();
	//CSSの縮小化
	$css_custom = minify_css($css_custom);
	foreach ($preg_match_array as $preg_match => $replace) {
		// var_dump($preg_match);
		// var_dump($replace);
		preg_match_all(
			$preg_match,
			$css_custom,
			$match
		);
		// var_dump($match);
		foreach ($match[1] as $value) {
			$css_custom = str_replace($value,$replace,$css_custom);
		}
	}
	//HTMLにインラインでスタイルを書く
	if (get_skin_url()) {
		//スキンがある場合
		wp_add_inline_style( THEME_NAME.'-skin-style', $css_custom );
	} else {
		//スキンを使用しない場合
		wp_add_inline_style( THEME_NAME.'-style', $css_custom );
	}
}
endif;//!function_exists( 'wp_add_css_custome_to_inline_style' )

//親テーマstyle.cssの読み込み
if ( !function_exists( 'wp_enqueue_style_theme_style' ) ):
function wp_enqueue_style_theme_style(){
	$preg_match_array = array(
		// '/.*?(header {background-image: ).*?/uis'=>'header-container-in {background-image: ',
		'/.*?\n([^{}]*?article h2.*?})/uis'=>'',
		'/.*?\n([^{}]*?article h3.*?})/uis'=>'',
		'/.*?\n([^{}]*?article h4.*?})/uis'=>'',
		'/.*?\n([^{}]*?article h5.*?})/uis'=>'',
		'/.*?\n([^{}]*?article h6.*?})/uis'=>'',
		'/.*?\n([^{}]*?kaerebalink-.*?})/uis'=>''
	);
	//バッファリング
	ob_start();
	require (get_template_directory() . '/style.css');
	$css = ob_get_clean();
	foreach ($preg_match_array as $preg_match => $replace) {
		// var_dump($preg_match);
		// var_dump($replace);
		preg_match_all(
			$preg_match,
			$css,
			$match
		);
		// var_dump($match);
		foreach ($match[1] as $value) {
			$css = str_replace($value,$replace,$css);
		}
	}
	// foreach ($preg_match_array as $preg_match) {
	// 	preg_match_all(
	// 		$preg_match,
	// 		$css,
	// 		$match
	// 	);
	// 	foreach ($match[1] as $value) {
	// 		$css = str_replace($value,'',$css);
	// 	}
	// }
	//カエレバ削除
	// preg_match_all(
	// 	'/.*?\n([^{}]*?kaerebalink-.*?})/uis',
	// 	$css,
	// 	$match
	// );
	// foreach ($match[1] as $value) {
	// 	$css = str_replace($value,'',$css);
	// }
	//ファイル書き出し
	$path = __DIR__.'/dest/thx-style.css';
	$tcc = new thx_Customize_Core();
	$tcc -> str_to_file($path, $css);
	// $cocoon_css = get_template_directory_uri() . '/style.css';
	// var_dump($cocoon_css);
	wp_enqueue_style(
		THEME_NAME.'-style',
		plugins_url( 'dest/thx-style.css', __FILE__ )
	);
	// wp_enqueue_style( THEME_NAME.'-style', $cocoon_css );
}
endif;//!function_exists( 'wp_enqueue_style_theme_style' )

new thx_Cocoon_Option;
