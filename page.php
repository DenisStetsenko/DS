<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages'
 * on your WordPress site will use a different template.
 */
get_header(); ?>

<div class="wrapper" id="default-page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <main class="site-main section-margin" id="main">

          <?php
          while ( have_posts() ) {
            the_post();
            get_template_part( 'template-parts/loop-templates/content', 'page' );
          }
          ?>

        </main><!-- #main -->
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>