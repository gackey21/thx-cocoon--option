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
		}//__construct()

		static $_var = __DIR__.'/src/_var.php';//変数ファイル
		static $src = __DIR__.'/src/';

		//ファイル書き出し
		public function str_to_file($path, $str) {
			require_once( ABSPATH.'wp-admin/includes/file.php' );
			if ( WP_Filesystem() ) {
				global $wp_filesystem;
				$wp_filesystem -> put_contents( $path, $str );
			}
		}
		//ミニマムなcss
		public static function minimum_css() {
			require( thx_Cocoon_Option::$_var );
			require_once( thx_Cocoon_Option::$src.'initial.php' );
			require_once( thx_Typography::$css_amp_dir.'_typography.php' );
			require_once( thx_Typography::$css_amp_dir.'amp.php' );
			require_once( thx_Typography::$css_amp_dir.'h.php' );
		}
		//amp_all_cssにecho
		public function echo_amp_css($css) {
			ob_start();
			thx_Cocoon_Option::minimum_css();
			$minimum = ob_get_clean();
			$css .= minify_css($minimum);
			echo $css;
		}
	}//class
}//! class_exists
//設定変更CSSを読み込む
if ( !function_exists( 'wp_add_css_custome_to_inline_style' ) ):
function wp_add_css_custome_to_inline_style(){
	ob_start();//バッファリング
	get_template_part('tmp/css-custom');
	thx_Cocoon_Option::minimum_css();
	$css_custom = ob_get_clean();
	//CSSの縮小化
	$css_custom = minify_css($css_custom);
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

new thx_Cocoon_Option;
