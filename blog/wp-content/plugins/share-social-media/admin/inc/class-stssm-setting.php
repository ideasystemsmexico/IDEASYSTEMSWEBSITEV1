<?php
defined( 'ABSPATH' ) || die();
require_once STSSM_PLUGIN_DIR_PATH . 'includes/class-stssm-helper.php';

class STSSM_Setting {
	public static function add_action_links( $links ) {
		$settings_link = ( '<a href="' . esc_url( admin_url( 'options-general.php?page=stssm_settings' ) ) . '">' . esc_html__( 'Settings', 'share-social-media' ) . '</a>' );
		array_unshift( $links, $settings_link );

		return $links;
	}

	public static function redirect() {
		if ( get_option( 'stssm_redirect_to_settings', false ) ) {
			delete_option( 'stssm_redirect_to_settings' );
			?>
			<div class="updated notice notice-success is-dismissible">
				<p>
					<?php
					echo wp_kses(
						sprintf(
							/* translators: %s: Settings page link. */
							__( 'To get started with Social Icons Sticky, visit our <a href="%s" target="_blank">settings page</a>.', 'share-social-media' ),
							esc_url( admin_url( 'options-general.php?page=stssm_settings' ) )
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
					<a class="button" href="<?php echo esc_url( admin_url( 'options-general.php?page=stssm_settings' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Social Icons Sticky Settings', 'share-social-media' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}

	public static function save_social_share_icons() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-social-share-icons'] ) || ! wp_verify_nonce( $_POST['save-social-share-icons'], 'save-social-share-icons' ) ) {
			die();
		}

		$sticky_icons_enable    = isset( $_POST['sticky_icons_enable'] ) ? (bool) $_POST['sticky_icons_enable'] : false;
		$sticky_icons_placement = isset( $_POST['sticky_icons_placement'] ) ? sanitize_text_field( $_POST['sticky_icons_placement'] ) : 'left';

		$all_pages_enable     = isset( $_POST['all_pages_enable'] ) ? (bool) $_POST['all_pages_enable'] : false;
		$pages_before_content = isset( $_POST['pages_before_content'] ) ? (bool) $_POST['pages_before_content'] : false;
		$pages_after_content  = isset( $_POST['pages_after_content'] ) ? (bool) $_POST['pages_after_content'] : false;

		$all_posts_enable     = isset( $_POST['all_posts_enable'] ) ? (bool) $_POST['all_posts_enable'] : false;
		$posts_before_content = isset( $_POST['posts_before_content'] ) ? (bool) $_POST['posts_before_content'] : false;
		$posts_after_content  = isset( $_POST['posts_after_content'] ) ? (bool) $_POST['posts_after_content'] : false;

		$icons_content    = ( isset( $_POST['icons_content'] ) && is_array( $_POST['icons_content'] ) ) ? array_map( 'sanitize_text_field', $_POST['icons_content'] ) : array();
		$icons_sticky     = ( isset( $_POST['icons_sticky'] ) && is_array( $_POST['icons_sticky'] ) ) ? array_map( 'sanitize_text_field', $_POST['icons_sticky'] ) : array();
		$icons_sticky_all = ( isset( $_POST['icons_sticky_all'] ) && is_array( $_POST['icons_sticky_all'] ) ) ? array_map( 'sanitize_text_field', $_POST['icons_sticky_all'] ) : array();

		if ( ! in_array( $sticky_icons_placement, array_keys( STSSM_Helper::icons_placement_list_sticky() ) ) ) {
			$sticky_icons_placement = 'left';
		}

		update_option(
			'stssm_sticky_placement',
			array(
				'enable' => $sticky_icons_enable,
				'place'  => $sticky_icons_placement,
			),
			true
		);

		update_option(
			'stssm_pages_placement',
			array(
				'enable'         => $all_pages_enable,
				'after_content'  => $pages_after_content,
				'before_content' => $pages_before_content,
			),
			true
		);

		update_option(
			'stssm_posts_placement',
			array(
				'enable'         => $all_posts_enable,
				'after_content'  => $posts_after_content,
				'before_content' => $posts_before_content,
			),
			true
		);

		update_option( 'stssm_icons_content', $icons_content, true );
		update_option( 'stssm_icons_sticky', $icons_sticky, true );
		update_option( 'stssm_icons_sticky_all', $icons_sticky_all, true );

		wp_send_json_success( array( 'message' => esc_html__( 'Settings saved.', 'share-social-media' ) ) );
	}

	public static function save_icons_design() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['save-icons-design'] ) || ! wp_verify_nonce( $_POST['save-icons-design'], 'save-icons-design' ) ) {
			die();
		}

