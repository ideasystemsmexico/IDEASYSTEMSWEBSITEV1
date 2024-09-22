<?php
defined( 'ABSPATH' ) || die();
?>

<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="stssm-reset-plugin-form">

	<?php $nonce = wp_create_nonce( 'reset-plugin' ); ?>
	<input type="hidden" name="reset-plugin" value="<?php echo esc_attr( $nonce ); ?>">

	<input type="hidden" name="action" value="stssm-reset-plugin">

	<div class="st-alert-box st-alert-box-info notice notice-info">
		<p><?php esc_html_e( 'This will reset the plugin to its default state and clear all data created by this plugin.', 'share-social-media' ); ?></p>
	</div>

	<button type="submit" class="button button-primary" id="stssm-reset-plugin-btn" data-message="<?php esc_attr_e( 'Are you sure to reset the plugin to its default state?', 'share-social-media' ); ?>"><?php esc_html_e( 'Reset Plugin', 'share-social-media' ); ?></button>

</form>
