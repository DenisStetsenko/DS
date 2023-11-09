<main id="main" class="site-main">
	
	<div class="single-entry-heading bg-light-gray">
		<div class="container-xl">
			<?php get_template_part('template-parts/single-article/entry-header'); ?>
		</div>
	</div>
	
	<?php get_template_part('template-parts/single-article/breadcrumbs'); ?>
	
	<div class="single-entry-body">
		<div class="container-xl">
			<?php get_template_part('template-parts/single-article/post-categories'); ?>
			
			<div class="row">
				<div class="col-lg-8">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/loop-templates/content', 'single' );
					}
					?>
				</div>
				
				<div class="col-lg-4 d-none d-lg-flex">
					<?php get_sidebar(); ?>
				</div>
			</div>
			
			<?php get_template_part('template-parts/single-article/related-posts'); ?>
			<?php get_template_part('template-parts/single-article/comments-form'); ?>
		
		</div>
	</div>

</main><!-- #main -->