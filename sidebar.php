<?php

/**
 * The sidebar containing the main widget area.
 *
 * @package testwebsite
 */

$mn_sidebar_layout = "right_sidebar";

if (is_singular(array('post', 'page'))) {
	$mn_sidebar_layout = get_post_meta($post->ID, 'mn_sidebar_layout', true);
	if (!$mn_sidebar_layout) {
		$mn_sidebar_layout = "right_sidebar";
	}
}

if ($mn_sidebar_layout == "no_sidebar" || $mn_sidebar_layout == "no_sidebar_condensed") {
	return;
}

if (is_active_sidebar('testwebsite-right-sidebar') &&  $mn_sidebar_layout == "right_sidebar") {
?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar('testwebsite-right-sidebar'); ?>
	</div><!-- #secondary -->
<?php
}

if (is_active_sidebar('testwebsite-left-sidebar') &&  $mn_sidebar_layout == "left_sidebar") {
?>
	<div id="secondary" class="widget-area">
		<?php dynamic_sidebar('testwebsite-left-sidebar'); ?>
	</div><!-- #secondary -->
<?php
}
