<?php
/**
 * Plugin Name: Contact Form Query
 * Plugin URI: https://scriptstown.com/wordpress-plugins/contact-form-query/
 * Description: Add a contact form and receive new message notifications directly to your WordPress admin and to your email. Search and filter messages.
 * Version: 1.8.1
 * Author: ScriptsTown
 * Author URI: https://scriptstown.com/
 * Text Domain: contact-form-query
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */

defined( 'ABSPATH' ) || die();

define( 'STCFQ_PLUGIN_VERSION', '1.8.1' );
define( 'STCFQ_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'STCFQ_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'STCFQ_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

final class STCFQ_Contact_Form_Query {
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
			require_once STCFQ_PLUGIN_DIR_PATH . 'admin/admin.php';
		}
		require_once STCFQ_PLUGIN_DIR_PATH . 'public/public.php';
	}

	private function setup_database() {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/class-stcfq-database.php';
		register_activation_hook( __FILE__, array( 'STCFQ_Database', 'activation' ) );
		register_deactivation_hook( __FILE__, array( 'STCFQ_Database', 'deactivation' ) );
	}
}
STCFQ_Contact_Form_Query::get_instance();
