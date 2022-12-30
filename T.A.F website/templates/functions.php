<?php

if (!function_exists('epic_setup')) {
  function epic_setup() {
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    register_nav_menus(array(
      'primary'              => 'Primary Nav Menu',
      'footer-ministries'    => 'Footer Ministries Menu',
      'footer-about-us'      => 'Footer About Us Menu',
      'footer-media'         => 'Footer Media Menu',
      'footer-get-connected' => 'Footer Get Connected Menu',
      'footer-watch'         => 'Footer Watch Menu',
      'footer-connect'       => 'Footer Connect Menu',
      'footer-give'          => 'Footer Give Menu',
      'footer-social'        => 'Footer Social',
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
      'gallery',
      'status',
      'audio',
      'chat',
    ));

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 900, 507, false );
    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, icons, and column width.
     */
    add_editor_style(array(
      'css/editor-style.css',
      epic_fonts_url(),
    ));
  }
}

add_action('after_setup_theme', 'epic_setup');

if (!function_exists('epic_fonts_url')) {
  /**
   * Register Google fonts for Epic.
   *
   * Create your own epic_fonts_url() function to override in a child theme.
   *
   * @since EpicSF 1.0
   *
   * @return string Google fonts URL for the theme.
   */
  function epic_fonts_url() {
    $fonts_url = '';
    $fonts = array(
      'Cardo:400,400i',
      'Lato:300,400,700,900',
    );

    $fonts_url = add_query_arg(array(
      'family' => urlencode(
        implode('|', $fonts)
      ),
    ), 'https://fonts.googleapis.com/css');

    return $fonts_url;
  }
}

if (!function_exists('epic_event_month')) {
  function epic_event_month($event_description) {
    $months = array('January', 'February', 'March', 'April', 'May',
      'June', 'July', 'August', 'September', 'October', 'November', 'December');

    foreach ($months as $month) {
      if (strpos($event_description, $month) !== false) {
        return $month;
      }
    }

    return '';
  }
}

if (!function_exists('epic_get_events')) {
  function epic_get_events() {
    return get_posts(array(
      'category_name'  => 'event',
      'post_status'    => 'publish',
      'orderby'        => 'date',
      'order'          => 'DESC',
      'posts_per_page' => 100,
    ));
  }
}

if (!function_exists('epic_get_media')) {
  function epic_get_media($sub_category = 'media') {
    return get_posts(array(
      'category_name'  => $sub_category,
      'post_status'    => 'publish',
      'orderby'        => 'date',
      'order'          => 'DESC',
      'posts_per_page' => 500, // :D
    ));
  }
}

if (!function_exists('epic_get_40_days_media')) {
  function epic_get_40_days_media() {
    return epic_get_media('40-days-of-prayer');
  }
}

if (!function_exists('epic_get_2020_prayer_media')) {
  function epic_get_2020_prayer_media() {
    return epic_get_media('2020-prayer-guide');
  }
}

if (!function_exists('epic_get_story_media')) {
  function epic_get_story_media() {
    $posts = epic_get_media('stories');
    $sections = array();
    foreach ($posts as $post) {
      $tags = get_the_tags($post->ID);
      if (!$tags || count($tags) < 1 || !$tags[0]->name) {
        continue;
      }

      if (!isset($sections[$tags[0]->name])) {
        $sections[$tags[0]->name] = array();
      }

      $sections[$tags[0]->name][] = $post;
    }

    return $sections;
  }
}

if (!function_exists('epic_get_baptism_media')) {
  function epic_get_baptism_media() {
    return epic_get_media('baptisms');
  }
}

if (!function_exists('epic_get_sermon_series_media')) {
  function epic_get_sermon_series_media() {
    return epic_get_media('sermon-series');
  }
}

if (!function_exists('epic_get_featured_post')) {
  function epic_get_featured_post() {
    $posts = get_posts(array(
      'name'        => 'featured',
      'post_status' => 'publish',
    ));

    if ($posts[0]) return $posts[0];
  }
}

if (!function_exists('epic_get_featured_messages_post')) {
  function epic_get_featured_messages_post() {
    $posts = get_posts(array(
      'title'       => 'Featured Messages',
      'post_status' => 'publish',
    ));

    if ($posts[0]) return $posts[0];
  }
}

if (!function_exists('epic_is_media')) {
  // Intended to be called inside 'the loop'
  function epic_is_media() {
    $cats = get_the_category();

    foreach ($cats as $cat) {
      if ($cat->name === 'media') return true;
    }

    return false;
  }
}

if (!function_exists('epic_is_event')) {
  // Intended to be called inside 'the loop'
  function epic_is_event() {
    $cats = get_the_category();

    foreach ($cats as $cat) {
      if ($cat->name === 'event') return true;
    }

    return false;
  }
}

if (!function_exists('should_hide_title')) {
  function should_hide_title() {
    $page = strtolower( the_title(null, null, false) );
    return in_array($page, array(
      'about',
      'faq',
      'get connected',
      'media',
      'podcast',
      'link tree',
      'ministries',
      'partnerships',
      'stories',
      'baptisms',
    ));
  }
}

/**
 * Enqueues scripts and styles.
 *
 * @since EpicSF 1.0
 */
function epic_scripts() {
  // Add custom fonts, used in the main stylesheet.
  wp_enqueue_style(
    'epic-fonts',
    epic_fonts_url(),
    array(),
    null
  );

  wp_enqueue_style(
    'epic-font-icons',
    'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    array(),
    null
  );

  // Theme stylesheet.
  wp_enqueue_style(
    'epic-style',
    get_stylesheet_uri(),
    null,
    // Increment this to match the theme version to bust the cache.
    '1.0.40'
  );

}

add_action('wp_enqueue_scripts', 'epic_scripts');

function disable_author_pages() {
  global $wp_query;
  if ( is_author() && !is_404() ) {
    $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
  }
}

add_action('template_redirect', 'disable_author_pages');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since EpicSF 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function epic_body_classes($classes) {
  // Adds a class of custom-background-image to sites with a custom background image.
  if (get_background_image()) {
    $classes[] = 'custom-background-image';
  }

  // Adds a class of group-blog to sites with more than 1 published author.
  if (is_multi_author()) {
    $classes[] = 'group-blog';
  }

  // Adds a class of no-sidebar to sites without active sidebar.
  if (! is_active_sidebar('sidebar-1')) {
    $classes[] = 'no-sidebar';
  }

  // Adds a class of hfeed to non-singular pages.
  if (!is_singular()) {
    $classes[] = 'hfeed';
  }

  return $classes;
}

add_filter('body_class', 'epic_body_classes');

if (!function_exists('slugify')) {
  function slugify( $str ) {
    $str = strtolower( $str );
    $str = preg_replace( '/\s/', '-', $str );
    return $str;
  }
}

/**
 * Custom template tags for this theme.
 *
 * @since EpicSF 1.0
 */
require get_template_directory() . '/inc/template-tags.php';
// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
