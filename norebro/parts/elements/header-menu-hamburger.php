<?php
	// Settings
	$menu_type = NorebroSettings::menu_type();
?>

<!-- Fullscreen -->
<?php if ( $menu_type == 'hamburger' ) : ?>
	<div class="hamburger-menu" id="hamburger-fullscreen-menu">
		<a class="hamburger" aria-controls="site-navigation" aria-expanded="false"></a>
	</div>
<?php endif; ?>