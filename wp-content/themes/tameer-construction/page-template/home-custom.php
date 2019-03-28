<?php
/**
 * Template Name: Home Custom Page
 */
?>

<?php do_action( 'tameer_construction_before_slider' ); ?>

<?php if( get_theme_mod('tameer_construction_slider_arrows') != ''){ ?>
  <section id="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
      <?php $pages = array();
          for ( $count = 1; $count <= 3; $count++ ) {
            $mod = intval( get_theme_mod( 'tameer_construction_slide_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $pages[] = $mod;
            }
          }
          if( !empty($pages) ) :
          $args = array(
              'post_type' => 'page',
              'post__in' => $pages,
              'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>     
      <div class="carousel-inner" role="listbox">
        <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title();?></h2>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( tameer_construction_string_limit_words( $excerpt,20 ) ); ?></p>
              <div class ="readbutton">
                <a href="<?php the_permalink(); ?>"> <?php echo esc_html(get_theme_mod('tameer_construction_slide_page',__('READ MORE','tameer-construction'))); ?></a>
              </div>
            </div>
          </div>
        </div>
        <?php $i++; endwhile; 
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
      <div class="no-postfound"></div>
        <?php endif;
      endif;?>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
      </a>
    </div> 
    <div class="clearfix"></div>
  </section> 
<?php }?> 

<?php do_action( 'tameer_construction_after_slider' ); ?>

<section id="about">
  <div class="container">
    <?php $pages = array();
      $mod = absint( get_theme_mod( 'tameer_construction_about_page'));
      if ( 'page-none-selected' != $mod ) {
        $pages[] = $mod;
      }
    if( !empty($pages) ) :
      $args = array(
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="about-text">
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <div class ="aboutbtn">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','tameer-construction'); ?></a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="about-img">
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
    endif;
    wp_reset_postdata()?>
      <div class="clearfix"></div> 
  </div>
</section>

<?php do_action( 'tameer_construction_after_about' ); ?>

<?php get_footer(); ?>