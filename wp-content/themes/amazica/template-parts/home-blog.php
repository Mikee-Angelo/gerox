<!-- Our Blog Start-->
<?php $bg_image = get_theme_mod('amazica_home_blog_background'); ?>
<div id="home-blog" class="home-section space section-blog" data-src="<?php echo esc_url($bg_image); ?>" data-pos-x="left" data-parallax>
	<div class="container">
		<div class="section-heading <?php echo (!empty($bg_image))?'heading-light':''; ?>">
	 	    <h2 class="section-title"><?php echo esc_html(get_theme_mod('themefarmer_home_blog_heading')); ?></h2>
	 	    <p class="section-description"><?php echo esc_html(get_theme_mod('themefarmer_home_blog_desc')); ?></p>
		</div>
		<div class="blog-details">
			<div class="home-blog-carousel owl-carousel">
			<?php 
				$post_count = absint(get_theme_mod('themefarmer_home_blog_count', 10));
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'post', 'paged'=>$paged, 'posts_per_page' => $post_count, 'ignore_sticky_posts' => 1, );
				$query = new WP_Query( $args );
				while($query->have_posts()){
					$query->the_post();
					get_template_part('template-parts/content','home');
				}
				wp_reset_postdata(); 
			?>
			</div>
		</div>
	</div>
</div>
<!-- Our Blog End -->