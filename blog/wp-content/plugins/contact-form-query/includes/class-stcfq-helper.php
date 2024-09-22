<?php
defined( 'ABSPATH' ) || die();

class STCFQ_Helper {
	public static function contact_fields() {
		$contact_fields = get_option( 'stcfq_form_fields' );

		if ( ! empty( $contact_fields ) ) {
			return $contact_fields;
		}

		return array(
			array(
				'name'     => 'name',
				'enable'   => true,
				'type'     => 'text',
				'label'    => __( 'Your Name', 'contact-form-query' ),
				'required' => true,
				'classes'  => '',
			),
			array(
				'name'     => 'email',
				'enable'   => true,
				'type'     => 'email',
				'label'    => __( 'Your Email', 'contact-form-query' ),
				'required' => true,
				'classes'  => '',
			),
			array(
				'name'     => 'subject',
				'enable'   => true,
				'type'     => 'text',
				'label'    => __( 'Subject', 'contact-form-query' ),
				'required' => true,
				'classes'  => '',
			),
			array(
				'name'     => 'message',
				'enable'   => true,
				'type'     => 'textarea',
				'label'    => __( 'Message', 'contact-form-query' ),
				'required' => true,
				'classes'  => '',
			),
		);
	}

	public static function output_field( $type, $data ) {
		if ( ! in_array( $type, array( 'text', 'email', 'textarea' ) ) ) {
			return;
		}

		if ( ! ( isset( $data['name'] ) && ! empty( $data['name'] ) ) ) {
			return;
		}

		if ( ! isset( $data['enable'] ) || ! $data['enable'] ) {
			return;
		}

		if ( ! isset( $data['required'] ) ) {
			$data['required'] = false;
		}

		$output_span_classes  = 'stcfq-form-control-wrap stcfq-' . $data['name'];
		$output_input_classes = 'stcfq-form-control';
		if ( isset( $data['classes'] ) && ! empty( $data['classes'] ) ) {
			$output_input_classes .= ' ' . $data['classes'];
		}

		$output_input_required = '';
		if ( isset( $data['required'] ) && ( (bool) $data['required'] ) ) {
			$output_input_required .= ' required aria-required=true';
		}

		echo '<p>';
		echo '<label>';
		if ( isset( $data['label'] ) && ! empty( $data['label'] ) ) {
			echo esc_html( $data['label'] );
			echo '<br>';
		}
		echo '<span class="' . esc_attr( $output_span_classes ) . '">';

		if ( 'text' === $type || 'email' === $type ) {
			echo '<input type="' . esc_attr( $type ) . '" name="' . esc_attr( $data['name'] ) . '" size="40" class="' . esc_attr( $output_input_classes ) . '"' . esc_attr( $output_input_required ) . ' aria-invalid="false">';
		} elseif ( 'textarea' === $type ) {
			echo '<textarea type="' . esc_attr( $type ) . '" name="' . esc_attr( $data['name'] ) . '" cols="65" rows="6" class="' . esc_attr( $output_input_classes ) . '"' . esc_attr( $output_input_required ) . ' aria-invalid="false"></textarea>';
		}

		echo '</span>';
		echo '</label>';
		echo '</p>';
	}

	public static function consent_field() {
		$consent_field = get_option( 'stcfq_consent_field' );

		if ( ! is_array( $consent_field ) ) {
			$consent_field = array();
		}

		$consent_field['enable']  = isset( $consent_field['enable'] ) ? (bool) $consent_field['enable'] : false;
		$consent_field['text']    = isset( $consent_field['text'] ) ? stripcslashes( $consent_field['text'] ) : '';
		$consent_field['classes'] = isset( $consent_field['classes'] ) ? stripcslashes( $consent_field['classes'] ) : '';
		$consent_field['msg']     = isset( $consent_field['msg'] ) ? stripcslashes( $consent_field['msg'] ) : '';

		if ( empty( $consent_field['text'] ) ) {
			$consent_field['text'] = esc_html__( 'I consent to having this website store my submitted information so they can respond to my inquiry.', 'contact-form-query' );
		}

		if ( empty( $consent_field['msg'] ) ) {
			$consent_field['msg'] = esc_html__( 'Please confirm.', 'contact-form-query' );
		}

		return $consent_field;
	}

