<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
/* サムネイルの上下余白除去 */
[class$="card-thumb"] {
	margin-top: 0;
	margin-bottom: 0;
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
.rect-entry-card .related-entry-card-content {
	padding-bottom: 0;
}
/* 関連記事（縦型） */
.rect-vartical-card .related-entry-card-content {
	margin: <?=$thx_gls * $thx_sb_ratio * 0.8?>px 0 0;
}
.rect-vartical-card .related-entry-card-wrap {
	padding: <?=$thx_gls * $thx_sb_ratio * 0.8?>px;
}
