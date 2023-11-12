<?php
$custom_title_width = get_field('custom_title_width');
if ( $custom_title_width && $custom_title_width != '-1' ) {
	$title_width = $custom_title_width . 'px';
} else {
	$title_width = '100%';
}
?>
<div class="entry-header" style="--title-width: <?= $title_width; ?>">
	<?php the_title('<h1 class="entry-title mb-0"><span>', '</span></h1>'); ?>
	<?php
	$subtitle = get_field( 'subtitle' );
	if ( ! $subtitle && has_excerpt() ) {
		$excerpt = get_the_excerpt();
		$excerpt = wp_strip_all_tags($excerpt);
		$subtitle = $excerpt;
	}
	if ( $subtitle ) : ?>
		<p class="subtitle font-secondary mb-0 fw-normal mt-3"><?= wp_strip_all_tags($subtitle); ?></p>
	<?php endif; ?>
</div>