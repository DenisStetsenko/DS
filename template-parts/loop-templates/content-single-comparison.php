<?php
/**
 * Single post partial template
 */

// Display Author Block
get_template_part('template-parts/single-article/author-block');

// Affiliate Disclosure
get_template_part('template-parts/single-article/affiliate-disclosure'); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<?php get_template_part('template-parts/single-article/post-thumbnail')?>
	
	<div class="intro-content comparison-summary mb-4" itemprop="description">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
	
	<?php if ( $product_list_intro = get_field('product_list_intro') ) : ?>
		<div class="intro-content product-list-intro">
			<div class="entry-content">
				<?php echo apply_filters('the_content', $product_list_intro); ?>
			</div>
		</div>
	<?php endif; ?>

	<!-- PRODUCTS SUMMARY[Top Picks] TABLE -->
	<?php
	$summary_list = get_field('summary_list');
	if ( $summary_list && array_filter($summary_list) ) : ?>
		<div class="product-summary-wrapper overflow-hidden rounded-3 bg-light-gray border py-4 px-4">
			<?php
			$i = 1;
			foreach ( $summary_list as $top_picks ) :
				$top_picks['preview'] && $top_picks['preview']['alt'] ? $alt_top = $top_picks['preview']['alt'] : $alt_top = $top_picks['heading']['title'];
				?>
				<div class="top-picks d-flex flex-wrap justify-content-between <?= $i == 1 ? 'best' : ''; ?>">
					
					<?= $top_picks['preview'] ? '<div class="column-preview rounded-2 bg-white d-flex align-items-center justify-content-center py-2 px-2 position-relative">
																					<img class="img-fluid" src="'.$top_picks['preview']['sizes']['top-picks-thumbnail'].'" loading="lazy" alt="'. $alt_top . '">
																			 </div>' : null ; ?>

					<div class="d-flex <?= $top_picks['preview'] ? 'column-description' : 'col-lg-8'; ?>">
						<?php if ( $top_picks['heading'] ) : ?>
							<div class="top-picks-heading font-secondary flex-grow-1 px-3 py-0 d-flex flex-column justify-content-between">
								<div class="top">
									<?= $top_picks['heading']['subtitle'] ? '<p class="subtitle mb-0 font-secondary fs-6 fw-bolder text-gray text-uppercase">'.$top_picks['heading']['subtitle'].'</p>' 	: null; ?>
									<?= $top_picks['heading']['title'] 		? '<p class="title fs-4 fw-bold mb-2">'.$top_picks['heading']['title'].'</p>' 	: null; ?>
								</div>
								<div class="bottom lh-sm">
									<?php if ( $top_picks['heading']['title'] ) : ?>
										<a class="more" href="<?php the_permalink(); ?>#pick-<?= strtolower( preg_replace('/(\W)+/', '-', $top_picks['heading']['title']) ); ?>">
											<i class="icon-down"></i><?php _e('Jump to Review', 'wp-theme'); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="d-flex align-items-center <?= $top_picks['preview'] ? 'column-link' : 'col-lg-4'; ?> text-lg-end">
						<?= acf_link($top_picks['price'], 'btn btn-primary btn-sm btn-price affiliate-link flex-grow-1', 'nofollow noreferrer noopener'); ?>
					</div>
					
				</div>
				
			<?php $i++; endforeach; ?>
		</div>
	<?php endif; ?>
	<!-- / PRODUCTS SUMMARY[Top Picks] TABLE -->
	
	<?php if ( $summary_list && array_filter($summary_list) ) : ?>
		<div class="entry-content-main">
			<?php
			$i = 1;
			foreach ( $summary_list as $summary_list_item ) :
				$summary_list_item['preview'] && $summary_list_item['preview']['alt'] ? $alt = $summary_list_item['preview']['alt'] : $alt = $summary_list_item['heading']['title'];
				?>
				<section <?= $summary_list_item['heading']['title'] ? 'id="pick-'.strtolower( preg_replace('/(\W)+/', '-', $summary_list_item['heading']['title']) ).'"' : ''; ?> class="product-card ">
					
					
					<!-- PRODUCT HEADING -->
					<header class="product-heading mb-4">
						<?= $summary_list_item['heading']['subtitle'] ? '<p class="subtitle mb-2 font-secondary text-black fw-bolder text-uppercase fs-4 ls-lg">'.$summary_list_item['heading']['subtitle'].'</p>' 	: null; ?>
						<?= $summary_list_item['heading']['title'] 		? '<h2 class="title m-0"><i>'.$i.'.</i>' .$summary_list_item['heading']['title'].'</h2>' 	: null; ?>
					</header>
					<!-- / PRODUCT HEADING -->

					
					<!-- PRODUCT BIG IMAGE -->
					<?php if ( $summary_list_item['preview'] ) {
						echo '<figure class="post-thumbnail figure border bg-white rounded overflow-hidden w-100 d-flex align-items-center justify-content-center mb-5">';
							echo '<img class="figure-img img-fluid p-2" src="'. $summary_list_item['preview']['sizes']['large'] .'" loading="lazy" alt="'. $alt .'">';
							echo $summary_list_item['preview']['caption'] ? '<figcaption class="figure-caption font-secondary text-gray fs-6">' . $summary_list_item['preview']['caption'] . '</figcaption>' : '';
						echo '</figure>';
					} ?>
					<!-- / PRODUCT BIG IMAGE -->

					<!-- PRODUCT SUMMARY -->
					<?= $summary_list_item['content'] ? '<div class="entry-content entry-content-headings-styling">' . apply_filters('the_content', $summary_list_item['content']) . '</div>' : null; ?>
					<!-- / PRODUCT SUMMARY -->
					
					<!-- PROS & CONS -->
					<?php if ( $summary_list_item['display_pros_and_cons'] && array_filter($summary_list_item['pros_and_cons']) ) : ?>
						<div class="pros-and-cons d-flex flex-wrap mt-5 mb-7 rounded border overflow-hidden font-secondary">
							
							<?php if ( $summary_list_item['pros_and_cons']['pros'] ) : ?>
								<div class="column pros">
									<div class="heading fw-bold font-secondary text-center"><span><?php _e('Pros', 'wp-theme'); ?></span></div>
									<ul class="list pros-list list-unstyled m-0">
										<?php foreach ($summary_list_item['pros_and_cons']['pros'] as $list_item) : ?>
											<li><span class="icon"></span><?= $list_item['list_item']; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
							
							<?php if ( $summary_list_item['pros_and_cons']['cons'] ) : ?>
								<div class="column cons">
									<div class="heading fw-bold font-secondary text-center"><span><?php _e('Cons', 'wp-theme'); ?></span></div>
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

					<!-- PRODUCT PRICE BUTTON -->
					<?= acf_link($summary_list_item['price'], 'btn btn-primary btn-price affiliate-link d-table mx-auto mt-5', 'nofollow noreferrer noopener'); ?>
					<!-- / PRODUCT PRICE BUTTON -->
					
					
				</section>
			
			<?php $i++; endforeach; ?>
		</div>
	<?php endif; ?>
	
	<?php get_template_part( 'template-parts/single-article/entry-footer' ); ?>
	
</article><!-- #post-## -->