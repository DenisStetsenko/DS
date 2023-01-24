<?php
defined( 'ABSPATH' ) || exit;
/**
 * Partial template for content
 *
 */
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header">
    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
  </header><!-- .entry-header -->

  <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>

  <div class="entry-content">
    <?php the_content();?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->