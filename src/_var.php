<?php if ( !defined( 'ABSPATH' ) ) exit;
///////////////////////////////////////
// グローバル変数
///////////////////////////////////////
global
	$is_safari,
	$is_chrome,
	$is_gecko,
	// $is_IE,
	// $is_opera,
	// $is_NS4,
	// $is_lynx,
	$is_iphone;

///////////////////////////////////////
// define
///////////////////////////////////////
// define("SKIN_THX_DIR", get_stylesheet_directory()."/skins/skin-thx/");
// define("SKIN_THX_CSS_PHP_DIR", SKIN_THX_DIR."tmp/css_php/");

///////////////////////////////////////
// 新規パラメータ
///////////////////////////////////////

//サイトキーサブカラー
// define('OP_SITE_KEY_SUB_COLOR', 'site_key_sub_color');
// if ( !function_exists( 'get_site_key_sub_color' ) ):
// function get_site_key_sub_color(){
// 	return get_theme_option(OP_SITE_KEY_SUB_COLOR);
// }
// endif;

///////////////////////////////////////
// 色の指定
///////////////////////////////////////
//汎用色
$white = '#ffffff';
$white_hsla = colorcode_to_hsla($white);
$thx_frost =
	'background: '.hsla_to_css_code($white_hsla, 1.0, 0.8).';';
$thx_frost_hover =
	'background: '.hsla_to_css_code($white_hsla, 1.0, 0.9).';';
$thx_frost_btm =
	'background: linear-gradient(
		to bottom, '
		.hsla_to_css_code($white_hsla, 1.0, 0.0).' 00%, '
		.hsla_to_css_code($white_hsla, 1.0, 0.8).' 05%, '
		.$white.' 80%);';
//キーカラー
if (get_site_key_color()){
	$thx_key = get_site_key_color();
} else {
	$thx_key = '#808080';
}

$thx_key_hsla = colorcode_to_hsla($thx_key);

$thx_key_095 = hsla_to_css_code($thx_key_hsla,'95%');
$thx_key_080 = hsla_to_css_code($thx_key_hsla,'80%');
$thx_key_060 = hsla_to_css_code($thx_key_hsla,'60%');

//キーテキストカラー
if (get_site_key_text_color()){
	$thx_key_text = get_site_key_text_color();
}

//サイト背景色
if (get_site_background_color()){
	$thx_bg = get_site_background_color();
} else {
	$thx_bg = $thx_key_095;
}

//ボタン色
if (get_go_to_top_background_color()){
	$thx_sub = get_go_to_top_background_color();
	$thx_sub_hsla = colorcode_to_hsla($thx_sub);
// } elseif (get_site_key_sub_color()) {
//   $thx_sub = get_site_key_sub_color();
} else {
	$thx_sub_hsla = generate_sub_color($thx_key_hsla);
	$thx_sub = hsla_to_css_code($thx_sub_hsla);
	//$thx_sub_hsla = generate_counter_color($thx_key_hsla);
}

// if (!$thx_sub_hsla) {
//   $thx_sub_hsla = colorcode_to_hsla($thx_sub);
// }

$thx_sub_090 = hsla_to_css_code($thx_sub_hsla,'90%');
$thx_sub_080 = hsla_to_css_code($thx_sub_hsla,'80%');
$thx_sub__080 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.8);
$thx_sub__050 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.5);
$thx_sub__020 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.2);
$thx_sub__000 = hsla_to_css_code($thx_sub_hsla, 1.0, 0.0);

//カウンターカラー
$thx_counter_hsla = generate_counter_color($thx_key_hsla);
$thx_counter = hsla_to_css_code($thx_counter_hsla);

///////////////////////////////////////
// 文字サイズの指定
///////////////////////////////////////

//フォントサイズ
if (get_site_font_size()){
	$thx_fz_px = get_site_font_size();
	$thx_fz = floatval($thx_fz_px);
}

//モバイルフォントサイズ
if (get_mobile_site_font_size()){
	$thx_mb_fz_px = get_mobile_site_font_size();
	$thx_mb_fz = floatval($thx_mb_fz_px);
}

