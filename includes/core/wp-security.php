<?php
if( ! defined('ABSPATH') ) exit;

/**
 * Removes the generator tag with WP version numbers. Hackers will use this to find weak and old WP installs
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_no_generator' ) ) {
  function wp_custom_no_generator(){
    return '';
  }
}
add_filter('the_generator', 'wp_custom_no_generator');


/**
 * Clean up wp_head() from unused or unsecure stuff
 ***********************************************************************************************************************/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);


/**
 * Show less info to users on failed login for security.
 * (Will not let a valid username be known.)
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_show_less_login_info' ) ) {
  function wp_custom_show_less_login_info(){
    return "<strong>ERROR</strong>: Stop guessing!";
  }
}
add_filter('login_errors', 'wp_custom_show_less_login_info');


/**
 * Disable use XML-RPC & X-Pingback
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_disable_x_pingback' ) ) {
  function wp_custom_disable_x_pingback($headers){
    unset($headers['X-Pingback']);
    return $headers;
  }
}
add_filter( 'wp_headers', 'wp_custom_disable_x_pingback' );
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Disable /wp-admin screen on log-out
 ***********************************************************************************************************************/
add_action('wp_logout','wp_custom_auto_redirect_after_logout');
function wp_custom_auto_redirect_after_logout(){
	$location = $_SERVER['HTTP_REFERER'];
	wp_safe_redirect( home_url($location) );
	exit();
}