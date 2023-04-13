<?php
if ( has_post_thumbnail() ) {
	echo '<figure class="post-thumbnail figure mb-4">';
	the_post_thumbnail( 'full', array( 'class' => 'img-fluid figure-img rounded border', 'loading' => 'lazy' ) );
	echo get_the_post_thumbnail_caption() ? '<figcaption class="figure-caption font-secondary text-gray fs-6">' . get_the_post_thumbnail_caption() . '</figcaption>' : '';
	echo '</figure>';
}