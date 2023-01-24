<?php
defined( 'ABSPATH' ) || exit;
/**
 * Sidebar
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 */
if ( ! is_active_sidebar( 'right-sidebar' ) ) {
  return;
}

if ( is_active_sidebar('right-sidebar') ) dynamic_sidebar('right-sidebar');
