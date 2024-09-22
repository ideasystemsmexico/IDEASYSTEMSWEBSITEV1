<?php
/**
 * The template for displaying content on the search results page.
 *
 * @package ShuttleThemes
 */
?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<?php shuttle_input_blogtitle(); ?>

						<div class="entry-content">
							<?php the_excerpt(); ?>

							<div class="entry-meta">
								<?php shuttle_input_blogauthor(); ?>
								<?php shuttle_input_blogdate(); ?>
								<?php shuttle_input_blogcomment(); ?>
								<?php shuttle_input_blogcategory(); ?>
								<?php shuttle_input_blogtag(); ?>
							</div>
						</div>

					<div class="clearboth"></div>
					</article><!-- #post-<?php get_the_ID(); ?> -->	