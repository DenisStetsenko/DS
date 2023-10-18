<?php
// ACF: Pros & Cons
$pros_and_cons = get_field('pros_and_cons');


// Support custom "anchor" values.
$anchor = "";
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id='.esc_attr( $block['anchor'] );
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wp-block-pros-and-cons pros-and-cons d-sm-flex flex-wrap rounded border overflow-hidden font-secondary';
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

	<?php if ( $pros_and_cons && array_filter($pros_and_cons) ) : ?>
		
		<?php if ( $pros_and_cons['pros'] ) { ?>
			<div class="column pros">
				<div class="heading fw-bold font-secondary text-center"><span><?php _e('Pros', 'wp-theme'); ?></span></div>
				<ul class="list pros-list list-unstyled m-0">
					<?php foreach ($pros_and_cons['pros'] as $list_item) : ?>
						<li><span class="icon"></span><?= $list_item['list_item']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php } ?>
	
		<?php if ( $pros_and_cons['cons'] ) { ?>
			<div class="column cons">
				<div class="heading fw-bold font-secondary text-center"><span><?php _e('Cons', 'wp-theme'); ?></span></div>
				<ul class="list cons-list list-unstyled m-0">
					<?php foreach ($pros_and_cons['cons'] as $list_item) : ?>
						<li><span class="icon"></span><?= $list_item['list_item']; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php } ?>
	
	<?php else : ?>
		<p class="text-center" style="font-family: var(--wp--preset--font-family--inter);font-weight:700;padding: 20px;flex-basis: 0;flex-grow: 1;margin: 0;background: var(--wp--preset--color--pale-pink);">
			PROS & CONS LIST IS EMPTY!<br>
			CLICK TO ADD CONTENT
		</p>
	<?php endif; ?>
	
</div>