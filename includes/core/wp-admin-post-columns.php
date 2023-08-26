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
		'post-layout' => __ ('Layout'),
		'categories'  => __ ('Categories'),
		'date'        => __('Date'),
		'author'      => __ ('Author'),
//	'designation' => __ ( 'Designation' ),
//	'image'       => __ ( 'Image' ),
	) );
	
} );


// Handle the value for each of the new columns.
add_action( "manage_post_posts_custom_column", function ( $column_name, $post_id ) {
	
	if ( $column_name == 'post-layout' ) {
		$template = get_post_meta( $post_id, '_wp_page_template', true );
		if ( $template === 'default' || $template === '' ) {
			$icon = '<span class="informational-post-layout" style="color: #a225ea; font-weight: 600">Info Post</span>';
		} else {
			$icon = '<span class="list-post-layout" style="color: #11b264; font-weight: 600">List Post</span>';
		}
		
		// Display an ACF Icon field
		echo $icon;
	}
	
}, 10, 2 );


add_action( 'admin_print_styles-edit.php', function() {
	echo '<style>.fixed #author.column-author{ width: 70px; }
							 .fixed #categories.column-categories{ width: 8% }
							 .fixed #post-layout.column-post-layout{ width: 8%; text-align: center }
 								 #post-layout .column-thumb img{ max-width: 100%; height: auto }
 								 .post-layout.column-post-layout { text-align: center }
        </style>';
} );