<?php
// ACF: Product Card
$product_card_heading = get_field('heading');
$product_card_image   = get_field('hero_image');
$product_card_link   	= get_field('affiliate_link');
$best 								= $product_card_heading['mark_as_best'];
$best_label 					= $best ? 'best' : '';
$excluded_from_toc 		= $product_card_heading['exclude_from_toc'] ? ' ez-toc-exclude' : '';

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

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wp-block-acf-product-card-item product-card';
if ( ! empty( $block['className'] ) )   $class_name .= ' ' . $block['className'];

if ( ! empty( $product_card_heading['title'] && array_filter($product_card_heading) ) ) { ?>
	
	<div class="<?= esc_attr( $class_name ); ?>" style="<?= esc_attr( $margin ); ?>">
		<!-- PRODUCT HEADING -->
		<?php
		$number_data 						= '';
		$title_tag 							= $product_card_heading['title_tag'];
		$original_product_title = $product_card_heading['title']; ?>
		<header class="product-heading mb-4">
			<?php
			
			if ( preg_match('/^\d+\./', $original_product_title) ) {
				$product_title 	= preg_replace('/^\d+\.\s*/', '', $original_product_title); // Use preg_replace to remove the number and dot from the beginning of the string.
				$number 				= trim(preg_replace('/^(\d+\.\s*).*/', '$1', $original_product_title)); // Use preg_replace to keep only the number and dot at the beginning of the string.
				
				$number_data = "data-number=\"$number\"";
				$product_title = '<span class="number">'. $number . '</span> ' . $product_title;
				
			} else {
				$product_title = $original_product_title;
			}
			
			echo "<$title_tag class=\"title m-0$excluded_from_toc\" $number_data>";
				
				if ( $product_card_link ) {
					$link_target = $product_card_link['target'] ? 'target="_blank" rel="nofollow sponsored"' : '';
					echo '<a class="affiliate-link" href="'. esc_url($product_card_link['url']) .'" '.$link_target.'>'. $product_title . '</a>';
				}
				else {
					echo $product_title;
				}
				
			echo "</$title_tag>";
			echo $product_card_heading['subtitle'] ? '<p class="subtitle mt-3 font-secondary text-black fw-bold text-uppercase fs-4 lh-sm ls-lg">'. $product_card_heading['subtitle'].'</p>' 	: null; ?>
		</header>
		<!-- / PRODUCT HEADING -->
		
		<!-- PRODUCT BIG IMAGE -->
		<?php if ( $product_card_image ) {
			echo '<figure class="post-thumbnail figure rounded w-100 mb-5 '.$best_label.'">';
			echo '<img class="figure-img img-fluid rounded w-100" src="'. $product_card_image['sizes']['large'] .'" loading="lazy" alt="'. esc_attr($product_card_image['alt']) .'">';
			echo '</figure>';
			echo $product_card_image['caption'] ? '<figcaption class="figure-caption font-secondary text-gray fs-5 fst-italic text-center">' . esc_attr($product_card_image['caption']) . '</figcaption>' : '';
		} ?>
		<!-- / PRODUCT BIG IMAGE -->
	</div>

<?php } else { ?>
	<p class="text-center" style="font-family: var(--wp--preset--font-family--inter);font-weight:700;padding: 20px;flex-basis: 0;flex-grow: 1;margin: 0;background: var(--wp--preset--color--pale-pink);">
		PRODUCT CARD IS EMPTY!<br>
		CLICK TO ADD CONTENT
	</p>
<?php }