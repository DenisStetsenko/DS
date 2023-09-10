<?php
$notifications_bar = get_field('notifications_bar', 'option');
if ( ! empty($notifications_bar['content']) && $notifications_bar['enable_disable'] ) : ?>
	<div id="header-notifications_bar" class="quick-navbar text-white py-2"
	     style="background-color: <?= $notifications_bar['custom_background_color'] ? $notifications_bar['custom_background_color'] : '#AF41C1'; ?>">
		<div class="container-xl text-center">
			<div class="entry-content"><?= $notifications_bar['content'] ?></div>
		</div>
	</div>
<?php endif; ?>