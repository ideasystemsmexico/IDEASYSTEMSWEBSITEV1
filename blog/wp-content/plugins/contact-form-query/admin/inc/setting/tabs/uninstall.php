<?php
defined( 'ABSPATH' ) || die();

$delete_data_enable = get_option( 'stcfq_delete_data_enable' );
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-uninstall-setting-form">

	<?php $nonce = wp_create_nonce( 'save-uninstall-setting' ); ?>
	<input type="hidden" name="save-uninstall-setting" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-uninstall-setting">

	<div class="st-alert-box-info notice notice-info">
		<p><?php esc_html_e( 'This will delete all the data when you delete the plugin using WordPress "Plugins" menu if you enable this setting.', 'contact-form-query' ); ?></p>
	</div>

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Data Deletion', 'contact-form-query' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( "Delete all data on plugin's deletion", 'contact-form-query' ); ?></span>
						</legend>
						<label for="stcfq_delete_data_enable">
							<input <?php checked( $delete_data_enable, true, true ); ?> name="delete_data_enable" type="checkbox" id="stcfq_delete_data_enable" value="1">
							<?php esc_html_e( "Delete all data on plugin's deletion", 'contact-form-query' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-uninstall-setting-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>
