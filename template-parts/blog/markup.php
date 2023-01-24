<div class="wrapper" id="index-wrapper">

  <div class="container" tabindex="-1">

    <div class="row">
      <div class="col-12">
        <?php
        global $wp_query;
        if ( have_posts() ) :

          if ( is_home() ) {
            $curr_category_slug = 'data-category="blog"';
          } elseif ( is_category() ) {
            $category     = get_query_var('cat');
            $current_cat  = get_category($category);
            $curr_category_slug = 'data-category="'. $current_cat->slug .'"';
          } elseif ( is_archive() ) {
            $curr_category_slug = 'data-category="all" data-year="'. get_query_var('year') .'" data-monthnum="'. get_query_var('monthnum') .'"';
          } elseif ( is_search() ) {
            $curr_category_slug = 'data-category="all" data-search="'. get_search_query() .'"';
          }

          echo '<div class="row posts-loop">';
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/blog/blog-loop-item' );
            endwhile;
          echo '</div>';


          if ( $wp_query->found_posts > get_option('posts_per_page') && ! is_single() ) :
            echo '<button id="load-more" class="btn btn-primary d-table mx-auto mt-5" 
                   '. $curr_category_slug .' data-type="blog" data-ppp="'. get_option('posts_per_page') .'" data-title="'. __('LOAD MORE', 'twentytwentyone') .'">'. __('LOAD MORE', 'twentytwentyone') . '</button>';
          endif;

        else :
          get_template_part( 'template-parts/loop-templates/content', 'none' );
        endif;
        ?>
      </div>
    </div>


  </div>

</div>