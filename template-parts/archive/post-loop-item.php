<?php
$subtitle                     = get_field( 'subtitle' );
$yoast_wpseo_primary_category = get_post_meta( get_the_ID(), '_yoast_wpseo_primary_category', true );


// GA Tracker based ON $args on get_template_part
$gaTrackers = '';
if ( $args && ! empty($args['original_post']) ) {
	$gaTrackers = 'onclick="__gaTrackers(\'send\', \'event\', \'Related Post Click\', \''. $args['original_post'].'\', \''. get_the_permalink() .'\');"';
}

// COLUMN COUNT BASED ON $args on get_template_part
$layout = 'col-md-6 col-lg-4';
if ( $args && ! empty($args['layout']) ) {
	if ( $args['layout'] == '2-cols' ){
		$layout = 'col-md-6';
	} elseif ( $args['layout'] == '3-cols' ) {
		$layout = 'col-md-6 col-lg-4';
	} elseif ( $args['layout'] == '4-cols' ) {
		$layout = 'col-md-6 col-lg-3';
	}
}


if ( $yoast_wpseo_primary_category ) {
	$main_term = $yoast_wpseo_primary_category;
} elseif ( $post_category = wp_get_post_categories( get_the_ID() ) ) {
	$main_term = $post_category[0];
} else {
	$main_term = false;
}



?>
<div class="<?= $layout; ?> item">
	<article class="blog-loop-item position-relative">
		<div class="bg rounded border d-block" style="background: url(<?= get_the_post_thumbnail_url() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://place-hold.it/420x250'; ?>) no-repeat center/cover"></div>
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
			 <?= $gaTrackers != '' ? $gaTrackers : null; ?>></a>
	</article>
</div>