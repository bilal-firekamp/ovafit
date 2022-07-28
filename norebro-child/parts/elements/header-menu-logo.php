<?php
	$logo = NorebroSettings::get_logo();
	$logo_for_fixed = NorebroSettings::get_logo( false, true );
	$logo_as_image = is_array( $logo );
	$logo_for_fixed_as_image = is_array( $logo_for_fixed );

	$logo_for_onepage = NorebroSettings::get_logo_for_onepage();

	$show_search = ! NorebroSettings::get( 'header_hide_search', 'global' );
	$header_style = NorebroSettings::header_menu_style();

	$logo_text = NorebroSettings::get( 'branding_text_logo', 'global' );
	if ( $logo_text == NULL ) {
		$logo_text = get_bloginfo( 'name' );
	}
?>

<div class="site-branding">
	<?php if ( $show_search && ( $header_style == 'style6' || $header_style == 'style5' ) ) : ?>
	<div class="search">
		<a href="#" data-nav-search="true">
			<span class="icon ion-android-search"></span>
		</a>
	</div>
	<?php endif; ?>
	<p class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

			<span class="logo<?php if ( $logo_as_image && $logo['mobile'] ) { echo ' with-mobile'; } ?>">
				<?php if ( $logo_as_image && ( $logo['default'] || $logo['retina'] ) ) : ?>
					<img src="<?php echo esc_url( ( $logo['default'] ) ? $logo['default'] : $logo['retina'] ); ?>" <?php if ( $logo['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo['retina'] ) { echo ' srcset="' . $logo['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( $logo_text ); ?>">
				<?php else : ?>
					<?php echo esc_html( $logo_text ); ?>
				<?php endif; ?>
			</span>

			<span class="fixed-logo">
				<?php if ( $logo_for_fixed_as_image && ( $logo_for_fixed['default'] || $logo_for_fixed['retina'] ) ) : ?>
					<img src="<?php echo esc_url( ( $logo_for_fixed['default'] ) ? $logo_for_fixed['default'] : $logo_for_fixed['retina'] ); ?>" <?php if ( $logo_for_fixed['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo_for_fixed['retina'] ) { echo ' srcset="' . $logo_for_fixed['retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( $logo_text ); ?>">
				<?php else : ?>
					<?php echo esc_html( $logo_text ); ?>
				<?php endif; ?>
			</span>

			<?php if ( $logo_as_image && $logo['mobile'] ) : ?>
			<span class="mobile-logo">
				<img src="<?php echo esc_url( $logo['mobile'] ); ?>" class="<?php if ( $logo['have_vector'] ) { echo ' svg-logo'; } ?>" alt="<?php echo esc_attr( $logo_text ); ?>">
			</span>
			<?php endif; ?>

			<?php if ( $logo_for_fixed_as_image && $logo_for_fixed['mobile'] ) : ?>
			<span class="fixed-mobile-logo">
				<img src="<?php echo esc_url( $logo_for_fixed['mobile'] ); ?>" class="<?php if ( $logo_for_fixed['have_vector'] ) { echo ' svg-logo'; } ?>" alt="<?php echo esc_attr( $logo_text ); ?>">
			</span>
			<?php endif; ?>

			<span class="for-onepage">
				<span class="dark hidden">
					<?php if ( $logo_for_onepage['dark'] || $logo_for_onepage['dark_retina'] ) : ?>
						<img src="<?php echo esc_url( ( $logo_for_onepage['dark'] ) ? $logo_for_onepage['dark'] : $logo_for_onepage['dark_retina'] ); ?>" <?php if ( $logo_for_onepage['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo_for_onepage['dark_retina'] ) { echo ' srcset="' . $logo_for_onepage['dark_retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( $logo_text ); ?>">
					<?php else : ?>
						<?php echo esc_html( $logo_text ); ?>
					<?php endif; ?>
				</span>
				<span class="light hidden">
					<?php if ( $logo_for_onepage['light'] || $logo_for_onepage['light_retina'] ) : ?>
						<img src="<?php echo esc_url( ( $logo_for_onepage['light'] ) ? $logo_for_onepage['light'] : $logo_for_onepage['light_retina'] ); ?>" <?php if ( $logo_for_onepage['have_vector'] ) { echo ' class="svg-logo"'; } ?><?php if ( $logo_for_onepage['light_retina'] ) { echo ' srcset="' . $logo_for_onepage['light_retina'] . ' 2x"'; } ?> alt="<?php echo esc_attr( $logo_text ); ?>">
					<?php else : ?>
						<?php echo esc_html( $logo_text ); ?>
					<?php endif; ?>
				</span>
			</span>
		</a>
	</p>
</div><!-- .site-branding -->
