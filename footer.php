<?php
/**
 * The template for displaying the footer
 */
?>

</div><!-- #wrapper -->

	<footer id="colophon" aria-label="Footer" class="footer site-footer border-top text-black font-secondary py-3 py-md-4 bg-light-gray">
		<div class="container">
	
			<div class="row align-items-center">
				<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
					<div class="col-md-6 order-md-2 text-center text-md-end mb-2 mb-md-0">
						<nav id="nav-footer-menu" class="footer-menu">
							<?php wp_nav_menu( array(
									'theme_location'  => 'footer-menu',
									'menu_class'      => 'list-inline m-0',
									'container'      	=> FALSE,
									'fallback_cb'     => 'wp_bootstrap_navwalker::fallback')
							); ?>
						</nav>
					</div>
				<?php } ?>
				<div class="col-md-6 order-md-1 text-center text-md-start">
					<p class="m-0"><?php printf( __( '©%s %s. Published with <i class="icon">%s</i>', 'wp-theme' ),
															 date('Y'),
															 get_bloginfo('name'),
															 wp_custom_bs_icons('ui', 'heartUA') ); ?></p>
				</div>
			</div>
	
		</div>
	</footer>

</div><!-- #page we need this extra closing tag here -->


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

<?php if ( is_singular('post') ) : ?>
<script>
	document.addEventListener("DOMContentLoaded", () => {
      /**
			 * https://www.jsdelivr.com/package/npm/gumshoejs
       */
		const header = document.querySelector('#masthead');
		const spy = new Gumshoe('#right-sidebar #ez-toc-container > nav a', {
			nested			: true,
			nestedClass	: 'active-parent',
			reflow			: false,
			offset: function () {
					return header.getBoundingClientRect().height + 65;
			}
		});
	});
</script>
<?php endif; ?>

<?php get_template_part('template-parts/popups/search-popup'); ?>
<?php get_template_part('template-parts/popups/email-popup'); ?>

<?php wp_footer(); ?>
</body>
</html>