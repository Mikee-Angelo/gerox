<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Amaica
 */


/**
 * Prints HTML with meta information for the current post-date/time.
 */
function amazica_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"> <i class="fa fa-clock-o"></i> ' . $time_string . '</a>';

	echo '<span class="post-meta-item posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}



function amazica_post_comments(){
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="post-meta-item comments-link">';
			comments_popup_link('<i class="fa fa-comment-o"></i> '.
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment <span class="screen-reader-text"> on %s</span>', 'amazica' ),
						array(
							'span' => array(
								'class' => array(),
							),
							'i'
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
}


/**
 * Prints HTML with meta information for the current author.
 */
function amazica_posted_by() {
	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"> <i class="fa fa-user"></i> ' . esc_html( get_the_author() ) . ' </a> </span>';
	echo '<span class="post-meta-item byline"> ' . $byline . ' </span>'; // WPCS: XSS OK.

}



function amazica_post_categories(){

	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'amazica' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="post-meta-item cat-links"> <i class="fa fa-folder"></i> <span class="post-categories"> %1$s </span></span>', $categories_list ); // WPCS: XSS OK.
		}
	}
}

function amazica_post_tags(){

	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'amazica' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="post-meta-item tags-links"> <i class="fa fa-tags"></i> <span class="post-tags"> %1$s </span> </span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}

function amazica_the_edit_link(){
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( ' %1$s Edit <span class="screen-reader-text">%2$s</span>', 'amazica' ),
				array(
					'span' => array(
						'class' => array(),
					),
					'i' => array(
						'class' => array('fa', 'pencil-square-o'),
					),
				)
			),
			'<i class="fa fa-pencil-square-o"></i>',
			get_the_title()
		),
		'<span class="post-meta-item edit-link">',
		'</span>'
	);
}


$post_meta_arr = get_theme_mod( 'amazica_post_index_meta', array( 'posted_on', 'post_comments') );
foreach ($post_meta_arr as $key => $meta_item) {
	if(function_exists('amazica_'.$meta_item)) {
		add_action('amazica_post_index_meta', 'amazica_'.$meta_item);
	}
}

$post_meta_arr = get_theme_mod( 'amazica_index_entry_footer', array('post_categories', 'post_tags', 'the_edit_link') );
foreach ($post_meta_arr as $key => $meta_item) {
	if(function_exists('amazica_'.$meta_item)) {
		add_action('amazica_index_entry_footer', 'amazica_'.$meta_item);
	}
}

$post_meta_arr = get_theme_mod( 'amazica_post_single_meta', array( 'posted_on', 'post_comments', 'posted_by') );
foreach ($post_meta_arr as $key => $meta_item) {
	if(function_exists('amazica_'.$meta_item)) {
		add_action('amazica_post_single_meta', 'amazica_'.$meta_item);
	}
}

$post_meta_arr = get_theme_mod( 'amazica_single_entry_footer', array( 'post_categories', 'post_tags', 'the_edit_link') );
foreach ($post_meta_arr as $key => $meta_item) {
	if(function_exists('amazica_'.$meta_item)) {
		add_action('amazica_single_entry_footer', 'amazica_'.$meta_item);
	}
}

