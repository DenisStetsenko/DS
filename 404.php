<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>
	<style>
		#wrapper{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
		}
	</style>
  <div id="404-page-wrapper" class="section-padding flex-grow-1">
    <div class="container">
      <div class="row align-items-center">

				<div class="col-lg-7 text-center order-lg-2 mb-8 mb-lg-0">
					<header class="section-title">
						<h1 class="page-title mb-2" style="font-size: 120px"><?php esc_html_e( '404', 'wp-theme' ); ?></h1>
						<h2 class="page-subtitle"><?php esc_html_e( 'Page Not Found', 'wp-theme' ); ?></h2>
					</header><!-- .page-header -->

					<div class="error-404">
						<div class="entry-content mobile-content-sm-size">
							<p><?php esc_html_e( "The page you're looking for can not be found.", "wp-theme" ); ?></p>
						</div><!-- .page-content -->
					</div><!-- .error-404 -->
				</div>
				
				<div class="col-lg-5 order-lg-1 text-center text-lg-start pe-lg-0">
					<img src="<?= get_theme_file_uri('assets/images/404.svg'); ?>" class="img-fluid not-found-img px-4 px-lg-0" alt="<?php esc_html_e( '404 Not Found Image', 'wp-theme' ); ?>">
				</div>
				
				
      
      </div>
    </div>
  </div>


<?php get_footer();