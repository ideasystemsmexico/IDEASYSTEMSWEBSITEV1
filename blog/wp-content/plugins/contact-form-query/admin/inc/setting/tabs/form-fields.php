<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';
$contact_fields    = STCFQ_Helper::contact_fields();
$consent_field     = STCFQ_Helper::consent_field();
$submit_button     = STCFQ_Helper::submit_button();
$feedback_messages = STCFQ_Helper::feedback_messages();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-form-fields-form">

	<?php $nonce = wp_create_nonce( 'save-form-fields' ); ?>
	<input type="hidden" name="save-form-fields" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-form-fields">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Contact Form Shortcode', 'contact-form-query' ); ?></th>
				<td>
					<strong id="stcfq-contact-form-shortcode">[contact_form_query]</strong>&nbsp;
					<button type="button" class="button" id="stcfq-copy-contact-form-shortcode" data-message="<?php esc_attr_e( 'Copied to clipboard.', 'contact-form-query' ); ?>"><?php esc_html_e( 'Copy', 'contact-form-query' ); ?></button>
					<p class="description">
						<?php esc_html_e( 'Use above shortcode in any page or post to display the contact form. Also, you may use "Contact Form" block in the block editor to display the contact form.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Form Fields', 'contact-form-query' ); ?></th>
				<td>
					<p class="description">
						<?php esc_html_e( 'You can re-order the form fields by simply expanding the field and then draging it up or down.', 'contact-form-query' ); ?>
					</p>
					<ul id="stcfq-form-field-settings" class="clearfix">
					<?php foreach ( $contact_fields as $key => $field ) { ?>
						<li class="stcfq-form-field-setting">
							<button type="button" class="stcfq-accordion">
								<?php echo esc_html( ucwords( $field['name'] ) ); ?>
								<?php esc_html_e( 'field', 'contact-form-query' ); ?>
							</button>
							<div class="stcfq-accordion-panel">
								<p>
									<input type="hidden" name="order[]" value="<?php echo esc_attr( $field['name'] ); ?>">

									<div class="stcfq-accordion-field">
										<span class="stcfq-accordion-field-label">
											<label for="stcfq_form_enable_<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Enable', 'contact-form-query' ); ?></label>
										</span>
										<span class="stcfq-accordion-field-input">
											<label>
												<input <?php checked( $field['enable'], true, true ); ?> type="radio" name="enable_<?php echo esc_attr( $field['name'] ); ?>" value="1">
												<span><?php esc_html_e( 'Yes', 'contact-form-query' ); ?></span>
											</label>
											&nbsp;
											<label>
												<input <?php checked( $field['enable'], false, true ); ?> type="radio" name="enable_<?php echo esc_attr( $field['name'] ); ?>" value="0">
												<span><?php esc_html_e( 'No', 'contact-form-query' ); ?></span>
											</label>
										</span>
									</div>

									<div class="stcfq-accordion-field">
										<span class="stcfq-accordion-field-label">
											<label for="stcfq_form_label_<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Form Label', 'contact-form-query' ); ?></label>
										</span>
										<span class="stcfq-accordion-field-input">
											<input name="label_<?php echo esc_attr( $field['name'] ); ?>" type="text" id="stcfq_form_label_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $field['label'] ); ?>" class="regular-text">
										</span>
									</div>

									<div class="stcfq-accordion-field">
										<span class="stcfq-accordion-field-label">
											<label for="stcfq_form_required_<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Required Field', 'contact-form-query' ); ?></label>
										</span>
										<span class="stcfq-accordion-field-input">
											<label>
												<input <?php checked( $field['required'], true, true ); ?> type="radio" name="required_<?php echo esc_attr( $field['name'] ); ?>" value="1">
												<span><?php esc_html_e( 'Yes', 'contact-form-query' ); ?></span>
											</label>
											&nbsp;
											<label>
												<input <?php checked( $field['required'], false, true ); ?> type="radio" name="required_<?php echo esc_attr( $field['name'] ); ?>" value="0">
												<span><?php esc_html_e( 'No', 'contact-form-query' ); ?></span>
											</label>
										</span>
									</div>

									<div class="stcfq-accordion-field">
										<span class="stcfq-accordion-field-label">
											<label for="stcfq_form_classes_<?php echo esc_attr( $key ); ?>"><?php esc_html_e( 'Additional Class (use space for multiple classes)', 'contact-form-query' ); ?></label>
										</span>
										<span class="stcfq-accordion-field-input">
											<input name="classes_<?php echo esc_attr( $field['name'] ); ?>" type="text" id="stcfq_form_classes_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $field['classes'] ); ?>" class="regular-text">
										</span>
									</div>
								</p>
							</div>
						</li>
					<?php } ?>
					</ul>

					<div class="stcfq-consent-field-settings">
						<button type="button" class="stcfq-accordion"><?php esc_html_e( 'Consent Field', 'contact-form-query' ); ?></button>
						<div class="stcfq-accordion-panel">
							<p>
								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_enable_consent"><?php esc_html_e( 'Enable', 'contact-form-query' ); ?></label>
									</span>
									<span class="stcfq-accordion-field-input">
										<label>
											<input <?php checked( $consent_field['enable'], true, true ); ?> type="radio" name="enable_consent" value="1">
											<span><?php esc_html_e( 'Yes', 'contact-form-query' ); ?></span>
										</label>
										&nbsp;
										<label>
											<input <?php checked( $consent_field['enable'], false, true ); ?> type="radio" name="enable_consent" value="0">
											<span><?php esc_html_e( 'No', 'contact-form-query' ); ?></span>
										</label>
									</span>
								</div>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_text_consent"><?php esc_html_e( 'Field Text', 'contact-form-query' ); ?></label>
									</span>
									<span class="stcfq-accordion-field-input">
										<textarea name="text_consent" rows="5" cols="40" id="stcfq_form_text_consent" class="large-text code"><?php echo esc_html( $consent_field['text'] ); ?></textarea>
									</span>
								</div>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_classes_consent"><?php esc_html_e( 'Additional Class (use space for multiple classes)', 'contact-form-query' ); ?></label>
									</span>
									<span class="stcfq-accordion-field-input">
										<input name="classes_consent" type="text" id="stcfq_form_classes_consent" value="<?php echo esc_attr( $consent_field['classes'] ); ?>" class="regular-text">
									</span>
								</div>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_msg_consent"><?php esc_html_e( 'Validation Message (if unchecked)', 'contact-form-query' ); ?></label>
									</span>
									<span class="stcfq-accordion-field-input">
										<input name="msg_consent" type="text" id="stcfq_form_msg_consent" value="<?php echo esc_attr( $consent_field['msg'] ); ?>" class="widefat">
									</span>
								</div>
							</p>
						</div>
					</div>

					<div class="stcfq-submit-button-settings">
						<button type="button" class="stcfq-accordion"><?php esc_html_e( 'Submit Button', 'contact-form-query' ); ?></button>
						<div class="stcfq-accordion-panel">
							<p>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_text_button"><?php esc_html_e( 'Button Text', 'contact-form-query' ); ?></label>
									</span>
									<span class="stcfq-accordion-field-input">
										<input name="text_button" type="text" id="stcfq_form_text_button" value="<?php echo esc_attr( $submit_button['text'] ); ?>" class="regular-text">
									</span>
								</div>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_classes_button_parent">
											<?php esc_html_e( 'Additional Class for Button Container (use space for multiple classes)', 'contact-form-query' ); ?>
											<hr>
											<?php
											echo wp_kses(
												__( 'Example: <span class="stcfq-text-light">wp-block-buttons', 'contact-form-query' ),
												array( 'span' => array( 'class' => array() ) )
											);
											?>
										</label>
									</span>

									<span class="stcfq-accordion-field-input">
										<input name="parent_classes_button" type="text" id="stcfq_form_classes_button_parent" value="<?php echo esc_attr( $submit_button['parent_classes'] ); ?>" class="regular-text">
									</span>
								</div>

								<div class="stcfq-accordion-field">
									<span class="stcfq-accordion-field-label">
										<label for="stcfq_form_classes_button">
											<?php esc_html_e( 'Additional Class for Button Element (use space for multiple classes)', 'contact-form-query' ); ?>
											<hr>
											<?php
											echo wp_kses(
												__( 'Example: <span class="stcfq-text-light">wp-block-button wp-block-button-link wp-element-button</span>', 'contact-form-query' ),
												array( 'span' => array( 'class' => array() ) )
											);
											?>
										</label>
									</span>
									<span class="stcfq-accordion-field-input">
										<input name="classes_button" type="text" id="stcfq_form_classes_button" value="<?php echo esc_attr( $submit_button['classes'] ); ?>" class="regular-text">
									</span>
								</div>
							</p>
						</div>
					</div>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_success_message"><?php esc_html_e( 'Success Message', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="success_message" type="text" id="stcfq_success_message" value="<?php echo esc_attr( $feedback_messages['success'] ); ?>" class="widefat">
					<p class="description">
						<?php esc_html_e( 'Enter message to show when user submits the form successfully.', 'contact-form-query' ); ?>&nbsp;
					</p>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-form-fields-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>

<div class="stcfq-review">
	<div class="stcfq-review-us">
		<a target="_blank" href="https://wordpress.org/support/plugin/contact-form-query/reviews/#new-post" class="stcfq-review-link">
			<span class="stcfq-rate-us">
				<?php esc_html_e( 'Like this plugin? Leave a Review.', 'contact-form-query' ); ?>
			</span>
			<div class="vers column-rating">
				<div class="star-rating">
					<span class="screen-reader-text"><?php esc_html_e( 'Like this plugin? Leave a Review.', 'contact-form-query' ); ?></span>
					<div class="star star-full" aria-hidden="true"></div>
					<div class="star star-full" aria-hidden="true"></div>
					<div class="star star-full" aria-hidden="true"></div>
					<div class="star star-full" aria-hidden="true"></div>
					<div class="star star-full" aria-hidden="true"></div>
				</div>
			</div>
		</a>
	</div>
</div>
