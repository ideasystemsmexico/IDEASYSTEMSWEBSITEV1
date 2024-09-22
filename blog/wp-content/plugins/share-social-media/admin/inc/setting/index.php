<?php
defined( 'ABSPATH' ) || die();

$menu_tab = ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'social_icons';

$menu_tabs = array(
	'social_icons' => esc_html__( 'Social Icons', 'share-social-media' ),
	'icons_design' => esc_html__( 'Icons Design', 'share-social-media' ),
	'reset'        => esc_html__( 'Reset', 'share-social-media' ),
);
?>
<div class="wrap stssm">
	<div class="stssm-header">
		<div class="stssm-heading stssm-page-heading"><?php esc_html_e( 'Social Icons Sticky', 'share-social-media' ); ?></div>
	</div>

	<div class="nav-tab-wrapper">
	<?php
	foreach ( $menu_tabs as $key => $value ) {
		$class = ( $menu_tab === $key ) ? ' nav-tab-active' : '';
		?>
		<a class="nav-tab<?php echo esc_attr( $class ); ?>" href="?page=stssm_settings&tab=<?php echo esc_attr( $key ); ?>">
			<?php echo esc_html( $value ); ?>
		</a>
		<?php
	}
	?>
	</div>
	<div class="stssm-section">
		<?php
		if ( 'social_icons' === $menu_tab ) {
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/social-icons.php';
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
		} elseif ( 'icons_design' === $menu_tab ) {
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/icons-design.php';
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
		} elseif ( 'reset' === $menu_tab ) {
			require_once STSSM_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/reset.php';
		}
		?>
	</div>
</div>
