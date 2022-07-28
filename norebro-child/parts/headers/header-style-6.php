<?php
	// Settings
	$mobile_is_fixed = NorebroSettings::get( 'header_mobile_menu_fixed', 'global' );
	$fixed_initial_offset = NorebroSettings::get( 'header_fixed_initial_offset', 'global' );

	$subheader_have_social = have_rows( 'global_header_menu_contacts_bar_social_links', 'option' );
	$show_subheader = NorebroSettings::subheader_is_displayed();

	$mobile_search_visibility = NorebroSettings::get( 'mobile_search_visibility', 'global' );

	$header_classes = '';

	if ( $show_subheader ) { 
		$header_classes .= ' with-subheader'; 
	}
	if ( $mobile_search_visibility == false ) {
		$header_classes .= ' without-mobile-search';
	}
?>

<header id="masthead" class="site-header dark-text header-6<?php echo esc_attr($header_classes); ?>"
<?php if ( $mobile_is_fixed ) { echo ' data-mobile-header-fixed="true"'; } ?>
<?php if ( $fixed_initial_offset ) { echo ' data-fixed-initial-offset="' . $fixed_initial_offset . '"'; } ?>>
	<div class="header-wrap">
		<?php get_template_part( 'parts/elements/header-menu-logo' ); ?>
		<div class="right">
			<?php get_template_part( 'parts/elements/header-menu-nav' ); ?>	
			<?php get_template_part( 'parts/elements/header-menu-optional-nav' ); ?>
			<?php 
				if ( ! NorebroSettings::hamburger_in_panel() ) {
					get_template_part( 'parts/elements/header-menu-hamburger' );
				}
			?>
		</div>
		<div class="close-menu"></div>
	</div><!-- .header-wrap -->

	<div class="header-bottom">
		<p class="copyright">
			<?php echo NorebroSettings::get( 'footer_copyright_left', 'global' ); ?>
		</p>
	</div>
</header><!-- #masthead -->