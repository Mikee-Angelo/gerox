<?php if (function_exists('themefarmer_companion')): ?>
<div class="home-section space section-services">
	<div class="home-section-bg section-services"></div>
	<div class="container">
        <div class="section-heading">
            <h2 class="section-title wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_services_heading')); ?></h2>
            <p class="section-description wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_services_desc')); ?></p>
        </div>
        <div class="row section-details services-details">
        	<?php $services = get_theme_mod('themefarmer_home_services'); ?>
        	<?php if($services): foreach ($services as $key => $service): ?>
            <div class="col-md-4 col-sm-6 col-xs-6 service-item wow flipInX" style="color:<?php echo isset($service['color'])?esc_attr($service['color']).'':''; ?>; animation-delay:<?php echo intval($key*300).'ms;'; ?>">
                <div class="service-item-inner">
                    <div class="service-inner-info">
                        <div class="service-icon">
                            <i class="fa <?php echo esc_attr($service['icon']); ?>"></i>
                        </div>
                        <div class="service-info">
                            <h3 class="sub-section-title service-title"><?php echo esc_html($service['heading']); ?></h3>
                            <p class="sub-section-description service-description"><?php echo esc_html($service['description']); ?></p>
                            <?php $page_link = (absint($service['page_id']) > 0)?get_permalink(absint($service['page_id'])):$service['button_url']; ?>
                            <?php if(!empty($page_link)): ?>
                            <a class="btn sweep-to-top btn-read-more" href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($service['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="bottom-shadow"></div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>