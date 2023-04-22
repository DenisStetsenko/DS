<?php if ( has_custom_logo() ) : ?>
	<div class="site-logo site-branding">
		<?php
		$custom_logo_id     = get_theme_mod( 'custom_logo' );
		$custom_logo['alt'] = get_bloginfo('name');
		$image              = wp_custom_svg_icon( wp_get_attachment_image_src($custom_logo_id, 'full')[0] );
		
		if ( $image ) {
			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link d-inline-block" rel="home" aria-current="page" aria-label="%3$s">%2$s</a>',
				esc_url( home_url( '/' ) ),
				$image,
				__($custom_logo['alt']. ' Logo', 'wp-theme')
			);
			echo $html;
		}
		?>
	</div>
<?php endif; ?>