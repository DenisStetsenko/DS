<?php
/**
 * Header Navbar (Bootstrap 5)
 *
 */
?>

<label id="main-nav-label" for="main-nav" class="screen-reader-text"><?php esc_html_e( 'Main Navigation', 'wp-theme' ); ?></label>
<nav id="main-nav" class="navbar navbar-expand-lg navbar-light" aria-labelledby="main-nav-label">

  <div class="container">

    <!-- Your site title as branding in the menu -->
    <?php if ( ! has_custom_logo() ) { ?>

      <?php if ( is_front_page() && is_home() ) : ?>
        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
      <?php else : ?>
        <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
      <?php endif; ?>

      <?php
    } else { the_custom_logo(); }
    ?>
    <!-- end custom logo -->

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'wp-theme' ); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- The WordPress Menu goes here -->
    <?php
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'container_class' => 'collapse navbar-collapse',
            'container_id'    => 'navbarNavDropdown',
            'menu_class'      => 'navbar-nav ms-auto',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu',
            'depth'           => 2,
            'walker'          => new WP_Custom_Bootstrap_Navwalker(),
        )
    );
    ?>

  </div><!-- .container -->

</nav><!-- .site-navigation -->
