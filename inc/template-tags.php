<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package testwebsite
 */

if ( ! function_exists( 'testwebsite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function testwebsite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'testwebsite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'testwebsite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$comment_count = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $comment_count == 0 ) {
			$comments = __('No Comments', 'testwebsite' );
		} elseif ( $comment_count > 1 ) {
			$comments = $comment_count . __(' Comments', 'testwebsite' );
		} else {
			$comments = __('1 Comment', 'testwebsite' );
		}
		$comment_link = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	}else{
		$comment_link = __(' Comment Closed', 'testwebsite' );
	}

	echo '<span class="posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span><span class="byline"> ' . $byline . '</span><span class="comment-count"><i class="fa fa-comments-o"></i>' . $comment_link ."</span>"; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'testwebsite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function testwebsite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'testwebsite' ) );
		if ( $categories_list && testwebsite_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder"></i>' . esc_html__( '%1$s', 'testwebsite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'testwebsite' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tag"></i>' . esc_html__( '%1$s', 'testwebsite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function testwebsite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'testwebsite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'testwebsite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so testwebsite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so testwebsite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in testwebsite_categorized_blog.
 */
function testwebsite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'testwebsite_categories' );
}
add_action( 'edit_category', 'testwebsite_category_transient_flusher' );
add_action( 'save_post',     'testwebsite_category_transient_flusher' );

if ( ! function_exists( 'testwebsite_social_share' ) ) :
/**
 * Prints HTML with social share
 */
function testwebsite_social_share(){
	global $post;
    $post_url = get_permalink();

	// Get current page title
	$post_title = str_replace( ' ', '%20', get_the_title());
	
	// Get Post Thumbnail for pinterest
	$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	// Construct sharing URL
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$post_title.'&amp;url='.$post_url;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$post_url;
	$googleURL = 'https://plus.google.com/share?url='.$post_url;
	$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$post_url.'&amp;media='.$post_thumbnail[0].'&amp;description='.$post_title;
    $mailURL = 'mailto:?Subject='.$post_title.'&amp;Body='.$post_url;

	$content = '<div class="testwebsite-share-buttons">';
    $content .= '<a target="_blank" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
    $content .= '<a target="_blank" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
	$content .= '<a target="_blank" href="'.$googleURL.'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
	$content .= '<a target="_blank" href="'.$pinterestURL.'" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
    $content .= '<a target="_blank" href="'.$mailURL.'"><i class="fa fa-envelope" aria-hidden="true"></i></a>';
    $content .= '</div>';
    
    echo $content;
}
endif;

