<?php $arg = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'post_not_in'		 => get_the_ID()
);
$wp_related_query  = new WP_Query( $arg );
if ( $wp_related_query->have_posts() ) : $originalPostUrl = get_the_permalink(); ?>
	
	<aside aria-label="<?php _e('Suggested Articles', 'wp-theme'); ?>" role="region" class="related-posts">
		<header class="section-title">
			<h2><?php _e( 'You might also like', 'wp-theme' ); ?></h2>
		</header>
		
		<div class="row posts-loop">
			<?php while ( $wp_related_query->have_posts() ) : $wp_related_query->the_post();
				$subtitle = get_field('subtitle');
				$yoast_wpseo_primary_category = get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category', true);
				
				if ( $yoast_wpseo_primary_category ) {
					$main_term = $yoast_wpseo_primary_category;
				} elseif ( $post_category = wp_get_post_categories(get_the_ID()) ) {
					$main_term = $post_category[0];
				} else {
					$main_term = false;
				}
				?>
				<div class="col-md-6 col-lg-3 item">
					<article class="blog-loop-item position-relative">
						<div class="bg rounded border d-block" style="background: url(<?= get_the_post_thumbnail_url() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://via.placeholder.com/420x315'; ?>) no-repeat center/cover"></div>
						<div class="inner py-3">
							<?php
							if ( $main_term ) echo '<span class="category rounded bg-light-gray text-uppercase fw-bolder border font-secondary text-gray d-inline-block">' . get_cat_name($main_term) . '</span>';
							the_title( '<h3 class="entry-title h4 mb-1">', '</h3>' ); ?>
							<?php if ( $subtitle ) : ?>
								<p class="subtitle font-secondary mb-0 fw-lighter"><?= wp_strip_all_tags($subtitle); ?></p>
							<?php endif; ?>
						</div>
						<a title="<?php _e('Read the Article', 'wp-theme'); ?>" aria-label="<?php _e('Read the Article', 'wp-theme'); ?>"
						   href="<?php the_permalink(); ?>" class="post-link stretched-link"
						   onclick="__gaTrackers('send', 'event', 'Related Post Click', '<?= $originalPostUrl; ?>', '<?php the_permalink();?>');"></a>
					</article>
				</div>
			<?php endwhile; ?>
		</div>
		
	</aside>
<?php endif;wp_reset_query(); ?>