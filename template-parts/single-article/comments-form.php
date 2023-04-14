<?php if( is_single() && comments_open() ) : ?>
	<aside id="comments-form" class="position-relative" aria-label="Site Comments" role="region">
		
		<header class="section-title wow fadeInLeft" data-wow-delay="50ms" data-wow-offset="60" data-wow-duration="700ms">
			<h2><?php _e( 'Have Something to Say?', 'wp-theme' ); ?></h2>
		</header>
		
		<?php comments_template(); ?>
	</aside>
<?php endif; // close to check single.php ?>