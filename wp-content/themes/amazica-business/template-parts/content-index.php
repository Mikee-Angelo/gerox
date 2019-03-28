<article  id="post-<?php the_ID(); ?>"  <?php post_class("col-md-12 content-index"); ?>>
	<div class="content-index-inner row">
		<?php if(has_post_thumbnail()): ?>
		<div class="post-thumbnail col">
			<?php the_post_thumbnail('amazica-thumb', array( 'class' => 'img-responsive blog-photo' )); ?>
			<div class="overlay">
	            <a class="post-qk-link sweep-to-top the-post-link" href="<?php the_permalink(); ?>"><span class="fa fa-play"></span></a>
	            <a class="post-qk-link sweep-to-top the-post-img" href="<?php echo esc_url(wp_get_attachment_image_url(get_post_thumbnail_id(), 'full')); ?>"><i class="fa fa-search"></i></a>
            </div>
            <div class="blog-avtar sweep-to-top">
            	<a class="the-avatar" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' )); ?></a>
            </div>
		</div>
		<?php endif; ?>
		<div class="post-content col">
			<?php the_title( '<h2 class="entry-title post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<div class="entry-meta post-meta">
				<?php do_action( 'amazica_post_index_meta'); ?>
			</div>
			<div class="entry-summary post-description"><?php the_excerpt(); ?></div>
			<div class="clearfix"></div>
			<div class="row post-index-bottom">
				<div class="col entry-footer">
					<?php do_action( 'amazica_index_entry_footer'); ?>
				</div>
				<div class="col blog-btn">
					<a class="btn btn-read-more sweep-to-top" href="<?php the_permalink(); ?>"> <i class="fa fa-play"></i> <?php esc_html_e('Read More', 'amazica-business'); ?></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>	
</article>