<?php
// ACF: FAQs
$faqs 						= get_field( 'faqs' );
$exclude_from_toc = get_field( 'exclude_from_toc' );
$excluded_class 	= $exclude_from_toc ? 'ez-toc-exclude' : '';

// Support custom "anchor" values.
if ( ! empty( $block['anchor'] ) ) {
	$anchor = esc_attr( $block['anchor'] );
} else {
	$anchor = acf_uniqid("acf-accordion");
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wp-block-acf-accordion accordion font-secondary';
if ( ! empty( $block['className'] ) )   $class_name .= ' ' . $block['className'];
//if ( ! empty( $block['align'] ) )       $class_name .= ' align' . $block['align'];

$loop_item_class_name = 'accordion-header accordion-button m-0';
if ( ! empty( $excluded_class) )   $loop_item_class_name .= ' ' . $excluded_class;

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
?><div id="<?= esc_attr( $anchor ); ?>" class="<?= esc_attr( $class_name ); ?>" style="<?= esc_attr( $margin ); ?>">
	
	<?php
	$uniqueID = acf_uniqid("faq");
	$i = 1;
	foreach( $faqs as $key => $item ) :
		$active 	= $key === array_key_first($faqs);
		$field_id = $uniqueID. '-' . $i;
		?>
		
		<div class="accordion-item rounded overflow-hidden">
			
			<h3 id="heading-<?= $field_id; ?>" class="<?= esc_attr($loop_item_class_name); ?>"
					itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"
					data-bs-toggle="collapse"
					data-bs-target="#collapse-<?= $field_id; ?>"
					aria-expanded="<?= $active ? 'true' : 'false'; ?>"
					aria-controls="collapse-<?= $field_id; ?>"
			><?= wp_strip_all_tags($item['question']); ?></h3>

			<div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"
					 id="collapse-<?= $field_id; ?>" class="accordion-collapse collapse <?= $active ? 'show' : ''; ?>"
					 aria-labelledby="heading-<?= $field_id; ?>" data-bs-parent="#<?= esc_attr( $anchor ); ?>">
				<div class="accordion-body pt-0">
					<?= $item['answer'] ? '<div class="entry-content font-secondary" itemprop="text">' . wp_kses_post($item['answer']) . '</div>' : null; ?>
				</div>
			</div>
			
		</div>
	<?php $i ++; endforeach; ?>

</div>