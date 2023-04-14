<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages'
 * on your WordPress site will use a different template.
 */
get_header(); ?>

<div id="default-page-wrapper" class="main-area-padding">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-8">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/loop-templates/content', 'page' );
					}
					?>
				</div>
				
				<div class="col-lg-4 d-flex">
					<?php get_sidebar(); ?>
				</div>
				
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>