		$content_icons_shape = isset( $_POST['stssm_content_icons_shape'] ) ? sanitize_text_field( $_POST['stssm_content_icons_shape'] ) : 'circle';
		$content_icons_w     = isset( $_POST['stssm_size_content_icons_w'] ) ? absint( $_POST['stssm_size_content_icons_w'] ) : 30;
		$content_icons_h     = isset( $_POST['stssm_size_content_icons_h'] ) ? absint( $_POST['stssm_size_content_icons_h'] ) : 30;
		$content_icons_ml    = isset( $_POST['stssm_size_content_icons_ml'] ) ? absint( $_POST['stssm_size_content_icons_ml'] ) : 0;
		$content_icons_mr    = isset( $_POST['stssm_size_content_icons_mr'] ) ? absint( $_POST['stssm_size_content_icons_mr'] ) : 8;
		$content_icons_mt    = isset( $_POST['stssm_size_content_icons_mt'] ) ? absint( $_POST['stssm_size_content_icons_mt'] ) : 4;
		$content_icons_mb    = isset( $_POST['stssm_size_content_icons_mb'] ) ? absint( $_POST['stssm_size_content_icons_mb'] ) : 4;

		$sticky_icons_shape = isset( $_POST['stssm_sticky_icons_shape'] ) ? sanitize_text_field( $_POST['stssm_sticky_icons_shape'] ) : 'circle';
		$sticky_icons_w     = isset( $_POST['stssm_size_sticky_icons_w'] ) ? absint( $_POST['stssm_size_sticky_icons_w'] ) : 30;
		$sticky_icons_h     = isset( $_POST['stssm_size_sticky_icons_h'] ) ? absint( $_POST['stssm_size_sticky_icons_h'] ) : 30;
		$sticky_icons_mt    = isset( $_POST['stssm_size_sticky_icons_mt'] ) ? absint( $_POST['stssm_size_sticky_icons_mt'] ) : 6;
		$sticky_icons_mb    = isset( $_POST['stssm_size_sticky_icons_mb'] ) ? absint( $_POST['stssm_size_sticky_icons_mb'] ) : 6;

		if ( ! in_array( $content_icons_shape, array_keys( STSSM_Helper::icons_shape_list() ) ) ) {
			$content_icons_shape = 'circle';
		}

		if ( ! in_array( $sticky_icons_shape, array_keys( STSSM_Helper::icons_shape_list() ) ) ) {
			$sticky_icons_shape = 'circle';
		}

		update_option(
			'stssm_content_icons_design',
			array(
				'shape' => $content_icons_shape,
				'w'     => $content_icons_w,
				'h'     => $content_icons_h,
				'ml'    => $content_icons_ml,
				'mr'    => $content_icons_mr,
				'mt'    => $content_icons_mt,
				'mb'    => $content_icons_mb,
			),
			true
		);

		update_option(
			'stssm_sticky_icons_design',
			array(
				'shape' => $sticky_icons_shape,
				'w'     => $sticky_icons_w,
				'h'     => $sticky_icons_h,
				'mt'    => $sticky_icons_mt,
				'mb'    => $sticky_icons_mb,
			),
			true
		);

		wp_send_json_success( array( 'message' => esc_html__( 'Settings saved.', 'share-social-media' ) ) );
	}

	public static function reset_plugin() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		if ( ! isset( $_POST['reset-plugin'] ) || ! wp_verify_nonce( $_POST['reset-plugin'], 'reset-plugin' ) ) {
			die();
		}

		delete_option( 'stssm_sticky_placement' );
		delete_option( 'stssm_pages_placement' );
		delete_option( 'stssm_posts_placement' );
		delete_option( 'stssm_content_icons_design' );
		delete_option( 'stssm_sticky_icons_design' );
		delete_option( 'stssm_icons_content' );
		delete_option( 'stssm_icons_sticky' );
		delete_option( 'stssm_icons_sticky_all' );
		delete_option( 'stssm_redirect_to_settings' );

		wp_send_json_success( array( 'message' => esc_html__( 'The plugin has been reset to its default state.', 'share-social-media' ) ) );
	}
}