	public static function submit_button() {
		$submit_button = get_option( 'stcfq_submit_button' );

		if ( ! is_array( $submit_button ) ) {
			$submit_button = array();
		}

		$submit_button['text']           = isset( $submit_button['text'] ) ? stripcslashes( $submit_button['text'] ) : '';
		$submit_button['parent_classes'] = isset( $submit_button['parent_classes'] ) ? stripcslashes( $submit_button['parent_classes'] ) : '';
		$submit_button['classes']        = isset( $submit_button['classes'] ) ? stripcslashes( $submit_button['classes'] ) : '';

		if ( empty( $submit_button['text'] ) ) {
			$submit_button['text'] = esc_html__( 'Send Your Message', 'contact-form-query' );
		}

		return $submit_button;
	}

	public static function feedback_messages() {
		$feedback_messages = get_option( 'stcfq_feedback_messages' );

		if ( ! is_array( $feedback_messages ) ) {
			$feedback_messages = array();
		}

		if ( ! isset( $feedback_messages['success'] ) || empty( $feedback_messages['success'] ) ) {
			$feedback_messages['success'] = esc_html__( 'Thank you for contacting us. We will reply to your email as soon as possible.', 'contact-form-query' );
		}

		return $feedback_messages;
	}

	public static function filter_list() {
		return array( 'subject', 'name', 'email', 'message', 'answered', 'note' );
	}

	public static function captcha_list() {
		return array(
			''                    => esc_html__( 'None', 'contact-form-query' ),
			'google_recaptcha_v2' => esc_html__( 'Google reCAPTCHA Version 2', 'contact-form-query' ),
			'cf_turnstile'        => esc_html__( 'Cloudflare Turnstile', 'contact-form-query' ),
		);
	}

	public static function google_recaptcha_v2_themes() {
		return array(
			'light' => esc_html__( 'Light', 'contact-form-query' ),
			'dark'  => esc_html__( 'Dark', 'contact-form-query' ),
		);
	}

	public static function google_recaptcha_v2() {
		$google_recaptcha_v2 = get_option( 'stcfq_google_recaptcha_v2' );

		if ( ! is_array( $google_recaptcha_v2 ) ) {
			$google_recaptcha_v2 = array();
		}

		$google_recaptcha_v2['site_key']   = isset( $google_recaptcha_v2['site_key'] ) ? $google_recaptcha_v2['site_key'] : '';
		$google_recaptcha_v2['secret_key'] = isset( $google_recaptcha_v2['secret_key'] ) ? $google_recaptcha_v2['secret_key'] : '';
		$google_recaptcha_v2['theme']      = isset( $google_recaptcha_v2['theme'] ) ? $google_recaptcha_v2['theme'] : 'light';

		return $google_recaptcha_v2;
	}

	public static function cf_turnstile_themes() {
		return array(
			'auto'  => esc_html__( 'Auto', 'contact-form-query' ),
			'light' => esc_html__( 'Light', 'contact-form-query' ),
			'dark'  => esc_html__( 'Dark', 'contact-form-query' ),
		);
	}

	public static function cf_turnstile() {
		$cf_turnstile = get_option( 'stcfq_cf_turnstile' );

		if ( ! is_array( $cf_turnstile ) ) {
			$cf_turnstile = array();
		}

		$cf_turnstile['site_key']   = isset( $cf_turnstile['site_key'] ) ? $cf_turnstile['site_key'] : '';
		$cf_turnstile['secret_key'] = isset( $cf_turnstile['secret_key'] ) ? $cf_turnstile['secret_key'] : '';
		$cf_turnstile['theme']      = isset( $cf_turnstile['theme'] ) ? $cf_turnstile['theme'] : 'light';

		return $cf_turnstile;
	}

