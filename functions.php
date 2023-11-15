<?php
/**
 * Included Files
 ***********************************************************************************************************************/
// Run Theme Setup Functions
include get_theme_file_path('/includes/core/theme-setup.php');

// Load WordPress Security Updates
include get_theme_file_path('/includes/core/wp-security.php');

// Load WordPress Enchantments
include get_theme_file_path('/includes/core/wp-enchantments.php');

// Load Bootstrap Enchantments
include get_theme_file_path('/includes/core/bootstrap-helpers.php');

// Load custom WordPress nav walker.
include get_theme_file_path('/includes/core/bootstrap-navwalker.php');

// Load custom WordPress pagination.
include get_theme_file_path('/includes/core/bootstrap-pagination.php');

// Load ACF Functions
include get_theme_file_path('/includes/acf/acf-functions.php');

// Load WP Editor Customizer
include get_theme_file_path('/includes/core/wp-editor-customizer.php');

// Load WP Custom Shortcodes
include get_theme_file_path('/includes/core/wp-custom-shortcodes.php');

// Load WP Bootstrap Icons
include get_theme_file_path('/includes/core/wp-bootstrap-icons.php');

// Load WP Social Sare
include get_theme_file_path('/includes/core/wp-social-share.php');

// Load Custom WP Metaboxes
//include get_theme_file_path('/includes/core/wp-custom-metabox.php');

// Load Custom Post Types
include get_theme_file_path('/includes/core/custom-post-types.php');

// Load Widgets
include get_theme_file_path('/includes/core/wp-widgets.php');

// Load Custom Post Admin Columns
include get_theme_file_path('/includes/core/wp-admin-post-columns.php');


/**
 * Enqueue Scripts and Styles for Front-End
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_scripts_and_styles' ) ) {
  function wp_custom_scripts_and_styles(){

    wp_enqueue_script('jquery');
	  // Fix to: Does not use passive listeners to improve scrolling performance
		wp_add_inline_script( 'jquery',
			'jQuery.event.special.touchstart = {
				setup: function (_, ns, handle) {
					this.addEventListener("touchstart", handle, {passive: !ns.includes("noPreventDefault")});
				}
			};
			jQuery.event.special.touchmove = {
				setup: function (_, ns, handle) {
					this.addEventListener("touchmove", handle, {passive: !ns.includes("noPreventDefault")});
				}
			};
			jQuery.event.special.wheel = {
				setup: function (_, ns, handle) {
					this.addEventListener("wheel", handle, {passive: true});
				}
			};
			jQuery.event.special.mousewheel = {
				setup: function (_, ns, handle) {
					this.addEventListener("mousewheel", handle, {passive: true});
				}
			};'
	  );
		// END OF Fix to: Does not use passive listeners to improve scrolling performance
		
    // Remove Gutenberg Block Library CSS from loading on the frontend (we'll use own styles)
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
    wp_dequeue_style( 'classic-theme-styles' );
		
    if ( is_home() || is_archive() ) :
      wp_enqueue_script( 'ajax-pagination',  get_theme_file_uri('assets/scripts/ajax-load-more.js'), array( 'jquery' ), null, true );
      wp_localize_script( 'ajax-pagination', 'ajaxPagination', array(
          'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
          'protection'  => wp_create_nonce('wp-custom-key')
      ));
    endif;
		
		if ( is_singular('post') ) :
//			wp_enqueue_script( 'gumshoe', 'https://cdnjs.cloudflare.com/ajax/libs/gumshoe/5.1.1/gumshoe.min.js', array(), null, true ); // load in <footer>
//			wp_add_inline_script( 'gumshoe',
//				"document.addEventListener('DOMContentLoaded', () => {
//					const header 	= document.querySelector('#masthead');
//					const spy 		= new Gumshoe('#right-sidebar #ez-toc-container > nav a', {
//						nested	: true,
//						nestedClass	: 'active-parent',
//						reflow	: false,
//						offset: function () {
//							return header.getBoundingClientRect().height + 65;
//						}
//					});
//				});"
//			);
		
		
			// Fancybox Init
			wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/4.0.31/fancybox.min.css', null, array() );
			wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancyapps-ui/4.0.31/fancybox.umd.min.js', array(), null, true );
			wp_add_inline_script( 'fancybox',
				"document.addEventListener('DOMContentLoaded', () => {
					Fancybox.bind('[data-fancybox], .entry-content a[href$=\"png\"], .entry-content a[href$=\"jpg\"]', {
						infinite: false
					});
				});"
			);
		endif;
		
    wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js', array('jquery'), null, true );
	  wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true );

    //wp_enqueue_style( 'main', get_theme_file_uri('assets/styles/css/main.css'), array(), time() );
    wp_enqueue_style( 'main-min', get_theme_file_uri('assets/styles/css/main.min.css'), array(), '2.0.33' );
  }
}
add_action('wp_enqueue_scripts', 'wp_custom_scripts_and_styles' );

/**
 * Custom Logos for Light background
 * @param $wp_customize
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_customizer_custom_logo' ) ) {
  function wp_custom_customizer_custom_logo($wp_customize) {

    $wp_customize->add_setting('site_footer_logo', array(
        'sanitize_callback'     => '',
        'sanitize_js_callback'  => '',
        'type'                  => 'theme_mod'
    ) );
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_footer_logo', array(
        'label'     => __('Footer Logo', 'wp-theme'),
        'settings'  => 'site_footer_logo',
        'section'   => 'title_tagline',
        'priority'  => 9
    )));

  }
}
add_action('customize_register', 'wp_custom_customizer_custom_logo');

/**
 * Preload Local Google Fonts
 */
