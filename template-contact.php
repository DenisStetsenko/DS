<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

	<div id="template-contact" class="main-area-padding">
		<main id="main" class="site-main">
			<div class="container">
				
				<div class="row">
					<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
						<?php
						while ( have_posts() ) { the_post();
							get_template_part( 'template-parts/loop-templates/content', 'page' );
						}
						echo '<div class="wow fadeInUp" data-wow-duration="300ms">';
							echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');
						echo '</div>';
						?>
					</div>
				</div>
			</div>
		</main>
	</div>

<?php get_footer();