<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

$captcha_list = STCFQ_Helper::captcha_list();

$steps_url_recaptcha = STCFQ_Helper::steps_url_recaptcha();
$steps_url_turnstile = STCFQ_Helper::steps_url_turnstile();

$google_recaptcha_v2_themes = STCFQ_Helper::google_recaptcha_v2_themes();
$cf_turnstile_themes        = STCFQ_Helper::cf_turnstile_themes();

$captcha = get_option( 'stcfq_captcha' );

$google_recaptcha_v2 = STCFQ_Helper::google_recaptcha_v2();
$cf_turnstile        = STCFQ_Helper::cf_turnstile();

$block_keywords = (string) get_option( 'stcfq_block_keywords' );
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-captcha-form">

	<?php $nonce = wp_create_nonce( 'save-captcha' ); ?>
	<input type="hidden" name="save-captcha" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-captcha">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Captcha', 'contact-form-query' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Captcha', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $captcha_list as $key => $value ) {
							?>
						<label>
							<input <?php checked( $captcha, $key, true ); ?> type="radio" name="captcha" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $captcha_list );
							if ( key( $captcha_list ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_site_key"><?php esc_html_e( 'Site Key (reCAPTCHA v2)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="google_recaptcha_v2_site_key" type="text" id="stcfq_google_recaptcha_v2_site_key" value="<?php echo esc_attr( $google_recaptcha_v2['site_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Google reCAPTCHA v2 Site Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url_recaptcha ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_secret_key"><?php esc_html_e( 'Secret Key (reCAPTCHA v2)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="google_recaptcha_v2_secret_key" type="text" id="stcfq_google_recaptcha_v2_secret_key" value="<?php echo esc_attr( $google_recaptcha_v2['secret_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Google reCAPTCHA v2 Secret Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url_recaptcha ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_google_recaptcha_v2">
				<th scope="row">
					<label for="stcfq_google_recaptcha_v2_theme"><?php esc_html_e( 'Theme (reCAPTCHA v2)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Google reCAPTCHA Version 2 Theme.', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $google_recaptcha_v2_themes as $key => $value ) {
							?>
						<label>
							<input <?php checked( $google_recaptcha_v2['theme'], $key, true ); ?> type="radio" name="google_recaptcha_v2_theme" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $google_recaptcha_v2_themes );
							if ( key( $google_recaptcha_v2_themes ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
					<p class="description"><?php esc_html_e( 'Select Google reCAPTCHA Version 2 Theme.', 'contact-form-query' ); ?></p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_cf_turnstile">
				<th scope="row">
					<label for="stcfq_cf_turnstile_site_key"><?php esc_html_e( 'Site Key (Turnstile)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="cf_turnstile_site_key" type="text" id="stcfq_cf_turnstile_site_key" value="<?php echo esc_attr( $cf_turnstile['site_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Cloudflare Turnstile Site Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url_turnstile ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_cf_turnstile">
				<th scope="row">
					<label for="stcfq_cf_turnstile_secret_key"><?php esc_html_e( 'Secret Key (Turnstile)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="cf_turnstile_secret_key" type="text" id="stcfq_cf_turnstile_secret_key" value="<?php echo esc_attr( $cf_turnstile['secret_key'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Cloudflare Turnstile Secret Key.', 'contact-form-query' ); ?>&nbsp;
						<a target="_blank" href="<?php echo esc_url( $steps_url_turnstile ); ?>"><?php esc_html_e( 'Click Here', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr class="stcfq_captcha stcfq_cf_turnstile">
				<th scope="row">
					<label for="stcfq_cf_turnstile_theme"><?php esc_html_e( 'Theme (Turnstile)', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Cloudflare Turnstile Theme.', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $cf_turnstile_themes as $key => $value ) {
							?>
						<label>
							<input <?php checked( $cf_turnstile['theme'], $key, true ); ?> type="radio" name="cf_turnstile_theme" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $cf_turnstile_themes );
							if ( key( $cf_turnstile_themes ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
					<p class="description"><?php esc_html_e( 'Select Google reCAPTCHA Version 2 Theme.', 'contact-form-query' ); ?></p>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_block_keywords"><?php esc_html_e( 'Blacklist Keywords', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<textarea name="block_keywords" rows="5" cols="40" id="stcfq_block_keywords" class="code"><?php echo esc_html( $block_keywords ); ?></textarea>
					<p class="description">
						<?php esc_html_e( 'Enter one keyword per line. The keyword is case-sensitive and can have spaces in it. This would block the message by not saving the entry if any of the keywords match the name, subject, email, or message field. However, it would still show the success message to the user.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-captcha-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>