	public static function keyword_found( $keywords, $keyword ) {
		foreach ( $keywords as $key => $val ) {
			if ( false !== strpos( $keyword, $val ) ) {
				return true;
			}
		}
	}

	public static function add_async_defer_attribute( $tag, $handle ) {
		if ( in_array( $handle, array( 'recaptcha-api-v2', 'cf-turnstile' ), true ) ) {
			return str_replace( ' src', ' async defer src', $tag );
		}

		return $tag;
	}

	public static function email_carrier_list() {
		return array(
			'wp_mail' => esc_html__( 'WP Mail', 'contact-form-query' ),
			'smtp'    => esc_html__( 'SMTP', 'contact-form-query' ),
		);
	}

	public static function email_carrier() {
		$carrier = get_option( 'stcfq_email_carrier' );

		if ( ! in_array( $carrier, array_keys( self::email_carrier_list() ) ) ) {
			$carrier = 'wp_mail';
		}

		return $carrier;
	}

	public static function wp_mail() {
		$wp_mail = get_option( 'stcfq_wp_mail' );

		if ( ! is_array( $wp_mail ) ) {
			$wp_mail = array();
		}

		$wp_mail['from_name']  = isset( $wp_mail['from_name'] ) ? $wp_mail['from_name'] : '';
		$wp_mail['from_email'] = isset( $wp_mail['from_email'] ) ? $wp_mail['from_email'] : '';

		return $wp_mail;
	}

	public static function smtp() {
		$smtp = get_option( 'stcfq_smtp' );

		if ( ! is_array( $smtp ) ) {
			$smtp = array();
		}

		$smtp['from_name']  = isset( $smtp['from_name'] ) ? $smtp['from_name'] : '';
		$smtp['host']       = isset( $smtp['host'] ) ? $smtp['host'] : '';
		$smtp['username']   = isset( $smtp['username'] ) ? $smtp['username'] : '';
		$smtp['password']   = isset( $smtp['password'] ) ? $smtp['password'] : '';
		$smtp['encryption'] = isset( $smtp['encryption'] ) ? $smtp['encryption'] : '';
		$smtp['port']       = isset( $smtp['port'] ) ? $smtp['port'] : '';

		return $smtp;
	}

