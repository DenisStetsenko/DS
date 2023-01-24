<?php
if ( is_front_page() ) return;
if ( has_post_thumbnail( get_queried_object_id() ) ) {
  $background = get_the_post_thumbnail_url( get_queried_object_id(), 'full');
} else {
  return;
}
?>
<div id="page-banner" class="">
  <div class="inner d-flex align-items-center position-relative overflow-hidden" style="background: url(<?= $background; ?>) no-repeat center top/cover">
    <div class="container position-relative z-index">
      <div class="row">
        <div class="col-12 text-center" data-aos="fade" data-aos-delay="50" data-aos-duration="700" data-aos-easing="ease-in-out" data-aos-anchor-placement="top-bottom">

          <?php
          if ( is_front_page() ) :


          else : ?>
            <h1 class="page-title text-center text-white text-uppercase m-0"><?php
              if ( is_home() ) {
                single_post_title();
              } elseif ( is_archive() ) {
                get_the_archive_title();
              } else {
                the_title();
              }
              ?></h1>
          <?php
          endif; ?>

        </div>
      </div>
    </div>
  </div>
</div>