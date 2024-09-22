<?php
defined( 'WP_UNINSTALL_PLUGIN' ) || die();

delete_transient( 'stcfq_unanswered_messages_count' );
delete_option( 'stcfq_redirect_to_settings' );

if ( get_option( 'stcfq_delete_data_enable' ) ) {

	delete_option( 'stcfq_delete_data_enable' );
	delete_option( 'stcfq_submit_button' );
	delete_option( 'stcfq_consent_field' );
	delete_option( 'stcfq_form_fields' );
	delete_option( 'stcfq_captcha' );
	delete_option( 'stcfq_block_keywords' );
	delete_option( 'stcfq_email_carrier' );
	delete_option( 'stcfq_wp_mail' );
	delete_option( 'stcfq_smtp' );
	delete_option( 'stcfq_email_to_admin' );
	delete_option( 'stcfq_google_recaptcha_v2' );
	delete_option( 'stcfq_cf_turnstile' );
	delete_option( 'stcfq_feedback_messages' );
	delete_option( 'stcfq_layout' );
	delete_option( 'stcfq_design' );

	global $wpdb;
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}stcfq_queries" );
}
