<?php
defined( 'ABSPATH' ) || exit;
/**
 * Partial template for content in page.php
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header id="page-header" class="wow fadeInDown" data-wow-delay="50ms">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->
	
  <div class="entry-content wow fadeIn" data-wow-delay="150ms">
    <?php the_content();?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->