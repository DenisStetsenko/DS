<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

	<div id="template-contact" class="main-area-padding position-relative z-1">
		<main id="main" class="site-main">
			<div class="container">

				<header id="page-header" class="disable-highlight text-center">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				
				<div class="row">
					<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
						<?php
						while ( have_posts() ) { the_post(); ?>
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								
								<div class="entry-content mobile-content-sm-size text-center">
									<?php the_content();?>
								</div><!-- .entry-content -->

							</article>
						<?php }
						//echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');
						?>
					</div>
				</div>
				
			</div>
		</main>
	</div>

<?php get_footer();