//行の高さ
if (get_entry_content_line_hight()){
	$thx_lh = floatval(get_entry_content_line_hight());
	//$thx_ls = round(($thx_lh - 1) * $thx_fz / 2) * 2;
	//$thx_lh_px = $thx_fz + $thx_ls;
}

//グリッド揃え用行間の設定
if ( !function_exists( 'get_grid_line_space' ) ):
function get_grid_line_space($fz, $lh){
	$gls = round(($lh - 1) * $fz / 2) * 2;
	return floatval($gls);
}
endif;

//グリッド揃え用line-heightの設定
if ( !function_exists( 'get_grid_line_height' ) ):
function get_grid_line_height($fz, $lh){
	$gls = get_grid_line_space($fz, $lh);
	$glh = $fz + $gls;
	return floatval($glh);
}
endif;

//スマホ判別
if (is_mobile()) {
	$thx_fz = $thx_mb_fz;
	$thx_fz_px = $thx_mb_fz_px;
}
$thx_gls = floatval(get_grid_line_space($thx_fz, $thx_lh));
$thx_gls_px = $thx_gls.'px';
$thx_glh = floatval(get_grid_line_height($thx_fz, $thx_lh));
$thx_glh_px = $thx_glh.'px';

//フォントのコンデンス率
$thx_font_condense = 1.0;
$thx_fw = $thx_fz * $thx_font_condense;
$thx_fw_px = $thx_fw.'px';

//サイドバーのサイズ比率
$thx_sb_ratio = 0.875;

//スニペットのフォントサイズ比率
$thx_snipet_ratio = 0.75;

///////////////////////////////////////
// メディアクエリ
///////////////////////////////////////
$mq_iphone_p = '(max-width: 414px) and (orientation: portrait)';
$mq_iphone_l = '(min-width: 568px) and (orientation: landscape)';
$mq_ipad_p = '(min-width: 768px) and (orientation: portrait)';
$mq_ipad_l = '(min-width: 1024px) and (orientation: landscape)';
$mq_not_iphone_p = array($mq_iphone_l, $mq_ipad_p, $mq_ipad_l);

///////////////////////////////////////
// カラム（メインカラム）の指定
///////////////////////////////////////

//メインカラムの幅
if (wp_is_mobile()) {
	$thx_main_wd_px = 'auto';
} else {
	$thx_main_wd = get_main_column_contents_width()
		? get_main_column_contents_width()
		: 800;
	$thx_main_wd = $thx_main_wd - fmod($thx_main_wd, $thx_fw);
	$main_column_padding = get_main_column_padding()
		? get_main_column_padding()
		: 29;
	$main_column_border_width = get_main_column_border_width()
		? get_main_column_border_width()
		: 1;
	$thx_main_wd += floatval($main_column_padding) * 2;
	$thx_main_wd += floatval($main_column_border_width) * 2;
	$thx_main_wd_px = $thx_main_wd.'px';

}//wp_is_mobile()

///////////////////////////////////////
// カラム（.wp-block-columns）の指定
///////////////////////////////////////
//子カラムの横マージン
$thx_clm_mg = $thx_fw * 2;
//$thx_clm_mg_px = $thx_clm_mg.'px';

///////////////////////////////////////
// Typography初期設定
///////////////////////////////////////
if ($is_safari) {
	$str_mg_shift = 1;
} else {
	$str_mg_shift = 0;
}
// $str_mg_shift = 1;
// $str_mg_shift = $thx_fz / 20;
$str_mg_top = floatval($thx_gls / 2 - $str_mg_shift);
$str_mg_btm = floatval($thx_gls / 2 + $str_mg_shift);
$str_mg_top_css = 'margin-top: -'.$str_mg_top.'px;';
$str_mg_btm_css = 'margin-bottom: -'.$str_mg_btm.'px;';
$str_str_mg_top_css = 'margin-top: '.$str_mg_btm.'px;';
$str_div_mg_top_css = 'margin-top: '.floatval($thx_gls + $thx_glh).'px;';
$div_str_mg_top_css = 'margin-top: '.floatval($str_mg_btm + $thx_glh).'px;';
$div_div_mg_top_css = 'margin-top: '.floatval($thx_gls + $thx_glh).'px;';
$grid_shift = floatval($str_mg_shift * 2);//未検証
