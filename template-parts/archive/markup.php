<div id="template-articles-archive" class="section-padding">
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-8">

				<header class="section-title category-heading">
					<h1 class="entry-title mb-3">
						<?php if ( is_archive() ){
							$category = get_category(get_query_var('cat'));
							echo '<i class="icon icon-'.$category->slug.'"></i><span>'.get_the_archive_title().'</span>';
						} ?>
					</h1>
					<?= category_description(); ?>
				</header>
				
				<?php
				global $wp_query;
				if ( have_posts() ) :
					$curr_category_slug = '';
					
					if ( is_category() ) {
						$category = get_category(get_query_var('cat'));
						$curr_category_slug = 'data-category="'.$category->slug.'"';
					}
					elseif ( is_archive() ) {
						$category = get_category(get_query_var('cat'));
						$curr_category_slug = 'data-category="'.$category->slug.'" data-year="'. get_query_var('year') .'" data-monthnum="'. get_query_var('monthnum') .'"';
					}
					elseif ( is_search() ) {
						$curr_category_slug = 'data-category="all" data-search="'. get_search_query() .'"';
					}
					
					echo '<div class="row posts-loop g-4">';
						while ( have_posts() ) : the_post();
							 get_template_part( 'template-parts/archive/post-loop', 'item', array( 'layout' => '2-cols', 'include-author-block' => 1 ) );
						endwhile;
					echo '</div>';
					
					
					if ( $wp_query->found_posts > get_option('posts_per_page') ) :
						echo '<button id="load-more" class="btn btn-primary mt-5"
                   '. $curr_category_slug .' data-type="blog" data-ppp="'. get_option('posts_per_page') .'" data-title="'. __('Load More', 'twentytwentyone-child') .'">'. __('Load More', 'twentytwentyone-child') . '</button>';
					endif;
				
				else :
					get_template_part( 'template-parts/loop-templates/content', 'none' );
				endif;
				?>
			</div>

			<div class="col-lg-4">
				<?php if ( is_active_sidebar( 'archive-sidebar' ) ) { ?>
					<aside id="right-sidebar" class="ps-lg-4">
						<?php dynamic_sidebar( 'archive-sidebar' ); ?>
					</aside>
				<?php } ?>
			</div>

		</div>


	</div>
</div>