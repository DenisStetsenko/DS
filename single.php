<?php
/**
 * Single
 *
 * Default post template for Products Comparison layout
 */
get_header(); ?>

  <div id="single-article-template" class="post-comparison-layout section-padding">
		<main id="main" class="site-main">

			<div class="container">
				
				<?php get_template_part('template-parts/single-article/post-categories'); ?>
				<?php get_template_part('template-parts/single-article/entry-header'); ?>
				
				<div class="row">
					<div class="col-lg-8">
						<?php
							while ( have_posts() ) {
								the_post();
								get_template_part( 'template-parts/loop-templates/content-single', 'comparison' );
							}
						?>
					</div>
	
					<div class="col-lg-4">
						<?php if ( is_active_sidebar( 'comparison-sidebar' ) ) { ?>
							<aside id="right-sidebar" class="ps-lg-4">
								<?php dynamic_sidebar( 'comparison-sidebar' ); ?>
							</aside>
						<?php } ?>
					</div>
	
				</div>
				
				<?php get_template_part('template-parts/single-article/related-posts'); ?>
				
			</div>
			
		</main><!-- #main -->
  </div>

<?php get_footer(); ?>