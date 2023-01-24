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

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<div class="site" id="page">
  <a class="skip-link visually-hidden-focusable" href="#wrapper"><?php esc_html_e( 'Skip to content', 'wp-theme' ); ?></a>

  <?php get_template_part( 'template-parts/header/site-header' ); ?>
		
	<?php if ( function_exists('yoast_breadcrumb') && is_singular('post') ) { ?>
		<div class="yoast-breadcrumb-container py-3">
			<div class="container">
				<?php yoast_breadcrumb( '<nav id="nav-yoast-breadcrumb" aria-label="breadcrumb"><ol class="breadcrumb font-secondary">','</ol></nav>' ); ?>
			</div>
		</div>
	<?php } ?>
	
	<div id="wrapper" class="site-content">