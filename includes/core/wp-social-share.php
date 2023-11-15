<?php
function get_share_link($url, $title, $network){
	return getShareLink($url, $title, $network);
}

function getShareLink($url, $title, $network){
	switch($network):
		case 'twitter':
			return 'https://twitter.com/intent/tweet?text='. urlencode($title) .'&amp;url='. urlencode($url);
			break;
		case 'facebook':
			return 'https://www.facebook.com/sharer/sharer.php?u='. urlencode($url);
			break;
		case 'linkedin':
			return 'https://www.linkedin.com/shareArticle?mini=true&amp;title='. urlencode($title) .'&amp;url='. urlencode($url);
			break;
		default:
			return $url;
			break;
	endswitch;
}

function display_social_share_icons() {
	$url   = get_the_permalink();
	$title = get_the_title();
	?>
	<ul class="social-share-icons list-inline">
		<li class="list-inline-item list-heading font-secondary text-gray"><?php _e('Share article', 'wp-theme'); ?>:</li>
		<li class="list-inline-item"><a target="popup" aria-label="<?php _e('Share on Twitter', 'wp-theme'); ?>" data-service="Twitter" href="<?= get_share_link($url, $title, 'twitter'); ?>" rel="nofollow"><?= wp_custom_bs_icons('social', 'twitter'); ?></a></li>
		<li class="list-inline-item"><a target="popup" aria-label="<?php _e('Share on Facebook', 'wp-theme'); ?>" data-service="Facebook" href="<?= get_share_link($url, $title, 'facebook'); ?>" rel="nofollow"><?= wp_custom_bs_icons('social', 'facebook'); ?></a></li>
		<li class="list-inline-item"><a target="popup" aria-label="<?php _e('Share on Linkedin', 'wp-theme'); ?>" data-service="Linkedin" href="<?= get_share_link($url, $title, 'linkedin'); ?>" rel="nofollow"><?= wp_custom_bs_icons('social', 'linkedin'); ?></a></li>
	</ul>
	<?php
}
add_shortcode('social-share', 'display_social_share_icons');