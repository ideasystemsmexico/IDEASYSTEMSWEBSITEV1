<?php
/**
 * The template for displaying content where a specific template is not available.
 *
 * @package ShuttleThemes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="">

		<h2 class="search-title">
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'shuttle' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
		</h2>

	</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'shuttle' ), 'after'  => '</div>', ) ); ?>
		</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->