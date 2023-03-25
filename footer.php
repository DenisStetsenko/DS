<?php
/**
 * The template for displaying the footer
 */
?>

</div><!-- #wrapper -->

	<footer id="colophon" aria-label="Footer" class="footer site-footer border-top text-black font-secondary py-4 bg-light-gray">
		<div class="container">
	
			<div class="row align-items-center">
				<div class="col-lg-8 order-lg-2 text-lg-end">
					<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
						<nav id="nav-footer-menu" class="footer-menu" role="navigation">
							<?php wp_nav_menu( array(
									'theme_location'  => 'footer-menu',
									'menu_class'      => 'list-inline m-0',
									'container'      	=> FALSE,
									'fallback_cb'     => 'wp_bootstrap_navwalker::fallback')
							); ?>
						</nav>
					<?php } ?>
				</div>
				<div class="col-lg-4 order-lg-1">
					<p class="m-0"><?php printf( __( '©%s %s. Published with <i class="icon">%s</i>', 'wp-theme' ),
															 date('Y'),
															 get_bloginfo('name'),
															 wp_custom_bs_icons('ui', 'heart') ); ?></p>
				</div>
			</div>
	
		</div>
	</footer>

</div><!-- #page we need this extra closing tag here -->


<?php if ( is_singular('post') ) : ?>
	<script>
      let progressScroll = () => {
          let docElem = document.documentElement,
              docBody = document.body,
              scrollTop = docElem['scrollTop'] || docBody['scrollTop'],
              scrollBottom = (docElem['scrollHeight'] || docBody['scrollHeight']) - window.innerHeight,
              scrollPercent = scrollTop / scrollBottom * 100 + '%';
          document.getElementById("progress-bar").style.setProperty("--scrollAmount", scrollPercent);
      }
      document.addEventListener('scroll', progressScroll);
	</script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>