<?php
/**
 * Front page template.
 * USE Settings->Reading and set up Front Page.
 */
get_header(); ?>

  <div class="wrapper" id="front-page-wrapper">
		<main class="site-main" id="main">
		
		  <?php
		  while ( have_posts() ) {
			  the_post();
			  //get_template_part( 'template-parts/front-page/content' );
		  }
		  ?>

		</main><!-- #main -->
  </div>

<?php get_footer(); ?>