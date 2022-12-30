<?php
/**
 * The template file for a single post (event / media page)
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage EpicSF
 * @since EpicSF 1.0
 */

get_header(); ?>
<div id="primary" class="content-area">
  <main id="main" class="site-main">
  <?php if ( have_posts() ) : ?>

    <?php
    while ( have_posts() ) : the_post();
      if (epic_is_event()) {
        get_template_part( 'template-parts/events/event', get_post_format() );
      } else if (epic_is_media()) {
        get_template_part( 'template-parts/media/media', get_post_format() );
      } else { ?>
        <div class="entry-content container-fluid">
          <div class="col-sm-12 col-md-12 col-lg-6 col-lg-offset-4">
          <?php the_title( '<h1 class="variation">', '</h1>' ); ?>
          <?php the_subtitle( '<div class="body2">', '</div>' ); ?>
          <div class="spacer-30"></div>
          <?php the_content(); ?>
          </div>
        </div>
        <?php
      }
    endwhile;

  endif;
  ?>
  </main>
</div>

<?php get_footer(); ?>