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

    // Add support for Block styles.
    add_theme_support( 'wp-block-styles' );
	
	  // Editor Style
	  add_theme_support( 'editor-styles' );
	  add_editor_style( 'style-editor.css' );
	  add_editor_style( array( 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap', 'style-editor.css' ));
		
		// new image sizes
	  add_image_size( 'top-picks-thumbnail', 130, 130 );
		
    // remove render gutenberg svg_filters junk
    remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
	  remove_action( 'wp_body_open', 'gutenberg_global_styles_render_svg_filters' );

    // remove render_block filters which adding unnecessary stuff
	  //remove_filter('render_block', 'wp_render_duotone_support');
	  //remove_filter('render_block', 'wp_restore_group_inner_container');
	  //remove_filter('render_block', 'wp_render_layout_support_flag');
	
	  //Completely Remove Default styles
	  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	
	  /**
	   * Gutenberg Default block styles
	   */
	  add_theme_support( 'responsive-embeds' ); // The embed blocks automatically apply styles to embedded content to reflect the aspect ratio of content that is embedded in an iFrame.
	  add_theme_support( 'custom-units', 'px', 'rem' );
	  add_theme_support( 'custom-spacing' ); // Some blocks can have padding controls.
	  remove_theme_support( 'core-block-patterns' );
		
	  /**
	   * Gutenberg Add Theme Colors
	   */
	  add_theme_support( 'disable-custom-gradients' ); // Disabling custom gradients
	  add_theme_support( 'editor-color-palette', array(
		  array(
			  'name'  => esc_attr__( 'Primary Yellow', 'wp-theme' ),
			  'slug'  => 'primary-yellow',
			  'color' => '#fdd11f',
		  ),
		  array(
			  'name'  => esc_attr__( 'Primary Yellow Dark', 'wp-theme' ),
			  'slug'  => 'light-grayish-magenta',
			  'color' => '#f0c000',
		  ),
		  array(
			  'name'  => esc_attr__( 'White', 'wp-theme' ),
			  'slug'  => 'white',
			  'color' => '#ffffff',
		  ),
		  array(
			  'name'  => esc_attr__( 'Black', 'wp-theme' ),
			  'slug'  => 'black',
			  'color' => '#292929',
		  ),
		  array(
			  'name'  => esc_attr__( 'Gray', 'wp-theme' ),
			  'slug'  => 'gray',
			  'color' => '#595959',
		  ),
		  array(
			  'name'  => esc_attr__( 'Light Gray', 'wp-theme' ),
			  'slug'  => 'light-gray',
			  'color' => '#f7f8f9',
		  ),
		  array(
			  'name'  => esc_attr__( 'Color Border Gray', 'wp-theme' ),
			  'slug'  => 'border-gray',
			  'color' => '#eaecee',
		  ),
	  ) );
	
	  /**
	   * Gutenberg Theme Font Sizes
	   */
	  //add_theme_support('disable-custom-font-sizes'); // disable custom font size
	  add_theme_support( 'editor-font-sizes', array(
		  array(
			  'name' => esc_attr__( '14px (0.875rem)', 'wp-theme' ),
			  'size' => '0.875rem',
			  'slug' => 'small'
		  ),
		  array(
			  'name' => esc_attr__( '18px (1.125rem)', 'wp-theme' ),
			  'size' => '1.125rem',
			  'slug' => 'medium'
		  ),
		  array(
			  'name' => esc_attr__( '36px (2.25rem)', 'wp-theme' ),
			  'size' => '2.25rem',
			  'slug' => 'large'
		  ),
		  array(
			  'name' => esc_attr__( '44px (2.75rem)', 'wp-theme' ),
			  'size' => '2.75rem',
			  'slug' => 'x-large'
		  ),
		  array(
			  'name' => esc_attr__( '54px (3.375rem)', 'wp-theme' ),
			  'size' => '3.375rem',
			  'slug' => 'huge'
		  )
	  ) );
		
  }
}
add_action( 'after_setup_theme', 'wp_custom_theme_setup' );