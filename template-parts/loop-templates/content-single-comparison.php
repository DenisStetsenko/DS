<?php
/**
 * Single post partial template
 */
$affiliate_disclosure = get_field('affiliate_disclosure', 'option');
$summary_list 				= get_field('summary_list');

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

	
	<div class="entry-content entry-content-summary mb-4">
		<?php the_content(); ?>
	</div>

	<!-- PRODUCTS SUMMARY[Top Picks] TABLE -->
	<?php if ( $summary_list && array_filter($summary_list) ) : ?>
		<div class="product-summary-wrapper overflow-hidden">
			<?php foreach ( $summary_list as $top_picks ) :
				$top_picks['preview'] && $top_picks['preview']['alt'] ? $alt_top = $top_picks['preview']['alt'] : $alt_top = $top_picks['heading']['title'];
				?>
				<div class="top-picks row align-items-center justify-content-between">
					
					<?= $top_picks['preview'] ? '<div class="column-preview"><img class="img-fluid rounded-1" src="'.$top_picks['preview']['sizes']['top-picks-thumbnail'].'" loading="lazy" alt="'. $alt_top . '"></div>' : null ; ?>

					<div class="<?= $top_picks['preview'] ? 'col-lg-6 ps-0' : 'col-lg-8'; ?>">
						<?php if ( $top_picks['heading'] ) : ?>
							<div class="top-picks-heading font-secondary">
								<?= $top_picks['heading']['subtitle'] ? '<p class="subtitle mb-0 font-secondary fs-6 fw-bolder text-gray text-uppercase">'.$top_picks['heading']['subtitle'].'</p>' 	: null; ?>
								<?= $top_picks['heading']['title'] 		? '<p class="title fs-4 fw-bold">'.$top_picks['heading']['title'].'</p>' 	: null; ?>
								<a class="more" href="<?php the_permalink(); ?>#pick-<?= strtolower( preg_replace('/(\W)+/', '-', $top_picks['heading']['title']) ); ?>">
									<i><?= $down_icon; ?></i><?php _e('Jump to Review', 'wp-theme'); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="col-lg-4 text-lg-end">
						<?= acf_link($top_picks['price'], 'btn btn-outline-primary btn-sm btn-price affiliate-link'); ?>
					</div>
					
				</div>
				
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<!-- / PRODUCTS SUMMARY[Top Picks] TABLE -->
	
	<?php if ( $summary_list && array_filter($summary_list) ) : ?>
		<div class="entry-content entry-content-main">
			<?php foreach ( $summary_list as $summary_list_item ) :
				$summary_list_item['preview'] && $summary_list_item['preview']['alt'] ? $alt = $summary_list_item['preview']['alt'] : $alt = $summary_list_item['heading']['title'];
				?>
				<section <?= $summary_list_item['heading']['title'] ? 'id="pick-'.strtolower( preg_replace('/(\W)+/', '-', $summary_list_item['heading']['title']) ).'"' : ''; ?> class="product-card ">
					
					
					<!-- PRODUCT HEADING -->
					<header class="product-heading mb-4">
						<?= $summary_list_item['heading']['subtitle'] ? '<p class="subtitle mb-1 font-secondary text-gray fw-bolder text-uppercase">'.$summary_list_item['heading']['subtitle'].'</p>' 	: null; ?>
						<?= $summary_list_item['heading']['title'] 		? '<h2 class="title m-0">'.$summary_list_item['heading']['title'].'</h2>' 	: null; ?>
					</header>
					<!-- / PRODUCT HEADING -->

					
					<!-- PRODUCT BIG IMAGE -->
					<?php if ( $summary_list_item['preview'] ) {
						echo '<figure class="post-thumbnail figure ">';
							echo '<img class="figure-img img-fluid rounded border" src="'. $summary_list_item['preview']['sizes']['large'] .'" loading="lazy" alt="'. $alt .'">';
							echo $summary_list_item['preview']['caption'] ? '<figcaption class="figure-caption font-secondary text-gray fs-6">' . $summary_list_item['preview']['caption'] . '</figcaption>' : '';
						echo '</figure>';
					} ?>
					<!-- / PRODUCT BIG IMAGE -->
					
					
					<!-- PRODUCT PRICE BUTTON -->
					<?= acf_link($summary_list_item['price'], 'btn btn-primary btn-price affiliate-link d-table mx-auto mb-4'); ?>
					<!-- / PRODUCT PRICE BUTTON -->
					
					
					<!-- PROS & CONS -->
					<?php if ( $summary_list_item['display_pros_and_cons'] && array_filter($summary_list_item['pros_and_cons']) ) : ?>
						<div class="pros-and-cons d-flex flex-wrap my-5 rounded border overflow-hidden font-secondary">
							
							<?php if ( $summary_list_item['pros_and_cons']['pros'] ) : ?>
								<div class="column pros">
									<div class="heading fw-bold font-secondary"><span><?php _e('Pros', 'wp-theme'); ?></span></div>
									<ul class="list pros-list list-unstyled m-0">
										<?php foreach ($summary_list_item['pros_and_cons']['pros'] as $list_item) : ?>
											<li><span class="icon"></span><?= $list_item['list_item']; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
							
							<?php if ( $summary_list_item['pros_and_cons']['cons'] ) : ?>
								<div class="column cons">
									<div class="heading fw-bold font-secondary"><span><?php _e('Cons', 'wp-theme'); ?></span></div>
									<div class="list cons-list list-unstyled m-0">
										<?php foreach ($summary_list_item['pros_and_cons']['cons'] as $list_item) : ?>
											<li><span class="icon"></span><?= $list_item['list_item']; ?></li>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
							
						</div>
					<?php endif; ?>
					<!-- / PROS & CONS -->
					
					
					<!-- PRODUCT SUMMARY -->
					<?= $summary_list_item['content'] ? '<div class="entry-content">' . apply_filters('the_content', $summary_list_item['content']) . '</div>' : null; ?>
					<!-- / PRODUCT SUMMARY -->
					
				</section>
			
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</article><!-- #post-## -->