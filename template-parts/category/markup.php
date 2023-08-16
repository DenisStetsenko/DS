<?php
$show_category_sidebar = get_field('show_category_sidebar', 'option');
$layout = '3-cols';
if ( $show_category_sidebar ) $layout = '2-cols';

?>

<div id="template-articles-archive" class="main-area-padding">
	<div class="container">

		<header id="category-heading">
			<h1 class="category-title">
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
			<?= is_category() && category_description() ? '<div class="cat-description">'. category_description() .'</div>' : ''; ?>
		</header>
		
		<div class="row">
			
			<div class="<?= $show_category_sidebar ? 'col-lg-8' : 'col-12'; ?>">
				
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
					
					echo '<div class="row posts-loop g-4 g-lg-5">';
						while ( have_posts() ) : the_post();
							 get_template_part( 'template-parts/category/post-loop', 'item', array( 'layout' => $layout, 'include-author-block' => 1 ) );
						endwhile;
					echo '</div>';
					
					
					if ( $wp_query->found_posts > get_option('posts_per_page') ) :
						echo '<button id="load-more" class="btn btn-primary mt-7 d-table mx-auto px-8"
                   '. $curr_category_slug .'
                   data-type="blog"
                   data-ppp="'. get_option('posts_per_page') .'"
                   data-layout="'.$layout.'"
                   data-title="'. __('Load More', 'twentytwentyone-child') .'">'. __('Load More', 'twentytwentyone-child') . '</button>';
					endif;
				
				else :
					get_template_part( 'template-parts/loop-templates/content', 'none' );
				endif;
				?>
			</div>

			<?php if ( is_active_sidebar( 'category-sidebar' ) && $show_category_sidebar ) { ?>
				<div class="col-lg-4 d-flex">
					<aside id="right-sidebar" class="position-relative">
						<div class="sticky-top">
							<?php dynamic_sidebar( 'category-sidebar' ); ?>
						</div>
					</aside>
				</div>
			<?php } ?>

		</div>


	</div>
</div>