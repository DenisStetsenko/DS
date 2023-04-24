<?php
/**
 * Partial template for content in page.php
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header id="page-header" class="wow fadeIn" data-wow-delay="50ms" data-wow-duration="700ms">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->
	
  <div class="entry-content mobile-content-sm-size wow fadeIn" data-wow-delay="100ms" data-wow-duration="700ms">
    <?php the_content();?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->