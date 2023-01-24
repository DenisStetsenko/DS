<div class="col-md-6 col-lg-4 item">
  <article class="blog-loop-item">
      <a href="<?php the_permalink(); ?>" class="post-thumbnail">

        <span class="bg rounded d-block" style="background: url(<?= get_the_post_thumbnail_url() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://via.placeholder.com/420x315'; ?>) no-repeat center/cover"></span>

        <span class="data d-block">

          <span class="inner-content d-block">
            <?php
            the_title( '<h3 class="entry-title h4">', '</h3>' );
            //echo '<time>' . get_the_date( 'm/j/Y' ) . '</time>';
            if ( has_excerpt() ) {
              the_excerpt();
            } else {
              echo wp_trim_words( get_the_content(), 20, '...' );
            }
            ?>
          </span>
          <span class="btn btn-primary">Read More</span>
        </span>

      </a>
  </article>
</div>