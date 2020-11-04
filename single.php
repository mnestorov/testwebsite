<?php

/**
 * The template for displaying all single posts.
 *
 * @package testwebsite
 */

get_header(); ?>

<header class="mn-main-header">
	<div class="mn-container">
		<?php the_title('<h1 class="mn-main-title">', '</h1>'); ?>
	</div>
</header><!-- .entry-header -->

<div class="mn-container mn-clearfix">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('template-parts/content', 'single'); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
				?>

			<?php endwhile; // End of the loop. 
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>