<?php
defined( 'ABSPATH' ) || exit;
/**
 * Search results partial template
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header">

    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>'); ?>
  </header><!-- .entry-header -->

  <div class="entry-summary">

    <?php the_excerpt(); ?>

  </div><!-- .entry-summary -->

</article><!-- #post-## -->