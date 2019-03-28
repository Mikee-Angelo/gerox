<?php
/**
 * The template for displaying archive pages
 */

get_header(); ?>

<div class="container">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header>
	<?php endif; ?>
	<div class="row">
		<?php
		    $layout_setting = get_theme_mod( 'tameer_construction_layout_settings', __('Right Sidebar','tameer-construction') );
	    if($layout_setting == 'Left Sidebar'){ ?>
		    <div id="sidebox" class="col-lg-4 col-md-4">
				<?php dynamic_sidebar('sidebox-1'); ?>
			</div>
			<div class="col-lg-8 col-md-8">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						
						get_template_part( 'template-parts/post/content' );

					endwhile;

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				?>
				<div class="navigation">
	                <?php
	                    
	                    the_posts_pagination( array(
	                        'prev_text'          => __( 'Previous page', 'tameer-construction' ),
	                        'next_text'          => __( 'Next page', 'tameer-construction' ),
	                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tameer-construction' ) . ' </span>',
	                    ) );
	                ?>
       	 		</div>
			</div>
		<?php }else if($layout_setting == 'Right Sidebar'){ ?>
			<div class="col-lg-8 col-md-8">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						
						get_template_part( 'template-parts/post/content' );

					endwhile;

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				?>
				<div class="navigation">
	                <?php
	                    
	                    the_posts_pagination( array(
	                        'prev_text'          => __( 'Previous page', 'tameer-construction' ),
	                        'next_text'          => __( 'Next page', 'tameer-construction' ),
	                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tameer-construction' ) . ' </span>',
	                    ) );
	                ?>
       	 		</div>
			</div>
			<div id="sidebox" class="col-lg-4 col-md-4">
				<?php dynamic_sidebar('sidebox-1'); ?>
			</div>
		<?php }else if($layout_setting == 'One Column'){ ?>
			<div class="col-lg-12 col-md-12">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						
						get_template_part( 'template-parts/post/content' );

					endwhile;

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				?>
				<div class="navigation">
	                <?php
	                    
	                    the_posts_pagination( array(
	                        'prev_text'          => __( 'Previous page', 'tameer-construction' ),
	                        'next_text'          => __( 'Next page', 'tameer-construction' ),
	                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tameer-construction' ) . ' </span>',
	                    ) );
	                ?>
       	 		</div>
			</div>
		<?php }else if($layout_setting == 'Grid Layout'){ ?>
			<div class="col-lg-9 col-md-9">
				<div class="row">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();
							
							get_template_part( 'template-parts/post/gridlayout' );

						endwhile;

						else :

							get_template_part( 'template-parts/post/content', 'none' );

						endif;
					?>
					<div class="navigation">
		                <?php
		                    
		                    the_posts_pagination( array(
		                        'prev_text'          => __( 'Previous page', 'tameer-construction' ),
		                        'next_text'          => __( 'Next page', 'tameer-construction' ),
		                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tameer-construction' ) . ' </span>',
		                    ) );
		                ?>
	       	 		</div>
	       	 	</div>
			</div>
			<div id="sidebox" class="col-lg-3 col-md-3">
				<?php dynamic_sidebar('sidebox-2'); ?>
			</div>
		<?php }else {?>
			<div class="col-lg-8 col-md-8">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();
						
						get_template_part( 'template-parts/post/content' );

					endwhile;

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
				?>
				<div class="navigation">
	                <?php
	                    
	                    the_posts_pagination( array(
	                        'prev_text'          => __( 'Previous page', 'tameer-construction' ),
	                        'next_text'          => __( 'Next page', 'tameer-construction' ),
	                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tameer-construction' ) . ' </span>',
	                    ) );
	                ?>
       	 		</div>
			</div>
			<div id="sidebox" class="col-lg-4 col-md-4">
				<?php dynamic_sidebar('sidebox-1'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<?php get_footer();