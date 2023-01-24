<div id="template-articles-archive" class="section-padding">
	<div class="container">

		<header class="section-title category-heading">
			<h1 class="entry-title mb-3">
				<?php if ( is_archive() ){
					echo get_the_archive_title();
				} ?>
			</h1>
			<?= category_description(); ?>
		</header>

		<div class="row">
			
			<div class="col-lg-4 order-lg-2 mb-5 mb-lg-0 d-flex">
				<?php if ( is_active_sidebar( 'comparison-sidebar' ) ) { ?>
					<aside id="right-sidebar" class="ps-lg-4 flex-grow-1 d-flex">
						<?php dynamic_sidebar( 'comparison-sidebar' ); ?>
					</aside>
				<?php } ?>
			</div>

			<div class="col-lg-8 order-lg-1">
				<?php
				global $wp_query;
				if ( have_posts() ) :
					$curr_category_slug = '';
					if ( is_home() ) {
						$show_categories = get_field('show_categories',  get_option('page_for_posts') );
						$categories_List = implode(',', $show_categories);
						$curr_category_slug = 'data-category="'.$categories_List.'"';
					} elseif ( is_category() ) {
						$category     = get_query_var('cat');
						$current_cat  = get_category($category);
						$curr_category_slug = 'data-category="'. $current_cat->slug .'"';
					} elseif ( is_archive() ) {
						$curr_category_slug = 'data-category="all" data-year="'. get_query_var('year') .'" data-monthnum="'. get_query_var('monthnum') .'"';
					} elseif ( is_search() ) {
						
						$show_categories = get_field('show_categories',  get_option('page_for_posts') );
						$categories_List = implode(',', $show_categories);
						
						$curr_category_slug = 'data-category="'.$categories_List.'" data-search="'. get_search_query() .'"';
					}
					
					echo '<div class="row posts-loop g-4">';
						while ( have_posts() ) : the_post();
							 get_template_part( 'template-parts/archive/post-loop', 'item', array( 'layout' => '2-cols' ) );
						endwhile;
					echo '</div>';
					
					
					if ( $wp_query->found_posts > get_option('posts_per_page') && ! is_single() ) :
						echo '<button id="load-more" class="btn btn-primary mt-5"
                   '. $curr_category_slug .' data-type="blog" data-ppp="'. get_option('posts_per_page') .'" data-title="'. __('Load More', 'twentytwentyone-child') .'">'. __('Load More', 'twentytwentyone-child') . '</button>';
					endif;
				
				else :
					get_template_part( 'template-parts/loop-templates/content', 'none' );
				endif;
				?>
			</div>

		</div>


	</div>
</div>