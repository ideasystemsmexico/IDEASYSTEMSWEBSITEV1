<?php
defined( 'ABSPATH' ) || die();
?>
<div class="stcfq-filter-title">
	<?php esc_html_e( 'Search & Filter Messages', 'contact-form-query' ); ?>
</div>
<form action="<?php echo esc_url( admin_url( 'admin.php?page=stcfq_messages' ) ); ?>" method="post" id="stcfq-apply-filter-form">
	<input type="hidden" name="apply-filter" value="<?php echo esc_attr( wp_create_nonce( 'apply-filter' ) ); ?>">

	<div class="stcfq-filter-items">
		<?php
		if ( $filter_items_count > 0 ) {
			foreach ( $search_key as $key => $value ) {
				$search_field = sanitize_text_field( wp_unslash( $value ) );
				$search_value = isset( $_POST['search_value'][ $key ] ) ? sanitize_text_field( wp_unslash( $_POST['search_value'][ $key ] ) ) : ''; ?>
				<div class="stcfq-filter-item">
					<select name="search_key[]">
						<option value="subject" <?php selected( $search_field, 'subject', true ); ?>>
							<?php esc_html_e( 'Subject', 'contact-form-query' ); ?>
						</option>
						<option value="name" <?php selected( $search_field, 'name', true ); ?>>
							<?php esc_html_e( 'Name', 'contact-form-query' ); ?>
						</option>
						<option value="email" <?php selected( $search_field, 'email', true ); ?>>
							<?php esc_html_e( 'Email', 'contact-form-query' ); ?>
						</option>
						<option value="message" <?php selected( $search_field, 'message', true ); ?>>
							<?php esc_html_e( 'Message', 'contact-form-query' ); ?>
						</option>
						<option value="answered" <?php selected( $search_field, 'answered', true ); ?>>
							<?php esc_html_e( 'Answered (Y or N)', 'contact-form-query' ); ?>
						</option>
						<option value="note" <?php selected( $search_field, 'note', true ); ?>>
							<?php esc_html_e( 'Note', 'contact-form-query' ); ?>
						</option>
					</select>
					<input type="text" name="search_value[]" value="<?php echo esc_attr( $search_value ); ?>" required>
					<button type="button" class="stcfq-filter-remove-item">
						<span class="dashicons dashicons-no"></span>
					</button>
				</div>
			<?php
			}
		} else { ?>
		<div class="stcfq-filter-item">
			<select name="search_key[]">
				<option value="subject"><?php esc_html_e( 'Subject', 'contact-form-query' ); ?></option>
				<option value="name"><?php esc_html_e( 'Name', 'contact-form-query' ); ?></option>
				<option value="email"><?php esc_html_e( 'Email', 'contact-form-query' ); ?></option>
				<option value="message"><?php esc_html_e( 'Message', 'contact-form-query' ); ?></option>
				<option value="answered"><?php esc_html_e( 'Answered (Y or N)', 'contact-form-query' ); ?></option>
				<option value="note"><?php esc_html_e( 'Note', 'contact-form-query' ); ?></option>
			</select>
			<input type="text" name="search_value[]" required>
			<button type="button" class="stcfq-filter-remove-item">
				<span class="dashicons dashicons-no"></span>
			</button>
		</div>
		<?php
		} ?>
	</div>

	<div class="stcfq-filter-actions mt-2 mb-2">
		<button type="button" class="button button-secondary stcfq-filter-add-item"><?php esc_html_e( 'Add more', 'contact-form-query' ); ?></button>
		<button type="submit" class="button button-primary stcfq-apply-filter"><?php esc_html_e( 'Apply filter', 'contact-form-query' ); ?></button>
		<?php if ( $filter_items_count > 0 ) { ?>
		<button type="button" class="button button-secondary stcfq-reset-filter"><?php esc_html_e( 'Reset filter', 'contact-form-query' ); ?></button>
		<?php } ?>
	</div>
</form>
