<div id="navbarOffCanvas" class="offcanvas offcanvas-end" tabindex="-1"  aria-labelledby="offcanvasExampleLabel">
	
	<div class="offcanvas-header">
		<h5 class="offcanvas-title " id="navbarOffCanvasLabel">MENU</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	
	<div class="offcanvas-body">
		<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
		<nav id="navbar-offcanvas-nav" class="mt-5 mb-6" role="navigation" aria-label="<?php esc_attr_e( 'Primary Mobile Navigation', 'twentytwentyone-child' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'header-menu',
				'container_id'    => FALSE,
				'container' 			=> 'ul',
				'menu_class'			=> 'list-unstyled font-secondary text-center text-uppercase',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
			) );
			?>
		</nav>
		<?php endif; ?>
		
		<button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#subscribeModal"><?php _e('Subscribe', 'wp-theme'); ?></button>
		<button class="btn btn-secondary w-100 mt-4" data-bs-toggle="modal" data-bs-target="#searchModal"><?php _e('Search', 'wp-theme'); ?></button>
		
	</div>
	
</div>