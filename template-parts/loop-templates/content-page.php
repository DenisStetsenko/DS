<?php
/**
 * Partial template for content in page.php
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header id="page-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->
	
  <div class="entry-content mobile-content-sm-size">
    <?php the_content();?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->