<?php
/**
 * The template for displaying the footer
 */
?>

</div><!-- #wrapper -->

<footer id="colophon" class="footer site-footer bg-primary text-white py-4">
  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <?php wp_nav_menu( array(
            'theme_location'  => 'footer-menu',
            'menu_class'      => 'list-unstyled list-inline',
            'fallback_cb'     => 'wp_bootstrap_navwalker::fallback')
        ); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <p class="m-0">Copyright © <?= bloginfo('name') . ' ' . date('Y'); ?>. All Rights Reserved.</p>
      </div>
    </div>

  </div>
</footer>

</div><!-- #page we need this extra closing tag here -->


<?php if ( is_singular('post') ) : ?>
	<script>
      let processScroll = () => {
          let docElem = document.documentElement,
              docBody = document.body,
              scrollTop = docElem['scrollTop'] || docBody['scrollTop'],
              scrollBottom = (docElem['scrollHeight'] || docBody['scrollHeight']) - window.innerHeight,
              scrollPercent = scrollTop / scrollBottom * 100 + '%';
          document.getElementById("progress-bar").style.setProperty("--scrollAmount", scrollPercent);
      }
      document.addEventListener('scroll', processScroll);
	</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>