	public static function send_email( $to, $subject, $body, $name = '' ) {
		$email_carrier = self::email_carrier();

		if ( 'wp_mail' === $email_carrier ) {

			$wp_mail    = self::wp_mail();
			$from_name  = $wp_mail['from_name'];
			$from_email = $wp_mail['from_email'];

			if ( is_array( $to ) ) {
				foreach ( $to as $key => $value ) {
					$to[ $key ]	= $name[ $key ] . ' <' . $value . '>';
				}
			} else {
				if ( ! empty( $name ) ) {
					$to = "$name <$to>";
				}
			}

			$headers = array();
			array_push( $headers, 'Content-Type: text/html; charset=UTF-8' );
			if ( ! empty( $from_name ) ) {
				array_push( $headers, "From: $from_name <$from_email>" );
			}

			$status = wp_mail( $to, html_entity_decode( $subject ), $body, $headers, array() );
			return $status;

		} elseif ( 'smtp' === $email_carrier ) {

			$smtp       = self::smtp();
			$from_name  = $smtp['from_name'];
			$host       = $smtp['host'];
			$username   = $smtp['username'];
			$password   = $smtp['password'];
			$encryption = $smtp['encryption'];
			$port       = $smtp['port'];

			if ( file_exists( ABSPATH . WPINC . '/PHPMailer/PHPMailer.php' ) ) {
				require_once ABSPATH . WPINC . '/PHPMailer/PHPMailer.php';
				require_once ABSPATH . WPINC . '/PHPMailer/SMTP.php';
				require_once ABSPATH . WPINC . '/PHPMailer/Exception.php';
				$mail = new PHPMailer\PHPMailer\PHPMailer( true );

			} else {
				// Fallback.
				require_once ABSPATH . WPINC . '/class-phpmailer.php';
				$mail = new PHPMailer( true );
			}

			try {
				$mail->CharSet  = 'UTF-8';
				$mail->Encoding = 'base64';

				if ( $host && $port ) {
					$mail->IsSMTP();
					$mail->Host = $host;
					if ( ! empty( $username ) && ! empty( $password ) ) {
						$mail->SMTPAuth = true;
						$mail->Password = $password;
					} else {
						$mail->SMTPAuth = false;
					}
					if ( ! empty( $encryption ) ) {
						$mail->SMTPSecure = $encryption;
					} else {
						$mail->SMTPSecure = NULL;
					}
					$mail->Port = $port;
				}

				$mail->Username = $username;

				$mail->setFrom( $mail->Username, $from_name );

				$mail->Subject = html_entity_decode( $subject );
				$mail->Body    = $body;

				$mail->IsHTML( true );

				if ( is_array( $to ) ) {
					foreach ( $to as $key => $value ) {
						$mail->AddAddress( $value, $name[ $key ] );
					}
				} else {
					$mail->AddAddress( $to, $name );
				}

				$status = $mail->Send();
				return $status;

			} catch ( Exception $e ) {
			}

			return false;
		}
	}

	public static function email_to_admin() {
		$email_to_admin = get_option( 'stcfq_email_to_admin' );

		if ( ! is_array( $email_to_admin ) ) {
			$email_to_admin = array();
		}

		$email_to_admin['enable']  = isset( $email_to_admin['enable'] ) ? (bool) $email_to_admin['enable'] : false;
		$email_to_admin['to']      = isset( $email_to_admin['to'] ) ? $email_to_admin['to'] : '';
		$email_to_admin['subject'] = isset( $email_to_admin['subject'] ) ? $email_to_admin['subject'] : '';
		$email_to_admin['body']    = isset( $email_to_admin['body'] ) ? $email_to_admin['body'] : '';

		if ( empty( $email_to_admin['subject'] ) ) {
			$email_to_admin['subject'] = sprintf(
				/* translators: 1: Sender name, 2: Sender email */
				esc_html__( 'New message from %1$s - %2$s', 'contact-form-query' ),
				'[SENDER_NAME]',
				'[SENDER_EMAIL]'
			);
		}

		if ( empty( $email_to_admin['body'] ) ) {
			$email_to_admin['body'] = sprintf(
				wp_kses(
					/* translators: 1: Sender name, 2: Sender email, 3: Subject, 4: Message */
					__( '<strong>Sender Name:</strong> %1$s<br><strong>Sender Email:</strong> %2$s<br> <strong>Subject:</strong> %3$s<br> <strong>Message:</strong> %4$s<br>', 'contact-form-query' ),
					array(
						'br' => array(),
						'strong' => array(),
					)
				),
				'[SENDER_NAME]',
				'[SENDER_EMAIL]',
				'[SUBJECT]',
				'[MESSAGE]'
			);
		}

		return $email_to_admin;
	}

	public static function steps_url_recaptcha() {
		return 'https://scriptstown.com/how-to-get-site-and-secret-key-for-google-recaptcha/';
	}

	public static function steps_url_turnstile() {
		return 'https://scriptstown.com/how-to-get-site-and-secret-key-for-cloudflare-turnstile/';
	}

	public static function layout_list() {
		return array(
			'default' => esc_html__( 'Default', 'contact-form-query' ),
			'compact' => esc_html__( 'Compact', 'contact-form-query' ),
		);
	}

	public static function default_layout() {
		return 'default';
	}

