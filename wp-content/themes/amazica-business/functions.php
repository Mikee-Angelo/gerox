<?php
function amazica_business_theme_setup() {
    load_child_theme_textdomain( 'amazica-business', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'amazica_business_theme_setup' );

function amazica_business_register_scripts() {

    $parent_style = 'amazica-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'amazica-business-style', get_stylesheet_uri(), array( $parent_style ));

	remove_filter('amazica_inline_style', 'amazica_set_theme_primary_color', 30);
	$custom_css = amazica_set_theme_primary_color('');
    wp_add_inline_style( 'amazica-business-style', $custom_css );
    
}
add_action('wp_enqueue_scripts', 'amazica_business_register_scripts', 20);

function amazica_business_register_font_style(){
	wp_enqueue_style( 'amazica-fonts-style', amazica_get_font_url(array('Roboto' => array(400,500,700,900))));
}
add_action('wp_enqueue_scripts', 'amazica_business_register_font_style', 10);

function amazica_business_customize_register($wp_customize){
	$wp_customize->get_setting('amazica_theme_primary_color')->default = '#50ad54';
}
add_action('customize_register', 'amazica_business_customize_register', 999);

