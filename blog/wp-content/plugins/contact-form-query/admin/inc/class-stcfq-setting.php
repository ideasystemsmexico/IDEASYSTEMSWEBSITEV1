<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

class STCFQ_Setting {
	public static function add_action_links( $links ) {
		$settings_link = ( '<a href="' . esc_url( admin_url( 'admin.php?page=stcfq_settings' ) ) . '">' . esc_html__( 'Settings', 'contact-form-query' ) . '</a>' );
		array_unshift( $links, $settings_link );

		return $links;
	}

	public static function redirect() {
		if ( get_option( 'stcfq_redirect_to_settings', false ) ) {
			delete_option( 'stcfq_redirect_to_settings' );
			?>
			<div class="updated notice notice-success is-dismissible">
				<p>
					<?php
					echo wp_kses(
						sprintf(
							/* translators: %s: Settings page link. */
							__( 'To get started with Contact Form Query, visit our <a href="%s" target="_blank">settings page</a>.', 'contact-form-query' ),
							esc_url( admin_url( 'admin.php?page=stcfq_settings' ) )
						),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						)
					);
					?>
				</p>
				<p>
					<a class="button" href="<?php echo esc_url( admin_url( 'admin.php?page=stcfq_settings' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Contact Form Query Settings', 'contact-form-query' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}

	public static function save_form_fields() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-form-fields'] ) || ! wp_verify_nonce( $_POST['save-form-fields'], 'save-form-fields' ) ) {
			die();
		}

		$enable_name    = isset( $_POST['enable_name'] ) ? (bool) $_POST['enable_name'] : true;
		$enable_email   = isset( $_POST['enable_email'] ) ? (bool) $_POST['enable_email']  : true;
		$enable_subject = isset( $_POST['enable_subject'] ) ? (bool) $_POST['enable_subject'] : true;
		$enable_message = isset( $_POST['enable_message'] ) ? (bool) $_POST['enable_message'] : true;

		$label_name    = isset( $_POST['label_name'] ) ? sanitize_text_field( $_POST['label_name'] ) : '';
		$label_email   = isset( $_POST['label_email'] ) ? sanitize_text_field( $_POST['label_email'] ) : '';
		$label_subject = isset( $_POST['label_subject'] ) ? sanitize_text_field( $_POST['label_subject'] ) : '';
		$label_message = isset( $_POST['label_message'] ) ? sanitize_text_field( $_POST['label_message'] ) : '';

		$classes_name    = isset( $_POST['classes_name'] ) ? sanitize_text_field( $_POST['classes_name'] ) : '';
		$classes_email   = isset( $_POST['classes_email'] ) ? sanitize_text_field( $_POST['classes_email'] ) : '';
		$classes_subject = isset( $_POST['classes_subject'] ) ? sanitize_text_field( $_POST['classes_subject'] ) : '';
		$classes_message = isset( $_POST['classes_message'] ) ? sanitize_text_field( $_POST['classes_message'] ) : '';

		$required_name    = isset( $_POST['required_name'] ) ? (bool) $_POST['required_name'] : true;
		$required_email   = isset( $_POST['required_email'] ) ? (bool) $_POST['required_email'] : true;
		$required_subject = isset( $_POST['required_subject'] ) ? (bool) $_POST['required_subject'] : true;
		$required_message = isset( $_POST['required_message'] ) ? (bool) $_POST['required_message'] : true;

		$enable_consent  = isset( $_POST['enable_consent'] ) ? (bool) $_POST['enable_consent'] : false;
		$text_consent    = isset( $_POST['text_consent'] ) ? sanitize_text_field( $_POST['text_consent'] ) : '';
		$classes_consent = isset( $_POST['classes_consent'] ) ? sanitize_text_field( $_POST['classes_consent'] ) : '';
		$msg_consent     = isset( $_POST['msg_consent'] ) ? sanitize_text_field( $_POST['msg_consent'] ) : '';

