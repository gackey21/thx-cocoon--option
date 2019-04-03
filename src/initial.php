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
.site-name-text {
	font-size: 3rem;
	font-weight: 800;
	line-height: 1.5em;
}
.logo-text {
	padding: 0;
}
.footer {
	padding-top: 2px;
}
.footer-bottom-logo .site-name-text {
	font-size: 2rem;
}
.footer-bottom-content .copyright {
	margin-top: 2px;
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
// グローバルナビ
?>
#header-container .navi,
#navi .navi-in>.menu-header .sub-menu {
	<?=$thx_frost?>
}
#navi .navi-in a {
	color: <?=$thx_sub?>;
	font-weight: 800;
	white-space: nowrap;
}
#navi .navi-in a:hover,
#footer a:hover {
	background-color: <?=$thx_sub__080?>;
	transition-duration: 0.3s;
}
.menu-item-has-children > a {
	font-size: 1.25em;
}
.navi-in > ul > li:last-child .sub-menu {
	right: 0;
}
.navi-in > ul > li:last-child .sub-menu .menu-item-has-children {
	position: relative;
}
.navi-in > ul .sub-menu {
	border: 1px solid <?=$thx_sub?>;
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
	line-height: <?=$thx_fz * $thx_sb_ratio + 7?>px;
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
	padding: 4px 4px 2px;
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
<?php
///////////////////////////////////////
// under-entry-content の並び順
?>
.under-entry-content {
	display: flex;
	flex-direction: column;
}
.under-entry-content .related-entries {
	order: 2;
}
.under-entry-content .pager-post-navi {
	order: -1;
}
.under-entry-content .comment-area {
	order: 3;
}
<?php
///////////////////////////////////////
// ul
?>
.content ul {
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
.navi-in li:before {
	display: none;
}
.slick-dots li:before {
	display: none;
}
.wp-block-gallery li:before {
	display: none;
}
