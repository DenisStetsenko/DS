<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ' sticky-top';

$wrapper_classes .= ' bg-white';
?>

<?php get_template_part( 'template-parts/header/notification-bar' ); ?>

<div id="progress-bar-container" class="bg-white">
	<div id="progress-bar"></div>
</div>
<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>">
  <?php get_template_part( 'template-parts/header/navbar-collapse' ); ?>
</header><!-- #masthead -->
