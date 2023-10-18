<?php
$custom_title_width = get_field('custom_title_width');
$title_width = '910';
if ( $custom_title_width ) {
	$title_width = $custom_title_width;
}
?>
<header class="entry-header" style="--title-width: <?= $title_width; ?>px">
	<?php the_title('<h1 class="entry-title mb-2"><span>', '</span></h1>'); ?>
	<?php
	$subtitle = get_field( 'subtitle' );
	if ( ! $subtitle && has_excerpt() ) {
		$excerpt = get_the_excerpt();
		$excerpt = wp_strip_all_tags($excerpt);
		$subtitle = $excerpt;
	}
	if ( $subtitle ) : ?>
		<p class="subtitle font-secondary mb-0 fw-lighter"><?= wp_strip_all_tags($subtitle); ?></p>
	<?php endif; ?>
</header>