<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amazica 
 */

if(amazica_blog_layout() !== 'col-md-12'){
	?>

	<aside id="secondary" class="col-12 col-md-3 amzc-sidebar" role="complementary">
	<?php
	if (is_active_sidebar( 'sidebar' ) ) {
		 dynamic_sidebar( 'sidebar' ); 
	}else{

		$args = array(
			'name'          => esc_html__( 'Sidebar', 'amazica' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Sidebar Widget Area', 'amazica' ),
			'before_widget' => '<div id="%1$s" class="widget sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-heading"><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		);
		the_widget('WP_Widget_Search', 'title='.esc_html__('Search', 'amazica'), $args);
		the_widget('WP_Widget_Recent_Posts', null, $args);
		the_widget('WP_Widget_Recent_Comments', null, $args);
		the_widget('WP_Widget_Tag_Cloud', null, $args);
		the_widget('WP_Widget_Archives', null, $args);
		the_widget('WP_Widget_Categories', null, $args);
		the_widget('WP_Widget_Calendar', 'title='.esc_html__('Calendar', 'amazica'), $args);

	}
	?>
	</aside><!-- #secondary -->
<?php 
}