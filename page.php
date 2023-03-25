<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages'
 * on your WordPress site will use a different template.
 */
get_header(); ?>

<div id="default-page-wrapper" class="section-padding">
	<main id="main" class="site-main">
		<div class="container">
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/loop-templates/content', 'page' );
			}
			?>
		</div>
	</main>
</div>

<?php get_footer(); ?>