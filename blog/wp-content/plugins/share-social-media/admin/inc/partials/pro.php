<?php
defined( 'ABSPATH' ) || die();

if ( ! class_exists( 'STLSP_Login_Security_Pro' ) ) {
	?>
	<div class="stssm-pro stssm-pro--bottom">
		<div class="stssm-pro-description">
			<div class="stssm-pro-heading">
			<?php
			echo wp_kses(
				__( '<span class="stssm-pro-light">Get</span> <span class="stssm-pro-bold">Login Security <span class="stssm-pro-bold stssm-pro-underline">Pro</span>', 'share-social-media' ),
				array( 'span' => array( 'class' => array() ) )
			);
			?>
			</div>
			<div class="stssm-pro-check-list-wrap">
				<ul class="stssm-pro-check-list">
					<li><?php esc_html_e( 'Limit Login Attempts', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'Login-Logout Redirect', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'Role-Based Redirection', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'Recent Login History', 'share-social-media' ); ?></li>
				</ul>
				<ul class="stssm-pro-check-list">
					<li><?php esc_html_e( 'Login History by Username', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'WooCommerce Login / Register', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'WooCommerce Checkout', 'share-social-media' ); ?></li>
					<li><?php esc_html_e( 'Advanced Security', 'share-social-media' ); ?></li>
				</ul>
			</div>
		</div>
		<div class="stssm-pro-links">
			<a target="_blank" href="<?php echo esc_url( STSSM_Helper::get_pro_url() ); ?>" class="stssm-pro-link stssm-pro-bold"><?php esc_html_e( 'Buy Now', 'share-social-media' ); ?></a>
			<a target="_blank" href="<?php echo esc_url( STSSM_Helper::get_pro_detail_url() ); ?>" class="stssm-pro-link stssm-pro-link--alt"><?php esc_html_e( 'Learn More', 'share-social-media' ); ?></a>
		</div>
	</div>
	<?php
}
