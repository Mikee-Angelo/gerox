<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amazica 
 */

$content_layout = get_post_meta( get_the_ID(), 'themefarmer-page-content-layout', true);
$editing = apply_filters('themefarmer_page_builder_editing', false);
get_header(); ?>
<?php if($content_layout == 'page-builder' || $editing): ?>
<div class="container-full page-builder-content-area content-area">
    <main id="main" class="site-main">
        <div id="blog-content" class="page-builder-page">
            <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'pagebuilder' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
        </div>
        <div class="clearfix"></div>
    </main><!-- #main -->
</div>
<?php else: ?>
<div class="container-full space blog-post-index content-area">
	<div class="container">
		<div class="row">
			<main id="main" class="<?php echo esc_attr(amazica_blog_layout()); ?> col-sm-12 col-xs-12 blog-left blog-posts-wrap site-main">
					<div id="blog-content" class="row amzc-page">
						<?php
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
					</div>
					<div class="clearfix"></div>
			</main><!-- #main -->
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
endif;
get_footer();