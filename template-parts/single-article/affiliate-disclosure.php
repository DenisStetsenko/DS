<?php
$affiliate_disclosure = get_field('affiliate_disclosure', 'option');

if ( $affiliate_disclosure ) : ?>
	<aside class="affiliate-disclosure bg-light-gray text-gray rounded border mb-4 font-secondary text-start">
		<?= apply_filters('the_content', $affiliate_disclosure); ?>
	</aside>
<?php endif; ?>