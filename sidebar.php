<?php
/**
 * Sidebar
 *
 * Content for our sidebar, provides prompt for logged in users to create widgets
 */
?>

<div id="right-sidebar" class="position-relative flex-grow-1 ps-xxl-3">
	<div class="sticky-top">
		<?php
		if ( is_single() && 'post' == get_post_type() && is_page_template('single-comparison-template.php') && is_active_sidebar( 'comparison-sidebar' ) ) {
			dynamic_sidebar( 'comparison-sidebar' );
		}
		elseif ( is_single() && 'post' == get_post_type() && is_active_sidebar( 'review-sidebar' ) ) {
			dynamic_sidebar( 'review-sidebar' );
		}
		elseif ( is_page_template('template-about.php') && is_active_sidebar( 'about-page-sidebar' ) ) {
			
			if ( has_post_thumbnail() ) : ?>
			<aside id="media-image" role="region" aria-label="Sidebar Element"
					 class="widget widget_media_image border d-none d-lg-block">
				<figure class="image-container">
					<?php the_post_thumbnail('full', array( 'loading' => 'eager', 'class' => 'loading-image img-fluid image' )); ?>
				</figure>
			</aside>
		<?php endif;
			dynamic_sidebar( 'about-page-sidebar' );
		}
		elseif ( 'page' == get_post_type() && is_active_sidebar( 'page-sidebar' ) ) {
			dynamic_sidebar( 'page-sidebar' );
		}
		?>
	</div>
</div>