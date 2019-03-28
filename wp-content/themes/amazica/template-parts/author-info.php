<div class="col-12 author-info-container">
	<div class="row author-info-inner">
		<div class="col-md-2 author-thumbnail text-md-left text-center">
			<?php echo get_avatar( get_the_author_meta('email') , 150 ); ?>
		</div>	
		<div class="col author-info text-md-left text-center">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><h3 class="auther-name"><?php the_author(); ?></h3></a>
			<p class="author-description"> <?php the_author_meta('description'); ?></p>
			<div class="author-links">
				<ul>
					<?php 
						$social_link_facebook  = get_the_author_meta( 'social_link_facebook' );
						$social_link_google    = get_the_author_meta( 'social_link_google' );
						$social_link_linkedin  = get_the_author_meta( 'social_link_linkedin' );
						$social_link_twitter   = get_the_author_meta( 'social_link_twitter' );
						$social_link_youtube   = get_the_author_meta( 'social_link_youtube' );
					?>
					<?php if(isset($social_link_facebook) && !empty($social_link_facebook)): ?>
					<li><a href="<?php echo esc_url($social_link_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					<?php if(isset($social_link_twitter) && !empty($social_link_twitter)): ?>
					<li><a href="<?php echo esc_url($social_link_google); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>
					<?php if(isset($social_link_google) && !empty($social_link_google)): ?>
					<li><a href="<?php echo esc_url($social_link_linkedin); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
					<?php if(isset($social_link_linkedin) && !empty($social_link_linkedin)): ?>
					<li><a href="<?php echo esc_url($social_link_twitter); ?>"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
					<?php if(isset($social_link_youtube) && !empty($social_link_youtube)): ?>
					<li><a href="<?php echo esc_url($social_link_youtube); ?>"><i class="fa fa-youtube"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>