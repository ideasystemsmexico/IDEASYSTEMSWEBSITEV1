<?php
defined( 'ABSPATH' ) || die();

class STCFQ_Init {
	public static function init() {
		load_plugin_textdomain( 'contact-form-query', false, basename( STCFQ_PLUGIN_DIR_PATH ) . '/languages' );

		if ( version_compare( $GLOBALS['wp_version'], '5.8', '>=' ) ) {
			register_block_type(
				STCFQ_PLUGIN_DIR_PATH . 'includes/block',
				array(
					'render_callback' => array( 'STCFQ_Form', 'contact_form_query' ),
				)
			);
		}
	}
}
