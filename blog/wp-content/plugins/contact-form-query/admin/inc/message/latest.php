<?php
defined( 'ABSPATH' ) || die();

global $wpdb;

$messages = $wpdb->get_results( "SELECT ID, subject, message, created_at FROM {$wpdb->prefix}stcfq_queries ORDER BY ID DESC LIMIT 5" );

if ( count( $messages ) ) {
	?>
	<ul class="stcfq-latest-messages">
	<?php
	foreach ( $messages as $key => $value ) {
		if ( strlen( $value->subject ) > 80 ) {
			$subject = implode( ' ', array_slice( explode( ' ', stripslashes( $value->subject ) ), 0, 15 ) ) . '&hellip;';
		} else {
			$subject = stripslashes( $value->subject );
		}

		if ( strlen( $value->message ) > 120 ) {
			$message = implode( ' ', array_slice( explode( ' ', stripslashes( $value->message ) ), 0, 20 ) ) . '&hellip;';
		} else {
			$message = stripslashes( $value->message );
		}
		?>
		<li>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=stcfq_messages' ) . '&id=' . $value->ID . '&action=view' ); ?>">
				<span class="stcfq-latest-message-subject"><?php echo esc_html( $subject ); ?></span>
			</a>
			<span class="stcfq-latest-message-timestamp"><?php echo esc_html( STCFQ_Helper::local_date_i18n( $value->created_at, 'M jS Y, g:i a' ) ); ?></span>
			<?php if ( ! empty( $message ) ) { ?>
			<p>
				<?php echo esc_html( $message ); ?>
			</p>
			<?php } ?>
		</li>
		<?php
	}
	?>
	</ul>
	<div class="stcfq-dashboard-widget-footer">
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=stcfq_messages' ) ); ?>">
			<?php esc_html_e( 'View all', 'contact-form-query' ); ?>
		</a>
	</div>
	<?php
} else {
	?>
	<p><?php esc_html_e( 'No message found.', 'contact-form-query' ); ?></p>
	<?php
}
