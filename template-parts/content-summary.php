<?php
/**
 * Template part for displaying posts.
 *
 * @package testwebsite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="entry-figure">
		<?php 
		if(has_post_thumbnail()):
		$testwebsite_image = wp_get_attachment_image_src( get_post_thumbnail_id() , 'testwebsite-blog-thumb' );
		?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($testwebsite_image[0]); ?>" alt="<?php echo esc_attr( get_the_title() ) ?>"></a>
		<?php endif; ?>
	</figure>
	

	<div class="mn-post-wrapper">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php testwebsite_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				$testwebsite_blog_format = get_theme_mod( 'testwebsite_blog_format','excerpt' );
				if($testwebsite_blog_format == 'excerpt'){
					echo testwebsite_word_excerpt(get_the_content(), 160);

					echo '<div class="entry-readmore"><a href="'.esc_url(get_permalink()).'">'. __( 'Read More', 'testwebsite'). '<i class="fa fa-angle-right" aria-hidden="true"></i></a></div>';
				}else{
					the_content( __( 'Continue reading &rarr;', 'testwebsite' ));

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'testwebsite' ),
						'after'  => '</div>',
					) );
				}
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php 
			testwebsite_entry_footer(); 

			$testwebsite_blog_share_buttons = get_theme_mod( 'testwebsite_blog_share_buttons' );
			if(!$testwebsite_blog_share_buttons){
				testwebsite_social_share();
			}
			?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
