<?php
/**
 * Functions
 */

//show_admin_bar(false);

/**
 * Included Files
 ***********************************************************************************************************************/
// Run Theme Setup Functions
include get_theme_file_path('/includes/core/theme-setup.php');

// Load WordPress Security Updates
include get_theme_file_path('/includes/core/wp-security.php');

// Load WordPress Enchantments
include get_theme_file_path('/includes/core/wp-enchantments.php');

// Load Bootstrap Enchantments
include get_theme_file_path('/includes/core/bootstrap-helpers.php');

// Load custom WordPress nav walker.
include get_theme_file_path('/includes/core/bootstrap-navwalker.php');

// Load custom WordPress pagination.
include get_theme_file_path('/includes/core/bootstrap-pagination.php');

// Load ACF Functions
include get_theme_file_path('/includes/acf/acf-functions.php');

// Load WP Editor Customizer
include get_theme_file_path('/includes/core/wp-editor-customizer.php');

// Load WP Custom Shortcodes
include get_theme_file_path('/includes/core/wp-custom-shortcodes.php');

// Load WP Bootstrap Icons
include get_theme_file_path('/includes/core/wp-bootstrap-icons.php');

// Load WP Social Sare
include get_theme_file_path('/includes/core/wp-social-share.php');

// Load Yoast Breadcrumbs
include get_theme_file_path('/includes/core/yoast-breadcrumbs-list.php');

// Load Custom WP Metaboxes
//include get_theme_file_path('/includes/core/wp-custom-metabox.php');

// Load Custom Post Types
//include get_theme_file_path('/includes/core/custom-post-types.php');

// Load Widgets
include get_theme_file_path('/includes/core/wp-widgets.php');

// Load Custom Post Admin Columns
include get_theme_file_path('/includes/core/wp-admin-post-columns.php');


/**
 * Enqueue Scripts and Styles for Front-End
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_scripts_and_styles' ) ) {
  function wp_custom_scripts_and_styles(){

    wp_enqueue_script('jquery');

    // Special script for comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    // Remove Gutenberg Block Library CSS from loading on the frontend
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
	  
	
	  // Fancybox (BS Replacement)
    // wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css', array(), array() );
    // wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js', array('jquery'), array(), true );

    if ( is_home() || is_archive() ) :
      wp_enqueue_script( 'ajax-pagination',  get_theme_file_uri('assets/scripts/ajax-load-more.js'), array( 'jquery' ), null, true );
      wp_localize_script( 'ajax-pagination', 'ajaxPagination', array(
          'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
          'protection'  => wp_create_nonce('wp-custom-key')
      ));
    endif;

    wp_enqueue_script( 'bootstrap', get_theme_file_uri('assets/scripts/bootstrap/bootstrap.bundle.min.js'), array('jquery'), null, true );
    //wp_enqueue_script( 'global', get_theme_file_uri('assets/scripts/global.js'), array('jquery'), null, true );

    wp_enqueue_style( 'main', get_theme_file_uri('assets/styles/css/main.css'), array(), time() );

  }
}
add_action('wp_enqueue_scripts', 'wp_custom_scripts_and_styles');


/**
 * Custom Logos for Light background
 * @param $wp_customize
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_customizer_custom_logo' ) ) {
  function wp_custom_customizer_custom_logo($wp_customize) {

    $wp_customize->add_setting('site_footer_logo', array(
        'sanitize_callback'     => '',
        'sanitize_js_callback'  => '',
        'type'                  => 'theme_mod'
    ) );
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_footer_logo', array(
        'label'     => __('Footer Logo', 'wp-theme'),
        'settings'  => 'site_footer_logo',
        'section'   => 'title_tagline',
        'priority'  => 9
    )));

  }
}
add_action('customize_register', 'wp_custom_customizer_custom_logo');



/**
 * Ajax Load More ( used for IDX projects )
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_posts_ajax_pagination' ) ) {
  function wp_custom_posts_ajax_pagination() {
    check_ajax_referer('wp-custom-key', 'security');

    // Define args
    $ppp      = isset($_POST['ppp']) ? $_POST['ppp'] : get_option('posts_per_page');
    $cat      = isset($_POST['cat']) ? $_POST['cat'] : '';
    $search   = isset($_POST['search']) ? $_POST['search'] : '';
    $offset   = isset($_POST['offset']) ? $_POST['offset'] : get_option('posts_per_page');
    $year     = isset($_POST['year']) ? $_POST['year'] : '';
    $monthnum = isset($_POST['monthnum']) ? $_POST['monthnum'] : '';
    $type     = isset($_POST['type']) ? $_POST['type'] : '';

    $args = [];
    $args['post_type'] = 'post';
    $args['post_status'] = 'publish';
    $args['order'] = 'DESC';
    $args['orderby'] = 'date';
    $args['posts_per_page'] = $ppp;
    $args['offset'] = $offset;


    // Run WP_Query for BLOG posts
    if ($type == 'blog') {

      // if BLOG page DO NOT categorize output, just load all posts
      if ($cat !== 'all' && $cat !== '') $args['category_name'] = $cat;

      // if Search Results - Define Search results
      if ($search !== '') $args['s'] = $search;

      // if Search Results
      if ($year && $monthnum !== '') {
        $args['year']     = (int)$year;
        $args['monthnum'] = (int)$monthnum;
      }

    }

    // Run WP_Query
    ob_start();

    $wp_query = new WP_Query($args);

    // get total posts
    $postsCount = $wp_query->post_count;
    $foundCount = $wp_query->found_posts;

    if ($wp_query->have_posts()) :
      while ($wp_query->have_posts()) : $wp_query->the_post();
        if ($type === 'blog') {
          get_template_part('template-parts/blog/blog-loop-item');
        }
      endwhile;
    endif;
    wp_reset_query();

    $response = array(
        'html' => ob_get_clean(),
      //'args'        => $args,
        'type' => $type,
        'count' => $postsCount,
        'found' => $foundCount,
        'isLastPage' => $postsCount < $ppp
    );

    wp_send_json_success($response);
    wp_die();

  }

  add_action('wp_ajax_nopriv_load_more_pagination', 'wp_custom_posts_ajax_pagination');
  add_action('wp_ajax_load_more_pagination', 'wp_custom_posts_ajax_pagination');
}

/**
 * Remove "Category" from get_the_archive_title()
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );