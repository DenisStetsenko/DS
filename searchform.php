<?php
/**
 * Searchform
 *
 * Custom template for search form
 */
//$uid               = wp_unique_id( 's-' ); // The search form specific unique ID for the input.
$uid               = 'the-s-1'; // The search form specific unique ID for the input.
$aria_label = '';
if ( isset( $args['aria_label'] ) && ! empty( $args['aria_label'] ) ) {
  $aria_label = 'aria-label="' . esc_attr( $args['aria_label'] ) . '"';
}
?>

<form id="ajax-search-form" role="search" class="search-form rounded-4 bg-white" autocomplete="off" onsubmit="return false;"
			action="#" <?php echo $aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>>
  <label class="screen-reader-text" for="<?php echo $uid; ?>"><?php echo esc_html_x( 'Search for:', 'label', 'understrap' ); ?></label>
  <div class="input-group">
    <input type="search" class="field search-field form-control" id="<?php echo $uid; ?>" minlength="2"
					 name="s" value="<?php the_search_query(); ?>"
					 onkeyup="wp_ajax_live_search(this)"
					 placeholder="<?php echo esc_attr_x( 'Start Typing to Search &hellip;', 'placeholder', 'understrap' ); ?>">
  </div>
	<ul id="ajax-search-results"
			data-error="<?php _e('Something went wrong. Please try again or refresh the page', 'wp-theme'); ?>"
			data-message="<?php _e('Please enter at least 2 characters', 'wp-theme'); ?>" class="list-unstyled m-0 font-secondary"></ul>
</form>