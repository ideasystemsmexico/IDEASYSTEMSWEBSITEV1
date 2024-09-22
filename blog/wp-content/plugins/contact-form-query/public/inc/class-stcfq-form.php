<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

class STCFQ_Form {
	public static function contact_form_query() {
		ob_start();
		require_once STCFQ_PLUGIN_DIR_PATH . 'public/inc/form/contact.php';
		return ob_get_clean();
	}

	public static function save_contact_form_query() {
		try {
			ob_start();
			global $wpdb;

			$error_message = esc_html__( 'Error occurred while sending your message. Please try again after some time.', 'contact-form-query' );

			if ( ! isset( $_POST['save-contact'] ) || ! wp_verify_nonce( $_POST['save-contact'], 'save-contact' ) ) {
				die();
			}

			require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

			$captcha = get_option( 'stcfq_captcha' );

			if ( 'google_recaptcha_v2' === $captcha ) {
				$google_recaptcha_v2 = STCFQ_Helper::google_recaptcha_v2();
				if ( ! empty( $google_recaptcha_v2['site_key'] ) && ! empty( $google_recaptcha_v2['secret_key'] ) ) {
					if ( isset( $_POST['g-recaptcha-response'] ) && ! empty( $_POST['g-recaptcha-response'] ) ) {
						$response = wp_remote_post(
							'https://www.google.com/recaptcha/api/siteverify',
							array(
								'body' => array(
									'secret'   => $google_recaptcha_v2['secret_key'],
									'response' => $_POST['g-recaptcha-response'],
								),
							)
						);

						$data = wp_remote_retrieve_body( $response );
						$data = json_decode( $data );

						if ( ! ( isset( $data->success ) && ( true === $data->success ) ) ) {
							throw new Exception( wp_kses( __( '<strong>ERROR:</strong> Please confirm you are not a robot.', 'contact-form-query' ), array( 'strong' => array() ) ) );
						}
					} else {
						throw new Exception( wp_kses( __( '<strong>ERROR:</strong> Please confirm you are not a robot.', 'contact-form-query' ), array( 'strong' => array() ) ) );
					}
				}
			} elseif ( 'cf_turnstile' === $captcha ) {
				$cf_turnstile = STCFQ_Helper::cf_turnstile();
				if ( ! empty( $cf_turnstile['site_key'] ) && ! empty( $cf_turnstile['secret_key'] ) ) {
					if ( isset( $_POST['cf-turnstile-response'] ) && ! empty( $_POST['cf-turnstile-response'] ) ) {
						$response = wp_remote_post(
							'https://challenges.cloudflare.com/turnstile/v0/siteverify',
							array(
								'body' => array(
									'secret'   => $cf_turnstile['secret_key'],
									'response' => $_POST['cf-turnstile-response'],
								),
							)
						);

						$data = wp_remote_retrieve_body( $response );
						$data = json_decode( $data );

						if ( ! ( isset( $data->success ) && ( true === $data->success ) ) ) {
							throw new Exception( wp_kses( __( '<strong>ERROR:</strong> Please confirm you are not a robot.', 'contact-form-query' ), array( 'strong' => array() ) ) );
						}
					} else {
						throw new Exception( wp_kses( __( '<strong>ERROR:</strong> Please confirm you are not a robot.', 'contact-form-query' ), array( 'strong' => array() ) ) );
					}
				}
			}

			$contact_fields    = STCFQ_Helper::contact_fields();
			$consent_field     = STCFQ_Helper::consent_field();
			$feedback_messages = STCFQ_Helper::feedback_messages();

			$name_required    = true;
			$email_required   = true;
			$subject_required = true;
			$name_required    = true;

			foreach ( $contact_fields as $key => $field ) {
				if ( 'name' === $field['name'] ) {
					$name_enabled = (bool) $field['enable'];
					$name_required = (bool) $field['required'];
				} elseif ( 'email' === $field['name'] ) {
					$email_enabled = (bool) $field['enable'];
					$email_required = (bool) $field['required'];
				} elseif ( 'subject' === $field['name'] ) {
					$subject_enabled = (bool) $field['enable'];
					$subject_required = (bool) $field['required'];
				} elseif ( 'message' === $field['name'] ) {
					$message_enabled = (bool) $field['enable'];
					$message_required = (bool) $field['required'];
				}
			}

			$errors = array();

			$name = '';
			if ( ! isset( $name_enabled ) || $name_enabled ) {
				if ( $name_required && ( ! isset( $_POST['name'] ) || empty( trim( $_POST['name'] ) ) ) ) {
					$errors['name'] = esc_html__( 'Please provide your name.', 'contact-form-query' );
				} else {
					$name = sanitize_text_field( $_POST['name'] );
				}
			}

			$email = '';
			if ( ! isset( $email_enabled ) || $email_enabled ) {
				if ( $email_required && ( ! isset( $_POST['email'] ) || empty( trim( $_POST['email'] ) ) ) ) {
					$errors['email'] = esc_html__( 'Please provide your email.', 'contact-form-query' );
				} elseif ( ! empty( trim( $_POST['email'] ) ) && ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
					$errors['email'] = esc_html__( 'Please provide a valid email.', 'contact-form-query' );
				} else {
					$email = sanitize_email( $_POST['email'] );
				}
			}

			$subject = '';
			if ( ! isset( $subject_enabled ) || $subject_enabled ) {
				if ( $subject_required && ( ! isset( $_POST['subject'] ) || empty( trim( $_POST['subject'] ) ) ) ) {
					$errors['subject'] = esc_html__( 'Please specify subject.', 'contact-form-query' );
				} else {
					$subject = sanitize_text_field( $_POST['subject'] );
				}
			}

			$message = '';
			if ( ! isset( $message_enabled ) || $message_enabled ) {
				if ( $message_required && ( ! isset( $_POST['message'] ) || empty( trim( $_POST['message'] ) ) ) ) {
					$errors['message'] = esc_html__( 'Please provide your message.', 'contact-form-query' );
				} else {
					$message = sanitize_text_field( $_POST['message'] );
				}
			}

			if ( $consent_field['enable'] && ! empty( $consent_field['text'] ) ) {
				$consent = isset( $_POST['consent'] ) ? (bool) $_POST['consent'] : false;
				if ( ! $consent ) {
					$errors['consent'] = $consent_field['msg'];
				}
			}
		} catch ( Exception $exception ) {
			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				$response = $error_message;
			} else {
				$response = $exception->getMessage();
			}
			wp_send_json_error( $response );
		}

