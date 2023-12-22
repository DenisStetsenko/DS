<?php
/**
 * ACF Options
 ***********************************************************************************************************************/
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title'  => 'General Settings',
		'menu_title'  => 'Theme Settings',
		'menu_slug'   => 'theme-general-settings',
		'capability'  => 'edit_posts',
		'parent_slug' => '',
		'redirect'    => false
	) );
	
	acf_add_options_sub_page( array(
		'page_title'  => 'Header Notifications Bar',
		'menu_title'  => 'Notifications Bar',
		'parent_slug' => 'theme-general-settings',
	) );
	
}

/**
 * Register ACF Blocks
 * @return void
 */
function wp_custom_acf_register_acf_blocks() {
	/**
	 * We register our block's with WordPress's handy
	 * register_block_type();
	 * text, media, design, widgets, theme, embed
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 * https://www.advancedcustomfields.com/resources/acf-blocks-key-concepts/#block-variables-or-parameters-for-callbacks-in-php
	 */
	register_block_type( __DIR__ . '/blocks/faqs' );
	register_block_type( __DIR__ . '/blocks/top-products' );
	register_block_type( __DIR__ . '/blocks/product-card' );
	register_block_type( __DIR__ . '/blocks/pros-cons' );
	
}
add_action( 'init', 'wp_custom_acf_register_acf_blocks' );

function get_spacing_value( $spacing_value ) {
	// Used following code as reference: https://github.com/WordPress/gutenberg/blob/cff6d70d6ff5a26e212958623dc3130569f95685/lib/block-supports/layout.php/#L219-L225.
	if ( is_string( $spacing_value ) && str_contains( $spacing_value, 'var:preset|spacing|' ) ) {
		$spacing_value = str_replace( 'var:preset|spacing|', '', $spacing_value );
		return sprintf( 'var(--wp--preset--spacing--%s)', $spacing_value );
	}
	
	return $spacing_value;
}

/**
 * ACF BUTTON
 * Usage: acf_link(get_field('button'), 'extra-class-name');
 ************************************************************************************************************************/
if ( ! function_exists( 'acf_link' ) ) {
	function acf_link( $acf_field = null, $class = 'btn' ) {
		$link = '';
		
		if ($acf_field) {
			$target = !empty($acf_field['target']) ? 'target="_blank" rel="noopener"' : '';
			$link = sprintf(
				'<a class="%s" href="%s" data-acf="button" %s>%s</a>',
				esc_attr($class), esc_url($acf_field['url']), $target, wp_kses_post($acf_field['title'])
			);
		}
		
		return $link;
	}
}

/**
 * ACF JSON settings
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_acf_json_load_point' ) ) {
	function wp_custom_acf_json_load_point( $paths ) {
		unset( $paths[0] );
		$paths[] = get_stylesheet_directory() . '/includes/acf/acf-json';
		
		return $paths;
	}
	
	add_filter( 'acf/settings/load_json', 'wp_custom_acf_json_load_point' );
}

if ( ! function_exists( 'wp_custom_acf_json_save_point' ) ) {
	function wp_custom_acf_json_save_point( $path ) {
		$path = get_stylesheet_directory() . '/includes/acf/acf-json';
		
		return $path;
	}
	
	add_filter( 'acf/settings/save_json', 'wp_custom_acf_json_save_point' );
}


/**
 * Google Map API for ACF PRO
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_acf_init' ) ) {
	function wp_custom_acf_init() {
		$google_map_api = get_field( 'google_map_api', 'option' );
		if ( $google_map_api ) {
			acf_update_setting( 'google_api_key', $google_map_api );
		}
	}
}
add_action( 'acf/init', 'wp_custom_acf_init' );


/**
 * Update User Profile to use ACF image instead of Gravatar
 *
 * @param $avatar
 * @param $id_or_email
 * @param $size
 * @param $default
 * @param $alt
 *
 * @return mixed|string
 */
function wp_custom_change_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	global $pagenow;
	
	// user listing page
	if ( $pagenow == 'users.php' || $pagenow == 'profile.php' ) {
		
		//If is email, try and find user ID
		if ( ! is_numeric( $id_or_email ) && is_email( $id_or_email ) ) {
			$user = get_user_by( 'email', $id_or_email );
			if ( $user ) {
				$id_or_email = $user->ID;
			}
		}
		
		//if not user ID, return
		if ( ! is_numeric( $id_or_email ) ) {
			return $avatar;
		}
		
		//Find ID of attachment saved ACF meta
		$saved = get_user_meta( $id_or_email, 'author_photo', true );
		
		if ( 0 < absint( $saved ) ) {
			//return saved image
			return wp_get_attachment_image( $saved, [ $size, $size ], false, [ 'alt' => $alt ] );
		}
		
	}
	
	return $avatar;
	
}

