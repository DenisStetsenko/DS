<?php
/**
 * Sidebar
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 */
?>

<div id="right-sidebar" class="position-relative">
	<div class="sticky-top wow fadeInUp" data-wow-delay="100ms" data-wow-duration="700ms">
		<?php
		if ( is_single() && 'post' == get_post_type() && is_page_template('single-comparison-template.php') && is_active_sidebar( 'comparison-sidebar' ) ) {
			dynamic_sidebar( 'comparison-sidebar' );
		}
		elseif ( is_single() && 'post' == get_post_type() && is_active_sidebar( 'review-sidebar' ) ) {
			dynamic_sidebar( 'review-sidebar' );
		}
		elseif ( 'page' == get_post_type() && is_active_sidebar( 'page-sidebar' ) ) {
			dynamic_sidebar( 'page-sidebar' );
		}
		?>
	</div>
</div>



