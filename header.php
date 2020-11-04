<?php

/**
 * The header for our theme.
 *
 * @package testwebsite
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="mn-page">
		<?php
		$testwebsite_header_bg = get_theme_mod('testwebsite_header_bg', 'mn-black');
		$testwebsite_sticky_header = get_theme_mod('testwebsite_disable_sticky_header');
		$testwebsite_sticky_header_class = ($testwebsite_sticky_header) ? ' disable-sticky' : '';
		?>
		<header id="mn-masthead" class="mn-site-header <?php echo esc_attr($testwebsite_header_bg . $testwebsite_sticky_header_class); ?>">
			<div class="mn-container mn-clearfix">
				<div id="mn-site-branding">
					<?php if (get_header_image()) : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
						</a>
					<?php else : ?>
						<?php if (is_front_page()) : ?>
							<h1 class="mn-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php else : ?>
							<p class="mn-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php endif; ?>
						<p class="mn-site-description"><?php bloginfo('description'); ?></p>
					<?php endif; // End header image check. 
					?>
				</div><!-- .site-branding -->
				<div class="mn-phone"><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?php echo of_get_option("header_phone", "555-444-555"); ?></div>
				<div class="mn-toggle-nav">
					<span></span>
				</div>

				<nav id="mn-site-navigation" class="mn-main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container_class' => 'mn-menu mn-clearfix',
						'menu_class' => 'mn-clearfix',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					));
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->

		<div id="mn-content" class="mn-site-content mn-clearfix">