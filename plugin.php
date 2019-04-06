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
		//読み込むurl
		static $push_js_url = array();
		static $push_css_url = array();
		static $push_amp_url = array();
		static $push_css_dir = array();
		static $push_amp_dir = array();
		static $replace_cocoon_css;
		static $replace_cocoon_amp;
		static $css_dir = __DIR__.'/src/css/';
		static $dest_dir = __DIR__.'/dest/';

		public function __construct() {
			$thx_co_option = get_option('thx_co_option');

			//管理画面の設定
			add_action('admin_menu', array($this, 'add_sub_menu'));
			add_action('admin_init', 'thx_cocoon_option_settings_init');

			//amp_parent_cssにecho_amp_parent_css()をフック
			// add_filter('amp_parent_css', array( $this, 'echo_amp_parent_css' ));
			add_filter('amp_parent_css', 'echo_amp_parent_css');
			//amp_all_cssにecho_amp_all_css()をフック
			add_filter('amp_all_css', array( $this, 'echo_amp_all_css' ));

			//追加関数の読み込み
			require_once( __DIR__.'/src/php/hsla.php' );//hsla変調
			require_once( __DIR__.'/src/php/is-mobile.php' );//スマホ判別

			//エントリーカード・サムネイルの余白を均等にする
			if ($thx_co_option['equalizing_thumbnail_margin_in_entry_card']['amp'] == 1) {
				$this::$push_amp_dir[] = $this::$css_dir.'entry-card-margin.php';
			}
			if ($thx_co_option['equalizing_thumbnail_margin_in_entry_card']['style'] == 1) {
				$this::$push_css_dir[] = $this::$css_dir.'entry-card-margin.php';
			}

			//カードをホバー（COLORS風）
			if ($thx_co_option['wrap_hover']['amp'] == 1) {
				$this::$push_amp_dir[] = $this::$css_dir.'wrap-hover.php';
			}
			if ($thx_co_option['wrap_hover']['style'] == 1) {
				$this::$push_css_dir[] = $this::$css_dir.'wrap-hover.php';
			}

			//画像の囲み効果（ブロックエディタ）
			if ($thx_co_option['iwe_block_editor']['amp'] == 1) {
				$this::$push_amp_dir[] = $this::$css_dir.'iwe-amp.php';
			}
			if ($thx_co_option['iwe_block_editor']['style'] == 1) {
				$this::$push_css_dir[] = $this::$css_dir.'iwe-css.php';
			}

			//ハイライト表示を横スクロールに変更
			if ($thx_co_option['pre']['amp'] == 1) {
				$this::$push_amp_dir[] = $this::$css_dir.'pre.php';
			}
			if ($thx_co_option['pre']['style'] == 1) {
				$this::$push_css_dir[] = $this::$css_dir.'pre.php';
			}

			//phpでcssを記述
			if ($thx_co_option['php_css']['amp'] == 1) {
				$this::$push_amp_dir[] = $this::$dest_dir.'thx-phped.css';
			}
			if ($thx_co_option['php_css']['style'] == 1) {
				$this::$push_css_dir[] = $this::$dest_dir.'thx-phped.css';
			}

			//親スタイルの変更
			if ($thx_co_option['replace_cocoon_style']['amp'] == 1) {
				$this::$replace_cocoon_amp = $thx_co_option['replace_cocoon_style_array'];
			}
			if ($thx_co_option['replace_cocoon_style']['style'] == 1) {
				$this::$replace_cocoon_css = $thx_co_option['replace_cocoon_style_array'];
			}

			add_action('wp_enqueue_scripts', array($this, 'push_url'));
		}//__construct()

		//キューイング
		public function push_url() {
			$tCC = new thx_Customize_Core();
			foreach ($this::$push_css_url as $url) {
				$tCC -> enqueue_file_style($url);
			}
			foreach ($this::$push_js_url as $url) {
				$tCC -> enqueue_file_script($url);
			}
		}//push_url()

		// static $tcc = new thx_Customize_Core();
		static $_var = __DIR__.'/src/css/_var.php';//変数ファイル
		static $src = __DIR__.'/src/';

		//サブメニュー作成
		function add_sub_menu() {
			add_submenu_page(
				'thx-jp-customize-core',
				'thx.jp/ Cocoon Option の設定',
				'Cocoon Option',
				'manage_options',
				'thx-jp-cocoon-option',
				'thx_cocoon_option_form'
			);
		}

		//ミニマムなcss
		// public static function minimum_css() {
			// require( thx_Cocoon_Option::$_var );
			// require_once( thx_Typography::$css_amp_dir.'_typography.php' );
			// require_once( thx_Typography::$css_amp_dir.'amp.php' );
			// require_once( thx_Typography::$css_amp_dir.'h.php' );
			// require_once( thx_Typography::$css_amp_dir.'kaereba.php' );
		// }
		}

		//amp_all_cssにecho
		public static function echo_amp_all_css($css) {
			ob_start();
			foreach (thx_Customize_Core::$push_css_url as $url) {
				$css .= css_url_to_css_minify_code($url);
			}
			// thx_Cocoon_Option::minimum_css();
			require( thx_Cocoon_Option::$_var );
			foreach (thx_Cocoon_Option::$push_amp_dir as $dir) {
				require_once( $dir );
			}
			$minimum = ob_get_clean();
			$css .= minify_css($minimum);
			echo $css;
		}
	}//class
}//! class_exists
//HTMLにインラインでスタイルを書く
if ( !function_exists( 'wp_add_css_custome_to_inline_style' ) ):
function wp_add_css_custome_to_inline_style(){
	$preg_match_array = array(
		// '/.*?(}\.header{background).*?/uis'=>'.header-container-in{background'
	);
	ob_start();//バッファリング
	get_template_part('tmp/css-custom');
	// thx_Cocoon_Option::minimum_css();
	require( thx_Cocoon_Option::$_var );
	foreach (thx_Cocoon_Option::$push_css_dir as $dir) {
		require_once( $dir );
	}
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

require_once('src/php/menu.php');
require_once('src/php/cocoon-style.php');

	// ヘッダー部の書き換えβ
	// $tmp_php = thx_Customize_Core::file_to_str(__DIR__.'/../../src/child/tmp/header-container.php');
	// $path = get_stylesheet_directory().'/tmp/header-container.php';
	// thx_Customize_Core::str_to_file($path, $tmp_php);
	// $tmp_php = $tcc -> file_to_str(__DIR__.'/src/child/tmp/css-custom.php');
	// $path = get_stylesheet_directory().'/tmp/css-custom.php';
	// $tcc -> str_to_file($path, $tmp_php);

new thx_Cocoon_Option;
