<?php if ( function_exists('rank_math_the_breadcrumbs') && is_singular('post') && get_field('show_breadcrumbs', 'option') ) { ?>
	<div class="rankmath-breadcrumb-container">
		<div class="container-xl">
			<?php rank_math_the_breadcrumbs(); ?>
		</div>
	</div>
<?php } ?>