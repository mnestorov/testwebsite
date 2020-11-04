<?php

/**
 * The template for displaying the footer.
 *
 * @package testwebsite
 */

?>

</div><!-- #content -->

<footer id="mn-colophon" class="mn-site-footer">
	<?php if (is_active_sidebar('testwebsite-footer1') || is_active_sidebar('testwebsite-footer2') || is_active_sidebar('testwebsite-footer3') || is_active_sidebar('testwebsite-footer4')) : ?>
		<div id="mn-top-footer">
			<div class="mn-container">
				<div class="mn-top-footer mn-clearfix">
					<div class="mn-footer mn-footer1">
						<?php if (is_active_sidebar('testwebsite-footer1')) :
							dynamic_sidebar('testwebsite-footer1');
						endif;
						?>
					</div>

					<div class="mn-footer mn-footer2">
						<?php if (is_active_sidebar('testwebsite-footer2')) :
							dynamic_sidebar('testwebsite-footer2');
						endif;
						?>
					</div>

					<div class="mn-footer mn-footer3">
						<?php if (is_active_sidebar('testwebsite-footer3')) :
							dynamic_sidebar('testwebsite-footer3');
						endif;
						?>
					</div>

					<div class="mn-footer mn-footer4">
						<?php if (is_active_sidebar('testwebsite-footer4')) :
							dynamic_sidebar('testwebsite-footer4');
						endif;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if (is_active_sidebar('testwebsite-about-footer')) : ?>
		<div id="mn-middle-footer">
			<div class="mn-container">
				<?php
				dynamic_sidebar('testwebsite-about-footer');
				?>
			</div>
		</div>
	<?php endif; ?>

	<div id="mn-bottom-footer">
		<div class="mn-container mn-clearfix">
			<div class="mn-site-info">
				<?php echo __('&copy; 2020 All rights reserved.', 'testwebsite'); ?>
				<span class="sep"> | </span>
				<?php echo __('Developed by <a target="_blank" href="#">Martin Nestorov</a>', 'testwebsite'); ?>
			</div>

			<div class="mn-site-social">
				<?php
				$facebook = get_theme_mod('testwebsite_social_facebook');
				$twitter = get_theme_mod('testwebsite_social_twitter');
				$google_plus = get_theme_mod('testwebsite_social_google_plus');
				$pinterest = get_theme_mod('testwebsite_social_pinterest');
				$youtube = get_theme_mod('testwebsite_social_youtube');
				$linkedin = get_theme_mod('testwebsite_social_linkedin');
				$instagram = get_theme_mod('testwebsite_social_instagram');

				if ($facebook)
					echo '<a class="mn-facebook" href="' . esc_url($facebook) . '" target="_blank"><i class="fa fa-facebook"></i></a>';

				if ($twitter)
					echo '<a class="mn-twitter" href="' . esc_url($twitter) . '" target="_blank"><i class="fa fa-twitter"></i></a>';

				if ($google_plus)
					echo '<a class="mn-googleplus" href="' . esc_url($google_plus) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';

				if ($pinterest)
					echo '<a class="mn-pinterest" href="' . esc_url($pinterest) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';

				if ($youtube)
					echo '<a class="mn-youtube" href="' . esc_url($youtube) . '" target="_blank"><i class="fa fa-youtube"></i></a>';

				if ($linkedin)
					echo '<a class="mn-linkedin" href="' . esc_url($linkedin) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';

				if ($instagram)
					echo '<a class="mn-instagram" href="' . esc_url($instagram) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
				?>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>