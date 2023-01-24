<header class="entry-header mb-4">
	<?php the_title('<h1 class="entry-title mb-2">', '</h1>'); ?>
	<?php if ( $subtitle = get_field('subtitle') ) : ?>
		<p class="subtitle font-secondary mb-0 fw-lighter"><?= wp_strip_all_tags($subtitle); ?></p>
	<?php endif; ?>
</header>