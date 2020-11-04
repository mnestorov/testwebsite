<?php

/**
 * Template Name: Services Page
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

			<p><?php echo of_get_option('page_desc_editor', 'Default'); ?></p>

			<!-- Services -->
			<div class="mn-featured-post-wrap mn-clearfix">
				<div class="mn-featured-post mn-featured-post1">
					<div class="mn-featured-icon"><i class="fa fa fa-road"></i></div>
					<h4><?php echo of_get_option('service_1_title', 'Default'); ?></h4>
					<div class="mn-featured-excerpt"><?php echo of_get_option('service_1_desc_editor', 'Default'); ?></div>
					<a href="<?php echo of_get_option('service_1_url', 'Default'); ?>" class="mn-featured-readmore"><i class="fa fa-plus-square-o"></i></a>
				</div>
				<div class="mn-featured-post mn-featured-post2">
					<div class="mn-featured-icon"><i class="fa fa fa-road"></i></div>
					<h4><?php echo of_get_option('service_2_title', 'Default'); ?></h4>
					<div class="mn-featured-excerpt"><?php echo of_get_option('service_2_desc_editor', 'Default'); ?></div>
					<a href="<?php echo of_get_option('service_2_url', 'Default'); ?>" class="mn-featured-readmore"><i class="fa fa-plus-square-o"></i></a>
				</div>
				<div class="mn-featured-post mn-featured-post3">
					<div class="mn-featured-icon"><i class="fa fa fa-road"></i></div>
					<h4><?php echo of_get_option('service_3_title', 'Default'); ?></h4>
					<div class="mn-featured-excerpt"><?php echo of_get_option('service_3_desc_editor', 'Default'); ?></div>
					<a href="<?php echo of_get_option('service_3_url', 'Default'); ?>" class="mn-featured-readmore"><i class="fa fa-plus-square-o"></i></a>
				</div>
			</div>

			<div class="mn-featured-post-wrap mn-clearfix">
				<div class="mn-featured-post mn-featured-post1">
					<div class="mn-featured-icon"><i class="fa fa fa-road"></i></div>
					<h4><?php echo of_get_option('service_4_title', 'Default'); ?></h4>
					<div class="mn-featured-excerpt"><?php echo of_get_option('service_1_desc_editor', 'Default'); ?></div>
					<a href="<?php echo of_get_option('service_4_url', 'Default'); ?>" class="mn-featured-readmore"><i class="fa fa-plus-square-o"></i></a>
				</div>
				<div class="mn-featured-post mn-featured-post2">
					<div class="mn-featured-icon"><i class="fa fa fa-road"></i></div>
					<h4><?php echo of_get_option('service_5_title', 'Default'); ?></h4>
					<div class="mn-featured-excerpt"><?php echo of_get_option('service_2_desc_editor', 'Default'); ?></div>
					<a href="<?php echo of_get_option('service_5_url', 'Default'); ?>" class="mn-featured-readmore"><i class="fa fa-plus-square-o"></i></a>
				</div>
			</div>
			<!-- Services END -->

			<br /><br />

			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('template-parts/content', 'page'); ?>

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