<section id="front-hero-intro" class="section-padding bg-light-gray">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 wow fadeInUp" data-wow-delay="100ms">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/loop-templates/content', 'plain' );
				}
				?>
			</div>
			<div class="col-lg-5 ps-lg-8 text-lg-end">
				<?php if ( has_post_thumbnail() ) the_post_thumbnail('full', array( 'loading' => 'lazy', 'class' => 'img-fluid' )); ?>
			</div>
		</div>
	</div>
</section>