<?php
defined( 'ABSPATH' ) || die();

class STSSM_Admin_Menu {
	public static function register_assets() {
		wp_register_style( 'stssm-admin', STSSM_PLUGIN_URL . 'assets/css/stssm-admin.css', array(), STSSM_PLUGIN_VERSION, 'all' );
	}

	public static function create_menu() {
		$settings = add_options_page( esc_html__( 'Social Icons Sticky', 'share-social-media' ), esc_html__( 'Social Share', 'share-social-media' ), 'manage_options', 'stssm_settings', array( 'STSSM_Admin_Menu', 'settings' ) );
		add_action( 'admin_print_styles-' . $settings, array( 'STSSM_Admin_Menu', 'settings_assets' ) );
	}

	public static function settings() {
		require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/setting/index.php';
	}

	public static function settings_assets() {
		wp_enqueue_style( 'stssm-admin' );
		wp_style_add_data( 'stssm-admin', 'rtl', 'replace' );
		wp_enqueue_script( 'stssm-admin', STSSM_PLUGIN_URL . 'assets/js/stssm-admin.js', array( 'jquery', 'jquery-form' ), STSSM_PLUGIN_VERSION, true );
		wp_add_inline_script(
			'stssm-admin',
			sprintf( 'var stssmadminurl = %s;', wp_json_encode( admin_url() ) ),
			'before'
		);
	}
}
