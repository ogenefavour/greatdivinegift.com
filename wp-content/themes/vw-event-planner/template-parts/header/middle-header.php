<?php
/**
 * The template part for header
 *
 * @package VW Event Planner 
 * @subpackage vw_event_planner
 * @since VW Event Planner 1.0
 */
?>

<div class="main-header">
  <div class="container">
    <div class="row">      
      <div class="col-lg-3 col-md-3">
        <div class="logo">
          <?php if( has_custom_logo() ){ vw_event_planner_the_custom_logo();
            }else{ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html($description); ?></p>
          <?php endif; } ?>
        </div>
      </div>
      <div class="<?php if( get_theme_mod( 'vw_event_planner_header_search') != '') { ?>col-lg-6 col-md-6"<?php } else { ?>col-lg-7 col-md-7"<?php } ?>">
        <?php get_template_part( 'template-parts/header/navigation' ); ?>
      </div>
      <?php if( get_theme_mod( 'vw_event_planner_header_search') != '') { ?>
      <div class="col-lg-1 col-md-1">
          <div class="search-box">
            <span><i class="fas fa-search"></i></span>
          </div>
      </div>
      <?php }?>
      <div class="col-lg-2 col-md-2 p-0">
        <div class="book-now">
          <?php if( get_theme_mod( 'vw_event_planner_buynow_url') != '' || (get_theme_mod( 'vw_event_planner_buynow_text') != '') ){ ?>
            <a href="<?php echo esc_url(get_theme_mod('vw_event_planner_buynow_url',''));?>"><?php echo esc_html(get_theme_mod('vw_event_planner_buynow_text',''));?><i class="fas fa-angle-right"></i></a>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="serach_outer">
      <div class="closepop"><i class="far fa-window-close"></i></div>
      <div class="serach_inner">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</div>