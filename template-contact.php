<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

	<div id="template-contact" class="section-padding">
		<main id="main" class="site-main">
			<div class="container">
				
				<div class="row">
					<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/loop-templates/content', 'page' );
						}
						?>
					</div>
				</div>
			</div>
		</main>
	</div>

<?php get_footer();