		$text_button           = isset( $_POST['text_button'] ) ? sanitize_text_field( $_POST['text_button'] ) : '';
		$parent_classes_button = isset( $_POST['parent_classes_button'] ) ? sanitize_text_field( $_POST['parent_classes_button'] ) : '';
		$classes_button        = isset( $_POST['classes_button'] ) ? sanitize_text_field( $_POST['classes_button'] ) : '';

		$order = ( isset( $_POST['order'] ) && is_array( $_POST['order'] ) ) ? array_map( 'sanitize_text_field', $_POST['order'] ) : array();

		$success_message = isset( $_POST['success_message'] ) ? sanitize_text_field( $_POST['success_message'] ) : '';

		if ( empty( $label_name ) ) {
			$label_name = esc_html__( 'Your Name', 'contact-form-query' );
		}
		if ( empty( $label_email ) ) {
			$label_email = esc_html__( 'Your Email', 'contact-form-query' );
		}
		if ( empty( $label_subject ) ) {
			$label_subject = esc_html__( 'Subject', 'contact-form-query' );
		}
		if ( empty( $label_message ) ) {
			$label_message = esc_html__( 'Message', 'contact-form-query' );
		}

		$fields = array( 'name', 'email', 'subject', 'message' );

		if ( array_diff( $order, $fields ) !== array_diff( $fields, $order ) ) {
			wp_send_json_error( esc_html__( 'The fields are invalid or not supported.', 'contact-form-query' ) );
		}

		$at_least_one_field = $enable_name || $enable_email || $enable_subject || $enable_message;

		if ( ! $at_least_one_field ) {
			wp_send_json_error( esc_html__( 'Please enable at least one field.', 'contact-form-query' ) );
		}

		$type_name    = 'text';
		$type_email   = 'email';
		$type_subject = 'text';
		$type_message = 'textarea';

		$data = array();
		foreach ( $order as $field ) {
			array_push(
				$data,
				array(
					'name'     => $field,
					'enable'   => ${'enable_' . $field},
					'type'     => ${'type_' . $field},
					'label'    => ${'label_' . $field},
					'required' => ${'required_' . $field},
					'classes'  => ${'classes_' . $field},
				)
			);
		}

		update_option( 'stcfq_form_fields', $data, true );

		$consent_field = array(
			'enable'  => $enable_consent,
			'text'    => $text_consent,
			'classes' => $classes_consent,
			'msg'     => $msg_consent,
		);

		update_option( 'stcfq_consent_field', $consent_field, true );

		$submit_button = array(
			'text'           => $text_button,
			'parent_classes' => $parent_classes_button,
			'classes'        => $classes_button,
		);

		update_option( 'stcfq_submit_button', $submit_button, true );

		$feedback_messages = array(
			'success' => $success_message,
		);

		update_option( 'stcfq_feedback_messages', $feedback_messages, true );

