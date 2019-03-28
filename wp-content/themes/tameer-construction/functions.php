<?php
/**
 * Tameer Construction functions and definitions
 */

function tameer_construction_setup() {
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'tameer-construction-featured-image', 2000, 1200, true );
	add_image_size( 'tameer-construction-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'tameer-construction' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_editor_style( array( 'assets/css/editor-style.css', tameer_construction_fonts_url() ) );
}
add_action( 'after_setup_theme', 'tameer_construction_setup' );

/**
 * Register custom fonts.
 */
function tameer_construction_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

/**
 * Widget area.
 */
function tameer_construction_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'tameer-construction' ),
		'id'            => 'sidebox-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'tameer-construction' ),
		'id'            => 'sidebox-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on Pages and archive pages.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'tameer-construction' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'tameer-construction' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'tameer-construction' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'tameer-construction' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'tameer-construction' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tameer_construction_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tameer_construction_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'tameer-construction-fonts', tameer_construction_fonts_url(), array(), null );

	//bootstrap
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.css' ));

	// Theme stylesheet.
	wp_enqueue_style( 'tameer-construction-basic-style', get_stylesheet_uri() );

	//font-awesome 
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'tameer-construction-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'tameer-construction-style' ), '1.0' );
		wp_style_add_data( 'tameer-construction-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'tameer-construction-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'tameer-construction-style' ), '1.0' );
	wp_style_add_data( 'tameer-construction-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'tameer-construction-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$tameer_constructionScreenReaderText=array();
	
	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'tameer-construction-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );

		$tameer_constructionScreenReaderText['expand']         = __( 'Expand child menu', 'tameer-construction' );
		$tameer_constructionScreenReaderText['collapse']       = __( 'Collapse child menu', 'tameer-construction' );
		
	}

	wp_enqueue_script( 'jquery-custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), true );
	
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ), true );

	wp_localize_script( 'tameer-construction-skip-link-focus-fix', 'tameer_constructionScreenReaderText', $tameer_constructionScreenReaderText );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tameer_construction_scripts' );

/**
 * Front Page Template 
 */
function tameer_construction_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'tameer_construction_front_page_template' );

function tameer_construction_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'tameer_construction_loop_columns');
	if (!function_exists('tameer_construction_loop_columns')) {
	function tameer_construction_loop_columns() {
		return 3; // 3 products per row
	}
}

/* Excerpt Limit Begin */
function tameer_construction_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function tameer_construction_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

//footer Link
define('TAMEER_CONSTRUCTION_CREDIT','https://www.themeseye.com/','tameer-construction');

if ( ! function_exists( 'tameer_construction_credit' ) ) {
	function tameer_construction_credit(){
		echo "<a href=".esc_url(TAMEER_CONSTRUCTION_CREDIT)." target='_blank'>".esc_html__('Themeseye','tameer-construction')."</a>";
	}
}

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );