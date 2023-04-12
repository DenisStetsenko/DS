<?php
if( ! defined('ABSPATH') ) exit;

if ( ! function_exists('custom_post_types') ) {
  /**
   * Register Post Type Slider
   ***********************************************************************************************************************/
  function custom_post_types(){
    
    $post_type_testimonials_args = array(
      'labels' => array(
	      'name'                => _x('Testimonials', 'post type general name', 'wp-theme'),
	      'singular_name'       => _x('Testimonial', 'post type singular name', 'wp-theme'),
	      'add_new'             => _x('Add New', 'testimonial', 'wp-theme'),
	      'add_new_item'        => __('Add New', 'wp-theme'),
	      'edit_item'           => __('Edit', 'wp-theme'),
	      'new_item'            => __('New ', 'wp-theme'),
	      'all_items'           => __('All', 'wp-theme'),
	      'view_item'           => __('View', 'wp-theme'),
	      'search_items'        => __('Search', 'wp-theme'),
	      'not_found'           => __('No testimonials found', 'wp-theme'),
	      'not_found_in_trash'  => __('No testimonials found in the Trash', 'wp-theme'),
	      'parent_item_colon'   => '',
	      'menu_name'           => 'Testimonials'
      ),
      'description'   => 'Display Testimonial',
      'public'        => false, // HIDE LINK
      'show_ui'       => true, // HIDE LINK
      'menu_icon'     => 'dashicons-testimonial',
      'menu_position' => 5,
      'supports'      => array('title', 'page-attributes', 'editor'),
      'has_archive'   => false,
      'hierarchical'  => false
    );
    register_post_type('testimonials', $post_type_testimonials_args);
  }
}
add_action('init', 'custom_post_types');
