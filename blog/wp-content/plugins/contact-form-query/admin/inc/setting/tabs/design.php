<?php
defined( 'ABSPATH' ) || die();
require_once STCFQ_PLUGIN_DIR_PATH . 'includes/class-stcfq-helper.php';

$layout_list = STCFQ_Helper::layout_list();
$layout      = STCFQ_Helper::layout();
$design      = STCFQ_Helper::design();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stcfq-save-layout-form">

	<?php $nonce = wp_create_nonce( 'save-layout' ); ?>
	<input type="hidden" name="save-layout" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stcfq-save-layout">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Form Design', 'contact-form-query' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Select Form Design Layout', 'contact-form-query' ); ?></span>
						</legend>
						<?php
						foreach ( $layout_list as $key => $value ) {
							?>
						<label>
							<input <?php checked( $layout, $key, true ); ?> type="radio" name="layout" value="<?php echo esc_attr( $key ); ?>">
							<span><?php echo esc_html( $value ); ?></span>
						</label>
							<?php
							end( $layout_list );
							if ( key( $layout_list ) !== $key ) {
								echo '<br>';
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_success_background_color"><?php esc_html_e( 'Success Background Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="success_background_color" type="text" class="color-picker" id="stcfq_success_background_color" value="<?php echo esc_attr( $design['success_background_color'] ); ?>" class="regular-text" data-default-color="#d4edda">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_success_border_color"><?php esc_html_e( 'Success Border Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="success_border_color" type="text" class="color-picker" id="stcfq_success_border_color" value="<?php echo esc_attr( $design['success_border_color'] ); ?>" class="regular-text" data-default-color="#c3e6cb">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_success_font_color"><?php esc_html_e( 'Success Font Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="success_font_color" type="text" class="color-picker" id="stcfq_success_font_color" value="<?php echo esc_attr( $design['success_font_color'] ); ?>" class="regular-text" data-default-color="#155724">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_error_background_color"><?php esc_html_e( 'Error Background Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="error_background_color" type="text" class="color-picker" id="stcfq_error_background_color" value="<?php echo esc_attr( $design['error_background_color'] ); ?>" class="regular-text" data-default-color="#f8d7da">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_error_border_color"><?php esc_html_e( 'Error Border Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="error_border_color" type="text" class="color-picker" id="stcfq_error_border_color" value="<?php echo esc_attr( $design['error_border_color'] ); ?>" class="regular-text" data-default-color="#f5c6cb">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_error_font_color"><?php esc_html_e( 'Error Font Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="error_font_color" type="text" class="color-picker" id="stcfq_error_font_color" value="<?php echo esc_attr( $design['error_font_color'] ); ?>" class="regular-text" data-default-color="#721c24">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_validation_error_color"><?php esc_html_e( 'Validation Error Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="validation_error_color" type="text" class="color-picker" id="stcfq_validation_error_color" value="<?php echo esc_attr( $design['validation_error_color'] ); ?>" class="regular-text" data-default-color="#dc3232">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="stcfq_validation_error_border_color"><?php esc_html_e( 'Validation Error Border Color', 'contact-form-query' ); ?></label>
				</th>
				<td>
					<input name="validation_error_border_color" type="text" class="color-picker" id="stcfq_validation_error_border_color" value="<?php echo esc_attr( $design['validation_error_border_color'] ); ?>" class="regular-text" data-default-color="#dc3232">
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stcfq-save-layout-btn"><?php esc_html_e( 'Save Changes', 'contact-form-query' ); ?></button>

</form>
