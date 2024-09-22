<?php
defined( 'ABSPATH' ) || die();

require_once STSSM_PLUGIN_DIR_PATH . 'public/inc/class-stssm-language.php';
require_once STSSM_PLUGIN_DIR_PATH . 'public/inc/class-stssm-share.php';

add_action( 'init', array( 'STSSM_Language', 'load_translation' ) );

add_filter( 'the_content', array( 'STSSM_Share', 'add_icons_to_content' ) );

add_action( 'wp_enqueue_scripts', array( 'STSSM_Share', 'enqueue_scripts' ) );
