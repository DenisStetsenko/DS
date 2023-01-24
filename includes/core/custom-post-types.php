<?php
if( ! defined('ABSPATH') ) exit;

if ( ! function_exists('custom_post_types') ) {
  /**
   * Register Post Type Slider
   ***********************************************************************************************************************/
  function custom_post_types(){
    $post_type_slider_labels = array(
      'name'                => _x('Slider', 'post type general name', 'wp-theme'),
      'singular_name'       => _x('Slide', 'post type singular name', 'wp-theme'),
      'add_new'             => _x('Add New', 'slide', 'wp-theme'),
      'add_new_item'        => __('Add New', 'wp-theme'),
      'edit_item'           => __('Edit', 'wp-theme'),
      'new_item'            => __('New ', 'wp-theme'),
      'all_items'           => __('All', 'wp-theme'),
      'view_item'           => __('View', 'wp-theme'),
      'search_items'        => __('Search for a slide', 'wp-theme'),
      'not_found'           => __('No slides found', 'wp-theme'),
      'not_found_in_trash'  => __('No slides found in the Trash', 'wp-theme'),
      'parent_item_colon'   => '',
      'menu_name'           => 'Slider'
    );
    $post_type_slider_args = array(
      'labels'        => $post_type_slider_labels,
      'description'   => 'Display Slider',
      'public'        => true,
      'menu_icon'     => 'dashicons-slides',
      'menu_position' => 5,
      'supports'      => array('title', 'thumbnail', 'page-attributes', 'editor'),
      'has_archive'   => false,
      'hierarchical'  => false
    );
    register_post_type('slider', $post_type_slider_args);
  }
}
add_action('init', 'custom_post_types');
