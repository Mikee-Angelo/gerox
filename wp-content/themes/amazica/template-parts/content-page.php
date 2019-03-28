<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Amazica 
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("col-12 amzc-post"); ?>>
	<div class="post-content">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
	</div>
</article>