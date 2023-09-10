<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

	<div id="template-about" class="main-area-padding">
		<main id="main" class="site-main">
			<div class="container-xl">
				<div class="row">

					<div class="col-lg-8 mb-5 mb-lg-0">
						<?php while ( have_posts() ) { the_post(); ?>
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

								<header id="page-header">
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								</header><!-- .entry-header -->
								
								<?php if ( has_post_thumbnail() ) : ?>
									<aside id="media-image-mobile" role="region" aria-label="Sidebar Element"
												 class="widget rounded-3 font-secondary bg-light-gray border fs-4 widget_media_image d-lg-none">
										<?php the_post_thumbnail('full', array( 'loading' => 'eager', 'class' => 'img-fluid image' )); ?>
									</aside>
								<?php endif; ?>
								
								<div class="entry-content mobile-content-sm-size">
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