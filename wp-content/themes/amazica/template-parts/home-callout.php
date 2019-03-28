<div class="home-section space section-callout">
    <div class="home-section-bg section-color-bg section-callout-bg section-bg-blur"></div>
    <div class="container">
        <div class="row">
            <div class="seaction-heading color-light col-sm-12 col-xs-12 text-center">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('themefarmer_home_callout_heading')); ?></h2>
                <p class="section-description"><?php echo esc_html(get_theme_mod('themefarmer_home_callout_desc')); ?></p>
            </div>
            <?php $link = get_theme_mod('themefarmer_home_callout_link'); if($link): ?>
            <div class="col-sm-12 col-xs-12 text-center">
                <a href="<?php echo esc_url($link); ?>" class="btn btn-callout1 sweep-to-top"><?php echo esc_html(get_theme_mod('themefarmer_home_callout_label')); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>