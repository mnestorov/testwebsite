<?php remove_action('wp_head', 'wp_generator'); ?>
<?php
/**
 * testwebsite functions and definitions.
 *
 * @package testwebsite
 */

if ( ! function_exists( 'testwebsite_setup' ) ) :

//Sets up theme defaults and registers support for various WordPress features.

function testwebsite_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'testwebsite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	//Support for woocommerce
	add_theme_support( 'woocommerce' );

	//Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'testwebsite-about-thumb', 400, 420, true );
	add_image_size( 'testwebsite-blog-thumb', 800, 420, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'testwebsite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'testwebsite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', testwebsite_fonts_url() ) );
}
endif; // testwebsite_setup
add_action( 'after_setup_theme', 'testwebsite_setup' );

function testwebsite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'testwebsite_content_width', 800 );
}
add_action( 'after_setup_theme', 'testwebsite_content_width', 0 );

//Enables the Excerpt meta box in Page edit screen.
function testwebsite_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'testwebsite_add_excerpt_support_for_pages' );

//Register widget area.
function testwebsite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'testwebsite' ),
		'id'            => 'testwebsite-right-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'testwebsite' ),
		'id'            => 'testwebsite-left-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'testwebsite' ),
		'id'            => 'testwebsite-shop-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'testwebsite' ),
		'id'            => 'testwebsite-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'testwebsite' ),
		'id'            => 'testwebsite-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'testwebsite' ),
		'id'            => 'testwebsite-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'testwebsite' ),
		'id'            => 'testwebsite-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'About Footer', 'testwebsite' ),
		'id'            => 'testwebsite-about-footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'testwebsite_widgets_init' );

if ( ! function_exists( 'testwebsite_fonts_url' ) ) :
/**
 * Register Google fonts for testwebsite.
 *
 * @since testwebsite 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function testwebsite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'testwebsite' ) ) {
		$fonts[] = 'Open+Sans:400,300,600,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'testwebsite' ) ) {
		$fonts[] = 'Roboto+Condensed:300italic,400italic,700italic,400,300,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'testwebsite' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  implode( '|', $fonts ) ,
			'subset' =>  $subsets ,
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function testwebsite_scripts() {
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.3', true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery'), '4.1.2', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.3.3', true );
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery'), '20160213', true );

	if(is_page_template( 'templates/home-template.php' ) || is_front_page() ){
		wp_enqueue_script( 'testwebsite-draggabilly', get_template_directory_uri() . '/js/draggabilly.pkgd.min.js', array('jquery'), '1.3.3', true );
		wp_enqueue_script( 'testwebsite-elastiStack', get_template_directory_uri() . '/js/elastiStack.js', array('jquery'), '1.0.0', true );
	}

	wp_enqueue_script( 'testwebsite-custom', get_template_directory_uri() . '/js/testwebsite-custom.js', array('jquery'), '20150903', true );
	
	wp_enqueue_style( 'testwebsite-fonts', testwebsite_fonts_url(), array(), null );
	wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), '4.1.2' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.6.3' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.3' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.3' );
	wp_enqueue_style( 'testwebsite-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testwebsite_scripts' );

/**
 * Enqueue admin style
 */
function testwebsite_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_style( 'testwebsite-admin-style', get_template_directory_uri() . '/inc/css/admin-style.css', array(), '1.0' );
	wp_enqueue_script( 'testwebsite-admin-scripts', get_template_directory_uri() . '/inc/js/admin-scripts.js', array('jquery'), '20160915', true );
}
add_action( 'admin_enqueue_scripts', 'testwebsite_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/testwebsite-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Woocommerce additions
 */
require get_template_directory() . '/inc/woo-functions.php';

/**
 * Load Custom Metabox
 */
require get_template_directory() . '/inc/testwebsite-metabox.php';

/**
 * Widgets additions.
 */
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/widget-contact-info.php';
require get_template_directory() . '/inc/widgets/widget-personal-info.php';

/**
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/framework/' );
require_once dirname( __FILE__ ) . '/framework/options-framework.php';

/**
 * Check if current page si blog page
 *
 * @return void
 */
function testwebsite_is_blog_page() {

    global $post;

    //Post type must be 'post'.
    $post_type = get_post_type($post);

    //Check all blog-related conditional tags, as well as the current post type, 
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() || !is_single() )
        && ($post_type == 'post')
    ) ? true : false ;

}

/**
 * Load More Posts with AJAX
 *
 * @return void
 */
function testwebsite_load_more_scripts() {
	if (testwebsite_is_blog_page()) {
		global $wp_query; 
	
		// register our main script but do not enqueue it yet
		wp_register_script( 'testwebsite_loadmore', get_stylesheet_directory_uri() . '/js/testwebsite-loadmore.js', array('jquery') );
	
		// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
		wp_localize_script( 'testwebsite_loadmore', 'testwebsite_loadmore_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
			'posts' => json_encode( $wp_query->query_vars ),
			'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages
		));
	
		wp_enqueue_script( 'testwebsite_loadmore' );
	}
}
 
add_action( 'wp_enqueue_scripts', 'testwebsite_load_more_scripts' );

/**
 * AJAX handler function
 *
 * @return void
 */
function testwebsite_loadmore_ajax_handler() {
		// prepare our arguments for the query
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
		$args['post_status'] = 'publish';
	
		// it is always better to use WP_Query but not here
		query_posts( $args );
		if(have_posts() && !testwebsite_is_blog_page()) {
	
			// run the loop
			while( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_format());
				// the_title();
			endwhile;
		}
		die; // here we exit the script and even no wp_reset_query() required!
	
}
 
add_action('wp_ajax_loadmore', 'testwebsite_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'testwebsite_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}