<?php
if ( ! function_exists( 'wp_custom_theme_button_shortcode' ) ) {
  function wp_custom_theme_button_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'content'       => '',
        'author'        => '',
    ), $atts ) );

    return '<figure>
              <blockquote class="blockquote fw-light text-primary">
                <p>“' . $atts['content'] . '”</p>
              </blockquote>
              <figcaption class="blockquote-footer fw-bold text-primary mb-0">' . esc_html($atts['author']) . '</figcaption>
            </figure>';
  }
}
add_shortcode( 'blockquote', 'wp_custom_theme_button_shortcode' );
