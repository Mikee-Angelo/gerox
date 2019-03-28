<?php if(amazica_is_wc()): ?>
<!-- Product  Start -->
<div class="home-section space tf-products section-products-latest">
	<div class="home-section-bg section-color-bg section-products-latest-bg"></div>
	<div class="container">
		<div class="section-heading">
			<h2 class="section-title"><?php echo esc_html(get_theme_mod('amazica_home_products_latest_heading')); ?></h2>
	 	    <p class="section-description"><?php echo esc_html(get_theme_mod('amazica_home_products_latest_desc')); ?></p>
		</div>
		<div class="section-details home-products products-recents woocommerce">
			<div class="product-carasol products owl-carousel">
			<?php
				$product_count = absint(get_theme_mod('amazica_home_products_latest_count', 15));
				$query_args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $product_count, 'orderby' =>'date','order' => 'DESC' );
				$products = new WP_Query( $query_args );
				$catorgies = array();
				while($products->have_posts()){
					$products->the_post();
					wc_get_template_part( 'content-product-home' );
				}
				wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
</div>
<!-- Product End -->
<?php endif; ?>