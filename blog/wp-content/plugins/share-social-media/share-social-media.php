<?php
/**
 * Plugin Name: Social Icons Sticky
 * Plugin URI: https://scriptstown.com/wordpress-plugins/share-social-media/
 * Description: Add social sharing icons to a post or page of your WordPress website and allow visitors to share your content on various social media sites.
 * Version: 1.5.9
 * Author: ScriptsTown
 * Author URI: https://scriptstown.com/
 * Text Domain: share-social-media
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

defined( 'ABSPATH' ) || die();

define( 'STSSM_PLUGIN_VERSION', '1.5.9' );
define( 'STSSM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'STSSM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'STSSM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

final class STSSM_Share_Social_Media {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
		$this->setup_database();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/admin.php';
		}
		require_once STSSM_PLUGIN_DIR_PATH . 'public/public.php';
	}

	private function setup_database() {
		require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/class-stssm-database.php';
		register_activation_hook( __FILE__, array( 'STSSM_Database', 'activation' ) );
		register_deactivation_hook( __FILE__, array( 'STSSM_Database', 'deactivation' ) );
	}
}
STSSM_Share_Social_Media::get_instance();
