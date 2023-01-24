<?php
$author_id 	 	= get_post_field( 'post_author' );
$author_name 	= get_the_author_meta( 'display_name', $author_id );
$author_url 	= get_the_author_meta( 'user_url', $author_id );
$author_photo	= get_field('author_photo', 'user_'.$author_id );
$post_date 		= get_the_date( 'F j, Y' );
$post_m_date	= get_the_modified_date( 'F j, Y' );

?>
<aside class="article-block-meta mb-4">
	<div class="row align-items-center">
		
		<?php if ( $author_photo ) : ?>
			<div class="col-sm-8">
				<figure class="article-author d-flex align-items-center font-secondary fs-5 m-0">
					<img class="rounded-circle me-3" width="50" height="50" loading="lazy" src="<?= $author_photo['sizes']['thumbnail']; ?>" alt="<?= $author_photo['alt']; ?>">
					<figcaption>
						<?php printf( __( 'By <cite class="fst-normal">%s</cite>.<br>', 'wp-theme' ), get_the_author_posts_link() );
						if( get_the_modified_date() != get_the_date() ) : ?>
							<time datetime="<?= $post_m_date; ?>" itemprop="datePublished"><?php printf( __( 'Updated on %s', 'wp-theme' ), $post_m_date ); ?></time>
						<?php else : ?>
							<time datetime="<?= $post_date; ?>" itemprop="datePublished"><?php printf( __( 'Published on %s', 'wp-theme' ), $post_date ); ?></time>
						<?php endif; ?>
						<?= is_page_template('single-review-template.php') ? do_shortcode('[wp-reading-time]') : do_shortcode('[acf-reading-time]'); ?>
					</figcaption>
				</figure>
			</div>
		<?php endif; ?>
		
		<div class="col-sm-4 text-sm-end">
			<?php echo do_shortcode('[social-share]'); ?>
		</div>
	
	</div>
</aside>