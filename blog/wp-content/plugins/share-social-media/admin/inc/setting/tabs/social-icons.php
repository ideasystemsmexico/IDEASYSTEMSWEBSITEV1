<?php
defined( 'ABSPATH' ) || die();
require_once STSSM_PLUGIN_DIR_PATH . 'includes/class-stssm-helper.php';

$icons_placement_enable_list = STSSM_Helper::icons_placement_enable_list();
$icons_placement_list_pages  = STSSM_Helper::icons_placement_list_pages();
$icons_placement_list_posts  = STSSM_Helper::icons_placement_list_posts();
$icons_placement_list_sticky = STSSM_Helper::icons_placement_list_sticky();

$sticky_placement = STSSM_Helper::get_sticky_placement();
$pages_placement  = STSSM_Helper::get_pages_placement();
$posts_placement  = STSSM_Helper::get_posts_placement();

$icons_class = STSSM_Helper::icons_class();

$icons_content    = STSSM_Helper::get_icons_content();
$icons_sticky     = STSSM_Helper::get_icons_sticky();
$icons_sticky_all = STSSM_Helper::get_icons_sticky_all();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stssm-save-social-share-icons-form">

	<?php $nonce = wp_create_nonce( 'save-social-share-icons' ); ?>
	<input type="hidden" name="save-social-share-icons" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stssm-save-social-share-icons">

	<table class="form-table">
		<tbody>

			<tr>
				<th scope="row"><?php esc_html_e( 'Social Share Icons', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Social Share Icons', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_placement_enable_list_count = count( $icons_placement_enable_list );

						$i = 0;
						foreach ( $icons_placement_enable_list as $key => $value ) {
							if ( 'sticky_icons_enable' === $key ) {
								$checked = $sticky_placement['enable'];
							} elseif ( 'all_pages_enable' === $key ) {
								$checked = $pages_placement['enable'];
							} elseif ( 'all_posts_enable' === $key ) {
								$checked = $posts_placement['enable'];
							} else {
								$checked = false;
							}
							?>
						<label for="stssm-<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $checked, true, true ); ?> name="<?php echo esc_attr( $key ); ?>" type="checkbox" id="stssm-<?php echo esc_attr( $key ); ?>" value="1">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_placement_enable_list_count ) {
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
				<th scope="row"><?php esc_html_e( 'Sticky Icons Placement', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Sticky Icons Placement', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_placement_list_sticky_count = count( $icons_placement_list_sticky );

						$i = 0;
						foreach ( $icons_placement_list_sticky as $key => $value ) {
							?>
						<label for="stssm-sticky-<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $sticky_placement['place'], $key, true ); ?> name="sticky_icons_placement" type="radio" id="stssm-sticky-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_placement_list_sticky_count ) {
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
				<th scope="row"><?php esc_html_e( 'Placement on Pages', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Placement on Pages', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_placement_list_pages_count = count( $icons_placement_list_pages );

						$i = 0;
						foreach ( $icons_placement_list_pages as $key => $value ) {
							?>
						<label for="stssm-pages-<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $pages_placement[ $key ], true, true ); ?> name="pages_<?php echo esc_attr( $key ); ?>" type="checkbox" id="stssm-pages-<?php echo esc_attr( $key ); ?>" value="1">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_placement_list_pages_count ) {
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
				<th scope="row"><?php esc_html_e( 'Placement on Posts', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Placement on Posts', 'share-social-media' ); ?></span>
						</legend>
						<?php
						$icons_placement_list_posts_count = count( $icons_placement_list_posts );

						$i = 0;
						foreach ( $icons_placement_list_posts as $key => $value ) {
							?>
						<label for="stssm-posts-<?php echo esc_attr( $key ); ?>">
							<input <?php checked( $posts_placement[ $key ], true, true ); ?> name="posts_<?php echo esc_attr( $key ); ?>" type="checkbox" id="stssm-posts-<?php echo esc_attr( $key ); ?>" value="1">
							<?php echo esc_html( $value ); ?>
						</label>
							<?php
							if ( ++$i !== $icons_placement_list_posts_count ) {
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
				<th scope="row"><?php esc_html_e( 'Sticky Icons (Side)', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Sticky Icons (Side)', 'share-social-media' ); ?></span>
						</legend>
						<ul class="stssm-social-icons">
						<?php
						$icons_keys = array_keys( $icons_sticky );
						foreach ( $icons_class as $icon => $val ) {
							?>
						<label>
							<li class="ssm-<?php echo esc_attr( $icon ); ?>">
								<i class="<?php echo esc_attr( $val['class'] ); ?>"></i>
								<input <?php checked( in_array( $icon, $icons_keys, true ), true, true ); ?> name="icons_sticky[]" type="checkbox" value="<?php echo esc_attr( $icon ); ?>">&nbsp;
							</li>
						</label>
							<?php
						}
						?>
						</ul>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Sticky Icons (All)', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Sticky Icons (All)', 'share-social-media' ); ?></span>
						</legend>
						<ul class="stssm-social-icons stssm-content-social-icons">
						<?php
						$icons_keys = array_keys( $icons_sticky_all );
						foreach ( $icons_class as $icon => $val ) {
							?>
						<label>
							<li class="ssm-<?php echo esc_attr( $icon ); ?>">
								<i class="<?php echo esc_attr( $val['class'] ); ?>"></i>
								<input <?php checked( in_array( $icon, $icons_keys, true ), true, true ); ?> name="icons_sticky_all[]" type="checkbox" value="<?php echo esc_attr( $icon ); ?>">&nbsp;
							</li>
						</label>
							<?php
						}
						?>
						</ul>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php esc_html_e( 'Content Icons (Post, Page)', 'share-social-media' ); ?></th>
				<td>
					<fieldset>
						<legend class="screen-reader-text">
							<span><?php esc_html_e( 'Content Icons (Post, Page)', 'share-social-media' ); ?></span>
						</legend>
						<ul class="stssm-social-icons stssm-content-social-icons">
						<?php
						$icons_keys = array_keys( $icons_content );
						foreach ( $icons_class as $icon => $val ) {
							?>
						<label>
							<li class="ssm-<?php echo esc_attr( $icon ); ?>">
								<i class="<?php echo esc_attr( $val['class'] ); ?>"></i>
								<input <?php checked( in_array( $icon, $icons_keys, true ), true, true ); ?> name="icons_content[]" type="checkbox" value="<?php echo esc_attr( $icon ); ?>">&nbsp;
							</li>
						</label>
							<?php
						}
						?>
						</ul>
					</fieldset>
				</td>
			</tr>

		</tbody>
	</table>

	<button type="submit" class="button button-primary" id="stssm-save-social-share-icons-btn"><?php esc_html_e( 'Save Changes', 'share-social-media' ); ?></button>

</form>

<div class="stssm-review">
	<div class="stssm-review-us">
		<a target="_blank" href="https://wordpress.org/support/plugin/share-social-media/reviews/#new-post" class="stssm-review-link">
			<span class="stssm-rate-us">
				<?php esc_html_e( 'Like this plugin? Leave a Review.', 'share-social-media' ); ?>
			</span>
			<div class="vers column-rating">
				<div class="star-rating">
					<span class="screen-reader-text"><?php esc_html_e( 'Like this plugin? Leave a Review.', 'share-social-media' ); ?></span>
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
