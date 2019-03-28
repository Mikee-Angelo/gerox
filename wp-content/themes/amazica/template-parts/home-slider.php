<?php if (function_exists('themefarmer_companion')): ?>
<div class="slider-section section-slider">
	<div class="home-slider">
		<div class="home-carousel owl-carousel">
			<?php
				$slides = get_theme_mod('themefarmer_home_slider');
				$i = 1;
				if($slides){
					foreach ($slides as $key => $slide) {
						?>
						<div class="owl-slide">
							<?php 
								if(isset($slide['image'])):
									$slide_img = $slide['image'];
							 	else:
							 		$slide_img = get_template_directory_uri().'/images/slide'.$i.'.jpg';
								endif; 
							?>
							<img src="<?php echo esc_url($slide_img); ?>" class="img-responsive img-slide"/>
							<div class="overlay"></div>
			               	<div class="carousel-caption">
			               		<?php if(isset($slide['heading'])): ?>
								<h1 class="slider-heading animation animated-item-1"> <?php echo wp_kses_post($slide['heading']); ?> </h1>
								<?php endif; ?>
								<?php if(isset($slide['description'])): ?>
								<div class="slider-desc animation animated-item-2"><?php echo wp_strip_all_tags($slide['description']); ?></div>
								<?php endif; ?>								
								<?php if(!empty($slide['button1_url'])): ?>
								<a href="<?php echo esc_url($slide['button1_url']); ?>" class="btn animation animated-item-3 banner-link slide-bt-1"> <?php echo esc_html($slide['button1_text']); ?> </a>
								<?php endif; ?>
								<?php if(!empty($slide['button2_url'])): ?>
								<a href="<?php echo esc_url($slide['button2_url']); ?>" class="btn animation animated-item-4 banner-link sweep-to-left slide-bt-2"> <?php echo esc_html($slide['button2_text']); ?> </a>
								<?php endif; ?>
							</div>
						</div>
						<?php
						if($i == 2){ $i = 0; }
						$i++;
					}
				}
			?>
		</div>
		<div class="slider-shadow"></div>
	</div>
</div>
<?php endif; ?>