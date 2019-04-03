<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
/* カードをホバー（COLORS風） */
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
