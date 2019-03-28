<?php
/**
 * Tameer Construction: Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tameer_construction_customize_register( $wp_customize ) {

	$wp_customize->add_panel( 'tameer_construction_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'tameer-construction' ),
	    'description' => __( 'Description of what this panel does.', 'tameer-construction' ),
	) );

	$wp_customize->add_section( 'tameer_construction_general_option', array(
    	'title'      => __( 'Sidebar Settings', 'tameer-construction' ),
		'priority'   => 30,
		'panel' => 'tameer_construction_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('tameer_construction_layout_settings',array(
        'default' => __('Right Sidebar','tameer-construction'),
        'sanitize_callback' => 'tameer_construction_sanitize_choices'	        
	));

	$wp_customize->add_control('tameer_construction_layout_settings',array(
        'type' => 'radio',
        'label'     => __('Theme Sidebar Layouts', 'tameer-construction'),
        'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'tameer-construction'),
        'section' => 'tameer_construction_general_option',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','tameer-construction'),
            'Right Sidebar' => __('Right Sidebar','tameer-construction'),
            'One Column' => __('Full Width','tameer-construction'),
            'Grid Layout' => __('Grid Layout','tameer-construction')
        ),
	));

	//Topbar section
	$wp_customize->add_section('tameer_construction_topbar',array(
		'title'	=> __('Topbar','tameer-construction'),
		'description'	=> __('Add Topbar Content here','tameer-construction'),
		'priority'	=> null,
		'panel' => 'tameer_construction_panel_id',
	));

	$wp_customize->add_setting('tameer_construction_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tameer_construction_email',array(
		'label'	=> __('Add Email','tameer-construction'),
		'section'	=> 'tameer_construction_topbar',
		'setting'	=> 'tameer_construction_email',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('tameer_construction_call1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tameer_construction_call1',array(
		'label'	=> __('Add Phone Number','tameer-construction'),
		'section'	=> 'tameer_construction_topbar',
		'setting'	=> 'tameer_construction_call',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('tameer_construction_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tameer_construction_time',array(
		'label'	=> __('Add Time','tameer-construction'),
		'section'	=> 'tameer_construction_topbar',
		'type'		=> 'text'
	));

	//Social Icons
	$wp_customize->add_section('tameer_construction_social_link',array(
		'title'	=> __('Social Media','tameer-construction'),
		'description'	=> __('Add Social Media Url here','tameer-construction'),
		'priority'	=> null,
		'panel' => 'tameer_construction_panel_id',
	));

	$wp_customize->add_setting('tameer_construction_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('tameer_construction_facebook_url',array(
		'label'	=> __('Add Facebook link','tameer-construction'),
		'section'	=> 'tameer_construction_social_link',
		'setting'	=> 'tameer_construction_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('tameer_construction_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('tameer_construction_twitter_url',array(
		'label'	=> __('Add Twitter link','tameer-construction'),
		'section'	=> 'tameer_construction_social_link',
		'setting'	=> 'tameer_construction_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('tameer_construction_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('tameer_construction_youtube_url',array(
		'label'	=> __('Add Youtube link','tameer-construction'),
		'section'	=> 'tameer_construction_social_link',
		'setting'	=> 'tameer_construction_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('tameer_construction_google_plus_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('tameer_construction_google_plus_url',array(
		'label'	=> __('Add Google Plus link','tameer-construction'),
		'section'	=> 'tameer_construction_social_link',
		'setting'	=> 'tameer_construction_google_plus_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('tameer_construction_linkdin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	) );	
	$wp_customize->add_control('tameer_construction_linkdin_url',array(
		'label'	=> __('Add Linkdin link','tameer-construction'),
		'section'	=> 'tameer_construction_social_link',
		'setting'	=> 'tameer_construction_linkdin_url',
		'type'	=> 'url'
	) );

	//home page slider
	$wp_customize->add_section( 'tameer_construction_slider' , array(
    	'title'      => __( 'Slider Settings', 'tameer-construction' ),
		'priority'   => null,
		'panel' => 'tameer_construction_panel_id'
	) );

	$wp_customize->add_setting('tameer_construction_slider_arrows',array(
        'default' => 'true',
        'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('tameer_construction_slider_arrows',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide slider','tameer-construction'),
      	'section' => 'tameer_construction_slider',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'tameer_construction_slide_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'tameer_construction_sanitize_dropdown_pages'
		) );

		$wp_customize->add_control( 'tameer_construction_slide_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'tameer-construction' ),
			'section'  => 'tameer_construction_slider',
			'type'     => 'dropdown-pages'
		) );
	}

	//About
	$wp_customize->add_section('tameer_construction_about',array(
		'title'	=> __('About','tameer-construction'),
		'description'	=> __('Add About Section below.','tameer-construction'),
		'panel' => 'tameer_construction_panel_id',
	));

	$wp_customize->add_setting( 'tameer_construction_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'tameer_construction_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'tameer_construction_about_page', array(
		'label'    => __( 'Select About Page', 'tameer-construction' ),
		'description'	=> __('Image Size (537 x 358)','tameer-construction'),
		'section'  => 'tameer_construction_about',
		'type'     => 'dropdown-pages'
	) );

	//Footer
	$wp_customize->add_section( 'tameer_construction_footer' , array(
    	'title'      => __( 'Footer Text', 'tameer-construction' ),
		'priority'   => null,
		'panel' => 'tameer_construction_panel_id'
	) );

	$wp_customize->add_setting('tameer_construction_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('tameer_construction_footer_text',array(
		'label'	=> __('Add Copyright Text','tameer-construction'),
		'section'	=> 'tameer_construction_footer',
		'setting'	=> 'tameer_construction_footer_text',
		'type'		=> 'text'
	));


	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'tameer_construction_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'tameer_construction_customize_partial_blogdescription',
	) );
	
}
add_action( 'customize_register', 'tameer_construction_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Tameer Construction 1.0
 * @see tameer-construction_customize_register()
 *
 * @return void
 */
function tameer_construction_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Tameer Construction 1.0
 * @see tameer-construction_customize_register()
 *
 * @return void
 */
function tameer_construction_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function tameer_construction_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'footer-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Tameer_Construction_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Tameer_Construction_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Tameer_Construction_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Tameer Construction Pro', 'tameer-construction' ),
					'pro_text' => esc_html__( 'Go Pro', 'tameer-construction' ),
					'pro_url'  => esc_url('https://www.themeseye.com/wordpress/construction-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'tameer-construction-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'tameer-construction-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Tameer_Construction_Customize::get_instance();