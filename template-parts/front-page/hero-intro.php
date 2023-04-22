<div id="front-hero-intro" class="bg-light-gray">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 mb-6 mb-lg-0 text-center text-lg-start wow fadeInUp" data-wow-delay="100ms" data-wow-duration="700ms">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/loop-templates/content', 'plain' );
				}
				?>
			</div>
			<div class="col-lg-5 ps-lg-5 ps-xl-8 text-center text-lg-end">
				<?php if ( has_post_thumbnail() ) the_post_thumbnail('full', array( 'loading' => 'lazy', 'class' => 'img-fluid' )); ?>
			</div>
		</div>
	</div>
</div>