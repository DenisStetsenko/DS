<div id="front-hero-intro" class="bg-light-gray">
	<div class="container-xl">
		<div class="row align-items-center">
			<div class="col-lg-7 mb-6 mb-lg-0 text-center text-lg-start">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/loop-templates/content', 'plain' );
				}
				?>
			</div>
			<div class="col-lg-5 ps-lg-5 ps-xl-8 text-center text-lg-end">
				<figure class="image-container">
					<?php if ( has_post_thumbnail() ) the_post_thumbnail('full', array( 'loading' => 'eager', 'class' => 'loading-image img-fluid' )); ?>
					<figcaption class="placeholder"></figcaption>
				</figure>
			</div>
		</div>
	</div>
</div>