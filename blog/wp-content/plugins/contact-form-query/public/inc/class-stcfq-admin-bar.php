<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

class STCFQ_Admin_Bar {
	public static function admin_bar_menu() {
		if ( current_user_can( 'manage_options' ) ) {
			global $wp_admin_bar;

			$messages_count = STCFQ_Helper::unanswered_messages_count();

			$wp_admin_bar->add_menu(
				array(
					'id'    => 'stcfq-messages-count',
					/* translators: %d: Number of unanswered messages */
					'title' => '<span class="ab-icon"></span><span class="ab-label awaiting-mod count-' . esc_attr( $messages_count ) . '" aria-hidden="true">' . esc_html( $messages_count ) . '</span><span class="screen-reader-text comments-in-moderation-text">' . sprintf( esc_html( _n( '%d Message not answered.', '%d Messages not answered', $messages_count, 'contact-form-query' ) ), $messages_count ) . '</span>',
					'href'  => esc_url( admin_url( 'admin.php?page=stcfq_messages' ) ),
				)
			);
		}
	}

	public static function admin_bar_menu_assets() {
		if ( current_user_can( 'manage_options' ) ) {
			wp_register_style( 'stcfq-admin-bar', STCFQ_PLUGIN_URL . 'assets/css/stcfq-admin-bar.css', array(), STCFQ_PLUGIN_VERSION, 'all' );
			wp_enqueue_style( 'stcfq-admin-bar' );
			wp_style_add_data( 'stcfq-admin-bar', 'rtl', 'replace' );
		}
	}
}
