<?php
/**
 * Custom header implementation
 */

function tameer_construction_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'tameer_construction_custom_header_args', array(

		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'tameer_construction_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'tameer_construction_custom_header_setup' );

if ( ! function_exists( 'tameer_construction_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see tameer_construction_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'tameer_construction_header_style' );
function tameer_construction_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        #masthead .main-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'tameer-construction-basic-style', $custom_css );
	endif;
}
endif; // tameer_construction_header_style