		if ( count( $errors ) < 1 ) {
			$block_keywords = (string) get_option( 'stcfq_block_keywords' );
			if ( '' !== $block_keywords ) {
				$block_keywords = (array) preg_split( "/\r\n|\n|\r/", $block_keywords );
				if ( STCFQ_Helper::keyword_found( $block_keywords, $subject ) || STCFQ_Helper::keyword_found( $block_keywords, $email ) || STCFQ_Helper::keyword_found( $block_keywords, $name ) || STCFQ_Helper::keyword_found( $block_keywords, $message ) ) {
					wp_send_json_success( array( 'message' => $feedback_messages['success'] ) );
				}
			}

			try {
				$data = array(
					'name'       => $name,
					'email'      => $email,
					'subject'    => $subject,
					'message'    => $message,
					'created_at' => STCFQ_Helper::now(),
				);

				$success = $wpdb->insert( "{$wpdb->prefix}stcfq_queries", $data );

				$buffer = ob_get_clean();
				if ( ! empty( $buffer ) ) {
					throw new Exception( $error_message );
				}

				if ( false === $success ) {
					throw new Exception( $error_message );
				}

				STCFQ_Helper::cache_unanswered_messages_count();

				// Email to admin template.
				$email_to_admin  = STCFQ_Helper::email_to_admin();
				$enable_to_admin = $email_to_admin['enable'];
				$receiver_email  = $email_to_admin['to'];

				if ( $enable_to_admin && $receiver_email ) {
					// Sender's parameters.
					$sender_name    = $data['name'];
					$sender_email   = $data['email'];
					$sender_subject = stripcslashes( $data['subject'] );
					$sender_message = stripcslashes( $data['message'] );

					$subject_to_admin = $email_to_admin['subject'];
					$body_to_admin    = $email_to_admin['body'];

					// Replace placeholders for subject.
					$subject_to_admin = str_replace( '[SENDER_NAME]', $sender_name, $subject_to_admin );
					$subject_to_admin = str_replace( '[SENDER_EMAIL]', $sender_email, $subject_to_admin );
					$subject_to_admin = str_replace( '[SUBJECT]', $sender_subject, $subject_to_admin );
					$subject_to_admin = str_replace( '[MESSAGE]', $sender_message, $subject_to_admin );

					// Replace placeholders for body.
					$body_to_admin = str_replace( '[SENDER_NAME]', $sender_name, $body_to_admin );
					$body_to_admin = str_replace( '[SENDER_EMAIL]', $sender_email, $body_to_admin );
					$body_to_admin = str_replace( '[SUBJECT]', $sender_subject, $body_to_admin );
					$body_to_admin = str_replace( '[MESSAGE]', $sender_message, $body_to_admin );

					// Send email to admin.
					STCFQ_Helper::send_email( $receiver_email, $subject_to_admin, $body_to_admin );
				}

				wp_send_json_success( array( 'message' => $feedback_messages['success'] ) );
			} catch ( Exception $exception ) {
				wp_send_json_error( $error_message );
			}
		}

		wp_send_json_error( $errors );
	}
}
