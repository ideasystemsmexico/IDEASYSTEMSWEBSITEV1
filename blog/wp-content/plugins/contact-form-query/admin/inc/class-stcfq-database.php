<?php
defined( 'ABSPATH' ) || die();

class STCFQ_Database {
	/**
	 * Plugin activation.
	 *
	 * @return void
	 */
	public static function activation() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		// Create stcfq_queries table.
		$sql = "CREATE TABLE {$wpdb->prefix}stcfq_queries (
				ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				name varchar(255) DEFAULT NULL,
				email varchar(255) DEFAULT NULL,
				subject varchar(255) DEFAULT NULL,
				message text DEFAULT NULL,
				answered tinyint(1) NOT NULL DEFAULT '0',
				note text DEFAULT NULL,
				created_at datetime NULL DEFAULT NULL,
				updated_at datetime NULL DEFAULT NULL,
				PRIMARY KEY  (ID),
				KEY idx_answered (answered)
				) $charset_collate";
		dbDelta( $sql );

		// Create index 'idx_answered' if not exists on stcfq_queries table.
		$idx_answered = $wpdb->get_var(
			"SELECT COUNT(1) FROM INFORMATION_SCHEMA.STATISTICS
			WHERE TABLE_SCHEMA = DATABASE()
			AND TABLE_NAME = '{$wpdb->prefix}stcfq_queries'
			AND INDEX_NAME = 'idx_answered'"
		);

		if ( ! $idx_answered ) {
			$wpdb->query( "ALTER TABLE {$wpdb->prefix}stcfq_queries ADD INDEX idx_answered (answered)" );
		}

		add_option( 'stcfq_redirect_to_settings', true );
		delete_transient( 'stcfq_unanswered_messages_count' );
	}

	/**
	 * Plugin deactivation.
	 *
	 * @return void
	 */
	public static function deactivation() {
		delete_transient( 'stcfq_unanswered_messages_count' );
		delete_option( 'stcfq_redirect_to_settings' );
	}
}
