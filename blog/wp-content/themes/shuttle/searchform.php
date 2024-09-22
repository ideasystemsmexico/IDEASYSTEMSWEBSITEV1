<?php
/**
 * The template for displaying search forms.
 *
 * @package ShuttleThemes
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Search', 'shuttle' ) . ' &hellip;'; ?>" />
		<input type="submit" class="searchsubmit" name="submit" value="<?php esc_attr_e( 'Search', 'shuttle' ); ?>" />
	</form>