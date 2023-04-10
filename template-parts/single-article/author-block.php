<?php
$author_id 	 	= get_post_field( 'post_author' );
$author_name 	= get_the_author_meta( 'display_name', $author_id );
$author_url 	= get_the_author_meta( 'user_url', $author_id );
$author_photo	= get_field('author_photo', 'user_'.$author_id );
$post_date 		= get_the_date( 'M j, Y' );
$post_m_date	= get_the_modified_date( 'M j, Y' );

?>
<aside class="article-block-meta mb-4">
	<div class="row align-items-center">
		
		<?php if ( $author_photo ) : ?>
			<div class="col-sm-8">
				<figure class="article-author d-flex align-items-center font-secondary fs-5 m-0 text-gray">
					<img class="rounded-circle me-3" width="50" height="50" loading="lazy" src="<?= $author_photo['sizes']['thumbnail']; ?>" alt="<?= $author_photo['alt']; ?>">
					<figcaption>
						<ul class="list-inline m-0">
							<li class="list-heading mb-1">
								<?php printf( __( 'By <cite class="fst-normal">%s</cite>', 'wp-theme' ), get_the_author_meta('display_name', $author_id) ); //get_the_author_posts_link() ?>
							</li>
							<li class="list-inline-item">
								<?= is_page_template('single-review-template.php') ? do_shortcode('[wp-reading-time]') : do_shortcode('[acf-reading-time]'); ?>
							</li>
							<li class="list-inline-item">
								<?php if( get_the_modified_date() != get_the_date() ) : ?>
									<time datetime="<?= $post_m_date; ?>" itemprop="dateModified"><?php printf( __( 'updated on %s', 'wp-theme' ), $post_m_date ); ?></time>
								<?php else : ?>
									<time datetime="<?= $post_date; ?>" itemprop="datePublished"><?php printf( __( 'published on %s', 'wp-theme' ), $post_date ); ?></time>
								<?php endif; ?>
							</li>
						</ul>
					</figcaption>
				</figure>
			</div>
		<?php endif; ?>
		
		<div class="col-sm-4 text-sm-end">
			<?php echo do_shortcode('[social-share]'); ?>
		</div>
	
	</div>
</aside>