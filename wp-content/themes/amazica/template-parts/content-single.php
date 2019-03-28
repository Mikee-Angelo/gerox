<article id="post-<?php the_ID(); ?>" <?php post_class("col-12 amzc-post"); ?>>
	<div class="post-content">
		<?php if(has_post_thumbnail()): ?>
		<div class="single-post-thumbnail">
			<?php the_post_thumbnail('full', array( 'class' => 'img-responsive blog-photo' )); ?>
		</div>
		<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta post-meta">
			<?php do_action('amazica_post_single_meta'); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'amazica' ),
					'after'  => '</div>',
				) );
			?>
			<div class="clearfix"></div>
		</div><!-- .entry-content -->
		<div class="clearfix"></div>
		<div class="entry-footer">
			<?php do_action('amazica_single_entry_footer'); ?>
		</div>
	</div>
</article>
<?php get_template_part( 'template-parts/author', 'info' ); ?>