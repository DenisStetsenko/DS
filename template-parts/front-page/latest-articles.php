<?php
	$wp_query = new WP_Query(array(
		'post_type'	      => 'post',
		'post_status'     => 'publish',
		'orderby'					=> 'date',
		'order'						=> 'DESC',
		'posts_per_page'  => 3
	));
	if ( $wp_query->have_posts() ) : ?>
	
	<section id="front-latest-articles" class="section-margin">
		<div class="container">
			
			<header class="section-title wow fadeInLeft" data-wow-delay="150ms" data-wow-offset="40">
				<h2 class=""><?php _e('Read The Latest'); ?></h2>
			</header>
			
			<div class="row posts-loop g-4 g-lg-5">
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<?php get_template_part( 'template-parts/category/post-loop', 'item', array( 'layout' => '3-cols', 'include-author-block' => 1 ) );; ?>
				<?php endwhile; ?>
			</div>
	
		</div>
	</section>
	
<?php endif; wp_reset_query(); ?>

