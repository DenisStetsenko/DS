<?php
/**
 * Template Name: Comparison Layout
 * Template Post Type: post
 * Default post template for Comparison layout
 */
get_header(); ?>

	<div id="single-article-template" class="post-comparison-layout main-area-padding">
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
