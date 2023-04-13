<?php
/**
 * Single
 *
 * Default post template for Review layout
 */
get_header(); ?>

  <div id="single-article-template" class="post-review-layout main-area-padding">
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
							<div id="right-sidebar" class="position-relative">
								<div class="sticky-top wow fadeInUp" data-wow-delay="50ms">
							  	<?php dynamic_sidebar( 'review-sidebar' ); ?>
								</div>
							</div>
					  <?php } ?>
					</div>

				</div>
			
			  <?php get_template_part('template-parts/single-article/related-posts'); ?>

			</div>

		</main><!-- #main -->
  </div>

<?php get_footer(); ?>