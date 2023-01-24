<?php
/*
 * Template Name: Single Product Review
 * Template Post Type: post
 * Default post template for Single Product Review layout
 */
get_header();  ?>

<div id="single-article-template" class="post-review-layout section-padding">
	<main id="main" class="site-main">
		
		<div class="container">
			
			<?php get_template_part('template-parts/single-article/post-categories'); ?>
			<?php get_template_part('template-parts/single-article/entry-header'); ?>
			
			<div class="row">
				<div class="col-lg-8">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/loop-templates/content-single', 'review' );
					}
					?>
				</div>
				
				<div class="col-lg-4 d-flex">
					<?php if ( is_active_sidebar( 'review-sidebar' ) ) { ?>
						<aside id="right-sidebar" class="ps-lg-4 flex-grow-1 d-flex">
							<?php dynamic_sidebar( 'review-sidebar' ); ?>
						</aside>
					<?php } ?>
				</div>
			
			</div>
			
			<?php get_template_part('template-parts/single-article/related-posts'); ?>
		
		</div>
	
	</main><!-- #main -->
</div>

<?php get_footer(); ?>
