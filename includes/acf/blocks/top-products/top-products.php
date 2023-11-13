<?php
// ACF: Product Comparison
$top_products = get_field('top_products');

// Support custom "anchor" values.
$anchor = "";
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id='.esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wp-block-acf-top-products-list product-summary-wrapper overflow-hidden rounded-3 bg-light-gray border py-5 py-sm-4 px-4';
if ( ! empty( $block['className'] ) )   $class_name .= ' ' . $block['className'];

// Set Custom Margin & Bottom adjustments
$margin				= '';
$marginTop 		= '';
$marginBottom = '';

if (isset($block['style']['spacing']['margin']['top'])) {
	$marginTop = $block['style']['spacing']['margin']['top'];
	$margin .= 'margin-top:' . get_spacing_value($marginTop) . ';';
}

if (isset($block['style']['spacing']['margin']['bottom'])) {
	$marginBottom = $block['style']['spacing']['margin']['bottom'];
	$margin .= 'margin-bottom:' . get_spacing_value($marginBottom) . ';';
}

if ( ! empty( $top_products && array_filter($top_products) ) ) { ?>
	<div <?= esc_attr( $anchor ); ?> class="<?= esc_attr( $class_name ); ?>" style="<?= esc_attr( $margin ); ?>">
		<?php
		foreach ( $top_products as $key => $product ) :
			$first = $key === array_key_first($top_products);
			$product['logo'] && $product['logo']['alt'] ? $alt_top = $product['logo']['alt'] : $alt_top = $product['heading']['title'];
			?>
			<div class="top-picks row align-items-md-center <?= $first ? 'best' : ''; ?>">
				
				<div class="col-sm-3">
					<?= $product['logo'] ? '<div class="column-preview rounded-2 bg-white d-flex align-items-center justify-content-center py-2 px-2 position-relative">
																						<img class="img-fluid product-logo" src="'.$product['logo']['sizes']['medium'].'" loading="lazy" alt="'. esc_attr($alt_top) . '">
																				 </div>' : null ; ?>
				</div>
				
				<div class="col-sm-9 ps-2">
					
					<div class="column-description position-relative">
						<?php if ( $product['heading'] ) : ?>
							<div class="top-picks-heading font-secondary text-center text-sm-start mt-4 px-4 mt-sm-0 px-sm-0">
								<div class="top pt-1 pt-md-0">
									<?= $product['heading']['subtitle']     ? '<p class="subtitle lh-sm font-secondary fs-6 fw-bolder text-gray text-uppercase">'.wp_strip_all_tags($product['heading']['subtitle']).'</p>' 	: null; ?>
									<?= $product['heading']['title'] 		    ? '<p class="title fw-bold mb-2">'.wp_strip_all_tags($product['heading']['title']).'</p>' 	: null; ?>
									<?= $product['heading']['description'] 	? '<p class="description mb-2">'.wp_kses_post($product['heading']['description']).'</p>' 	: null; ?>
								</div>
								
								<div class="middle d-flex align-items-center justify-content-center my-3 my-sm-0">
									<?php
									if ( is_array($product['affiliate_link_rel']) && ! empty($product['affiliate_link_rel']) ) {
										$link_rel = implode(' ', $product['affiliate_link_rel']);
									} else {
										$link_rel = 'noopener';
									}
									echo acf_link($product['link'], 'btn btn-primary btn-sm affiliate-link fw-medium', $link_rel);
									?>
								</div>
								
								<div class="bottom lh-sm">
									<?php if ( $product['heading']['title'] && ! empty($product['review_link']) ) : ?>
										<a class="more" href="<?= esc_url($product['review_link']['url']); ?>">
											<i class="icon-down"></i><?= esc_attr($product['review_link']['title']); ?>
										</a>
									<?php else : ?>
										<a class="more fw-medium" href="<?php the_permalink(); ?>#<?= sanitize_title_with_dashes($product['heading']['title']); ?>">
											<i class="icon-down"></i><?php _e('Jump to Review', 'wp-theme'); ?>
										</a>
									<?php endif; ?>
								</div>
								
							</div>
						<?php endif; ?>
					</div>
					
				</div>
				
			</div>
			
			<?php endforeach; ?>
	</div>
<?php } else { ?>
	<p class="text-center" style="font-family: var(--wp--preset--font-family--inter);font-weight:700;padding: 20px;flex-basis: 0;flex-grow: 1;margin: 0;">
		TOP PRODUCTS LIST IS EMPTY!<br>
		CLICK TO ADD CONTENT
	</p>
<?php }