if ( ! function_exists( 'wp_custom_preload_local_fonts' ) ) {
	function wp_custom_preload_local_fonts() {
		$fonts = [
			'assets/fonts/lora/Lora-Regular.woff2',
			'assets/fonts/lora/Lora-Italic.woff2',
			'assets/fonts/lora/Lora-Medium.woff2',
			'assets/fonts/lora/Lora-MediumItalic.woff2',
			'assets/fonts/lora/Lora-SemiBold.woff2',
			'assets/fonts/lora/Lora-SemiBoldItalic.woff2',
			'assets/fonts/lora/Lora-Bold.woff2',
			'assets/fonts/lora/Lora-BoldItalic.woff2',
			'assets/fonts/inter/Inter-Light.woff2',
			'assets/fonts/inter/Inter-Regular.woff2',
			'assets/fonts/inter/Inter-Medium.woff2',
			'assets/fonts/inter/Inter-SemiBold.woff2',
			'assets/fonts/inter/Inter-Bold.woff2',
			'assets/fonts/inter/Inter-ExtraBold.woff2',
		];

		foreach ( $fonts as $font_url ) {
			echo '<link rel="preload" href="'. get_theme_file_uri($font_url) .'" as="font" type="font/woff2" crossorigin>';
		}
	}
}
add_action('wp_head', 'wp_custom_preload_local_fonts');


/**
 * INLINE SVG
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_svg_icon' ) ) {
	function wp_custom_svg_icon( $icon ) {
		if ( $icon ) {
			if ( strpos( $icon, '.svg' ) !== false ) {
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $icon);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
				$svg 			= curl_exec($ch);
				$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				
				curl_close($ch);
				
				if ( $httpcode == 200 ) {
					return $svg;
				} else {
					echo '<img class="img-fluid" src="'.$icon.'" alt="icon" />';
				}
				
			} else {
				return '<img src="' . $icon . '" alt="icon" />';
			}
		}
	}
}


/**
 * Ajax Load More
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_posts_ajax_pagination' ) ) {
  function wp_custom_posts_ajax_pagination() {
    check_ajax_referer('wp-custom-key', 'security');

    // Define args
    $layout   = isset($_POST['layout']) 	? $_POST['layout'] : '3-cols';
    $ppp      = isset($_POST['ppp']) 			? $_POST['ppp'] : get_option('posts_per_page');
    $cat      = isset($_POST['cat']) 			? $_POST['cat'] : '';
    $offset   = isset($_POST['offset']) 	? $_POST['offset'] : get_option('posts_per_page');
    $year     = isset($_POST['year']) 		? $_POST['year'] : '';
    $monthnum = isset($_POST['monthnum']) ? $_POST['monthnum'] : '';
    $type     = isset($_POST['type']) 		? $_POST['type'] : '';

    $args = [];
    $args['post_type']      = 'post';
    $args['post_status']    = 'publish';
    $args['order']          = 'DESC';
    $args['orderby']        = 'date';
    $args['posts_per_page'] = $ppp;
    $args['offset']         = $offset;


    // Run WP_Query for BLOG posts
    if ($type == 'blog') {

      // if BLOG page DO NOT categorize output, just load all posts
      if ($cat !== 'all' && $cat !== '') $args['category_name'] = $cat;

			
      // if Search Results
      if ($year && $monthnum !== '') {
        $args['year']     = (int)$year;
        $args['monthnum'] = (int)$monthnum;
      }

    }

    // Run WP_Query
    ob_start();

    $wp_query = new WP_Query($args);

    // get total posts
    $postsCount = $wp_query->post_count;
    $foundCount = $wp_query->found_posts;

    if ($wp_query->have_posts()) :
      while ($wp_query->have_posts()) : $wp_query->the_post();
	      get_template_part( 'template-parts/category/post-loop', 'item', array( 'layout' => $layout, 'include-author-block' => 1 ) );
      endwhile;
    endif;
    wp_reset_query();

    $response = array(
        'html' => ob_get_clean(),
      //'args' => $args,
        'type' => $type,
        'layout' => $layout,
        'count' => $postsCount,
        'found' => $foundCount,
        'isLastPage' => $postsCount < $ppp
    );

    wp_send_json_success($response);
    wp_die();

  }

  add_action('wp_ajax_nopriv_load_more_pagination', 'wp_custom_posts_ajax_pagination');
  add_action('wp_ajax_load_more_pagination', 'wp_custom_posts_ajax_pagination');
}


/**
 * Remove "Category" from get_the_archive_title()
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );


/**
 * Custom get_author for Denis Stetsenko User
 */
