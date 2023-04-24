<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

	<div id="template-about" class="main-area-padding">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">

					<div class="col-lg-8 mb-5 mb-lg-0">
						<?php while ( have_posts() ) { the_post(); ?>
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

								<header id="page-header" class="text-center text-lg-start wow fadeIn" data-wow-delay="50ms" data-wow-duration="700ms">
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								</header><!-- .entry-header -->

								<?php if ( is_active_sidebar( 'about-page-mobile-sidebar' ) ) {
									dynamic_sidebar( 'about-page-mobile-sidebar' );
								}; ?>
								
								<div class="entry-content mobile-content-sm-size wow fadeIn" data-wow-delay="100ms" data-wow-duration="700ms">
									<?php the_content();?>
								</div><!-- .entry-content -->

							</article><!-- #post-## -->
						<?php } ?>
					</div>

					<div class="col-lg-4 d-flex">
						<?php get_sidebar(); ?>
					</div>

				</div>
			</div>
		</main>
	</div>

<?php get_footer();