<?php
defined( 'ABSPATH' ) || exit;
/**
 * Partial template for plain [ the_content() ] content
 *
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <div class="entry-content">
    <?php the_content();?>
  </div><!-- .entry-content -->

</article><!-- #post-## -->