if ( ! function_exists( 'wp_custom_the_author_posts_link' ) ) {
	function wp_custom_the_author_posts_link(){
		
		global $authordata;
		if ( ! is_object( $authordata ) ) {
			return '';
		}
		
		if ( $authordata->user_nicename == 'denis_admin' ) {
			$user_nicename = $authordata->nickname;
		} else {
			$user_nicename = $authordata->user_nicename;
		}
		
		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author" class="test">%3$s</a>',
			esc_url( get_author_posts_url( $authordata->ID, $user_nicename ) ),
			/* translators: %s: Author's display name. */
			esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ),
			get_the_author()
		);
		
		return $link;
	}
	//add_filter( 'the_author_posts_link', 'wp_custom_the_author_posts_link' );
}


/**
 * “indicates required fields” - How to hide it?
 */
add_filter( 'gform_required_legend', '__return_empty_string' );


/**
 * Popup Ajax Search
 */
function wp_ajax_live_search(){
	
	if ( ! check_ajax_referer( 'wp-denstetsenko-key', 'security', false ) ) {
		wp_send_json_error( 'Invalid Request' );
		return;
	}
	
	$args = [];
	$args['post_type']      = 'post';
	$args['post_status']    = 'publish';
	$args['order']          = 'DESC';
	$args['orderby']        = 'date';
	$args['posts_per_page'] = 7;
	$args['s']              = sanitize_text_field( $_POST['keyword'] );
	
	$wp_query = new WP_Query($args);
	
	ob_start();
	
	$foundCount = $wp_query->found_posts;
	
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			<li class="list-item font-secondary"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
		<?php endwhile;
	else : ?>
		<li class="list-item font-secondary text-center text-danger"><?php _e('Sorry, nothing was found.', 'wp-theme') ?></li>
	<?php endif;
	
	wp_reset_query();
	
	$response = array(
		'found'	=> $foundCount,
		'html' 	=> ob_get_clean(),
	);
	
	wp_send_json_success($response);
	wp_die();
}
add_action('wp_ajax_wp_ajax_live_search_data_fetch' , 'wp_ajax_live_search');
add_action('wp_ajax_nopriv_wp_ajax_live_search_data_fetch','wp_ajax_live_search');


/**
 * Custom Table of Content based on "Easy Table of Contents" plugin
 */
