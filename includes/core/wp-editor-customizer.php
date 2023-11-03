<?php
if ( ! function_exists( 'wp_custom_theme_add_my_tc_button' ) ) {
  function wp_custom_theme_add_my_tc_button() {

    // Check user permissions
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) return;

    // Check if WYSIWYG is enabled
    if ( get_user_option('rich_editing') == 'true') {
      add_filter('mce_external_plugins', 'wp_custom_theme_add_tinymce_plugin');
    }

    // Register the CSS files if using custom icons via the CSS property background-image
    wp_register_style( 'wp_custom_theme_tc_button_css', get_theme_file_uri('assets/styles/css/tinymce-btns.css'), false, null );
    wp_enqueue_style( 'wp_custom_theme_tc_button_css' );
  }
}
add_action('admin_head', 'wp_custom_theme_add_my_tc_button');


// Create the custom TinyMCE plugins
if ( ! function_exists( 'wp_custom_theme_add_tinymce_plugin' ) ) {
  function wp_custom_theme_add_tinymce_plugin($plugin_array) {
    $plugin_array['wp_custom_theme_tc_blockquote']  = get_theme_file_uri('assets/scripts/tinymce-btns.js');
    $plugin_array['wp_custom_theme_tc_button']      = get_theme_file_uri('assets/scripts/tinymce-btns.js');
    //$plugin_array['wp_custom_theme_tc_list']   = get_theme_file_uri('assets/scripts/tinymce-btns.js');
    return $plugin_array;
  }
}

// Add the buttons to the TinyMCE array of buttons that display, so they appear in the WYSIWYG editor
if ( ! function_exists( 'wp_custom_wysiwyg_toolbars' ) ) {
  function wp_custom_wysiwyg_toolbars( $buttons ){

    array_push($buttons, 'wp_custom_theme_tc_blockquote');
    array_push($buttons, 'wp_custom_theme_tc_button');

    return $buttons;
  }
}
add_filter( 'mce_buttons' , 'wp_custom_wysiwyg_toolbars'  );
