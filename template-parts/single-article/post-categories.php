<?php
$post_categories 							= wp_get_post_categories(get_the_ID());
$cats 												= array();
$yoast_wpseo_primary_category = (int) get_post_meta(get_the_ID(), '_yoast_wpseo_primary_category', true);


foreach($post_categories as $index => $category){
	$cat = get_category( $category );
	
	if ( $yoast_wpseo_primary_category && $yoast_wpseo_primary_category == $cat->term_id ) {
		
		$primary_category_name	= get_the_category_by_ID($yoast_wpseo_primary_category); // get primary category NAME
		$primary_cat 						= array( 'name' => $primary_category_name, 'id' => $yoast_wpseo_primary_category ); // add primary category to array
		array_unshift($cats , $primary_cat); // move primary category to the BEGINNING of array
		
		continue;
	}
	
	$cats[] = array( 'name' => $cat->name, 'id' => $cat->term_id );
}


if ( ! empty($cats) ) : ?>
	<ul class="nav post-categories-nav text-uppercase font-secondary mb-4">
		<?php foreach ($cats as $cat) : ?>
			<li class="nav-item">
				<a class="nav-item-link rounded fw-bolder" href="<?= get_term_link( $cat['id'], 'category' ); ?>"><?= $cat['name']; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>