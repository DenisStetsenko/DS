<div id="template-articles-archive" class="main-area-padding">
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-8">

				<header class="section-title category-heading">
					<h1 class="entry-title mb-3">
						<?php
						if ( is_category() ) {
							$category = get_category(get_query_var('cat'));
							if ( $category && ! is_wp_error($category) ) {
								echo '<i class="icon icon-'.$category->slug.'"></i><span>'.get_the_archive_title().'</span>';
							}
						}
						elseif ( is_author() ) {
							echo 'The Latest Articles by ' . nl2br(get_the_author_meta('first_name'));
						}
						elseif ( is_home() ) {
							echo 'The Latest Articles';
						}
						?>
					</h1>
					<?= is_category() && category_description() ? category_description() : ''; ?>
				</header>
				
				<?php
				global $wp_query;
				if ( have_posts() ) :
					$curr_category_slug = '';
					
					if ( is_category() ) {
						$category = get_category(get_query_var('cat'));
						$curr_category_slug = 'data-category="'.$category->slug.'"';
					}
					elseif ( is_search() ) {
						$curr_category_slug = 'data-category="all" data-search="'. get_search_query() .'"';
					}
					
					echo '<div class="row posts-loop g-4">';
						while ( have_posts() ) : the_post();
							 get_template_part( 'template-parts/category/post-loop', 'item', array( 'layout' => '2-cols', 'include-author-block' => 1 ) );
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

			<div class="col-lg-4 d-flex">
				<?php if ( is_active_sidebar( 'category-sidebar' ) ) { ?>
					<aside id="right-sidebar" class="position-relative">
						<div class="sticky-top">
							<?php dynamic_sidebar( 'category-sidebar' ); ?>
						</div>
					</aside>
				<?php } ?>
			</div>

		</div>


	</div>
</div>