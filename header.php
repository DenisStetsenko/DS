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
	
	<link rel="apple-touch-icon" sizes="180x180" href="<?= site_url( '/favicon/apple-touch-icon.png' ); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= site_url( '/favicon/favicon-32x32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= site_url( '/favicon/favicon-16x16.png' ); ?>">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php get_template_part('template-parts/header/offcanvas-mobile-menu'); ?>

<div class="site" id="page">
  <a class="skip-link visually-hidden-focusable" href="#wrapper"><?php esc_html_e( 'Skip to content', 'wp-theme' ); ?></a>

  <?php get_template_part( 'template-parts/header/site-header' ); ?>
	
	<div id="wrapper" class="site-content flex-grow-1">