	public static function layout() {
		$layout = get_option( 'stcfq_layout' );

		if ( ! in_array( $layout, array_keys( self::layout_list() ) ) ) {
			$layout = self::default_layout();
		}

		return $layout;
	}

	public static function design() {
		$design = get_option( 'stcfq_design' );

		if ( ! is_array( $design ) ) {
			$design = array();
		}

		$design['success_background_color'] = isset( $design['success_background_color'] ) ? sanitize_hex_color( $design['success_background_color'] ) : '';
		$design['success_border_color']     = isset( $design['success_border_color'] ) ? sanitize_hex_color( $design['success_border_color'] ) : '';
		$design['success_font_color']       = isset( $design['success_font_color'] ) ? sanitize_hex_color( $design['success_font_color'] ) : '';

		if ( empty( $design['success_background_color'] ) ) {
			$design['success_background_color'] = '#d4edda';
		}

		if ( empty( $design['success_border_color'] ) ) {
			$design['success_border_color'] = '#c3e6cb';
		}

		if ( empty( $design['success_font_color'] ) ) {
			$design['success_font_color'] = '#155724';
		}

		$design['error_background_color'] = isset( $design['error_background_color'] ) ? sanitize_hex_color( $design['error_background_color'] ) : '';
		$design['error_border_color']     = isset( $design['error_border_color'] ) ? sanitize_hex_color( $design['error_border_color'] ) : '';
		$design['error_font_color']       = isset( $design['error_font_color'] ) ? sanitize_hex_color( $design['error_font_color'] ) : '';

		if ( empty( $design['error_background_color'] ) ) {
			$design['error_background_color'] = '#f8d7da';
		}

		if ( empty( $design['error_border_color'] ) ) {
			$design['error_border_color'] = '#f5c6cb';
		}

		if ( empty( $design['error_font_color'] ) ) {
			$design['error_font_color'] = '#721c24';
		}

		$design['validation_error_color']        = isset( $design['validation_error_color'] ) ? sanitize_hex_color( $design['validation_error_color'] ) : '';
		$design['validation_error_border_color'] = isset( $design['validation_error_border_color'] ) ? sanitize_hex_color( $design['validation_error_border_color'] ) : '';

		if ( empty( $design['validation_error_color'] ) ) {
			$design['validation_error_color'] = '#dc3232';
		}

		if ( empty( $design['validation_error_border_color'] ) ) {
			$design['validation_error_border_color'] = '#dc3232';
		}

		return $design;
	}

	public static function unanswered_messages_count() {
		$messages_count = get_transient( 'stcfq_unanswered_messages_count' );

		if ( false === $messages_count ) {
			$messages_count = self::unanswered_messages_count_db();
			set_transient( 'stcfq_unanswered_messages_count', $messages_count, 3600 * 120 );
		}

		return $messages_count;
	}

	public static function cache_unanswered_messages_count() {
		$messages_count = self::unanswered_messages_count_db();
		set_transient( 'stcfq_unanswered_messages_count', $messages_count, 3600 * 120 );
	}

	public static function unanswered_messages_count_db() {
		global $wpdb;

		return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}stcfq_queries WHERE answered = 0" );
	}

	public static function now() {
		return current_time( 'Y-m-d H:i:s', true );
	}

	public static function local_date_i18n( $date_gmt, $format ) {
		$date = new \DateTime( get_date_from_gmt( $date_gmt, 'Y-m-d H:i:s' ) );
		return date_i18n( $format, $date->getTimestamp(), true );
	}

	public static function get_email_configuration_steps_url() {
		return 'https://scriptstown.com/wordpress-email-configuration-for-sending-an-email/';
	}

	public static function get_pro_detail_url() {
		return 'https://scriptstown.com/wordpress-plugins/login-security-pro/';
	}

	public static function get_pro_url() {
		return 'https://scriptstown.com/account/signup/login-security-pro';
	}
}
