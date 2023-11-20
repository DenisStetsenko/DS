<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * HTML <iframe> responsive via Bootstrap 4 framework
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_embed_handler_html' ) ) {
  function wp_custom_theme_embed_handler_html($cached_html, $url, $attr, $post_ID){
	
	  if ( ! has_blocks() ) {
	    $classes = array();
	
	    $classes_all = array(
        'ratio ratio-16x9',
	    );
	
	    if (false !== strpos($url, 'vimeo.com')) {
	      $classes[] = 'vimeo';
	    }
	
	    if (false !== strpos($url, 'youtube.com')) {
	      $classes[] = 'youtube';
	    }
	
	    $classes = array_merge($classes, $classes_all);
	
	    $cached_html = '<div class="' . esc_attr( implode(' ', $classes ) ) . '">' . $cached_html . '</div>';
	  }


    return $cached_html;
  }
}
add_filter('embed_oembed_html', 'wp_custom_theme_embed_handler_html', 100, 4);