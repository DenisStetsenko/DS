<?php
$author_id 	 	= get_post_field( 'post_author' );
$author_name 	= get_the_author_meta( 'display_name', $author_id );
$author_url 	= get_the_author_meta( 'user_url', $author_id );
$author_photo	= get_field('author_photo', 'user_'.$author_id );
$post_date 		= get_the_date( 'M j, Y' );
$post_m_date	= get_the_modified_date( 'M j, Y' );
?>
<aside class="author-block-meta mb-4">
	<div class="row align-items-start">
		
		<?php if ( $author_photo ) : ?>
			<div class="col-md-8 col-lg-9 mb-0 mb-md-0 pe-0">
				<figure class="article-author d-flex align-items-center font-secondary fs-5 m-0 text-gray">
					<img class="rounded-circle me-3 align-self-start" width="50" height="50" loading="lazy" src="<?= $author_photo['sizes']['thumbnail']; ?>" alt="<?= $author_photo['alt']; ?>">
					<figcaption>
						<ul class="list-inline m-0">
							<li class="list-heading">
								<?php
									if ( $author_url != '' ) {
										printf( __( '<cite class="fst-normal author-name fw-medium"><a href="%s">%s</a></cite>', 'wp-theme' ), $author_url, get_the_author_meta('display_name', $author_id) );
									} else {
										printf( __( '<cite class="fst-normal author-name fw-medium">%s</cite>', 'wp-theme' ), get_the_author_meta('display_name', $author_id) );
									}
									?>
							</li>
							<li class="list-inline-item">
								<?= do_shortcode('[wp-reading-time]'); ?>
							</li>
							<li class="list-inline-item">
								<?php if( get_the_modified_date() != get_the_date() ) : ?>
									<time datetime="<?= $post_m_date; ?>" itemprop="dateModified"><?php printf( __( 'Updated on: %s', 'wp-theme' ), $post_m_date ); ?></time>
								<?php else : ?>
									<time datetime="<?= $post_date; ?>" itemprop="datePublished"><?php printf( __( 'Published on: %s', 'wp-theme' ), $post_date ); ?></time>
								<?php endif; ?>
							</li>
						</ul>
					</figcaption>
				</figure>
			</div>
		<?php endif; ?>
		
		<div class="col-md-4 col-lg-3 text-md-end ps-md-0">
			<?php echo do_shortcode('[social-share]'); ?>
		</div>
	
	</div>
</aside>