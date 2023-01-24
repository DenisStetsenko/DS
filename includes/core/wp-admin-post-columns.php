<?php
// Register the columns.
add_filter( "manage_post_posts_columns", function ( $columns ) {
	
	unset($columns['title']);
	unset($columns['author']);
	unset($columns['categories']);
	unset($columns['comments']);
	unset($columns['date']);
	unset($columns['tags']);
	
	
	return array_merge ( $columns, array (
		'title'       => __ ('Title'),
		'author'      => __ ('Author'),
		'post-layout' => __ ('Layout'),
		'categories'  => __ ('Categories'),
		'date'        => __('Date')
//		'designation' => __ ( 'Designation' ),
//		'image'       => __ ( 'Image' ),
	) );
	
	
	
	//$columns['post-layout'] = 'Layout';
	
	return $columns;
} );

// Handle the value for each of the new columns.
add_action( "manage_post_posts_custom_column", function ( $column_name, $post_id ) {
	
	
	if ( $column_name == 'post-layout' ) {
		echo '<style>#post-layout{ width: 60px; text-align: center }
 								 #post-layout .column-thumb img{ max-width: 100%; height: auto }
 								 .post-layout.column-post-layout { text-align: center }
          </style>';
		$template = get_post_meta( $post_id, '_wp_page_template', true );
		
		if ( $template === 'default' || $template === '' ) {
			$icon = '<span class="dashicons dashicons-image-flip-horizontal"></span>';
		} else {
			$icon = '<span class="dashicons dashicons-table-col-before"></span>';
		}
		
		// Display an ACF field
		//echo get_field( 'my_acf_field', $post_id );
		echo $icon;
	}
	
}, 10, 2 );