<?php $arg = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 3,
	'post_not_in'		 => get_the_ID()
);
$wp_related_query  = new WP_Query( $arg );
if ( $wp_related_query->have_posts() ) : $originalPostUrl = get_the_permalink(); ?>
	
	<aside aria-label="<?php _e('Suggested Articles', 'wp-theme'); ?>" role="region" class="related-posts">
		<header class="section-title smaller">
			<h2><?php _e( 'You might also like', 'wp-theme' ); ?></h2>
		</header>
		
		<div class="row posts-loop g-4">
			<?php while ( $wp_related_query->have_posts() ) : $wp_related_query->the_post(); ?>
				<?php get_template_part( 'template-parts/archive/post-loop', 'item', array( 'original_post' => $originalPostUrl, 'layout' => '3-cols', 'include-author-block' => 1 ) ); ?>
			<?php endwhile; ?>
		</div>
		
	</aside>
<?php endif;wp_reset_query(); ?>