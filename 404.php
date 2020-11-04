<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package testwebsite
 */

get_header(); ?>

<header class="mn-main-header">
	<div class="mn-container">
		<h1 class="mn-main-title"><?php esc_html_e( '404 Error', 'testwebsite' ); ?></h1>
	</div>
</header><!-- .entry-header -->

<div class="mn-container">

	<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'testwebsite' ); ?></p>

</div>

<?php get_footer(); ?>
