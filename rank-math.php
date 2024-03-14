<?php
/**
 * https://rankmath.com/kb/filters-hooks-api-developer/
 */

/**
 * Filter code to remove noopener rel from external links.
 */
add_filter( 'rank_math/noopener', '__return_false');


/**
 * Disable Gutenberg Sidebar Integration
 * Use this filter to remove Rank Math integration from the Gutenberg Sidebar and add old meta boxes below the content area.
 */
add_filter( 'rank_math/gutenberg/enabled', '__return_false' );


/**
 * Filter if XML sitemap transient cache is enabled.
 * https://rankmath.com/kb/exclude-sitemaps-from-caching/#transient-cache
 * @param boolean $unsigned Enable cache or not, defaults to true
 */
add_filter( 'rank_math/sitemap/enable_caching', '__return_false');


/**
 * Filter to remove `rank-math-link` class from the frontend content links
 */
add_filter( 'rank_math/link/remove_class', '__return_true' );


/**
 * RankMath Remove rel="nofollow" and rel="sponsored" checkboxes from ACF Link Popup
 */
add_action('admin_enqueue_scripts', function (){
	// Simply hide them and think of better solution.
	$custom_css = "
								#wp-link-wrap .link-target{ display: block; }
								#wp-link-wrap .link-nofollow{ display: none; }
                #wp-link-wrap .link-sponsored{ display: none; }
                ";
	
	wp_add_inline_style( 'rank-math-common', $custom_css );
}, 999 );


/**
 * Filter to change review snippet HTML
 * https://rankmath.com/kb/filters-hooks-api-developer/#change-review-snippet-html
 *
 * @param string $html.
 */
add_filter( 'rank_math/snippet/html', function( $html ) {
	return $html;
});