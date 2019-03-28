<?php if(function_exists('themefarmer_companion')): ?>
<div class="home-section space section-about">
    <div class="home-section-bg section-about-bg"></div>
    <div class="container">
        <div class="row section-details about-details">
            <?php $ab_image = get_theme_mod('themefarmer_home_about_image'); if(!empty($ab_image)): ?>
            <div class="col">
                <img src="<?php echo esc_url($ab_image); ?>" class="img-fluid wow slideInLeft">
            </div>
            <?php endif; ?>
            <div class="col">
                <div class="section-heading color-light text-center">
                    <h2 class="section-title wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_about_heading')); ?></h2>
                    <p class="section-description wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_about_desc')); ?></p>
                </div>
            </div>
        </div>
        <?php do_action('amazica_after_about_us_section'); ?>
    </div>
</div>
<?php endif; ?>