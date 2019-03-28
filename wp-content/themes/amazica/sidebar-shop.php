<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amazica 
 */
if(amazica_woocommerce_layout() !== 'col-md-12'){
	?>

	<aside id="secondary" class="col-md-3 col-sm-12 col-xs-12 amzc-sidebar shop-sidedbar" role="complementary">
	<?php
	if (is_active_sidebar( 'woocommerce-sidebar' ) ) {
		 dynamic_sidebar( 'woocommerce-sidebar' ); 
	}else{

		$args = array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'amazica' ),
			'id'            => 'woocommerce-sidebar',
			'widget_id'     => 'woocommerce-sidebar',
			'class'         => 'woocommerce-sidebar',
			'description'   => esc_html__( 'WooCommerce Widget Area', 'amazica' ),
			'before_widget' => '<div id="%1$s" class="woocommerce-widget sidebar-widget widget">',
	        'after_widget'  => '</div>',
	        'before_title'  => '<div class="widget-heading"><h3 class="widget-title">',
	        'after_title'   => '</h3></div>',
		);
		if(amazica_is_wc()){
			
			the_widget('WC_Widget_Product_Categories', 'title='.esc_html__('Categories', 'amazica'), $args);
			the_widget('WC_Widget_Price_Filter', 'title='.esc_html__('Price Filter', 'amazica'), $args);
			the_widget('WC_Widget_Cart', 'title='.esc_html__('Cart', 'amazica'), $args);
			the_widget('WC_Widget_Recently_Viewed', 'title='.esc_html__('Recently Viewed Products', 'amazica'), $args);
			the_widget('WC_Widget_Top_Rated_Products', 'title='.esc_html__('Top Rated Products', 'amazica'), $args);
			
		}

	}
	?>
	</aside><!-- #secondary -->
<?php 
}