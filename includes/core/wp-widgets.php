<?php
/**
 * Register Sidebars
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_widgets_init' ) ) {
	function wp_custom_theme_widgets_init() {
		
		register_sidebar( array(
			'id'            => 'review-sidebar',
			'name'          => __( 'Review Sidebar', 'wp-theme' ),
			'description'   => __( 'This sidebar is located on the right-hand side of Review Single Post.', 'wp-theme' ),
			'before_widget' => '<aside role="region" aria-label="Sidebar Element" class="widget rounded %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="w-title">',
			'after_title'   => '</h3>',
		) );
		
		
		register_sidebar( array(
			'id'            => 'comparison-sidebar',
			'name'          => __( 'Comparison Sidebar', 'wp-theme' ),
			'description'   => __( 'This sidebar is located on the right-hand side of Comparison Single Post.', 'wp-theme' ),
			'before_widget' => '<aside role="region" aria-label="Sidebar Element" class="widget rounded %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="w-title">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'id'            => 'archive-sidebar',
			'name'          => __( 'Archive Sidebar', 'wp-theme' ),
			'description'   => __( 'This sidebar is located on the right-hand side of Archive page.', 'wp-theme' ),
			'before_widget' => '<aside role="region" aria-label="Sidebar Element" class="widget rounded %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="w-title">',
			'after_title'   => '</h3>',
		) );
		
	}
}
add_action( 'widgets_init', 'wp_custom_theme_widgets_init' );
