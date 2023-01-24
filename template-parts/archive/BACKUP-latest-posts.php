  <?php $arg = array(
      'post_type'	      => 'post',
      'category_name'   => 'blog',
      'post_status'     => 'publish',
      'posts_per_page'  => 3
  );
  $wp_query = new WP_Query($arg);
  if ($wp_query->have_posts()) : ?>
  <div id="articles-news" class="section-padding">
    <div class="container container-wide">
      <div class="row">
        <div class="col-12">
          <header class="section-header text-left">
            <h2>My latest blog posts</h2>
          </header>
        </div>
      </div>
      <div class="row posts-loop">
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
          <?php get_template_part( 'template-parts/blog/blog-loop-item' ); ?>
        <?php endwhile; ?>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <a class="btn btn-primary d-table mx-auto" href="<?php the_permalink(get_option('page_for_posts', true)); ?>">SEE ALL POSTS</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; wp_reset_query(); ?>