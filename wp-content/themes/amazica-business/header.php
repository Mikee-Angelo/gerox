<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Amaica
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'amazica-business' ); ?></a>
	<?php $header_class = (is_front_page())?'frontpage-header':''; ?>
	<header id="masthead" class="site-header <?php echo esc_attr($header_class); ?>">
		<?php do_action('themefarmer_before_header_main'); ?>
		<div class="header-main">
        	<div class="container">
            	<div class="primary-menu-container">
            		<nav id="site-navigation" class="main-navigation navbar navbar-expand-md navbar-light row" role="navigation">					  	
						<div class="navbar-header col-md-3">
							<!-- Brand and toggle get grouped for better mobile display -->
							<?php if(amazica_is_wc()): ?>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-header-cart" aria-controls="site-header-cart" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle cart', 'amazica-business'); ?>">
								<?php amazica_woocommerce_cart_link_contnet(); ?>
							</button>
							<?php endif; ?>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#TF-Navbar" aria-controls="TF-Navbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'amazica-business'); ?>">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
							<div class="site-branding site-logo">
							<?php
								if ( function_exists( 'the_custom_logo' ) && function_exists( 'has_custom_logo' ) && has_custom_logo()) :
									
									if ( is_front_page() ) : ?>
										<h1 class="site-title"><?php the_custom_logo();?></h1>
									<?php else : ?>
										<p class="site-title"><?php the_custom_logo();?></p>
									<?php
									endif;
								else :
									if ( is_front_page() ) : ?>
										<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
									endif;
									$description = get_bloginfo( 'description', 'display' );
									if ( $description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo $description; ?></p>
									<?php
									endif;
								endif;
							?>	
							</div><!-- .site-branding -->
						</div>
						<?php
							if(amazica_is_wc()){ 
								echo amazica_woocommerce_header_cart();
							}
							wp_nav_menu(array(
								'theme_location'    => 'primary',
								'depth'             => 0,
								'container'         => 'div',
								'container_class'   => 'collapse navbar-collapse col-md-9',
								'container_id'      => 'TF-Navbar',
								'menu_class'        => 'nav navbar-nav primary-menu',
								'menu_id'           => 'primary-menu',
								'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
								'walker'            => new WP_Bootstrap_Navwalker(),
							));
						?>
					</nav><!-- #site-navigation -->
                </div>
	        </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
