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
		static $css_dir = __DIR__.'/src/css/';
		static $dest_dir = __DIR__.'/dest/';

		public function __construct() {
			$thx_co_option = get_option('thx_co_option');

			//管理画面の設定
			add_action('admin_menu', array($this, 'add_sub_menu'));
			add_action('admin_init', 'thx_cocoon_option_settings_init');

			//amp_all_cssにecho_amp_css()をフック
			add_filter('amp_all_css', array( $this, 'echo_amp_css' ));

			//追加関数の読み込み
			require_once( __DIR__.'/src/hsla.php' );//hsla変調
			require_once( __DIR__.'/src/is-mobile.php' );//スマホ判別

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
		public static function minimum_css() {
			require( thx_Cocoon_Option::$_var );
			// require_once( thx_Cocoon_Option::$src.'initial.php' );
			require_once( thx_Typography::$css_amp_dir.'_typography.php' );
			require_once( thx_Typography::$css_amp_dir.'amp.php' );
			require_once( thx_Typography::$css_amp_dir.'h.php' );
			require_once( thx_Typography::$css_amp_dir.'kaereba.php' );
		}

		//amp_all_cssにecho
		public function echo_amp_css($css) {
			ob_start();
			foreach (thx_Customize_Core::$push_css_url as $url) {
				$css .= css_url_to_css_minify_code($url);
			}
			thx_Cocoon_Option::minimum_css();
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
//設定変更CSSを読み込む
if ( !function_exists( 'wp_add_css_custome_to_inline_style' ) ):
function wp_add_css_custome_to_inline_style(){
	$preg_match_array = array(
		// '/.*?(}\.header{background).*?/uis'=>'.header-container-in{background'
	);
	ob_start();//バッファリング
	get_template_part('tmp/css-custom');
	thx_Cocoon_Option::minimum_css();
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

//親テーマstyle.cssの読み込み
if ( !function_exists( 'wp_enqueue_style_theme_style' ) ):
function wp_enqueue_style_theme_style(){
	$preg_match_array = array(
		// '/.*?(header {background-image: ).*?/uis'=>'header-container-in {background-image: ',
		'/.*?\n([^{}]*?ff-meiryo.*?})/uis'=>
		PHP_EOL.
		'.ff-meiryo {'.PHP_EOL.
		'  font-family: "Meiryo", "Hiragino Sans", "Hiragino Kaku Gothic Pro", "游ゴシック体", "Yu Gothic",sans-serif;'.PHP_EOL.
		'}',
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
	// $tcc = new thx_Customize_Core();
	$tmp_php = $tcc -> file_to_str(__DIR__.'/src/child/tmp/header-container.php');
	$path = get_stylesheet_directory().'/tmp/header-container.php';
	$tcc -> str_to_file($path, $tmp_php);
}
endif;//!function_exists( 'wp_enqueue_style_theme_style' )
require_once('src/php/menu.php');

new thx_Cocoon_Option;
