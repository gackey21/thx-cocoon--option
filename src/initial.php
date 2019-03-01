<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php if (get_site_key_color()): ?>
.entry-title,
.archive-title {
	<?php if (!get_site_key_text_color()): ?>
	color: <?=$white?>;
	<?php endif;//!get_site_key_text_color() ?>
	background-color: <?=$thx_key?>;
}
<?php endif;//get_site_key_color() ?>
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
.article .toc,
.a-wrap .blogcard {
	border-color: <?=$thx_sub?>;
}
