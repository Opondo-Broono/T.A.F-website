<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage EpicSF
 * @since EpicSF 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>
  <meta name='og:image' content='https://d2jnnnpm1ykrse.cloudfront.net/2020-Epic-church-sf-stock-Ben-social-crop.jpg'>
  <meta name='og:image:width' content='3600'>
  <meta name='og:image:height' content='2400'>
  <meta name='og:image:alt' content='Pastor Ben on stage at Epic Church'>
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@epicchurchsf" />
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-11664989-1', 'auto');
    ga('send', 'pageview');
  </script>
  <!-- Global site tag (gtag.js) - Google Ads: 1070758363 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-1070758363"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-1070758363');
  </script>
  <script src="https://js.churchcenter.com/modal/v1"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <div class="site-inner">
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'epic' ); ?></a>

    <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
      <div id="site-header-menu" class="site-header-menu">

        <a id="churchonline_counter" class="body4" href="http://live.epicsf.com">
          <span class="live link">Watch Live</span>
          <span class="msg">Watch live in</span>
          <ul class="countdown clearfix">
            <li><span class="days"></span> <span class="unit">days</span></li>
            <li><span class="hours"></span> <span class="unit">hrs</span></li>
            <li><span class="minutes"></span> <span class="unit">mins</span></li>
          </ul>
        </a>

        <?php if ( has_nav_menu( 'primary' ) ) : ?>
          <nav id="site-navigation" class="navbar navbar-full navbar-light" aria-label="<?php esc_attr_e( 'Primary Menu', 'epic' ); ?>">
            <div>
              <a href="/" class="navbar-brand" id="epic-logo">
                <img src="/wp-content/uploads/2020/05/logo-black.svg" alt="Epic" />
              </a>
            </div>
            <div class="primary-nav-container">
              <?php
                wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'menu_class'     => 'nav navbar-nav pull-md-right',
                  'walker'         => new WP_Bootstrap_Navwalker(),
                  'depth'          => 2,
                 ));
              ?>
              <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#epicCollapsingNavbar">
                <span class="screen-reader-text">Toggle menu</span>
                <div class="menu-line" role="presentation"></div>
                <div class="menu-line" role="presentation"></div>
                <div class="menu-line" role="presentation"></div>
              </button>
            </div>
          </nav><!-- .navbar -->
          <div class="collapse navbar-collapse site-footer" id="epicCollapsingNavbar">
            <nav class="navbar container-fluid">
              <div class="row">
                <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 vision">
                  <p>Our vision is to see an increasing number of people in San Francisco orient their entire lives around Jesus.</p>
                </div>
              </div>
              <div class="row">
              <?php if ( has_nav_menu( 'footer-watch' ) ) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                  <strong>Watch</strong>
                  <div aria-label="<?php esc_attr_e( 'Footer Watch Menu', 'epic' ); ?>">
                    <?php
                      wp_nav_menu( array(
                        'theme_location' => 'footer-watch',
                        'menu_class'     => 'nav navbar-nav',
                       ) );
                    ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php if ( has_nav_menu( 'footer-connect' ) ) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                  <strong>Connect</strong>
                  <div aria-label="<?php esc_attr_e( 'Footer Connect Menu', 'epic' ); ?>">
                    <?php
                      wp_nav_menu( array(
                        'theme_location' => 'footer-connect',
                        'menu_class'     => 'nav navbar-nav',
                       ) );
                    ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php if ( has_nav_menu( 'footer-give' ) ) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                  <strong>Give</strong>
                  <div aria-label="<?php esc_attr_e( 'Footer Give Menu', 'epic' ); ?>">
                    <?php
                      wp_nav_menu( array(
                        'theme_location' => 'footer-give',
                        'menu_class'     => 'nav navbar-nav',
                       ) );
                    ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php if ( has_nav_menu( 'footer-social' ) ) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 social-links">
                  <div aria-label="<?php esc_attr_e( 'Footer Social Menu', 'epic' ); ?>">
                    <?php
                      wp_nav_menu( array(
                        'theme_location' => 'footer-social',
                        'menu_class'     => 'nav navbar-nav',
                       ) );
                    ?>
                  </div>
                </div>
              <?php endif; ?>
              </div> <!-- row site-footer -->
            </nav>
          </div> <!-- .collapse navbar-collapse -->
        <?php endif; ?>
      </div><!-- .site-header-menu -->
    <?php endif; ?>
  </div><!-- .site-header-main -->

    <div id="content" class="site-content">