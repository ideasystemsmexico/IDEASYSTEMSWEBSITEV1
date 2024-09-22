<?php
defined( 'ABSPATH' ) || die();

if ( ! class_exists( 'STLSP_Login_Security_Pro' ) ) {
	?>
<div class="stcfq-pro stcfq-pro--bottom">
	<div class="stcfq-pro-description">
		<div class="stcfq-pro-heading">
		<?php
		echo wp_kses(
			__( '<span class="stcfq-pro-light">Get</span> <span class="stcfq-pro-bold">Login Security <span class="stcfq-pro-bold stcfq-pro-underline">Pro</span>', 'contact-form-query' ),
			array( 'span' => array( 'class' => array() ) )
		);
		?>
		</div>
		<div class="stcfq-pro-check-list-wrap">
			<ul class="stcfq-pro-check-list">
				<li><?php esc_html_e( 'Limit Login Attempts', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'Login-Logout Redirect', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'Role-Based Redirection', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'Recent Login History', 'contact-form-query' ); ?></li>
			</ul>
			<ul class="stcfq-pro-check-list">
				<li><?php esc_html_e( 'Login History by Username', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'WooCommerce Login / Register', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'WooCommerce Checkout', 'contact-form-query' ); ?></li>
				<li><?php esc_html_e( 'Advanced Security', 'contact-form-query' ); ?></li>
			</ul>
		</div>
	</div>
	<div class="stcfq-pro-links">
		<a target="_blank" href="<?php echo esc_url( STCFQ_Helper::get_pro_url() ); ?>" class="stcfq-pro-link stcfq-pro-bold"><?php esc_html_e( 'Buy Now', 'contact-form-query' ); ?></a>
		<a target="_blank" href="<?php echo esc_url( STCFQ_Helper::get_pro_detail_url() ); ?>" class="stcfq-pro-link stcfq-pro-link--alt"><?php esc_html_e( 'Learn More', 'contact-form-query' ); ?></a>
	</div>
</div>
	<?php
}
