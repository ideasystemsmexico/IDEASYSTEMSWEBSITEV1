<?php
defined( 'ABSPATH' ) || die();

require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/class-stcfq-admin-menu.php';
require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/class-stcfq-message.php';
require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/class-stcfq-setting.php';

/* Filter to add action links */
add_filter( 'plugin_action_links_' . STCFQ_PLUGIN_BASENAME, array( 'STCFQ_Setting', 'add_action_links' ) );

/* Action to redirect after activation */
add_action( 'admin_notices', array( 'STCFQ_Setting', 'redirect' ) );

/* Action to register assets */
add_action( 'init', array( 'STCFQ_Admin_Menu', 'register_assets' ) );

/* Action to create menu pages */
add_action( 'admin_menu', array( 'STCFQ_Admin_Menu', 'create_menu' ) );

/* Action to load more messages */
add_action( 'wp_ajax_stcfq-load-more-messages', array( 'STCFQ_Message', 'load_more' ) );

/* Action to delete message */
add_action( 'wp_ajax_stcfq-delete-message', array( 'STCFQ_Message', 'delete' ) );

/* Action to perform on bulk messages */
add_action( 'wp_ajax_stcfq-bulk-action', array( 'STCFQ_Message', 'bulk_action' ) );

/* Action to save note */
add_action( 'wp_ajax_stcfq-save-note', array( 'STCFQ_Message', 'save_note' ) );

/* Action to add latest messages to dashboard */
add_action( 'wp_dashboard_setup', array( 'STCFQ_Message', 'latest_messages' ) );

/* Action to enqueue scripts to admin dashboard */
add_action( 'admin_enqueue_scripts', array( 'STCFQ_Message', 'admin_enqueue_scripts' ) );

/* Action to save form fields settings */
add_action( 'wp_ajax_stcfq-save-form-fields', array( 'STCFQ_Setting', 'save_form_fields' ) );

/* Action to save layout settings */
add_action( 'wp_ajax_stcfq-save-layout', array( 'STCFQ_Setting', 'save_layout' ) );

/* Action to save captcha settings */
add_action( 'wp_ajax_stcfq-save-captcha', array( 'STCFQ_Setting', 'save_captcha' ) );

/* Action to save email settings */
add_action( 'wp_ajax_stcfq-save-email', array( 'STCFQ_Setting', 'save_email' ) );

/* Action to save uninstall setting */
add_action( 'wp_ajax_stcfq-save-uninstall-setting', array( 'STCFQ_Setting', 'save_uninstall_setting' ) );
