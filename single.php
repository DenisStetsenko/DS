<?php
/**
 * Single
 *
 * Default post template for Review layout
 */
get_header(); ?>

  <div id="single-article-template" class="post-review-layout main-area-padding pt-0">
		<main id="main" class="site-main">

			<div class="single-entry-heading bg-light-gray">
				<div class="container">
					<?php get_template_part('template-parts/single-article/post-categories'); ?>
					<?php get_template_part('template-parts/single-article/entry-header'); ?>
				</div>
			</div>
			
			<div class="container">
				
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
						<?php get_sidebar(); ?>
					</div>

				</div>
			
			  <?php get_template_part('template-parts/single-article/related-posts'); ?>
			  <?php get_template_part('template-parts/single-article/comments-form'); ?>

			</div>

		</main><!-- #main -->
  </div>

<?php get_footer(); ?>