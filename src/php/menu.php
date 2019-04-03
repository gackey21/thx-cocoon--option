<?php if ( ! defined( 'ABSPATH' ) ) exit;
// フォームの枠組を出力する
function thx_cocoon_option_form() {
	// ユーザーが必要な権限を持つか確認する必要がある
	if (!current_user_can('manage_options'))  {
		wp_die( __('このページにアクセスする管理者権限がありません。') );
	}
	?>
	<div class="wrap">
		<form action="options.php" method="post">
			<?php settings_fields('thx_cocoon_option-group'); // グループ名 ?>
			<?php do_settings_sections('thx_cocoon_option_section'); // ページ名 ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php if (isset($_GET['settings-updated'])): ?>
		<?php if ($_GET['settings-updated']): ?>
			<div class="updated notice is-dismissible">
				<p><strong>設定を保存しました。</strong></p>
			</div>
		<?php endif; ?>
	<?php endif;//isset ?>
	<?php
}//thx_cocoon_option_form()
function thx_cocoon_option_settings_init() {
	$thx_co_option = get_option('thx_co_option');
	if( !$thx_co_option ) {
		$thx_co_option = array(
			'equalizing_thumbnail_margin_in_entry_card' => 1,
		);
		update_option( 'thx_co_option', $thx_co_option );
	}
	register_setting('thx_cocoon_option-group', 'thx_co_option');
	//拡張機能の設定
	add_settings_section(
		'thx_cocoon_option_settings_section', // セクション名
		'thx.jp/ Cocoon Optionの設定', // タイトル
		'thx_cocoon_option_settings_section_callback', // echo '<p>プラグインのON/OFFを切り替えます。</p>';
		'thx_cocoon_option_section' // このセクションを表示するページ名。do_settings_sectionsで設定
	);
	function thx_cocoon_option_settings_section_callback() {
		echo '<p>検証中の機能です。</p>';
	}

	//エントリーカード・サムネイルの余白を均等にする
	add_settings_field(
		'thx_equalizing_thumbnail_margin_in_entry_card',
		'エントリーカード・サムネイルの余白を均等にする',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name' => 'thx_co_option',
			'option_array_name' => 'equalizing_thumbnail_margin_in_entry_card',
			'comment' => array(
				'amp' => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add' => '',
		)
	);
}//thx_cocoon_option_settings_init()
