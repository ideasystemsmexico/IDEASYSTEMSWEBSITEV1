<?php
defined( 'ABSPATH' ) || die();

wp_enqueue_style( 'stcfq', STCFQ_PLUGIN_URL . 'assets/css/stcfq.min.css', array(), STCFQ_PLUGIN_VERSION, 'all' );
wp_style_add_data( 'stcfq', 'rtl', 'replace' );
wp_enqueue_script( 'stcfq', STCFQ_PLUGIN_URL . 'assets/js/stcfq.min.js', array( 'jquery', 'jquery-form' ), STCFQ_PLUGIN_VERSION, true );
wp_add_inline_script(
	'stcfq',
	sprintf( 'var stcfqadminurl = %s;', wp_json_encode( admin_url() ) ),
	'before'
);

require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';
$contact_fields = STCFQ_Helper::contact_fields();
$consent_field  = STCFQ_Helper::consent_field();
$submit_button  = STCFQ_Helper::submit_button();

$layout  = STCFQ_Helper::layout();
$captcha = get_option( 'stcfq_captcha' );

if ( 'default' !== $layout ) {
	wp_enqueue_style( 'stcfq-layout-' . esc_attr( $layout ), STCFQ_PLUGIN_URL . 'assets/css/stcfq-layout-' . esc_attr( $layout ) . '.css', array(), STCFQ_PLUGIN_VERSION, 'all' );
}

$design = STCFQ_Helper::design();

$success_background_color      = $design['success_background_color'];
$success_border_color          = $design['success_border_color'];
$success_font_color            = $design['success_font_color'];
$error_background_color        = $design['error_background_color'];
$error_border_color            = $design['error_border_color'];
$error_font_color              = $design['error_font_color'];
$validation_error_color        = $design['validation_error_color'];
$validation_error_border_color = $design['validation_error_border_color'];

$css = '';
if ( '#d4edda' !== $success_background_color ) {
	$css .= ( '.stcfq-container .st-alert-success { background-color: ' . sanitize_hex_color( $success_background_color ) . '; }' );
}
if ( '#c3e6cb' !== $success_border_color ) {
	$css .= ( '.stcfq-container .st-alert-success { border-color: ' . sanitize_hex_color( $success_border_color ) . '; }' );
}
if ( '#155724' !== $success_font_color ) {
	$css .= ( '.stcfq-container .st-alert-success { color: ' . sanitize_hex_color( $success_font_color ) . '; }' );
}
if ( '#f8d7da' !== $error_background_color ) {
	$css .= ( '.stcfq-container .st-alert-error { background-color: ' . sanitize_hex_color( $error_background_color ) . '; }' );
}
if ( '#f5c6cb' !== $error_border_color ) {
	$css .= ( '.stcfq-container .st-alert-error { border-color: ' . sanitize_hex_color( $error_border_color ) . '; }' );
}
if ( '#721c24' !== $error_font_color ) {
	$css .= ( '.stcfq-container .st-alert-error { color: ' . sanitize_hex_color( $error_font_color ) . '; }' );
}
if ( '#dc3232' !== $validation_error_color ) {
	$css .= ( '.stcfq-container .st-text-danger { color: ' . sanitize_hex_color( $validation_error_color ) . ' !important; }' );
}
if ( '#dc3232' !== $validation_error_border_color ) {
	$css .= ( '.stcfq-container .st-is-invalid { border-color: ' . sanitize_hex_color( $validation_error_border_color ) . ' !important; }' );
}

if ( ! empty( $css ) ) {
	wp_add_inline_style( 'stcfq', $css );
}
?>

<div class="stcfq-container" id="stcfq-container">
	<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="stcfq-save-contact-form">
		<?php $nonce = wp_create_nonce( 'save-contact' ); ?>
		<input type="hidden" name="save-contact" value="<?php echo esc_attr( $nonce ); ?>">
		<input type="hidden" name="action" value="stcfq-save-contact">

		<?php
		foreach ( $contact_fields as $field ) {
			STCFQ_Helper::output_field(
				$field['type'],
				array(
					'name'     => $field['name'],
					'enable'   => $field['enable'],
					'label'    => $field['label'],
					'classes'  => $field['classes'],
					'required' => $field['required'],
				)
			);
		}

		if ( $consent_field['enable'] && ! empty( $consent_field['text'] ) ) {
			?>
		<p>
			<label class="stcfq-consent-field-label">
				<input type="checkbox" name="consent" class="stcfq-consent-field <?php echo esc_attr( $consent_field['classes'] ); ?>" value="1">
				<?php echo esc_html( $consent_field['text'] ); ?>
			</label>
		</p>
			<?php
		}
		$data_cpt       = '';
		$data_site_key  = '';
		$data_cpt_theme = '';
		if ( 'google_recaptcha_v2' === $captcha ) {
			$google_recaptcha_v2 = STCFQ_Helper::google_recaptcha_v2();
			if ( ! empty( $google_recaptcha_v2['site_key'] ) && ! empty( $google_recaptcha_v2['secret_key'] ) ) {
				add_filter( 'script_loader_tag', array( 'STCFQ_Helper', 'add_async_defer_attribute' ), 10, 2 );
				wp_enqueue_script( 'recaptcha-api-v2', 'https://www.google.com/recaptcha/api.js', array(), null );
				?>
			<p>
				<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $google_recaptcha_v2['site_key'] ); ?>" data-theme="<?php echo esc_attr( $google_recaptcha_v2['theme'] ); ?>"></div>
			</p>
				<?php
			}
		} elseif ( 'cf_turnstile' === $captcha ) {
			$cf_turnstile = STCFQ_Helper::cf_turnstile();
			if ( ! empty( $cf_turnstile['site_key'] ) && ! empty( $cf_turnstile['secret_key'] ) ) {
				$data_cpt       = 'cf_turnstile';
				$data_site_key  = $cf_turnstile['site_key'];
				$data_cpt_theme = $cf_turnstile['theme'];
				add_filter( 'script_loader_tag', array( 'STCFQ_Helper', 'add_async_defer_attribute' ), 10, 2 );
				wp_enqueue_script( 'cf-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit', array(), null );
				?>
			<p>
				<div id="stcfq-cf-turnstile"></div>
			</p>
			<?php
			}
		}
		?>

		<div class="stcfq-save-contact-btn-wrap<?php echo esc_attr( ( '' !== $submit_button['parent_classes'] ) ? ( ' ' . $submit_button['parent_classes'] ) : '' ); ?>">
			<button type="submit" class="stcfq-save-contact-btn<?php echo esc_attr( ( '' !== $submit_button['classes'] ) ? ( ' ' . $submit_button['classes'] ) : '' ); ?>" <?php
			if ( '' !== $data_cpt ) { echo ( 'data-cpt="' . esc_attr( $data_cpt ) . '"' ); }
			if ( '' !== $data_site_key ) { echo ( ' data-site-key="' . esc_attr( $data_site_key ) . '"' ); }
			if ( '' !== $data_cpt_theme ) { echo ( ' data-cpt-theme="' . esc_attr( $data_cpt_theme ) . '"' ); }
			?>><?php echo esc_html( $submit_button['text'] ); ?></button>
		</div>
	</form>
</div>