function cs_toc($atts){
	global $post;
	
	$atts = shortcode_atts( array(
		'navid' => 'ez-toc-nav',
	), $atts, 'cs-toc' );
	
	$the_content 				= get_post_field('post_content', $post->ID);
	$summary_list 			= get_field('summary_list', $post->ID);
	$product_list_intro = get_field('product_list_intro', $post->ID);
	
	ob_start();
	
	if ( $summary_list && array_filter($summary_list) ) :
		echo '<div id="ez-toc-container" class="custom-ez-toc counter-hierarchy ez-toc-counter ez-toc-container-direction">
						<p class="ez-toc-title">Table of Contents</p>
						<nav id="'.esc_html($atts['navid']).'">
						<ul class="ez-toc-list ez-toc-list-level-1">';
		
						// Main Content
						if ( $the_content ) :
							preg_match_all('#<h2.*?>(.*?)</h2>#i',$the_content, $the_content_H2);
							foreach ($the_content_H2[1] as $h2) : ?>
								<li class="ez-toc-page-1 ez-toc-heading-level-2">
									<a class="ez-toc-link ez-toc-heading-1" href="#<?= sanitize_title_with_dashes($h2); ?>" title="<?= $h2; ?>"><?= $h2; ?></a>
								</li>
							<?php endforeach;
						endif;
	
						// Intro Content
						if ( $product_list_intro ) :
							preg_match_all('#<h2.*?>(.*?)</h2>#i',$product_list_intro, $product_list_intro_H2);
							foreach ($product_list_intro_H2[1] as $h2) : ?>
								<li class="ez-toc-page-1 ez-toc-heading-level-2">
									<a class="ez-toc-link ez-toc-heading-1" href="#<?= sanitize_title_with_dashes($h2); ?>" title="<?= $h2; ?>"><?= $h2; ?></a>
								</li>
							<?php endforeach;
							
							echo '<li class="ez-toc-page-1 ez-toc-heading-level-2">
											<ul class="ez-toc-list-level-3 offset-top add-counter">';
								$i = 1;
								foreach ( $summary_list as $summary_list_item ) : ?>
									<li class="ez-toc-heading-level-3">
										<a class="ez-toc-link ez-toc-heading-3" href="#try-<?= sanitize_title_with_dashes($summary_list_item['heading']['title']); ?>"
											 title="<?= $summary_list_item['heading']['title']; ?>"><?= $i .'. '.$summary_list_item['heading']['title']; ?></a>
									</li>
								<?php $i++; endforeach;
							echo 		'</ul>
										</li>';
							
						else :
							
							// NO INTRO h2
							$i = 1;
							foreach ( $summary_list as $summary_list_item ) : ?>
								<li class="ez-toc-page-1 ez-toc-heading-level-2">
									<a class="ez-toc-link ez-toc-heading-1" href="#try-<?= sanitize_title_with_dashes($summary_list_item['heading']['title']); ?>"
										 title="<?= $summary_list_item['heading']['title']; ?>"><?= $i .'. '.$summary_list_item['heading']['title']; ?></a>
								</li>
							<?php $i++; endforeach;
							
						endif;
						
						
		echo 	 '</ul>
						</nav>
					</div>';
	endif;
	
	return ob_get_clean();
}
add_shortcode('cs-toc', 'cs_toc');


/**
 * Simple function to replace headings with id='title'
 * @param $match
 *
 * @return string
 */
function retitle($match) {
	list( , $h2, $title) = $match;
	
	$id = sanitize_title_with_dashes($title);
	
	return "<$h2 id='$id' data-heading>$title</$h2>";
}


/**
 * TOC: Exclude by selector
 */
add_filter( 'ez_toc_exclude_by_selector', function( $selectors ) {
	$selectors['class'] = '.ez-toc-exclude';
	return $selectors;
});

/**
 * Add "wp-block-list" to the default List Block
 * Should not be necessary in future version of WP:
 * @see https://github.com/WordPress/gutenberg/issues/12420
 * @see https://github.com/WordPress/gutenberg/pull/42269
 */
add_filter( 'render_block', function( $block_content, $block ) {
	if ( 'core/list' === $block['blockName'] ) {
		$block_content = new WP_HTML_Tag_Processor( $block_content );
		$block_content->next_tag(); /* first tag should always be ul or ol */
		$block_content->add_class( 'wp-block-list' );
		$block_content->get_updated_html();
	}
	return $block_content;
}, 10, 2 );


/**
 * Prevent Affiliate Links From Getting Indexed In Search Engines
 * https://thirstyaffiliates.com/knowledgebase/how-to-prevent-affiliate-links-from-getting-indexed-in-search-engines
 * Add ‘noindex’ to HTTP headers on redirect
 * @return void
 */
function ta_add_noindex_headers() {
	header( 'X-Robots-Tag: noindex, nofollow' );
}
add_action( 'ta_before_link_redirect' , 'ta_add_noindex_headers' );


/**
 * thirstylink change Cloacked URL column width
 * @return void
 */
function thirstylink_cloaked_url_column_width() {
	$current_screen = get_current_screen();
	
	if ($current_screen && $current_screen->post_type === 'thirstylink') {
		echo '<style>
						#cloaked_url.manage-column { width: 30% }
					</style>';
	}
}
add_action('admin_head', 'thirstylink_cloaked_url_column_width');


/**
 * remove noreferrer on the frontend, but will still show in the editor
 */
add_filter('the_content', function ($content){
	$replace = array(" noreferrer" => "" ,"noreferrer " => "");
	return strtr($content, $replace);
}, 99);