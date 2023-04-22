<?php
$wp_query = new WP_Query(array(
	'post_type'	      => 'testimonials',
	'post_status'     => 'publish',
	'orderby'					=> 'rand',
	'order'						=> 'DESC',
	'posts_per_page'  => 3
));
if ( $wp_query->have_posts() ) :
	wp_enqueue_script('slick'); ?>
	
	<section id="hero-testimonials" class="section-margin">
		<div class="container">
			
			<header class="section-title text-center wow fadeInDown" data-wow-delay="50ms" data-wow-offset="60" data-wow-duration="700ms">
				<h2 class=""><?php _e('Opinions Matter'); ?></h2>
			</header>
			
			<div id="testimonials-slider" class="testimonials-loop d-none">
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="slick-slide">
						<div class="testimonials-loop-card rounded-3 position-relative border bg-light-gray text-center">
							<div class="entry-content fst-italic"><?php the_content(); ?></div>
							<h2 class="name mt-3 ls-lg mb-0"><?php the_title(); ?></h2>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<script>
        (function($) {
          $(document).ready(function(){
            const $slider = $('#testimonials-slider');
            if ( $slider.length ) {
                $slider.on('init', function(event, slick) {
                  $slider.removeClass('d-none');
                }).slick({
                    arrows: true,
                    dots: true,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 7000,
                    cssEase: 'ease-in-out',
                    infinite: true,
                    speed: 700,
                    pauseOnHover: true,
                    pauseOnFocus: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    useTransform: true,
                    adaptiveHeight: false,
                    rows: 0,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                            }
                        },
                    ]
                });
            }
          });
        }(jQuery));
			</script>
		
		</div>
	</section>

<?php endif; wp_reset_query(); ?>

