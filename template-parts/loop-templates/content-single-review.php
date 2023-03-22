<?php
/**
 * Single post partial template
 */
$affiliate_disclosure = get_field('affiliate_disclosure', 'option');

// SVG Icons
$pros_icon = wp_custom_bs_icons('ui', 'check');
$cons_icon = wp_custom_bs_icons('ui', 'close');
$down_icon = wp_custom_bs_icons('ui', 'down');

// Display Author Block
get_template_part('template-parts/single-article/author-block'); ?>

<?php if ( $affiliate_disclosure ) : ?>
	<aside class="affiliate-disclosure bg-light-gray text-gray rounded border mb-4 font-secondary text-center ">
		<?= apply_filters('the_content', $affiliate_disclosure); ?>
	</aside>
<?php endif; ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<?php if ( has_post_thumbnail() ) {
		echo '<figure class="post-thumbnail figure mb-4">';
			the_post_thumbnail( 'full', array( 'class' => 'img-fluid figure-img rounded border', 'loading' => 'lazy' ) );
			echo get_the_post_thumbnail_caption() ? '<figcaption class="figure-caption font-secondary text-gray fs-6">' . get_the_post_thumbnail_caption() . '</figcaption>' : '';
		echo '</figure>';
	} ?>

	
	<div class="intro-content review-summary mb-4">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php get_template_part( 'template-parts/single-article/entry-footer' ); ?>
	
</article><!-- #post-## -->