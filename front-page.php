<?php

/**
 * Front Page
 *
 * @package testwebsite
 */

$testwebsite_page = '';
$testwebsite_page_array = get_pages();
if (is_array($testwebsite_page_array)) {
	$testwebsite_page = $testwebsite_page_array[0]->ID;
}

if ('page' == get_option('show_on_front')) {
	include(get_page_template());
} else {
	get_header();
?>
	<section id="mn-home-slider-section">
		<div id="mn-bx-slider">
			<?php for ($i = 1; $i < 4; $i++) {
				if ($i == 1) {
					$testwebsite_slider_title = get_theme_mod('testwebsite_slider_title1', __('WordPress Test Theme', 'testwebsite'));
					$testwebsite_slider_subtitle = get_theme_mod('testwebsite_slider_subtitle1', __('Create website in no time', 'testwebsite'));
					$testwebsite_slider_image = get_theme_mod('testwebsite_slider_image1', get_template_directory_uri() . '/images/bg.jpg');
				} else {
					$testwebsite_slider_title = get_theme_mod('testwebsite_slider_title' . $i);
					$testwebsite_slider_subtitle = get_theme_mod('testwebsite_slider_subtitle' . $i);
					$testwebsite_slider_image = get_theme_mod('testwebsite_slider_image' . $i);
				}

				if ($testwebsite_slider_image) {
			?>
					<div class="mn-slide mn-slide-count<?php echo $i; ?>">
						<img src="<?php echo esc_url($testwebsite_slider_image); ?>">

						<?php if ($testwebsite_slider_title || $testwebsite_slider_subtitle) { ?>
							<div class="mn-slide-caption">
								<div class="mn-slide-cap-title animated fadeInDown">
									<?php echo esc_html($testwebsite_slider_title); ?>
								</div>

								<div class="mn-slide-cap-desc animated fadeInUp">
									<?php echo esc_html($testwebsite_slider_subtitle); ?>
								</div>
							</div>
						<?php } ?>
					</div>
			<?php
				}
			} ?>
		</div>
		<div class="mn-banner-shadow"><img src="<?php echo get_template_directory_uri() ?>/images/banner-shadow.png"></div>
	</section>

	<section id="mn-featured-post-section" class="mn-section">
		<div class="mn-container">
			<div class="mn-featured-post-wrap mn-clearfix">
				<?php
				$testwebsite_enable_featured_link = get_theme_mod('testwebsite_enable_featured_link', true);
				for ($i = 1; $i < 4; $i++) {
					$testwebsite_featured_page_id = get_theme_mod('testwebsite_featured_page' . $i, $testwebsite_page);
					$testwebsite_featured_page_icon = get_theme_mod('testwebsite_featured_page_icon' . $i, 'fa-bell');

					if ($testwebsite_featured_page_id) {
						$args = array('page_id' => $testwebsite_featured_page_id);
						$query = new WP_Query($args);
						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post();
				?>
								<div class="mn-featured-post <?php echo 'mn-featured-post' . $i; ?>">
									<div class="mn-featured-icon"><i class="fa <?php echo esc_attr($testwebsite_featured_page_icon); ?>"></i></div>
									<h4><?php the_title(); ?></h4>
									<div class="mn-featured-excerpt">
										<?php
										if (has_excerpt()) {
											echo get_the_excerpt();
										} else {
											echo testwebsite_excerpt(get_the_content(), 120);
										} ?>
									</div>
									<?php
									if ($testwebsite_enable_featured_link) {
									?>
										<a href="<?php the_permalink(); ?>" class="mn-featured-readmore"><i class="fa fa-plus-testwebsite-o"></i></a>
									<?php
									}
									?>
								</div>
				<?php
							endwhile;
						endif;
						wp_reset_postdata();
					}
				}
				?>
			</div>
		</div>
	</section>

	<?php
	$testwebsite_disable_about_sec = get_theme_mod('testwebsite_disable_about_sec');
	if (!$testwebsite_disable_about_sec) {
		$testwebsite_about_image_stack = get_theme_mod('testwebsite_about_image_stack');
		$testwebsite_about_sec_class = !$testwebsite_about_image_stack ? 'mn-about-fullwidth' : "";
	?>
		<section id="mn-about-us-section" class="mn-section">
			<div class="mn-container mn-clearfix">
				<div class="mn-about-sec <?php echo $testwebsite_about_sec_class; ?>">
					<?php
					$args = array(
						'page_id' => get_theme_mod('testwebsite_about_page')
					);
					$query = new WP_Query($args);
					if ($query->have_posts() && get_theme_mod('testwebsite_about_page')) :
						while ($query->have_posts()) : $query->the_post();
					?>
							<h2 class="mn-section-title"><?php the_title(); ?></h2>
							<div class="mn-content"><?php the_content(); ?></div>
					<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</div>

				<?php
				if ($testwebsite_about_image_stack) {
				?>
					<div class="mn-image-stack">
						<ul id="mn-elasticstack" class="mn-elasticstack">
							<?php
							$testwebsite_about_image_stack = explode(',', $testwebsite_about_image_stack);

							foreach ($testwebsite_about_image_stack as $testwebsite_about_image_stack_single) {
								$image = wp_get_attachment_image_src($testwebsite_about_image_stack_single, 'testwebsite-about-thumb');
							?>
								<li><img src="<?php echo esc_url($image[0]); ?>"></li>
							<?php
							}
							?>
						</ul>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php }

	$testwebsite_disable_tab_sec = get_theme_mod('testwebsite_disable_tab_sec');
	if (!$testwebsite_disable_tab_sec) {
	?>
		<section id="mn-tab-section" class="mn-section">
			<div class="mn-container mn-clearfix">
				<ul class="mn-tab">
					<?php
					for ($i = 1; $i < 6; $i++) {
						$testwebsite_tab_title = get_theme_mod('testwebsite_tab_title' . $i);
						$testwebsite_tab_icon = get_theme_mod('testwebsite_tab_icon' . $i);

						if ($testwebsite_tab_title) {
					?>
							<li class="mn-tab-list<?php echo $i; ?>">
								<a href="#<?php echo 'mn-tab' . $i; ?>">
									<?php echo '<i class="fa ' . esc_attr($testwebsite_tab_icon) . '"></i><span>' . esc_html($testwebsite_tab_title) . '</span>'; ?>
								</a>
							</li>
					<?php
						}
					}
					?>
				</ul>

				<div class="mn-tab-content">
					<?php
					for ($i = 1; $i < 6; $i++) {
						$testwebsite_tab_page = get_theme_mod('testwebsite_tab_page' . $i);
						if ($testwebsite_tab_page) {
					?>
							<div class="mn-tab-pane animated zoomIn" id="<?php echo 'mn-tab' . $i; ?>">
								<?php
								$args = array(
									'page_id' => $testwebsite_tab_page
								);
								$query = new WP_Query($args);
								if ($query->have_posts()) :
									while ($query->have_posts()) : $query->the_post();
								?>
										<h2 class="mn-section-title"><?php the_title(); ?></h2>
										<div class="mn-content"><?php the_content(); ?></div>
								<?php
									endwhile;
								endif;
								wp_reset_postdata();
								?>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</section>
	<?php }

	$testwebsite_disable_logo_sec = get_theme_mod('testwebsite_disable_logo_sec');
	if (!$testwebsite_disable_logo_sec) {
	?>
		<section id="mn-logo-section" class="mn-section">
			<div class="mn-container">
				<?php
				$testwebsite_logo_title = get_theme_mod('testwebsite_logo_title');
				?>

				<?php if ($testwebsite_logo_title) { ?>
					<h2 class="mn-section-title"><?php echo esc_html($testwebsite_logo_title); ?></h2>
				<?php } ?>

				<?php
				$testwebsite_client_logo_image = get_theme_mod('testwebsite_client_logo_image');
				$testwebsite_client_logo_image = explode(',', $testwebsite_client_logo_image);
				?>

				<div class="mn_client_logo_slider">
					<?php
					foreach ($testwebsite_client_logo_image as $testwebsite_client_logo_image_single) {
						$image = wp_get_attachment_image_src($testwebsite_client_logo_image_single, 'full');
					?>
						<img src="<?php echo esc_url($image[0]); ?>">
					<?php
					}
					?>
				</div>
			</div>
		</section>
	<?php } ?>
<?php
	get_footer();
}
