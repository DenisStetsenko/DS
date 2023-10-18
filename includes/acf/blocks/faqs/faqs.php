<?php
// ACF: FAQs
$faqs = get_field( 'faqs' );

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
?><div id="<?= esc_attr( $anchor ); ?>" class="<?= esc_attr( $class_name ); ?>">
	
	<?php
	$uniqueID = acf_uniqid("faq");
	$i = 1;
	foreach( $faqs as $key => $item ) :
		$active 	= $key === array_key_first($faqs);
		$field_id = $uniqueID. '-' . $i;
		?>
		<div class="accordion-item rounded overflow-hidden">
			<h3 itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question"
					class="accordion-header ez-toc-exclude m-0" id="heading-<?= $field_id; ?>">
				<button itemprop="name" class="accordion-button fw-bold <?= $active ? '' : 'collapsed'; ?>" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse-<?= $field_id; ?>"
								aria-expanded="<?= $active ? 'true' : 'false'; ?>" aria-controls="collapse-<?= $field_id; ?>"><?= wp_strip_all_tags($item['question']); ?></button>
			</h3>

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