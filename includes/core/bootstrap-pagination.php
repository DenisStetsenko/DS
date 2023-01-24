<?php
if( ! defined('ABSPATH') ) exit;

/**
 * Bootstrap4 pagination
 ***********************************************************************************************************************/
if ( ! function_exists( 'bootstrap_pagination' ) ) :
	function bootstrap_pagination($before = '', $after = '') {

		global $wp_query;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) { return; }
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 5;
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}

    echo $before.'<nav aria-label="Page navigation"><ul class="pagination pt-5 pb-5 mb-0 justify-content-center">';

		if ($paged > 1) {
			$first_page_text = "&laquo;";
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link().'" title="First">'.$first_page_text.'</a></li>';
		}

		$prevposts = get_previous_posts_link('&lsaquo;');
		if($prevposts) {
			echo '<li class="page-item">' . $prevposts  . '</li>';
		} else {
			echo
			'<li class="page-item disabled">
			<a class="page-link" href="#" tabindex="-1" aria-label="Previous">
		    <span aria-hidden="true">&lsaquo;</span>
		    <span class="sr-only">Previous</span>
		  </a>
    </li>';
		}

		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
			} else {
				echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}

		$nextposts = get_next_posts_link('&rsaquo;');
		if($nextposts) {
			echo '<li class="page-item">' . $nextposts  . '</li>';
		} else {
			echo
			'<li class="page-item disabled">
			<a class="page-link" href="#" aria-label="Next">
		    <span aria-hidden="true">&rsaquo;</span>
		    <span class="sr-only">Next</span>
		  </a>
    </li>';
		}

		if ($paged != $end_page ) {
			$last_page_text = "&raquo;";
			echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($max_page).'" title="Last">'.$last_page_text.'</a></li>';
		}

		echo $after.'</ul></nav>';

	}
endif;


add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes() {
	return 'class="page-link"';
}