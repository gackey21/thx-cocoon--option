<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php if (get_site_key_color()): ?>
<?php
///////////////////////////////////////
// キーカラー
///////////////////////////////////////
?>
.entry-title,
.archive-title {
	<?php if (!get_site_key_text_color()): ?>
	color: <?=$white?>;
	<?php endif;//!get_site_key_text_color() ?>
	background-color: <?=$thx_key?>;
}
<?php endif;//get_site_key_color() ?>
<?php
///////////////////////////////////////
// 背景色
///////////////////////////////////////
?>
body {
	<?php if (! get_site_background_color()): ?>
	background-color: <?=$thx_bg?>;
	<?php endif; ?>
}
<?php
///////////////////////////////////////
// ボタンカラー
///////////////////////////////////////
?>
.go-to-top-button {
	<?php if (! get_go_to_top_background_color()): ?>
	background-color: <?=$thx_sub?>;
	<?php endif; ?>
	<?php if (! get_go_to_top_text_color()): ?>
	color: #ddd;
	<?php endif; ?>
}
.go-to-top-button:hover {
	<?php if (! get_go_to_top_text_color()): ?>
	color: #fff;
	<?php endif; ?>
}
<?php
///////////////////////////////////////
// サブカラー
///////////////////////////////////////
?>
.article h2::after,
.article h3::after,
.article h4::after,
.article h5::after,
.article h6::after {
	color: <?php echo $thx_sub__050; ?>;
}
.article h2:hover::after,
.article h3:hover::after,
.article h4:hover::after,
.article h5:hover::after,
.article h6:hover::after {
	color: <?php echo $thx_sub__000; ?>;
}
<?php
///////////////////////////////////////
// 好みのカスタマイズ
///////////////////////////////////////
?>
<?php
///////////////////////////////////////
// フォント
?>
body {
	font-family: "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
	-webkit-text-size-adjust: 100%;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.site-name-text {
	font-family: "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
	font-size: 3rem;
	font-weight: 800;
	line-height: 1.5em;
}

.entry-title,
.archive-title,
h1 {
	font-family: "新ゴ B", "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
	font-size: 2rem;
	font-weight: 700;
	font-feature-settings: "palt";
	letter-spacing: 0.025em;
}
.tagline,
h2,
h3,
h4,
h5,
h6,
.sidebar h3,
.widget-entry-cards.large-thumb-on .card-title,
.cat-label,
.thx-label,
.blogcard-title,
.tab-caption-box-label-text,
.block-box-label-text,
.toggle-button,
.pagination .current,
.page-numbers.current,
.page-numbers.dots {
	font-family: "新ゴ R", "Hiragino Sans", "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
	font-weight: 600;
}
.site-name-text,
.entry-title,
.archive-title {
	text-shadow: 0.075em 0.075em 0.02em rgba(0, 0, 0, 0.21);
}
<?php
///////////////////////////////////////
// 見出し
?>
.article h3 {
	border: none;
  background: linear-gradient(90deg, <?php echo $thx_key_080; ?>, #fff);
}
.article h4,
.article h5,
.article h6 {
  border-color: <?php echo $thx_key_060; ?>;
  background: <?=$white?>;
}
<?php
///////////////////////////////////////
// wrapカード
?>
/* COLORSより */
.wp-block-image a img,
.a-wrap {
	border-radius: 4px;
	<?=$thx_frost?>
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.16), 0 0 0 1px rgba(0, 0, 0, 0.08);
	transition-duration: 0.3s;
}
.wp-block-image a img:hover,
.a-wrap:hover {
	transform: translateY(-4px);
	<?=$thx_frost_hover?>
	box-shadow: 0 0 8px rgba(0, 0, 0, 0.24);
	transition-duration: 0.3s;
}
/* 線色サブカラー */
.article .toc,
.a-wrap .blogcard {
	border-color: <?=$thx_sub?>;
}
/* サムネイルの上下余白除去 */
[class$="card-thumb"] {
	margin-top: 0;
	line-height: 0;
}
.cat-label {
	line-height: <?=$thx_lh?>;
}
/* 大きなサムネイル　margin指定 */
.widget-entry-cards.large-thumb .card-content {
	margin: <?=$thx_gls * $thx_sb_ratio * 0.8?>px 0 0;
}
/* ウィジェット部 */
.widget-entry-cards .a-wrap {
	margin: <?=$thx_gls * $thx_sb_ratio?>px 0;
	padding: <?=$thx_gls * $thx_sb_ratio * 0.8?>px;
}
/* 大きなカード */
.front-top-page .ect-big-card-first .a-wrap:first-of-type .card-content,
.ect-big-card .card-content {
	margin-top: 10px;
}
/* 関連記事（デフォルト） */
.related-entry-card-content {
	padding-bottom: 0;
}
/* 関連記事（縦型） */
.rect-vartical-card .related-entry-card-content {
	margin: <?=$thx_gls * $thx_sb_ratio * 0.8?>px 0 0;
}
.rect-vartical-card .related-entry-card-wrap {
	padding: <?=$thx_gls * $thx_sb_ratio * 0.8?>px;
}
<?php
///////////////////////////////////////
// ul
?>
ul {
	position: relative;
}
ul li {
	list-style-type: none;
}
ul li:before {
	position: absolute;
	left : 1em;
	color: <?=$thx_key?>;
	font-family: FontAwesome;
	content: "\f0da";
}
li ul li:before {
	position: absolute;
	left : 1em;
	color: <?=$thx_sub?>;
	font-family: FontAwesome;
	content: "\f105";
}
<?php
///////////////////////////////////////
// サイドバー
?>
.sidebar {
	<?php if (! get_sidebar_padding()): ?>
	padding: <?=$thx_gls_px?> <?=$thx_fw_px?>;
	<?php endif; ?>
	font-size: <?=$thx_fz * $thx_sb_ratio?>px;
	line-height: <?=$thx_glh * $thx_sb_ratio?>px;
}
.sidebar h3 {
	padding: 0.4em;
	margin: 0.3em 0;
}
.sidebar li:before {
	line-height: 1;
}
.sidebar :not(li) > ul > li:before {
	left : -<?=$thx_fw * $thx_sb_ratio * 0.5?>px;
}
.sidebar ul li ul {
	padding-left: <?=$thx_fw * $thx_sb_ratio * 1.5?>px;
}
.sidebar ul li a {
	margin-top: <?=$thx_gls * $thx_sb_ratio?>px;
	border-bottom: 1px solid <?=$thx_sub__050?>;
	padding: 0;
	line-height: 1;
}
.sidebar ul li a:hover {
	border-color: <?=$thx_key?>;
	background-color: <?=$thx_key_095?>;
	transition: 0.1s;
}
.widget-entry-cards.not-default .e-card {
	font-size: <?=$thx_fz * $thx_sb_ratio?>px;
}
.widget-entry-cards.large-thumb-on .card-content {
	white-space: nowrap;
	overflow: hidden;
}
