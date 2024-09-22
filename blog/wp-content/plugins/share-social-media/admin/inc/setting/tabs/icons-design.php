<?php
defined( 'ABSPATH' ) || die();
require_once STSSM_PLUGIN_DIR_PATH . 'includes/class-stssm-helper.php';

$icons_shape_list = STSSM_Helper::icons_shape_list();

$content_icons_design = STSSM_Helper::get_content_icons_design();
$sticky_icons_design  = STSSM_Helper::get_sticky_icons_design();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stssm-save-icons-design-form" class="options-media-php">

	<?php $nonce = wp_create_nonce( 'save-icons-design' ); ?>
	<input type="hidden" name="save-icons-design" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stssm-save-icons-design">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Content Icons Shape', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Content Icons Shape', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_shape_list_count = count( $icons_shape_list );

						$i = 0;
						foreach ( $icons_shape_list as $key => $value ) {
							?>
						<label for="stssm_content_icons_shape_<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $content_icons_design['shape'], $key, true ); ?> name="stssm_content_icons_shape" type="radio" id="stssm_content_icons_shape_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_shape_list_count ) {
								?>
						<br>
								<?php
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Content Icons Size', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Before/After Content Icons Size', 'share-social-media' ); ?></span>
						</legend>
						<label for="stssm_size_content_icons_w"><?php esc_html_e( 'Width', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_w" type="number" step="1" min="0" id="stssm_size_content_icons_w" value="<?php echo esc_attr( $content_icons_design['w'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_content_icons_h"><?php esc_html_e( 'Height', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_h" type="number" step="1" min="0" id="stssm_size_content_icons_h" value="<?php echo esc_attr( $content_icons_design['h'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_content_icons_ml"><?php esc_html_e( 'Marign Left', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_ml" type="number" step="1" min="0" id="stssm_size_content_icons_ml" value="<?php echo esc_attr( $content_icons_design['ml'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_content_icons_mr"><?php esc_html_e( 'Marign Right', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_mr" type="number" step="1" min="0" id="stssm_size_content_icons_mr" value="<?php echo esc_attr( $content_icons_design['mr'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_content_icons_mt"><?php esc_html_e( 'Marign Top', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_mt" type="number" step="1" min="0" id="stssm_size_content_icons_mt" value="<?php echo esc_attr( $content_icons_design['mt'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_content_icons_mb"><?php esc_html_e( 'Marign Bottom', 'share-social-media' ); ?></label>
						<input name="stssm_size_content_icons_mb" type="number" step="1" min="0" id="stssm_size_content_icons_mb" value="<?php echo esc_attr( $content_icons_design['mb'] ); ?>" class="small-text">
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Sticky Icons Shape', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Sticky Icons Shape', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_shape_list_count = count( $icons_shape_list );

						$i = 0;
						foreach ( $icons_shape_list as $key => $value ) {
							?>
						<label for="stssm_sticky_icons_shape_<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $sticky_icons_design['shape'], $key, true ); ?> name="stssm_sticky_icons_shape" type="radio" id="stssm_sticky_icons_shape_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_shape_list_count ) {
								?>
						<br>
								<?php
							}
						}
						?>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Sticky Icons Size', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Sticky Icons Size', 'share-social-media' ); ?></span>
						</legend>
						<label for="stssm_size_sticky_icons_w"><?php esc_html_e( 'Width', 'share-social-media' ); ?></label>
						<input name="stssm_size_sticky_icons_w" type="number" step="1" min="0" id="stssm_size_sticky_icons_w" value="<?php echo esc_attr( $sticky_icons_design['w'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_sticky_icons_h"><?php esc_html_e( 'Height', 'share-social-media' ); ?></label>
						<input name="stssm_size_sticky_icons_h" type="number" step="1" min="0" id="stssm_size_sticky_icons_h" value="<?php echo esc_attr( $sticky_icons_design['h'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_sticky_icons_mt"><?php esc_html_e( 'Marign Top', 'share-social-media' ); ?></label>
						<input name="stssm_size_sticky_icons_mt" type="number" step="1" min="0" id="stssm_size_sticky_icons_mt" value="<?php echo esc_attr( $sticky_icons_design['mt'] ); ?>" class="small-text">
						<br>
						<label for="stssm_size_sticky_icons_mb"><?php esc_html_e( 'Marign Bottom', 'share-social-media' ); ?></label>
						<input name="stssm_size_sticky_icons_mb" type="number" step="1" min="0" id="stssm_size_sticky_icons_mb" value="<?php echo esc_attr( $sticky_icons_design['mb'] ); ?>" class="small-text">
					</fieldset>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stssm-save-icons-design-btn"><?php esc_html_e( 'Save Changes', 'share-social-media' ); ?></button>

</form>
