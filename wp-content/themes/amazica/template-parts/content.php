<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amazica 
 */

?>
<?php if(is_singular()): ?>
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
		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-footer">
			<?php do_action('amazica_single_entry_footer'); ?>
		</div>
		<?php endif; ?>
	</div>
</article>
<?php 
	if(is_single()){
		get_template_part( 'template-parts/author', 'info' ); 
	}
?>
<?php else: ?>
<article  id="post-<?php the_ID(); ?>"  <?php post_class("col-md-6 content-index"); ?>>
	<div class="content-index-inner">
		<?php if(has_post_thumbnail()): ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail('amazica-thumb', array( 'class' => 'img-responsive blog-photo' )); ?>
			<div class="overlay">
            	<a class="post-qk-link sweep-to-top the-post-link" href="<?php the_permalink(); ?>"><span class="fa fa-play"></span></a>
                <a class="post-qk-link sweep-to-top the-post-img" href="<?php echo esc_url(wp_get_attachment_image_url(get_post_thumbnail_id(), 'full')); ?>"><i class="fa fa-search"></i></a>
            </div>
            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="blog-avtar sweep-to-top">
            	<a class="the-avatar" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' )); ?></a>
            </div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="post-content">
			<?php the_title( '<h2 class="entry-title post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta post-meta">
				<?php do_action( 'amazica_post_index_meta'); ?>
			</div>
			<?php endif; ?>
			<div class="entry-summary post-description"><?php the_excerpt(); ?></div>
			<div class="clearfix"></div>
			<div class="row post-index-bottom">
				<div class="col entry-footer">
					<?php 
						if ( 'post' === get_post_type() ){
							do_action( 'amazica_index_entry_footer'); 
						}
					?>
				</div>
				<div class="col blog-btn">
					<a class="btn btn-read-more sweep-to-top" href="<?php the_permalink(); ?>"> <i class="fa fa-play"></i> <?php esc_html_e('Read More', 'amazica'); ?></a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>	
</article>
<?php endif; ?>