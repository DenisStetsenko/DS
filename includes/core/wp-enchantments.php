<?php
/**
 * Add favicon to wp-admin area
 * @return void
 */
function wp_custom_favicon4admin() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon/favicon.ico" />';
}
add_action( 'admin_head', 'wp_custom_favicon4admin' );

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
 * Prints HTML with meta information for the categories, tags and comments.
 ***********************************************************************************************************************/
if ( ! function_exists( 'post_meta' ) ) {
  function post_meta() {

    // Get Categories for posts.
    $categories = get_the_category();

    echo '<div class="entry-meta"><ul class="list-inline mb-0">';

    if ( is_single() ) { ?>
      <li class="list-inline-item mb-1">
        <ul class="list-inline mb-0 single-post-user">
          <li class="list-inline-item">
            <?php echo get_avatar( get_the_author_meta('user_email'), $size = '65'); ?>
          </li>
          <li class="list-inline-item author vcard">
            <?php printf('<a class="url fn n " href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a>'); ?>
          </li>
        </ul>
      </li>
    <?php }

    // Date
    $time_string = '<li class="list-inline-item mb-1"><i class="fa fa-calendar mr-1" aria-hidden="true"></i><time class="entry-date published updated" datetime="%1$s">%2$s</time></li>';
    $time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(get_option( 'date_format' )) );
    echo $time_string;

    if ( !is_single() ) {
      // Author
      printf('<li class="list-inline-item author vcard mb-1"><i class="fa fa-user mr-1" aria-hidden="true"></i><a class="url fn n " href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></li>');
    }

    // Categories
    if ( !empty( $categories )) {
      echo '<li class="list-inline-item mb-1"><ul class="list-inline post-categories">';
      echo '<li class="list-inline-item"><i class="fa fa-heart" aria-hidden="true"></i></li>';
      printf( '<li class="list-inline-item cat-links"><a href="%1$s">%2$s</a></li>',
          esc_url( get_category_link( $categories[0]->term_id ) ),
          esc_html( $categories[0]->name )
      );
      echo '</ul></li>';
    }

    // Comments
    echo '<li class="list-inline-item mb-1"><i class="fa fa-comment mr-1" aria-hidden="true"></i>';
    printf( _nx( '1 commentaar', '%1$s reacties', get_comments_number(), 'comments title', 'wp-theme' ), number_format_i18n( get_comments_number() ) );
    echo '</li>';

    echo '</ul></div><!-- /.entry-meta -->';

  }
}


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
    <style type="text/css">
      body.login {
        background-color: #1D678C;
        background-image: url('<?php echo get_background_image(); ?>') !important;
        background-repeat: repeat;
        background-position: center center;
      }
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
 * wp-admin custom logo => site logo
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_wordpress_filter_login_head' ) ) {
  function wp_custom_wordpress_filter_login_head(){
    if (has_custom_logo()) : $image = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'medium'); ?>
      <style type="text/css">
        .login h1 a {
          background-image: url(<?php echo esc_url( $image[0] ); ?>);
          -webkit-background-size: <?php echo absint( $image[1] )?>px;
          background-size: <?php echo absint( $image[1] ) ?>px;
          height: <?php echo absint( $image[2] ) ?>px;
          width: <?php echo absint( $image[1] ) ?>px;
        }
      </style>
    <?php endif;
  }
}
add_action('login_head', 'wp_custom_wordpress_filter_login_head', 100);


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
 * Custom Wordpress Comments form
 * https://codex.wordpress.org/Function_Reference/comment_form
 **********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_comment_form' ) ) {
  function wp_custom_theme_comment_form($args){
    $args['comment_field'] =
        '<div class="form-group comment-form-comment">
          <label for="comment">' . _x('Comment', 'noun', 'wp-theme') . (' <span class="required">*</span>') . '</label>
          <textarea class="form-control" id="comment" name="comment" aria-required="true" cols="45" rows="6"></textarea>
        </div>';

    $args['class_submit'] = 'btn btn-primary'; // since WP 4.1.

    return $args;
  }
}
add_filter('comment_form_defaults', 'wp_custom_theme_comment_form');
