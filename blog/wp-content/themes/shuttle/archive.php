<?php
/**
 * The template for displaying Archive pages.
 *
 * @package ShuttleThemes
 */

get_header(); ?>

			<?php if( have_posts() ): ?>

				<div id="container">

				<?php while( have_posts() ): the_post(); ?>

					<div class="blog-grid element<?php shuttle_input_stylelayout(); ?>">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<header class="entry-header<?php shuttle_input_stylelayout_class1(); ?>">

							<?php shuttle_input_blogimage(); ?>

						</header>

						<div class="entry-content<?php shuttle_input_stylelayout_class2(); ?><?php shuttle_input_blogcommentclass(); ?>">

							<?php shuttle_input_blogtitle(); ?>
							<?php shuttle_input_blogmeta(); ?>
							<?php shuttle_input_blogtext(); ?>

						</div><div class="clearboth"></div>

					</article><!-- #post-<?php get_the_ID(); ?> -->

					</div>

				<?php endwhile; ?>

				</div><div class="clearboth"></div>

				<?php the_posts_pagination(); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; wp_reset_postdata(); ?>

<?php get_footer() ?>