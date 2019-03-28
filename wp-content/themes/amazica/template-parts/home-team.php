<?php if (function_exists('themefarmer_companion')): ?>
    <div class="home-section space section-team">
        <div class="home-section-bg section-team"></div>
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_team_heading')); ?></h2>
                <p class="section-description wow fadeInUp"><?php echo esc_html(get_theme_mod('themefarmer_home_team_desc')); ?></p>
            </div>
            <div class="section-details row team-details">
                <?php $team = get_theme_mod('themefarmer_home_team'); ?>
                <?php if($team): foreach ($team as $key => $member): ?>
                <div class="col-md-3 col-sm-6 col-xs-6 member-item">
                    <div class="meamber-item-inner wow zoomIn" style="animation-delay: <?php echo intval($key*200).'ms'; ?>;">
                        <div class="meamber-image">
                            <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>">
                        </div>
                        <div class="meamber-info">
                            <?php if(!empty($member['button_url'])): ?>
                                <a href="<?php echo esc_url($member['button_url']) ?>">
                                    <h3 class="sub-section-title  member-title"><?php echo esc_html($member['name']); ?></h3>       
                                </a>
                            <?php else: ?>
                                <h3 class="sub-section-title  member-title"><?php echo esc_html($member['name']); ?></h3>
                            <?php endif; ?>
                            <h6 class="member-designation"><?php echo esc_html($member['designation']); ?></h6>
                            <p class="member-description"><?php echo esc_html($member['description']); ?></p>
                            <div class="member-icons">
                                <ul>
                                    <?php if($member['socials']): foreach ($member['socials'] as $key => $item): if(!empty($item['link'])):?>
                                    <li><a href="<?php echo esc_url($item['link']); ?>"> <i class="fa <?php echo esc_attr($item['icon']); ?>"></i> </a></li>
                                    <?php endif; endforeach; endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>