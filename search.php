<?php
defined( 'ABSPATH' ) || exit;
/**
 * The template for displaying search results pages
 *
 */
get_header(); ?>

  <div class="wrapper" id="search-wrapper">
    <div class="container" id="content" tabindex="-1">

      <div class="row">

        <div class="col-lg-8">
          <main class="site-main" id="main">

            <?php if ( have_posts() ) : ?>

              <header class="page-header">
                <h1 class="page-title">
                  <?php printf( esc_html__( 'Search Results for: %s', 'wp-theme' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
              </header><!-- .page-header -->

              <?php while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/loop-templates/content', 'search' );
              endwhile; ?>

            <?php else : ?>
              <?php get_template_part( 'template-parts/loop-templates/content', 'none' ); ?>
            <?php endif; ?>

          </main><!-- #main -->

          <?php bootstrap_pagination(); ?><!-- The pagination component -->
        </div>

        <div class="col-lg-4">
          <?php if ( is_active_sidebar( 'right-sidebar' ) ) { ?>
            <?php dynamic_sidebar( 'right-sidebar' ); ?>
          <?php } ?>
        </div>

      </div><!-- .row -->

    </div><!-- #content -->
  </div><!-- #search-wrapper -->

<?php get_footer();