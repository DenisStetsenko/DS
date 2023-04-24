<?php
if ( has_post_thumbnail() ) {
	echo '<figure class="post-thumbnail figure mb-4">';
	the_post_thumbnail( 'full', array( 'class' => 'img-fluid figure-img rounded border', 'loading' => 'eager' ) );
	echo get_the_post_thumbnail_caption() ? '<figcaption class="figure-caption font-secondary text-gray fs-6 mt-2">' . get_the_post_thumbnail_caption() . '</figcaption>' : '';
	echo '</figure>';
}