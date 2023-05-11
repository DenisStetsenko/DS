<?php
/**
 * CUSTOM ADMIN STYLES
 * apply custom styles for pages section in the Dashboard section
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_style_for_pages' ) ) {
  function wp_custom_theme_style_for_pages() {
    $screen = get_current_screen();
    if ($screen->post_type == 'page') {
      echo '<style>
              #the-list tr.level-0 td.title .row-title{ color: #024e7d; letter-spacing: 0.2px; }
              #the-list tr.level-1 td.title .row-title{ font-weight: 400; }
              #the-list tr.level-2 td.title .row-title{ font-weight: 400; color: #405d89; font-size: 95% !important; }
              #the-list tr.level-3 td.title .row-title{ font-weight: 400; color: }
            </style>';
    }
  }
}
add_action('admin_head', 'wp_custom_theme_style_for_pages');


/**
 * Remove #more anchor from posts
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_remove_more_jump_link' ) ) {
  function wp_custom_remove_more_jump_link($link){
    $offset = strpos($link, '#more-');
    if ($offset) {
      $end = strpos($link, '"', $offset);
    }
    if ($end) {
      $link = substr_replace($link, '', $offset, $end - $offset);
    }
    return $link;
  }
}
add_filter('the_content_more_link', 'wp_custom_remove_more_jump_link');


/**
 * Custom excerpt length read more
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_excerpt_more' ) ) {
  function wp_custom_excerpt_more($more){
    return sprintf('... <a class="btn btn-secondary read-more" href="%1$s">%2$s</a>',
        get_permalink(get_the_ID()),
        __('Continue Reading', 'wp-theme')
    );
  }
}
add_filter('excerpt_more', 'wp_custom_excerpt_more');


/**
 * Custom excerpt length
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_excerpt_length' ) ) {
  function wp_custom_excerpt_length($length){
    return 25;
  }
}
add_filter('excerpt_length', 'wp_custom_excerpt_length', 20);


/**
 * Customize Login Screen
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_wordpress_login_styling' ) ) {
  function wp_custom_theme_wordpress_login_styling() { ?>
    <style>
        body.login {
            background-color: #292929;
            background-image: none !important;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        body.login #login{
            padding-top: 40px;
            padding-bottom: 40px;
        }
        body.login h1 a {
            background-image: url('<?php echo get_theme_file_uri('assets/images/logo-white-text.png'); ?>') !important;
            outline: none;
						box-shadow: none;
            width: 100%;
            background-size: contain;
            height: 54px;
        }
        body.login #nav, body.login #backtoblog{
            text-align: center;
        }
        body.login #nav a, body.login #backtoblog a{
            color: #fff;
            border-bottom: 1px solid transparent;
        }
        body.login #nav a:hover, body.login #backtoblog a:hover{
            color: #fff;
            border-bottom-color: #fdd11f;
        }
        body.login .privacy-policy-page-link{
            margin-top: 15px;
        }
        body.login .privacy-policy-page-link a{
            color: #fff
        }
        body.login #loginform{
            border-radius: 15px;
            color: #292929;
        }
        body.login input[type=text]:focus,
        body.login input[type=checkbox]:focus,
        body.login input[type=password]:focus{
            color: #292929;
            border-color: #fdd11f;
            box-shadow: 0 0 0 1px #fdd11f;
        }
        body.login .button.wp-hide-pw .dashicons{
            color: #292929;
        }
        body.login #loginform input[type="submit"]{
            color: #292929;
            background-color: #fdd11f;
            border-color: #fdd11f;
            font-weight: 600;
            border-radius: 25px;
            padding: 1px 20px;
            display: inline-block;
            font-size: 15px;
        }
        body.login .language-switcher { display: none }
    </style>
  <?php }
  add_action('login_enqueue_scripts', 'wp_custom_theme_wordpress_login_styling');
}


/**
 * wp-admin logo site URL
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_admin_logo_custom_url' ) ) {
  function wp_custom_admin_logo_custom_url(){
    return esc_url( home_url() );
  }
  add_filter('login_headerurl', 'wp_custom_admin_logo_custom_url');
}


/**
 * Allow SVG through WordPress Media Uploader
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_cc_mime_types' ) ) {
  function wp_custom_cc_mime_types($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
}
add_filter('upload_mimes', 'wp_custom_cc_mime_types');


/**
 * Remove type="text/javascript" | type="text/css"
 ***********************************************************************************************************************/
add_action('init', function(){ ob_start("prefix_output_callback"); });
add_action('shutdown', function(){ ob_end_flush(); });

function prefix_output_callback($buffer) {
	return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
}

/**
 * remove the inline style width from the figure element?
 */
add_filter('img_caption_shortcode_width', '__return_false');