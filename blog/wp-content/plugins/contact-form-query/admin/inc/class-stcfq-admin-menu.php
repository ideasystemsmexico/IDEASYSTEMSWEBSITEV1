<?php
defined( 'ABSPATH' ) || die();

class STCFQ_Admin_Menu {
	public static function register_assets() {
		wp_register_style( 'stcfq-admin', STCFQ_PLUGIN_URL . 'assets/css/stcfq-admin.css', array(), STCFQ_PLUGIN_VERSION, 'all' );
	}

	public static function create_menu() {
		$messages = add_menu_page(
			esc_html__( 'Contact Form Query', 'contact-form-query' ),
			esc_html__( 'Contact', 'contact-form-query' ),
			'manage_options',
			'stcfq_messages',
			array( 'STCFQ_Admin_Menu', 'messages' ),
			'dashicons-email',
			27
		);
		add_action( 'admin_print_styles-' . $messages, array( 'STCFQ_Admin_Menu', 'messages_assets' ) );

		$messages_submenu = add_submenu_page( 'stcfq_messages', esc_html__( 'Messages', 'contact-form-query' ), esc_html__( 'Messages', 'contact-form-query' ), 'manage_options', 'stcfq_messages', array( 'STCFQ_Admin_Menu', 'messages' ) );
		add_action( 'admin_print_styles-' . $messages_submenu, array( 'STCFQ_Admin_Menu', 'messages_assets' ) );

		$settings_submenu = add_submenu_page( 'stcfq_messages', esc_html__( 'Settings', 'contact-form-query' ), esc_html__( 'Settings', 'contact-form-query' ), 'manage_options', 'stcfq_settings', array( 'STCFQ_Admin_Menu', 'settings' ) );
		add_action( 'admin_print_styles-' . $settings_submenu, array( 'STCFQ_Admin_Menu', 'settings_assets' ) );
	}

	public static function messages() {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/message/route.php';
	}

	public static function messages_assets() {
		wp_enqueue_style( 'stcfq-admin' );
		wp_style_add_data( 'stcfq-admin', 'rtl', 'replace' );
		wp_enqueue_script( 'stcfq-admin', STCFQ_PLUGIN_URL . 'assets/js/stcfq-admin.js', array( 'jquery', 'jquery-form', 'jquery-ui-sortable', 'wp-color-picker' ), STCFQ_PLUGIN_VERSION, true );
		wp_add_inline_script(
			'stcfq-admin',
			sprintf( 'var stcfqadminurl = %s;', wp_json_encode( admin_url() ) ),
			'before'
		);
	}

	public static function settings() {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/index.php';
	}

	public static function settings_assets() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'stcfq-admin' );
		wp_style_add_data( 'stcfq-admin', 'rtl', 'replace' );
		wp_enqueue_script( 'stcfq-admin', STCFQ_PLUGIN_URL . 'assets/js/stcfq-admin.js', array( 'jquery', 'jquery-form', 'jquery-ui-sortable', 'wp-color-picker' ), STCFQ_PLUGIN_VERSION, true );
		wp_add_inline_script(
			'stcfq-admin',
			sprintf( 'var stcfqadminurl = %s;', wp_json_encode( admin_url() ) ),
			'before'
		);
	}
}
