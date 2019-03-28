<?php
/**
 * The front page template file
 */

get_header(); ?>

<div class="content-area">

	<?php // Show the selected frontpage content.
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'page-template/home-custom', 'front-page' );
		endwhile;
	else :
		get_template_part( 'template-parts/post/content', 'none' );
	endif; ?>
		
</div>

<?php get_footer();