add_filter( 'get_avatar', 'wp_custom_change_avatar', 10, 5 );


/**
 * ACF Reading time calculator
 * Thanks to: https://nicklewis.dev/how-to-create-a-reading-timer-from-acf-pro-flexible-content/
 */
if ( ! function_exists( 'acf_reading_time' ) ) {
	function acf_reading_time() {
		
		$the_post_ID      = get_the_ID();
		$total_word_count = 0; // Establish the total word count
		
		$post        = get_post( $the_post_ID ); // specific post
		$the_content = apply_filters( 'the_content', $post->post_content );
		
		
		// get total words count from default content
		if ( '' !== $the_content ) {
			$total_word_count = $total_word_count + str_word_count( strip_tags( $the_content ) );
		}
		
		
		// Replace 'flexible_content' with your custom field
		$all_fields = get_field( 'summary_list', $the_post_ID, true ); // Get the flexible content meta field name
		if ( $all_fields ) {
			foreach ( $all_fields as $field ) { // Loop the flexible content fields
				foreach ( $field as $key => $value ) { // Loop the fields by $key => $value
					
					// skip everything except main content
					if ( $key !== 'content' ) {
						continue;
					}
					
					// get total words count
					$total_word_count = $total_word_count + str_word_count( strip_tags( $value ) );
				}
			}
		}
		
		$readingtime = ceil( $total_word_count / 230 ); // 200-240 for regular reader.
		
		if ( $readingtime <= 1 ) { // If the reading time is equal to or less than 1
			$timer = " minute";
		} else {
			$timer = " minutes";
		}
		
		if ( $readingtime == 0 ) { // if the reading time equals 0 then change it to 1
			if ( is_singular('post') ) {
				$totalreadingtime = '<span class="total-reading-time">Reading time: 0 '.$timer.'</span>';
			} else {
				$totalreadingtime = '<span class="total-reading-time">0 '.$timer.' read</span>';
			}
		}
		else {
			if ( is_singular('post') ) {
				$totalreadingtime = '<span class="total-reading-time">Reading time: '. $readingtime . $timer . '</span>';
			} else {
				$totalreadingtime = '<span class="total-reading-time">'. $readingtime . $timer . ' read</span>';
			}
		}
		
		return $totalreadingtime;
	}
}
add_shortcode( 'acf-reading-time', 'acf_reading_time' );


/**
 * ACF Reading time calculator
 * Thanks to: https://nicklewis.dev/how-to-create-a-reading-timer-from-acf-pro-flexible-content/
 */
if ( ! function_exists( 'wp_reading_time' ) ) {
	function wp_reading_time() {
		
		$the_post_ID      = get_the_ID();
		$total_word_count = 0; // Establish the total word count
		
		$post        = get_post( $the_post_ID ); // specific post
		$the_content = apply_filters( 'the_content', $post->post_content );
		
		// make sure the content is not empty
		if ( '' !== $the_content ) {
			
			// get total words count
			$total_word_count = $total_word_count + str_word_count( strip_tags( $the_content ) );
			
			$readingtime = ceil( $total_word_count / 230 ); // 200-240 for regular reader.
			
			if ( $readingtime <= 1 ) { // If the reading time is equal to or less than 1
				$timer = " minute";
			} else {
				$timer = " minutes";
			}
			
			if ( $readingtime == 0 ) { // if the reading time equals 0 then change it to 1
				if ( is_singular('post') ) {
					$totalreadingtime = '<span class="total-reading-time">Reading time: 0 '.$timer.'</span>';
				} else {
					$totalreadingtime = '<span class="total-reading-time">0 '.$timer.' read</span>';
				}
			}
			else {
				if ( is_singular('post') ) {
					$totalreadingtime = '<span class="total-reading-time">Reading time: '. $readingtime . $timer . '</span>';
				} else {
					$totalreadingtime = '<span class="total-reading-time">'. $readingtime . $timer . ' read</span>';
				}
			}
			
			return $totalreadingtime;
		}
	}
}
add_shortcode( 'wp-reading-time', 'wp_reading_time' );