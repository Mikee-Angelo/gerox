<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amazica 
 */

get_header(); ?>

<div class="container-full space blog-post-index content-area">
	<div class="container">
		<div class="row justify-content-center">
			<main id="main" class="<?php echo esc_attr(amazica_blog_layout()); ?> col-12 blog-left blog-posts-wrap site-main">
				<?php if ( have_posts() ) : ?>
					<div id="blog-content" class="row posts-index">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'index' );
						endwhile;
					?>
					</div>
					<div class="clearfix"></div>
					<div class="the-pagination">
						<?php the_posts_pagination(); ?>
					</div>
				<?php
					else :
						get_template_part( 'template-parts/content', 'none' );
				endif; ?>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();
