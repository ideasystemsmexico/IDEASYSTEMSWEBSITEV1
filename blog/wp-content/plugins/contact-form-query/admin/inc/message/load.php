<?php
defined( 'ABSPATH' ) || die();

$message_count = count( $messages );
if ( $message_count > 0 ) {
	$offset = ( $current_page - 1 ) * $items_per_page;

	foreach ( $messages as $key => $value ) {
		$subject = isset( $value->subject ) ? $value->subject : '';
		$message = isset( $value->message ) ? $value->message : '';
		$name    = isset( $value->name ) ? $value->name : '';
		$email   = isset( $value->email ) ? $value->email : '';

		if ( strlen( $subject ) > 100 ) {
			$subject = implode( ' ', array_slice( explode( ' ', stripslashes( $subject ) ), 0, 20 ) ) . '&hellip;';
		} else {
			$subject = stripslashes( $subject );
		}

		if ( strlen( $message ) > 100 ) {
			$message = implode( ' ', array_slice( explode( ' ', stripslashes( $message ) ), 0, 20 ) ) . '&hellip;';
		} else {
			$message = stripslashes( $message );
		}

		if ( strlen( $name ) > 100 ) {
			$name = implode( ' ', array_slice( explode( ' ', stripslashes( $name ) ), 0, 20 ) ) . '&hellip;';
		} else {
			$name = stripslashes( $name );
		}

		if ( strlen( $email ) > 100 ) {
			$email = implode( ' ', array_slice( explode( ' ', stripslashes( $email ) ), 0, 20 ) ) . '&hellip;';
		} else {
			$email = stripslashes( $email );
		}
		?>
		<tr>
			<td data-label="<?php esc_attr_e( 'Select', 'contact-form-query' ); ?>">
				<input type="checkbox" class="stcfq-select-single" name="ids[]" value="<?php echo esc_attr( $value->ID ); ?>">
			</td>
			<td data-label="<?php esc_attr_e( 'S.No', 'contact-form-query' ); ?>">
				<?php echo esc_html( $total - ( $offset + $key ) ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Subject', 'contact-form-query' ); ?>">
				<?php echo esc_html( $subject ? $subject : '-' ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Message', 'contact-form-query' ); ?>">
				<?php echo esc_html( $message ? $message : '-' ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Name', 'contact-form-query' ); ?>">
				<?php echo esc_html( $name ? $name : '-' ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Email', 'contact-form-query' ); ?>">
				<?php echo esc_html( $email ? $email : '-' ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Answered', 'contact-form-query' ); ?>">
				<?php
				if ( $value->answered ) {
					echo ( '<span class="stcfq-text-bold stcfq-text-green">' . esc_html__( 'Yes', 'contact-form-query' ) . '</span>' );
				} else {
					echo ( '<span class="stcfq-text-bold stcfq-text-red">' . esc_html__( 'No', 'contact-form-query' ) . '</span>' );
				}
				?>
			</td>
			<td data-label="<?php esc_attr_e( 'Date', 'contact-form-query' ); ?>">
				<?php echo esc_html( ( $value->created_at ? STCFQ_Helper::local_date_i18n( $value->created_at, 'M jS Y, g:i a' ) : '-' ) ); ?>
			</td>
			<td data-label="<?php esc_attr_e( 'Action', 'contact-form-query' ); ?>">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=stcfq_messages' ) . '&id=' . $value->ID . '&action=view' ); ?>">
					<span class="dashicons dashicons-search"></span>
				</a>&nbsp;
				<a href="javascript:void(0)" class="stcfq-delete-message" data-message="<?php echo esc_attr( $value->ID ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'delete-message-' . $value->ID ) ); ?>" data-message-confirm="<?php esc_attr_e( 'Are you sure to delete this message?', 'contact-form-query' ); ?>">
					<span class="dashicons dashicons-trash"></span>
				</a>
			</td>
		</tr>
		<?php
	}
}
