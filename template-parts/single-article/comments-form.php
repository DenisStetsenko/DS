<?php if( is_single() && comments_open() ) : ?>
	<aside id="comments-form" class="position-relative" aria-label="Site Comments" role="region">
		
		<header class="section-title text-center mb-7">
			<h2><?php _e( 'Have Something to Say?', 'wp-theme' ); ?></h2>
		</header>
		
		<?php comments_template(); ?>
	</aside>
<?php endif; // close to check single.php ?>