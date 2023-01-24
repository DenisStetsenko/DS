<?php
/**
 * Filter the output of Yoast breadcrumbs so each item is an <li> with schema markup
 * @param $link_output
 * @param $link
 *
 * @return string
 */
function wp_custom_filter_yoast_breadcrumb_items( $link_output, $link ) {
	
		$new_link_output = '';
		
		if( ! str_contains( $link_output, 'breadcrumb_last' ) ) {
			$new_link_output .= '<li class="breadcrumb-item">';
			$new_link_output .= '<a href="' . $link['url'] . '" itemprop="url"><span property="name">' . $link['text'] . '</span></a>';
		}
// COMMENT else{} to HIDE PAGE TITLE FROM BREADCRUMBs
//		else {
//			$new_link_output .= '<li class="breadcrumb-item active" aria-current="page">';
//			$new_link_output .= $link['text'];
//		}
	$new_link_output .= '</li>';
	
	return $new_link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'wp_custom_filter_yoast_breadcrumb_items', 10, 2 );


/**
 * Filter the output of Yoast breadcrumbs to remove <span> tags added by the plugin
 * @param $output
 *
 * @return
 */
function wp_custom_filter_yoast_breadcrumb_output( $output ){
	
	$from = '<span>';
	$to = '</span>';
	$output = str_replace( $from, $to, $output );
	
	return $output;
}
add_filter( 'wpseo_breadcrumb_output', 'wp_custom_filter_yoast_breadcrumb_output' );

/**
 * Disable default separators
 * @param $separator
 *
 * @return false
 */
function wp_custom_filter_wpseo_breadcrumb_separator( $separator ) {
	return false;
}
add_filter( 'wpseo_breadcrumb_separator', 'wp_custom_filter_wpseo_breadcrumb_separator' );