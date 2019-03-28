<?php if(class_exists('Ultimate_Subscribe')): ?>
<div class="home-section space section-subscribe">
    <div class="home-section-bg section-subscribe-bg"></div>
    <div class="container">
        <div class="section-heading color-light">
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('themefarmer_home_subscribe_heading')); ?></h2>
            <p class="section-description"><?php echo esc_html(get_theme_mod('themefarmer_home_subscribe_desc')); ?></p>
        </div>
        <div class="subscribe-details">
            <div class="subscribe-details-inner">
            <?php 
                if(function_exists('ultimate_subscribe_get_subscribe_form')){
                    ultimate_subscribe_get_subscribe_form();
                }
            ?>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>