<?php
/**
 * Single post partial template
 */

// Display Author Block
get_template_part('template-parts/single-article/author-block');

// Affiliate Disclosure
get_template_part('template-parts/single-article/affiliate-disclosure');
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<?php get_template_part('template-parts/single-article/post-thumbnail')?>
	
	<div class="intro-content review-summary mb-4">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php get_template_part( 'template-parts/single-article/entry-footer' ); ?>
	
</article><!-- #post-## -->