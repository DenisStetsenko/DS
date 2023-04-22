<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">
	
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/favicon/site.webmanifest">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<!-- Eliminate render-blocking resources google fonts FIX -->
	<link
			rel="preload"
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap"
			as="style"
			onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link
				href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap"
				rel="stylesheet"
				type="text/css">
	</noscript>
	<!-- / Eliminate render-blocking resources google fonts FIX -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-H6ZQK70J7T"></script>
	<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-H6ZQK70J7T');
	</script>
	<!-- Google tag (gtag.js) -->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php get_template_part('template-parts/header/offcanvas-mobile-menu'); ?>

<div class="site" id="page">
  <a class="skip-link visually-hidden-focusable" href="#wrapper"><?php esc_html_e( 'Skip to content', 'wp-theme' ); ?></a>

  <?php get_template_part( 'template-parts/header/site-header' ); ?>
		
	<?php if ( function_exists('yoast_breadcrumb') && is_singular('post') && get_field('show_breadcrumbs', 'option') ) { ?>
		<div class="yoast-breadcrumb-container py-3">
			<div class="container">
				<?php yoast_breadcrumb( '<nav id="nav-yoast-breadcrumb" aria-label="breadcrumb"><ol class="breadcrumb font-secondary m-0">','</ol></nav>' ); ?>
			</div>
		</div>
	<?php } ?>
	
	<div id="wrapper" class="site-content flex-grow-1">