<?php

/**
 * testwebsite Theme Customizer.
 *
 * @package testwebsite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function testwebsite_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	$testwebsite_page = '';
	$testwebsite_page_array = get_pages();
	if (is_array($testwebsite_page_array)) {
		$testwebsite_page = $testwebsite_page_array[0]->ID;
	}

	$header_bg_choices = array(
		'mn-white' => __('White', 'testwebsite'),
		'mn-black' => __('Black', 'testwebsite')
	);

	/*============GENERAL SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'testwebsite_general_settings_panel',
		array(
			'title' 			=> __('General Settings', 'testwebsite'),
			'priority'          => 10
		)
	);

	//STATIC FRONT PAGE
	$wp_customize->add_section('static_front_page', array(
		'title'          => __('Static Front Page', 'testwebsite'),
		'panel' => 'testwebsite_general_settings_panel',
		'description'    => __('Your theme supports a static front page.', 'testwebsite'),
	));

	//TITLE AND TAGLINE SETTINGS
	$wp_customize->add_section('title_tagline', array(
		'title'    => __('Site Title & Tagline', 'testwebsite'),
		'panel' => 'testwebsite_general_settings_panel',
	));

	//HEADER LOGO 
	$wp_customize->add_section('header_image', array(
		'title'    => __('Header Logo', 'testwebsite'),
		'panel' => 'testwebsite_general_settings_panel',
	));

	//HEADER SETTINGS 
	$wp_customize->add_section(
		'testwebsite_header_setting_sec',
		array(
			'title'			=> __('Header Settings', 'testwebsite'),
			'panel'         => 'testwebsite_general_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_disable_sticky_header',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_disable_sticky_header',
		array(
			'settings'		=> 'testwebsite_disable_sticky_header',
			'section'		=> 'testwebsite_header_setting_sec',
			'label'			=> __('Disable Sticky Header', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'testwebsite_header_bg',
		array(
			'default'			=> 'mn-black',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'testwebsite_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Dropdown_Chooser(
			$wp_customize,
			'testwebsite_header_bg',
			array(
				'settings'		=> 'testwebsite_header_bg',
				'section'		=> 'testwebsite_header_setting_sec',
				'type'			=> 'select',
				'label'			=> __('Header Background Color', 'testwebsite'),
				'choices'       => $header_bg_choices,
			)
		)
	);


	$wp_customize->add_setting(
		'testwebsite_page_header_bg',
		array(
			'default'			=> get_template_directory_uri() . '/images/bg.jpg',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'testwebsite_page_header_bg',
			array(
				'label'    => __('Page Header Banner', 'testwebsite'),
				'settings' => 'testwebsite_page_header_bg',
				'section'  => 'testwebsite_header_setting_sec',
				'description'   => __('This banner will show in the header of all the inner pages <br/>Recommended Image Size: 1800X400px', 'testwebsite')
			)
		)
	);

	//BLOG SETTINGS
	$wp_customize->add_section(
		'testwebsite_blog_sec',
		array(
			'title'			=> __('Blog Settings', 'testwebsite'),
			'panel'         => 'testwebsite_general_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_blog_format',
		array(
			'default'			=> 'excerpt',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'testwebsite_blog_format',
		array(
			'label'    => __('Blog Content Format', 'testwebsite'),
			'section'  => 'testwebsite_blog_sec',
			'settings' => 'testwebsite_blog_format',
			'type'     => 'radio',
			'choices'  => array(
				'excerpt'  => 'Excerpt',
				'full_content' => 'Full Content',
			),
		)
	);

	$wp_customize->add_setting(
		'testwebsite_blog_share_buttons',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_blog_share_buttons',
		array(
			'settings'		=> 'testwebsite_blog_share_buttons',
			'section'		=> 'testwebsite_blog_sec',
			'label'			=> __('Disable Share Buttons', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	//BACKGROUND IMAGE
	$wp_customize->add_section('background_image', array(
		'title'    => __('Background Image', 'testwebsite'),
		'panel' => 'testwebsite_general_settings_panel',
	));

	$wp_customize->add_section('colors', array(
		'title'    => __('Colors', 'testwebsite'),
		'panel' => 'testwebsite_general_settings_panel',
	));

	/*============HOME SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'testwebsite_home_settings_panel',
		array(
			'title' 			=> __('Home Page Sections', 'testwebsite'),
			'priority'          => 10
		)
	);

	/*============SLIDER IMAGES SECTION============*/
	$wp_customize->add_section(
		'testwebsite_slider_sec',
		array(
			'title'			=> __('Slider Section', 'testwebsite'),
			'panel'         => 'testwebsite_home_settings_panel'
		)
	);

	//SLIDERS
	for ($i = 1; $i < 4; $i++) {

		$wp_customize->add_setting(
			'testwebsite_slider_heading' . $i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new testwebsite_Customize_Heading(
				$wp_customize,
				'testwebsite_slider_heading' . $i,
				array(
					'settings'		=> 'testwebsite_slider_heading' . $i,
					'section'		=> 'testwebsite_slider_sec',
					'label'			=> __('Slider ', 'testwebsite') . $i,
				)
			)
		);

		$wp_customize->add_setting(
			'testwebsite_slider_title' . $i,
			array(
				'default'			=> __('Testwebsite WordPress Theme', 'testwebsite'),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'testwebsite_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'testwebsite_slider_title' . $i,
			array(
				'settings'		=> 'testwebsite_slider_title' . $i,
				'section'		=> 'testwebsite_slider_sec',
				'type'			=> 'text',
				'label'			=> __('Caption Title', 'testwebsite')
			)
		);

		$wp_customize->add_setting(
			'testwebsite_slider_subtitle' . $i,
			array(
				'default'			=> __('Create website in no time', 'testwebsite'),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'testwebsite_slider_subtitle' . $i,
			array(
				'settings'		=> 'testwebsite_slider_subtitle' . $i,
				'section'		=> 'testwebsite_slider_sec',
				'type'			=> 'textarea',
				'label'			=> __('Caption SubTitle', 'testwebsite')
			)
		);

		$wp_customize->add_setting(
			'testwebsite_slider_image' . $i,
			array(
				'default'			=> get_template_directory_uri() . '/images/bg.jpg',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'testwebsite_slider_image' . $i,
				array(
					'label'    => __('Slider Image', 'testwebsite'),
					'settings' => 'testwebsite_slider_image' . $i,
					'section'  => 'testwebsite_slider_sec',
					'description'   => __('Recommended Image Size: 1800X800px', 'testwebsite')
				)
			)
		);
	}

	/*============FEATURED SECTION============*/

	//FEATURED PAGES
	$wp_customize->add_section(
		'testwebsite_featured_page_sec',
		array(
			'title'			=> __('Featured Section', 'testwebsite'),
			'panel'         => 'testwebsite_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_enable_featured_link',
		array(
			'default'			=> 1,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_enable_featured_link',
		array(
			'settings'		=> 'testwebsite_enable_featured_link',
			'section'		=> 'testwebsite_featured_page_sec',
			'label'			=> __('Enable Read More link ', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	for ($i = 1; $i < 4; $i++) {

		$wp_customize->add_setting(
			'testwebsite_featured_header' . $i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new testwebsite_Customize_Heading(
				$wp_customize,
				'testwebsite_featured_header' . $i,
				array(
					'settings'		=> 'testwebsite_featured_header' . $i,
					'section'		=> 'testwebsite_featured_page_sec',
					'label'			=> __('Featured Page ', 'testwebsite') . $i
				)
			)
		);

		$wp_customize->add_setting(
			'testwebsite_featured_page' . $i,
			array(
				'default'			=> $testwebsite_page,
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'testwebsite_featured_page' . $i,
			array(
				'settings'		=> 'testwebsite_featured_page' . $i,
				'section'		=> 'testwebsite_featured_page_sec',
				'type'			=> 'dropdown-pages',
				'label'			=> __('Select a Page', 'testwebsite')
			)
		);

		$wp_customize->add_setting(
			'testwebsite_featured_page_icon' . $i,
			array(
				'default'			=> 'fa fa-bell',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new testwebsite_Fontawesome_Icon_Chooser(
				$wp_customize,
				'testwebsite_featured_page_icon' . $i,
				array(
					'settings'		=> 'testwebsite_featured_page_icon' . $i,
					'section'		=> 'testwebsite_featured_page_sec',
					'label'			=> __('FontAwesome Icon', 'testwebsite'),
					'type'			=> 'icon'
				)
			)
		);
	}

	/*============ABOUT SECTION============*/

	$wp_customize->add_section(
		'testwebsite_about_sec',
		array(
			'title'			=> __('About Us Section', 'testwebsite'),
			'panel'         => 'testwebsite_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_disable_about_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_disable_about_sec',
		array(
			'settings'		=> 'testwebsite_disable_about_sec',
			'section'		=> 'testwebsite_about_sec',
			'label'			=> __('Disable About Section ', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'testwebsite_about_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Customize_Heading(
			$wp_customize,
			'testwebsite_about_header',
			array(
				'settings'		=> 'testwebsite_about_header',
				'section'		=> 'testwebsite_about_sec',
				'label'			=> __('About Page ', 'testwebsite')
			)
		)
	);

	$wp_customize->add_setting(
		'testwebsite_about_page',
		array(
			'default'			=> '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_about_page',
		array(
			'settings'		=> 'testwebsite_about_page',
			'section'		=> 'testwebsite_about_sec',
			'type'			=> 'dropdown-pages',
			'label'			=> __('Select a Page', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_about_image_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Customize_Heading(
			$wp_customize,
			'testwebsite_about_image_header',
			array(
				'settings'		=> 'testwebsite_about_image_header',
				'section'		=> 'testwebsite_about_sec',
				'label'			=> __('About Page Stack Images', 'testwebsite')
			)
		)
	);

	$wp_customize->add_setting(
		'testwebsite_about_image_stack',
		array(
			'default'			=> '',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Display_Gallery_Control(
			$wp_customize,
			'testwebsite_about_image_stack',
			array(
				'settings'		=> 'testwebsite_about_image_stack',
				'section'		=> 'testwebsite_about_sec',
				'label'			=> __('About Us Stack Image', 'testwebsite'),
				'description'   => __('Recommended Image Size: 400X420px <br/> Leave the gallery empty for Full Width Text', 'testwebsite')
			)
		)
	);

	/*============ABOUT SECTION============*/

	$wp_customize->add_section(
		'testwebsite_tab_sec',
		array(
			'title'			=> __('Tab Section', 'testwebsite'),
			'panel'         => 'testwebsite_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_disable_tab_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_disable_tab_sec',
		array(
			'settings'		=> 'testwebsite_disable_tab_sec',
			'section'		=> 'testwebsite_tab_sec',
			'label'			=> __('Disable Tab Section ', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	for ($i = 1; $i < 6; $i++) {

		$wp_customize->add_setting(
			'testwebsite_tab_header' . $i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new testwebsite_Customize_Heading(
				$wp_customize,
				'testwebsite_tab_header' . $i,
				array(
					'settings'		=> 'testwebsite_tab_header' . $i,
					'section'		=> 'testwebsite_tab_sec',
					'label'			=> __('Tab ', 'testwebsite') . $i
				)
			)
		);

		$wp_customize->add_setting(
			'testwebsite_tab_title' . $i,
			array(
				'default'			=> '',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'testwebsite_tab_title' . $i,
			array(
				'settings'		=> 'testwebsite_tab_title' . $i,
				'section'		=> 'testwebsite_tab_sec',
				'type'			=> 'text',
				'label'			=> __('Tab Title', 'testwebsite')
			)
		);

		$wp_customize->add_setting(
			'testwebsite_tab_icon' . $i,
			array(
				'default'			=> 'fa fa-bell',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'testwebsite_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new testwebsite_Fontawesome_Icon_Chooser(
				$wp_customize,
				'testwebsite_tab_icon' . $i,
				array(
					'settings'		=> 'testwebsite_tab_icon' . $i,
					'section'		=> 'testwebsite_tab_sec',
					'type'			=> 'icon',
					'label'			=> __('FontAwesome Icon', 'testwebsite'),
				)
			)
		);

		$wp_customize->add_setting(
			'testwebsite_tab_page' . $i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'testwebsite_tab_page' . $i,
			array(
				'settings'		=> 'testwebsite_tab_page' . $i,
				'section'		=> 'testwebsite_tab_sec',
				'type'			=> 'dropdown-pages',
				'label'			=> __('Select a Page', 'testwebsite')
			)
		);
	}

	/*============CLIENTS LOGO SECTION============*/
	$wp_customize->add_section(
		'testwebsite_logo_sec',
		array(
			'title'			=> __('Clients Logo Section', 'testwebsite'),
			'panel'         => 'testwebsite_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_disable_logo_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'testwebsite_disable_logo_sec',
		array(
			'settings'		=> 'testwebsite_disable_logo_sec',
			'section'		=> 'testwebsite_logo_sec',
			'label'			=> __('Disable Client Logo Section ', 'testwebsite'),
			'type'       	=> 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'testwebsite_logo_header',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Customize_Heading(
			$wp_customize,
			'testwebsite_logo_header',
			array(
				'settings'		=> 'testwebsite_logo_header',
				'section'		=> 'testwebsite_logo_sec',
				'label'			=> __('Section Title & Logo', 'testwebsite')
			)
		)
	);

	$wp_customize->add_setting(
		'testwebsite_logo_title',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'testwebsite_logo_title',
		array(
			'settings'		=> 'testwebsite_logo_title',
			'section'		=> 'testwebsite_logo_sec',
			'type'			=> 'text',
			'label'			=> __('Title', 'testwebsite')
		)
	);

	//CLIENTS LOGOS
	$wp_customize->add_setting(
		'testwebsite_client_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback' => 'testwebsite_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new testwebsite_Display_Gallery_Control(
			$wp_customize,
			'testwebsite_client_logo_image',
			array(
				'settings'		=> 'testwebsite_client_logo_image',
				'section'		=> 'testwebsite_logo_sec',
				'label'			=> __('Upload Clients Logos', 'testwebsite'),
				'description'   => __('Recommended Image Size: 220X90px', 'testwebsite')
			)
		)
	);

	/*============SOCIAL ICONS SECTION============*/
	$wp_customize->add_section(
		'testwebsite_social_sec',
		array(
			'title'			=> __('Footer Social Icons', 'testwebsite'),
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_facebook',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_facebook',
		array(
			'settings'		=> 'testwebsite_social_facebook',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Facebook URL', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_twitter',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_twitter',
		array(
			'settings'		=> 'testwebsite_social_twitter',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Twitter URL', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_google_plus',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_pinterest',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_pinterest',
		array(
			'settings'		=> 'testwebsite_social_pinterest',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Pinterest URL', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_youtube',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_youtube',
		array(
			'settings'		=> 'testwebsite_social_youtube',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Youtube URL', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_linkedin',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_linkedin',
		array(
			'settings'		=> 'testwebsite_social_linkedin',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Linkedin URL', 'testwebsite')
		)
	);

	$wp_customize->add_setting(
		'testwebsite_social_instagram',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'testwebsite_social_instagram',
		array(
			'settings'		=> 'testwebsite_social_instagram',
			'section'		=> 'testwebsite_social_sec',
			'type'			=> 'text',
			'label'			=> __('Instagram URL', 'testwebsite')
		)
	);
}
add_action('customize_register', 'testwebsite_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function testwebsite_customize_preview_js()
{
	wp_enqueue_script('testwebsite_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}
add_action('customize_preview_init', 'testwebsite_customize_preview_js');


function testwebsite_customizer_script()
{
	wp_enqueue_script('testwebsite-customizer-script', get_template_directory_uri() . '/inc/js/customizer-scripts.js', array('jquery'), '09092016', true);
	wp_enqueue_script('testwebsite-customizer-chosen-script', get_template_directory_uri() . '/inc/js/chosen.jquery.js', array('jquery'), '1.4.1', true);
	wp_enqueue_style('testwebsite-customizer-chosen-style', get_template_directory_uri() . '/inc/css/chosen.css');
	wp_enqueue_style('testwebsite-customizer-font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style('testwebsite-customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css');
}
add_action('customize_controls_enqueue_scripts', 'testwebsite_customizer_script');


if (class_exists('WP_Customize_Control')) :

	class testwebsite_Customize_Heading extends WP_Customize_Control
	{

		public function render_content()
		{
?>

			<?php if (!empty($this->label)) : ?>
				<h3 class="testwebsite-accordion-section-title"><?php echo esc_html($this->label); ?></h3>
			<?php endif; ?>
		<?php }
	}

	class testwebsite_Dropdown_Chooser extends WP_Customize_Control
	{
		public function render_content()
		{
			if (empty($this->choices))
				return;
		?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html($this->label); ?>
				</span>

				<?php if ($this->description) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

				<select class="hs-chosen-select" <?php $this->link(); ?>>
					<?php
					foreach ($this->choices as $value => $label)
						echo '<option value="' . esc_attr($value) . '"' . selected($this->value(), $value, false) . '>' . esc_html($label) . '</option>';
					?>
				</select>
			</label>
		<?php
		}
	}

	class testwebsite_Fontawesome_Icon_Chooser extends WP_Customize_Control
	{
		public $type = 'icon';

		public function render_content()
		{
		?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html($this->label); ?>
				</span>

				<?php if ($this->description) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

				<div class="testwebsite-selected-icon">
					<i class="fa <?php echo esc_attr($this->value()); ?>"></i>
					<span><i class="fa fa-angle-down"></i></span>
				</div>

				<ul class="testwebsite-icon-list clearfix">
					<?php
					$testwebsite_font_awesome_icon_array = testwebsite_font_awesome_icon_array();
					foreach ($testwebsite_font_awesome_icon_array as $testwebsite_font_awesome_icon) {
						$icon_class = $this->value() == $testwebsite_font_awesome_icon ? 'icon-active' : '';
						echo '<li class=' . $icon_class . '><i class="' . $testwebsite_font_awesome_icon . '"></i></li>';
					}
					?>
				</ul>
				<input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
			</label>
		<?php
		}
	}

	class testwebsite_Display_Gallery_Control extends WP_Customize_Control
	{
		public $type = 'gallery';

		public function render_content()
		{
		?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html($this->label); ?>
				</span>

				<?php if ($this->description) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post($this->description); ?>
					</span>
				<?php } ?>

				<div class="gallery-screenshot clearfix">
					<?php {
						$ids = explode(',', $this->value());
						foreach ($ids as $attachment_id) {
							$img = wp_get_attachment_image_src($attachment_id, 'thumbnail');
							echo '<div class="screen-thumb"><img src="' . esc_url($img[0]) . '" /></div>';
						}
					}
					?>
				</div>

				<input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Add/Edit Gallery', 'testwebsite') ?>" />
				<input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php _e('Clear', 'testwebsite') ?>" />
				<input type="hidden" class="gallery_values" <?php echo $this->link() ?> value="<?php echo esc_attr($this->value()); ?>">
			</label>
		<?php
		}
	}

	class testwebsite_Info_Text extends WP_Customize_Control
	{

		public function render_content()
		{
		?>
			<span class="customize-control-title">
				<?php echo esc_html($this->label); ?>
			</span>

			<?php if ($this->description) { ?>
				<span class="description customize-control-description">
					<?php echo wp_kses_post($this->description); ?>
				</span>
<?php }
		}
	}

endif;


//SANITIZATION FUNCTIONS
function testwebsite_sanitize_text($input)
{
	return wp_kses_post(force_balance_tags($input));
}

function testwebsite_sanitize_checkbox($input)
{
	if ($input == 1) {
		return 1;
	} else {
		return '';
	}
}

function testwebsite_sanitize_integer($input)
{
	if (is_numeric($input)) {
		return intval($input);
	}
}

function testwebsite_sanitize_choices($input, $setting)
{
	global $wp_customize;

	$control = $wp_customize->get_control($setting->id);

	if (array_key_exists($input, $control->choices)) {
		return $input;
	} else {
		return $setting->default;
	}
}
