<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

$email_carrier_list = STCFQ_Helper::email_carrier_list();

$email_carrier = STCFQ_Helper::email_carrier();

$wp_mail = STCFQ_Helper::wp_mail();

$smtp = STCFQ_Helper::smtp();

$email_to_admin = STCFQ_Helper::email_to_admin();

$email_configuration_steps_url = STCFQ_Helper::get_email_configuration_steps_url();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-email-form">

	<?php $nonce = wp_create_nonce( 'save-email' ); ?>
	<input type="hidden" name="save-email" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-email">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row">
					<label><?php esc_html_e( 'How to Configure?', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<p class="description">
						<a target="_blank" href="<?php echo esc_url( $email_configuration_steps_url ); ?>"><?php esc_html_e( 'Read Email Configuration Guide for Sending an Email', 'contact-form-query' ); ?></a>
					</p>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Email Carrier', 'contact-form-query' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Email Carrier', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $email_carrier_list as $key => $value ) {
							?>
						<label>
							<input <?php checked( $email_carrier, $key, true ); ?> type="radio" name="email_carrier" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $email_carrier_list );
							if ( key( $email_carrier_list ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_wp_mail">
				<th scope="row">
					<label for="stcfq_wp_mail_from_name"><?php esc_html_e( 'From Name', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="wp_mail_from_name" type="text" id="stcfq_wp_mail_from_name" value="<?php echo esc_attr( $wp_mail['from_name'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter From Name.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_wp_mail">
				<th scope="row">
					<label for="stcfq_wp_mail_from_email"><?php esc_html_e( 'From Email', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="wp_mail_from_email" type="email" id="stcfq_wp_mail_from_email" value="<?php echo esc_attr( $wp_mail['from_email'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter From Email.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_from_name"><?php esc_html_e( 'From Name', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_from_name" type="text" id="stcfq_smtp_from_name" value="<?php echo esc_attr( $smtp['from_name'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter From Name.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_host"><?php esc_html_e( 'Host', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_host" type="text" id="stcfq_smtp_host" value="<?php echo esc_attr( $smtp['host'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter SMTP Host.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_username"><?php esc_html_e( 'Username', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_username" type="text" id="stcfq_smtp_username" value="<?php echo esc_attr( $smtp['username'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter SMTP Username.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_password"><?php esc_html_e( 'Password', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_password" type="password" id="stcfq_smtp_password" value="<?php echo esc_attr( $smtp['password'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter SMTP Password.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_encryption"><?php esc_html_e( 'Encryption', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_encryption" type="text" id="stcfq_smtp_encryption" value="<?php echo esc_attr( $smtp['encryption'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter SMTP Encryption.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr class="stcfq_email stcfq_smtp">
				<th scope="row">
					<label for="stcfq_smtp_port"><?php esc_html_e( 'Port', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="smtp_port" type="text" id="stcfq_smtp_port" value="<?php echo esc_attr( $smtp['port'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter SMTP Port.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_to_admin_email"><?php esc_html_e( 'Enable Email to Admin', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<label>
						<input <?php checked( $email_to_admin['enable'], true, true ); ?> type="radio" name="to_admin_enable" value="1">
						<span><?php esc_html_e( 'Yes', 'contact-form-query' ); ?></span>
					</label>
					&nbsp;
					<label>
						<input <?php checked( $email_to_admin['enable'], false, true ); ?> type="radio" name="to_admin_enable" value="0">
						<span><?php esc_html_e( 'No', 'contact-form-query' ); ?></span>
					</label>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_to_admin_email"><?php esc_html_e( 'Receiver Admin Email', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="to_admin_email" type="email" id="stcfq_to_admin_email" value="<?php echo esc_attr( $email_to_admin['to'] ); ?>" class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Enter Receiver Admin Email Address.', 'contact-form-query' ); ?>
					</p>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-email-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>
