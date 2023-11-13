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