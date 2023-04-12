<?php
/**
 * Front page template.
 * USE Settings->Reading and set up Front Page.
 */
get_header(); ?>

  <div id="front-page-wrapper">
		<main class="site-main" id="main">
		
			<?php get_template_part('template-parts/front-page/hero-intro'); ?>
			<?php get_template_part('template-parts/front-page/the-process'); ?>
			<?php get_template_part('template-parts/front-page/testimonials'); ?>
			<?php get_template_part('template-parts/front-page/latest-articles'); ?>
			
		</main><!-- #main -->
  </div>

<?php get_footer(); ?>