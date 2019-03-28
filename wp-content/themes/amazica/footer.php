<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amazica 
 */

?>

	</div><!-- #content -->
	<!-- Footer Start -->
    <footer id="colophon" class="site-footer footer" role="contentinfo">
    	<?php if(get_theme_mod('amazica_show_footer_widgets', true)): ?>
        <div class="container-fluid footer-widgets">
            <div class="container">
				<div class="row widgets">
					<?php 
						$footer_widget  = array(
							'name' 			=> esc_html__( 'Footer Widget Area', 'amazica' ),
							'id' 			=> 'footer-widget-area',
							'description' 	=> esc_html__( 'footer widget area', 'amazica' ),
							'before_widget' => '<div id="%1$s" class="col-md-4 col-sm-6 widget footer-widget">',
							'after_widget'  => '</div>',
							'before_title'  => '<div class="widget-heading"><h3 class="widget-title">',
							'after_title'   => '</h3></div>',
						);

					   if ( is_active_sidebar( 'footer-widget-area' ) ) {
							 dynamic_sidebar( 'footer-widget-area'); 
						 }else{ 
							the_widget('WP_Widget_Calendar', 'title='.esc_attr__('Calendar', 'amazica'), $footer_widget);
							the_widget('WP_Widget_Categories', null, $footer_widget);
							the_widget('WP_Widget_Pages', null, $footer_widget);
						} 
					?>
				</div>
            </div>
        </div>
    	<?php endif; ?>
        <div class="conatainer-fluid footer-bar">
            <div class="container">
                <div class="row justify-content-center">
	                <div class="col-6 footer-copy text-center">
	                    <p>&copy; <?php echo esc_html(date_i18n(__('Y', 'amazica'))).' '; bloginfo( 'name' ); ?> | <?php printf( esc_html__( 'Theme: %1$s', 'amazica' ),  '<a href="'.esc_url('https://www.themefarmer.com/amazica/').'" rel="designer"> Amazica </a>' ); ?></p>
	                </div>
                </div>
            </div>
        </div>
        <a href="#" id="scroll-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
    </footer><!-- #colophon -->
    <!-- Footer End -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