		wp_send_json_success( array( 'message' => esc_html__( 'Setting saved.', 'contact-form-query' ) ) );
	}

	public static function save_layout() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-layout'] ) || ! wp_verify_nonce( $_POST['save-layout'], 'save-layout' ) ) {
			die();
		}

		$layout = isset( $_POST['layout'] ) ? sanitize_text_field( $_POST['layout'] ) : STCFQ_Helper::default_layout();

		if ( ! in_array( $layout, array_keys( STCFQ_Helper::layout_list() ) ) ) {
			$layout = STCFQ_Helper::default_layout();
		}

		update_option( 'stcfq_layout', $layout, true );

		$success_background_color = isset( $_POST['success_background_color'] ) ? sanitize_text_field( $_POST['success_background_color'] ) : '';
		$success_border_color     = isset( $_POST['success_border_color'] ) ? sanitize_text_field( $_POST['success_border_color'] ) : '';
		$success_font_color       = isset( $_POST['success_font_color'] ) ? sanitize_text_field( $_POST['success_font_color'] ) : '';

		$error_background_color   = isset( $_POST['error_background_color'] ) ? sanitize_text_field( $_POST['error_background_color'] ) : '';
		$error_border_color       = isset( $_POST['error_border_color'] ) ? sanitize_text_field( $_POST['error_border_color'] ) : '';
		$error_font_color         = isset( $_POST['error_font_color'] ) ? sanitize_text_field( $_POST['error_font_color'] ) : '';

		$validation_error_color        = isset( $_POST['validation_error_color'] ) ? sanitize_text_field( $_POST['validation_error_color'] ) : '';
		$validation_error_border_color = isset( $_POST['validation_error_border_color'] ) ? sanitize_text_field( $_POST['validation_error_border_color'] ) : '';

		$design = array(
			'success_background_color'      => $success_background_color,
			'success_border_color'          => $success_border_color,
			'success_font_color'            => $success_font_color,
			'error_background_color'        => $error_background_color,
			'error_border_color'            => $error_border_color,
			'error_font_color'              => $error_font_color,
			'validation_error_color'        => $validation_error_color,
			'validation_error_border_color' => $validation_error_border_color,
		);

		update_option( 'stcfq_design', $design, true );

		wp_send_json_success( array( 'message' => esc_html__( 'Setting saved.', 'contact-form-query' ) ) );
	}

	public static function save_captcha() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-captcha'] ) || ! wp_verify_nonce( $_POST['save-captcha'], 'save-captcha' ) ) {
			die();
		}

		$captcha = isset( $_POST['captcha'] ) ? sanitize_text_field( $_POST['captcha'] ) : '';

		$google_recaptcha_v2_site_key   = isset( $_POST['google_recaptcha_v2_site_key'] ) ? sanitize_text_field( $_POST['google_recaptcha_v2_site_key'] ) : '';
		$google_recaptcha_v2_secret_key = isset( $_POST['google_recaptcha_v2_secret_key'] ) ? sanitize_text_field( $_POST['google_recaptcha_v2_secret_key'] ) : '';
		$google_recaptcha_v2_theme      = isset( $_POST['google_recaptcha_v2_theme'] ) ? sanitize_text_field( $_POST['google_recaptcha_v2_theme'] ) : 'light';

		$cf_turnstile_site_key   = isset( $_POST['cf_turnstile_site_key'] ) ? sanitize_text_field( $_POST['cf_turnstile_site_key'] ) : '';
		$cf_turnstile_secret_key = isset( $_POST['cf_turnstile_secret_key'] ) ? sanitize_text_field( $_POST['cf_turnstile_secret_key'] ) : '';
		$cf_turnstile_theme      = isset( $_POST['cf_turnstile_theme'] ) ? sanitize_text_field( $_POST['cf_turnstile_theme'] ) : 'light';

		$block_keywords = isset( $_POST['block_keywords'] ) ? sanitize_textarea_field( $_POST['block_keywords'] ) : '';

		if ( ! in_array( $captcha, array_keys( STCFQ_Helper::captcha_list() ) ) ) {
			$captcha = '';
		}

		if ( ! in_array( $google_recaptcha_v2_theme, array_keys( STCFQ_Helper::google_recaptcha_v2_themes() ) ) ) {
			$google_recaptcha_v2_theme = 'light';
		}

		update_option( 'stcfq_captcha', $captcha, true );

		$google_recaptcha_v2 = array(
			'site_key'   => $google_recaptcha_v2_site_key,
			'secret_key' => $google_recaptcha_v2_secret_key,
			'theme'      => $google_recaptcha_v2_theme,
		);

		update_option( 'stcfq_google_recaptcha_v2', $google_recaptcha_v2, true );

		$cf_turnstile = array(
			'site_key'   => $cf_turnstile_site_key,
			'secret_key' => $cf_turnstile_secret_key,
			'theme'      => $cf_turnstile_theme,
		);

		update_option( 'stcfq_cf_turnstile', $cf_turnstile, true );

		update_option( 'stcfq_block_keywords', $block_keywords );

		wp_send_json_success( array( 'message' => esc_html__( 'Setting saved.', 'contact-form-query' ) ) );
	}

	public static function save_email() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-email'] ) || ! wp_verify_nonce( $_POST['save-email'], 'save-email' ) ) {
			die();
		}

		$carrier = isset( $_POST['email_carrier'] ) ? sanitize_text_field( $_POST['email_carrier'] ) : 'wp_mail';

		$wp_mail_from_name = isset( $_POST['wp_mail_from_name'] ) ? sanitize_text_field( $_POST['wp_mail_from_name'] ) : '';

		$smtp_from_name  = isset( $_POST['smtp_from_name'] ) ? sanitize_text_field( $_POST['smtp_from_name'] ) : '';
		$smtp_host       = isset( $_POST['smtp_host'] ) ? sanitize_text_field( $_POST['smtp_host'] ) : '';
		$smtp_username   = isset( $_POST['smtp_username'] ) ? sanitize_text_field( $_POST['smtp_username'] ) : '';
		$smtp_password   = isset( $_POST['smtp_password'] ) ? $_POST['smtp_password'] : '';
		$smtp_encryption = isset( $_POST['smtp_encryption'] ) ? sanitize_text_field( $_POST['smtp_encryption'] ) : '';
		$smtp_port       = isset( $_POST['smtp_port'] ) ? sanitize_text_field( $_POST['smtp_port'] ) : '';

		$to_admin_enable = isset( $_POST['to_admin_enable'] ) ? (bool) $_POST['to_admin_enable'] : true;

		if ( ! in_array( $carrier, array_keys( STCFQ_Helper::email_carrier_list() ) ) ) {
			$carrier = 'wp_mail';
		}

		$errors = array();

		if ( ! empty( trim( $_POST['wp_mail_from_email'] ) ) && ! filter_var( $_POST['wp_mail_from_email'], FILTER_VALIDATE_EMAIL ) ) {
			$errors['wp_mail_from_email'] = esc_html__( 'Please provide a valid email.', 'contact-form-query' );
		} else {
			$wp_mail_from_email = sanitize_email( $_POST['wp_mail_from_email'] );
		}

		if ( ! empty( trim( $_POST['to_admin_email'] ) ) && ! filter_var( $_POST['to_admin_email'], FILTER_VALIDATE_EMAIL ) ) {
			$errors['to_admin_email'] = esc_html__( 'Please provide a valid email.', 'contact-form-query' );
		} else {
			$to_admin_email = sanitize_email( $_POST['to_admin_email'] );
		}

		if ( count( $errors ) < 1 ) {
			update_option( 'stcfq_email_carrier', $carrier, true );

			$wp_mail = array(
				'from_name'  => $wp_mail_from_name,
				'from_email' => $wp_mail_from_email,
			);

			update_option( 'stcfq_wp_mail', $wp_mail, true );

			$smtp = array(
				'from_name'  => $smtp_from_name,
				'host'       => $smtp_host,
				'username'   => $smtp_username,
				'password'   => $smtp_password,
				'encryption' => $smtp_encryption,
				'port'       => $smtp_port,
			);

			update_option( 'stcfq_smtp', $smtp, true );

			$email_to_admin = array(
				'enable' => $to_admin_enable,
				'to'     => $to_admin_email,
			);

			update_option( 'stcfq_email_to_admin', $email_to_admin, true );

			wp_send_json_success( array( 'message' => esc_html__( 'Setting saved.', 'contact-form-query' ) ) );
		}

		wp_send_json_error( $errors );
	}

	public static function save_uninstall_setting() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-uninstall-setting'] ) || ! wp_verify_nonce( $_POST['save-uninstall-setting'], 'save-uninstall-setting' ) ) {
			die();
		}

		$delete_data_enable = isset( $_POST['delete_data_enable'] ) ? (bool) $_POST['delete_data_enable'] : false;

		update_option( 'stcfq_delete_data_enable', $delete_data_enable, true );

		wp_send_json_success( array( 'message' => esc_html__( 'Setting saved.', 'contact-form-query' ) ) );
	}
}
