<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// フォームの枠組を出力する
function thx_cocoon_option_form() {
	// ユーザーが必要な権限を持つか確認する必要がある
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'このページにアクセスする管理者権限がありません。' ) );
	}
	?>
	<div class="wrap">
		<form action="options.php" method="post">
			<?php settings_fields( 'thx_cocoon_option-group' ); // グループ名 ?>
			<?php do_settings_sections( 'thx_cocoon_option_section' ); // ページ名 ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
		<?php if ( $_GET['settings-updated'] ) : ?>
			<div class="updated notice is-dismissible">
				<p><strong>設定を保存しました。</strong></p>
			</div>
			<?php
			//thx-phped.cssを作成
			$thx_co_option = get_option( 'thx_co_option' );
			$css           = $thx_co_option['php_css_array'];
			$path          = thx_Cocoon_Option::$dest_dir . 'thx-phped.css';
			thx_Customize_Core::str_to_file( $path, $css );
			?>
		<?php endif; ?>
	<?php endif;//isset ?>
	<?php
}//thx_cocoon_option_form()

function thx_cocoon_option_settings_init() {
	$thx_co_option = get_option( 'thx_co_option' );
	if ( ! $thx_co_option ) {
		$thx_co_option = array(
			'equalizing_thumbnail_margin_in_entry_card' => array(
				'amp'   => 1,
				'style' => 1,
			),
			'wrap_hover'                                => array(
				'amp'   => 1,
				'style' => 1,
			),
			'iwe_block_editor'                          => array(
				'amp'   => 1,
				'style' => 1,
			),
			'pre'                                       => array(
				'amp'   => 1,
				'style' => 1,
			),
			'php_css'                                   => array(
				'amp'   => 0,
				'style' => 0,
			),
			'php_css_array'                             => '',
			'replace_cocoon_style'                      => array(
				'amp'   => 0,
				'style' => 0,
			),
			'replace_cocoon_style_array'                => '',
		);
		update_option( 'thx_co_option', $thx_co_option );
	}
	register_setting( 'thx_cocoon_option-group', 'thx_co_option' );
	//拡張機能の設定
	add_settings_section(
		'thx_cocoon_option_settings_section', // セクション名
		'thx.jp/ Cocoon Optionの設定', // タイトル
		'thx_cocoon_option_settings_section_callback', // echo '<p>プラグインのON/OFFを切り替えます。</p>';
		'thx_cocoon_option_section' // このセクションを表示するページ名。do_settings_sectionsで設定
	);
	function thx_cocoon_option_settings_section_callback() {
		// echo '<p>検証中の機能です。</p>';
	}

	//エントリーカード・サムネイルの余白を均等にする
	add_settings_field(
		'thx_equalizing_thumbnail_margin_in_entry_card',
		'エントリーカード・サムネイルの余白を均等にする',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'equalizing_thumbnail_margin_in_entry_card',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => '',
		)
	);

	//カードをホバー（COLORS風）
	add_settings_field(
		'thx_wrap_hover',
		'カードをホバーする（COLORS風）',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'wrap_hover',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => '',
		)
	);

	//画像の囲み効果（ブロックエディタ）
	add_settings_field(
		'thx_iwe_block_editor',
		'画像の囲み効果（ブロックエディタ）',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'iwe_block_editor',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => '',
		)
	);

	//ハイライト表示を横スクロールに変更
	add_settings_field(
		'thx_pre',
		'ハイライト表示を横スクロールに変更',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'pre',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => '',
		)
	);

	//phpでcssを記述
	add_settings_field(
		'thx_php_css',
		'phpでcssを記述',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'php_css',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => 'thx_textarea_callback',
			'arg'               => array(
				'option_name'       => 'thx_co_option',
				'option_array_name' => 'php_css_array',
				'comment'           => '',
				'placeholder'       => '',
				'rows'              => '20',
				'add'               => '',
			),
		)
	);

	//親スタイルの変更
	add_settings_field(
		'thx_replace_cocoon_style',
		'親スタイルの変更',
		'thx_checkbox_callback',
		'thx_cocoon_option_section',
		'thx_cocoon_option_settings_section',
		array(
			'option_name'       => 'thx_co_option',
			'option_array_name' => 'replace_cocoon_style',
			'comment'           => array(
				'amp'   => array(
					'ampのスタイルに適用する' => '1',
				),
				'style' => array(
					'通常のスタイルに適用する' => '1',
				),
			),
			'add'               => 'thx_textarea_callback',
			'arg'               => array(
				'option_name'       => 'thx_co_option',
				'option_array_name' => 'replace_cocoon_style_array',
				'comment'           => '',
				'placeholder'       => '',
				'rows'              => '20',
				'add'               => '',
			),
		)
	);
}//thx_cocoon_option_settings_init()
