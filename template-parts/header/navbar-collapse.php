<?php
/**
 * Header Navbar (Bootstrap 5)
 *
 */
?>

<nav id="main-nav" class="navbar navbar-expand-lg navbar-light">

  <div class="container">

    <!-- Your site title as branding in the menu -->
		<?php get_template_part('template-parts/header/site-branding'); ?>
    <!-- end custom logo -->

    <button class="navbar-toggler" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#navbarOffCanvas"
            aria-controls="navbarOffCanvas" aria-label="<?php esc_attr_e( 'Toggle Navigation', 'wp-theme' ); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- The WordPress Menu goes here -->
    <?php
    	wp_nav_menu( array(
				'theme_location'  => 'header-menu',
				'container_class' => 'collapse navbar-collapse justify-content-center pe-10',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new WP_Custom_Bootstrap_Navwalker()
			) );
    ?>
		<!-- The WordPress Menu goes here -->
		
		<div id="search-subscribe-area" class="ms-4 d-none d-lg-block">
			<ul class="list-inline m-0 ">
				<li class="list-inline-item mail">
					<a href="#" class="email-popup" data-bs-toggle="modal" data-bs-target="#subscribeModal" aria-label="<?php _e('Subscribe Modal Link', 'wp-theme'); ?>">
						<span class="normal"><?= wp_custom_bs_icons('ui', 'mail'); ?></span>
						<span class="hover"><?= wp_custom_bs_icons('ui', 'mail-heart'); ?></span>
					</a>
				</li>
				<li class="list-inline-item search">
					<a href="#" class="search-popup" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="<?php _e('Search Modal Link', 'wp-theme'); ?>">
						<span class="normal"><?= wp_custom_bs_icons('ui', 'search'); ?></span>
						<span class="hover"><?= wp_custom_bs_icons('ui', 'search-heart'); ?></span>
					</a>
				</li>
			</ul>
		</div>

  </div><!-- .container -->

</nav><!-- .site-navigation -->
