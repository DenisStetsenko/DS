<?php
// ACF: Pros & Cons
$pros_and_cons = get_field('pros_and_cons');

// Support custom "anchor" values.
$anchor = "";
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id='.esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wp-block-pros-and-cons pros-and-cons overflow-hidden font-secondary';
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
?><div <?= esc_attr( $anchor ); ?> class="<?= esc_attr( $class_name ); ?>" style="<?= esc_attr( $margin ); ?>">

	<?php if ( isset($pros_and_cons) && array_filter($pros_and_cons) ) :
		$prosHeading = $pros_and_cons['pros_heading'] ? : __('Pros', 'wp-theme');
		$consHeading = $pros_and_cons['cons_heading'] ? : __('Cons', 'wp-theme');
		?>
	
		<div class="column pros border border-2 border-success rounded overflow-hidden">
			<div class="heading fw-bold font-secondary bg-success text-white"><span><?= $prosHeading; ?></span></div>
			<?= $pros_and_cons['pros_content'] ? '<div class="entry-content pros-content">' . wp_kses_post($pros_and_cons['pros_content']) . '</div>' : null; ?>
		</div>
		
		<div class="column cons border border-2 border-danger rounded overflow-hidden">
			<div class="heading fw-bold font-secondary bg-danger text-white"><span><?= $consHeading; ?></span></div>
			<?= $pros_and_cons['cons_content'] ? '<div class="entry-content cons-content">' . wp_kses_post($pros_and_cons['cons_content']) . '</div>' : null; ?>
		</div>
		
	
	<?php else : ?>
		<p class="text-center" style="font-family: var(--wp--preset--font-family--inter);font-weight:700;padding: 20px;flex-basis: 0;flex-grow: 1;margin: 0;background: var(--wp--preset--color--pale-pink);">
			PROS & CONS LIST IS EMPTY!<br>
			CLICK TO ADD CONTENT
		</p>
	<?php endif; ?>
	
</div>