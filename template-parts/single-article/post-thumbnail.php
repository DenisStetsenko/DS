<?php
if ( has_post_thumbnail() ) {
	echo '<figure class="post-thumbnail figure mb-5 mb-lg-6 w-100">';
	the_post_thumbnail( array(850,9999), array( 'class' => 'img-fluid figure-img rounded border w-100', 'loading' => 'eager', 'width' => 100, 'height' => 100 ) );
	echo get_the_post_thumbnail_caption() ? '<figcaption class="figure-caption font-secondary text-gray fs-6 mt-2">' . get_the_post_thumbnail_caption() . '</figcaption>' : '';
	echo '</figure>';
}