<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package testwebsite
 */

if ( ! is_active_sidebar( 'testwebsite-shop-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'testwebsite-shop-sidebar' ); ?>
</div><!-- #secondary -->
