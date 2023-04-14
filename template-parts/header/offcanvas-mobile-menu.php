<div id="navbarOffCanvas" class="offcanvas offcanvas-end" tabindex="-1"  aria-labelledby="offcanvasExampleLabel">
	
	<div class="offcanvas-header">
		<h5 class="offcanvas-title " id="navbarOffCanvasLabel">MENU</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	
	<div class="offcanvas-body">
		<nav id="navbar-offcanvas-nav">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'header-menu',
				'container_id'    => FALSE,
				'container' 			=> 'ul',
				'menu_class'			=> 'list-unstyled font-secondary',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
			) );
			?>
		</nav>
		
	</div>
	
</div>