<?php if (function_exists('themefarmer_companion')): ?>
<div class="home-section space section-testimonials">
	<div class="home-section-bg section-testimonials"></div>
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('themefarmer_home_testimonials_heading')); ?></h2>
            <p class="section-description"><?php echo esc_html(get_theme_mod('themefarmer_home_testimonials_desc')); ?></p>
        </div>
        <div class="testimonials-details">
            <div class="testimonial-carousel owl-carousel">
            	<?php $testimonials = get_theme_mod('themefarmer_home_testimonials'); ?>
            	<?php if($testimonials): foreach ($testimonials as $key => $testimonial): ?>
                <div class="testimonial-item">
                    <div class="testimonial-item-inner fill-to-top-action">
                    	<div class="testimonial-item-top">
	                        <div class="testimonial-img fill-to-top">
	                            <img  class="img-responsive" src="<?php echo esc_url($testimonial['image']); ?>">
	                        </div>
	                        <div class="testimonial-user">
	                            <h2 class="sub-section-title testimonial-name"><?php echo esc_html($testimonial['title']) ?></h2>
	                            <h6 class="testimonial-designation"><?php echo esc_html($testimonial['subtitle']) ?></h6>
	                        </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="testimonial-info">
	                        <?php if(!empty($testimonial['link'])): ?>
	                        <a class="testimonial-link" href="<?php echo esc_url($testimonial['link']); ?>"><?php echo esc_html($testimonial['link']); ?></a>
	                        <?php endif; ?>
	                        <div class="clearfix"></div>
                            <p class="testimonial-description"><?php echo esc_html($testimonial['description']) ?></p>
                        </div>                        
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>