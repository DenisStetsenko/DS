<?php
function wp_custom_add_custom_box() {
	add_meta_box( 'wp-custom-layout', // Unique ID
						__( 'Post Layout', 'wp-theme' ), // Box title
								'wp_custom_metabox_render_html', // Content callback, must be of type callable
								'post', // Post type
								'side',	// Screen position
								'high' 	// Position priority
	);
}
add_action( 'add_meta_boxes', 'wp_custom_add_custom_box' );


function wp_custom_metabox_render_html( $post ) {
	// Add nonce for security and authentication.
	wp_nonce_field( 'wp_custom_nonce_action', 'wp_custom_nonce' );
	
	// Get Values
	if ( get_post_meta( $post->ID, '_wp_post_layout_meta_key', true ) ) {
		$value = get_post_meta( $post->ID, '_wp_post_layout_meta_key', true );
	} else {
		$value = 'comparison'; // define default value
	}
	?>

	<div id="post-layout-select" style="line-height: 2;">
		<fieldset>
			<legend class="screen-reader-text"><?php _e('Post Layout', 'wp-theme'); ?></legend>
			<input type="radio" name="wp_post_layout" class="post-format" id="wp-post-layout-comparison" value="comparison" <?php checked( $value, 'comparison' ); ?> required>
			<label for="wp-post-layout-comparison" class="post-format-icon dashicons-image-flip-horizontal"><?php _e('Products Comparison', 'wp-theme'); ?></label>
			<br>
			<input type="radio" name="wp_post_layout" class="post-format" id="wp-post-layout-review" value="review" <?php checked( $value, 'review' ); ?> required>
			<label for="wp-post-layout-review" class="post-format-icon dashicons-welcome-widgets-menus"><?php _e('Single Product Review', 'wp-theme'); ?></label>
		</fieldset>
	</div>
	<?php
}

function wp_custom_metabox_save_post_data( $post_id ) {
	
	// Add nonce for security and authentication.
	$nonce_name   = isset( $_POST['wp_custom_nonce'] ) ? $_POST['wp_custom_nonce'] : '';
	$nonce_action = 'wp_custom_nonce_action';
	
	// Check if nonce is valid.
	if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
		return;
	}
	
	// Check if user has permissions to save data.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	// Check if not an autosave.
	if ( wp_is_post_autosave( $post_id ) ) {
		return;
	}
	
	// Check if not a revision.
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}
	
	if ( isset( $_POST['post_type'] ) && 'post' === $_POST['post_type'] && array_key_exists( 'wp_post_layout', $_POST ) ) {
		// finally save post layout
		update_post_meta( $post_id, '_wp_post_layout_meta_key', $_POST['wp_post_layout'] );
	}
	
}
add_action( 'save_post', 'wp_custom_metabox_save_post_data' );