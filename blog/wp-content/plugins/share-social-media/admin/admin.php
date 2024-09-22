<?php
defined( 'ABSPATH' ) || die();

require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/class-stssm-admin-menu.php';
require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/class-stssm-setting.php';

add_filter( 'plugin_action_links_' . STSSM_PLUGIN_BASENAME, array( 'STSSM_Setting', 'add_action_links' ) );

add_action( 'admin_notices', array( 'STSSM_Setting', 'redirect' ) );

add_action( 'init', array( 'STSSM_Admin_Menu', 'register_assets' ) );

add_action( 'admin_menu', array( 'STSSM_Admin_Menu', 'create_menu' ) );

add_action( 'wp_ajax_stssm-save-social-share-icons', array( 'STSSM_Setting', 'save_social_share_icons' ) );

add_action( 'wp_ajax_stssm-save-icons-design', array( 'STSSM_Setting', 'save_icons_design' ) );

add_action( 'wp_ajax_stssm-reset-plugin', array( 'STSSM_Setting', 'reset_plugin' ) );
