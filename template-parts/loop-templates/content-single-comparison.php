<?php
/**
 * Single post partial template
 */

// Display Author Block
get_template_part('template-parts/single-article/author-block');

// Affiliate Disclosure
get_template_part('template-parts/single-article/affiliate-disclosure'); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="hero-content comparison-summary">

		<div class="content-widget widget rounded-3 font-secondary fs-4 bg-light-gray border p-4 d-lg-none mb-4">
			<?php echo do_shortcode('[ez-toc]'); ?>
		</div>

		<div class="entry-content mobile-content-sm-size" itemprop="description">
			<?php the_content(); ?>
		</div>
	</div>
	
</article><!-- #post-## -->