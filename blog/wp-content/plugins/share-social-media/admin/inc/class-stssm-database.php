<?php
defined( 'ABSPATH' ) || die();

class STSSM_Database {
	/**
	 * Plugin activation.
	 *
	 * @return void
	 */
	public static function activation() {
		add_option( 'stssm_redirect_to_settings', true );
	}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public static function deactivation() {
		delete_option( 'stssm_redirect_to_settings' );
	}
}
