<?php
defined( 'ABSPATH' ) || die();

class STSSM_Language {
	public static function load_translation() {
		load_plugin_textdomain( 'share-social-media', false, basename( STSSM_PLUGIN_DIR_PATH ) . '/languages' );
	}
}
