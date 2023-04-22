<?php
$subtitle = get_field( 'subtitle' );

// GA Tracker based ON $args on get_template_part
$gaTrackers = '';
if ( $args && ! empty($args['original_post']) ) {
	$gaTrackers = 'onclick="__gaTrackers(\'send\', \'event\', \'Related Post Click\', \''. $args['original_post'].'\', \''. get_the_permalink() .'\');"';
}

// COLUMN COUNT BASED ON $args on get_template_part
if ( $args && ! empty($args['layout']) ) {
	switch ($args['layout']) {
		case '1-col' :
			$layout = 'col-12';
			break;
		case '2-cols' :
			$layout = 'two-cols col-md-6';
			break;
		case '3-cols' :
			$layout = 'three-cols col-md-6 col-lg-4';
			break;
		case '4-cols' :
			$layout = 'four-cols col-md-6 col-lg-3';
			break;
		default:
			$layout = 'col-md-6 col-lg-4';
	}
} else {
	$layout = 'col-md-6 col-lg-4';
}

// Include Author / Date / Reading Time
$author_block_html = '';
if ( $args && ! empty($args['include-author-block']) && $args['include-author-block'] == 1 ) {
	
	$author_id 	 	= get_post_field( 'post_author' );
	$author_name 	= get_the_author_meta( 'display_name', $author_id );
	$post_date 				= get_the_date( 'M j, Y' );
	$format_post_date = date("Y-m-d", strtotime($post_date));
	
	$post_m_date	= get_the_modified_date( 'M j, Y' );
	$format_post_m_date = date("Y-m-d", strtotime($post_m_date));
	
	$author_block_html .= '<figure class="article-author font-secondary fs-5 mb-1 text-gray">';
		$author_block_html .= '<figcaption>';
	
			$author_block_html .= '<ul class="list-inline mb-0">';
		
			//$author_block_html .= '<li class="list-inline-item author-name">'. __( 'By <cite class="fst-normal">'.$author_name.'</cite>', 'wp-theme' ) . '</li>';
	
			$author_block_html .= '<li class="list-inline-item wp-reading-time">';
				$author_block_html .= is_page_template('single-review-template.php') ? do_shortcode('[wp-reading-time]') : do_shortcode('[acf-reading-time]');
			$author_block_html .= '</li>';
			
			if ( get_the_modified_date() != get_the_date() ) :
				$author_block_html .=	'<li class="list-inline-item dateModified"><time datetime="'. $format_post_m_date .'" itemprop="dateModified">'. sprintf( __( '%s', 'wp-theme' ), $post_m_date ) .'</time></li>';
			else :
				$author_block_html .=	'<li class="list-inline-item datePublished"><time datetime="'. $format_post_date .'" itemprop="datePublished">'. sprintf( __( '%s', 'wp-theme' ), $post_date ) .'</time></li>';
			endif;
	
			$author_block_html .= '</ul>';
			
		$author_block_html .= '</figcaption>';
	$author_block_html .= '</figure>';
}


// DEFINE POST MAIN CATEGORY
$yoast_wpseo_primary_category = get_post_meta( get_the_ID(), '_yoast_wpseo_primary_category', true );
if ( $yoast_wpseo_primary_category ) {
	$main_term = $yoast_wpseo_primary_category;
} elseif ( $post_category = wp_get_post_categories( get_the_ID() ) ) {
	$main_term = $post_category[0];
} else {
	$main_term = false;
}

// GENERATE POST CLASS LIST
$post_html_attrs = 'item ';
$post_html_attrs .= 'd-flex ';
$post_html_attrs .= $layout;

?>
<div class="<?= $post_html_attrs; ?>">
	<article class="post-loop-item rounded-3 position-relative border flex-grow-1 bg-white overflow-hidden">
		<div class="bg rounded-top-3 d-block" style="background: url(<?= get_the_post_thumbnail_url() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://place-hold.it/420x250'; ?>) no-repeat center/cover"></div>
		<div class="inner">
			<?php
			//if ( $main_term ) echo '<span class="category rounded bg-light-gray text-uppercase fw-bolder border font-secondary text-gray d-inline-block">' . get_cat_name($main_term) . '</span>';
			the_title( '<h3 class="entry-title mb-2">', '</h3>' );
			
			echo $author_block_html != '' ? $author_block_html : '';
			
			if ( $subtitle ) : ?>
				<p class="subtitle font-secondary mb-0"><?= wp_strip_all_tags($subtitle); ?></p>
			<?php endif;
			
			
			?>
		</div>
		<a title="<?php _e('Read the Article', 'wp-theme'); ?>" aria-label="<?php _e('Read the Article', 'wp-theme'); ?>"
			 href="<?php the_permalink(); ?>" class="post-link stretched-link"
			 <?= $gaTrackers != '' ? $gaTrackers : null; ?>></a>
	</article>
</div>