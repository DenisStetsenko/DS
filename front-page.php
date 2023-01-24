<?php
defined( 'ABSPATH' ) || exit;
/**
 * Front page template.
 * USE Settings->Reading and set up Front Page.
 */
get_header(); ?>

  <div class="wrapper" id="front-page-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <main class="site-main" id="main">
						
            <?php
            while ( have_posts() ) {
              the_post();
              get_template_part( 'template-parts/front-page/content' );
            }
            ?>

          </main><!-- #main -->
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>