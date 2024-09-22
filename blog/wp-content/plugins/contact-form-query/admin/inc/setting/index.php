<?php
defined( 'ABSPATH' ) || die();

$menu_tab = ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'form_fields';

$menu_tabs = array(
	'form_fields' => esc_html__( 'Form Fields', 'contact-form-query' ),
	'design'      => esc_html__( 'Design', 'contact-form-query' ),
	'captcha'     => esc_html__( 'Captcha', 'contact-form-query' ),
	'email'       => esc_html__( 'Email', 'contact-form-query' ),
	'uninstall'   => esc_html__( 'Uninstall', 'contact-form-query' ),
);
?>
<div class="wrap stcfq">
	<div class="stcfq-header stcfq-header--transparent">
		<div class="stcfq-heading stcfq-page-heading"><?php esc_html_e( 'Contact Form Query', 'contact-form-query' ); ?></div>
	</div>

	<div class="nav-tab-wrapper">
		<?php
		foreach ( $menu_tabs as $key => $value ) {
			$class = ( $menu_tab === $key ) ? ' nav-tab-active' : '';
			?>
		<a class="nav-tab<?php echo esc_attr( $class ); ?>" href="?page=stcfq_settings&tab=<?php echo esc_attr( $key ); ?>">
			<?php echo esc_html( $value ); ?>
		</a>
			<?php
		}
		?>
	</div>
	<div class="stcfq-section">
	<?php
	if ( 'form_fields' === $menu_tab ) {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/form-fields.php';
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
	} elseif ( 'design' === $menu_tab ) {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/design.php';
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
	} elseif ( 'captcha' === $menu_tab ) {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/captcha.php';
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
	} elseif ( 'email' === $menu_tab ) {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/email.php';
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/partials/pro.php';
	} elseif ( 'uninstall' === $menu_tab ) {
		require_once STCFQ_PLUGIN_DIR_PATH . 'admin/inc/setting/tabs/uninstall.php';
	}
	?>
	</div>
</div>
