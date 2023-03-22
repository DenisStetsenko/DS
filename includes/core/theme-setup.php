<?php
/**
 * Basic functions for Bootstrap Theme Set Up
 ***********************************************************************************************************************/

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

// Sets up theme defaults and registers support for various WordPress features.
if ( ! function_exists('wp_custom_theme_setup') ) {
  function wp_custom_theme_setup() {

    // By adding theme support, we declare that this theme does not use a hard-coded <title> tag
	  // in the document head, and expect WordPress to provide it for us.
    add_theme_support( 'title-tag' );

	  // Switch default core markup for search form, comment form, and comments to output valid HTML5.
	  add_theme_support( 'html5', array(
		  'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	  ));

    // Add widget support shortcodes
    add_filter('widget_text', 'do_shortcode');

    // Support for Featured Images
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'custom-logo', array(
      'height'      => 200,
      'width'       => 200,
      'flex-height' => true,
      'flex-width'  => true,
      'header-text' => array( 'site-title', 'site-description' ),
    ));

    // This feature adds RSS feed links to HTML <head>
    add_theme_support( 'automatic-feed-links' );

    // Register Navigation Menu
    register_nav_menus( array(
      'header-menu' => esc_html__( 'Header Menu', 'wp-theme' ),
      'footer-menu' => esc_html__( 'Footer Menu', 'wp-theme' )
    ));

	  // Add theme support WooCommerce
	  add_theme_support( 'woocommerce' );

    // Add support for block styles.
    add_theme_support( 'wp-block-styles' );

    // Editor Style
    add_theme_support( 'editor-style' );
		
    // remove render gutenberg svg_filters junk
    remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
    remove_action( 'wp_body_open', 'gutenberg_global_styles_render_svg_filters' );

    // remove render_block filters which adding unnecessary stuff
    remove_filter('render_block', 'wp_render_duotone_support');
    remove_filter('render_block', 'wp_restore_group_inner_container');
    remove_filter('render_block', 'wp_render_layout_support_flag');
	
	  //Completely Remove Default styles
	  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
		
		// new image sizes
	  add_image_size( 'top-picks-thumbnail', 100, 100 );
		
  }
}
add_action( 'after_setup_theme', 'wp_custom_theme_setup' );


/**
 * Editor styles
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_add_editor_styles' ) ) {
  function wp_custom_theme_add_editor_styles(){
    add_editor_style( array( 'assets/styles/css/custom-editor-style.css' ) );
  }
}
add_action('admin_init', 'wp_custom_theme_add_editor_styles');

