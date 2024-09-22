<?php
/**
 * The Page content template file.
 *
 * @package ShuttleThemes
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'shuttle' ), 'after'  => '</div>', ) ); ?>

		</article>