<?php
/**
 * The Single Post content template file.
 *
 * @package ShuttleThemes
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php shuttle_input_postmeta(); ?>
		<?php shuttle_input_postmedia(); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'shuttle' ), 'after'  => '</div>', ) ); ?>
		</div><!-- .entry-content -->

		</article>

		<div class="clearboth"></div>