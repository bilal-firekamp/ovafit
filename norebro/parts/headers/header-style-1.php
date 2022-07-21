<?php
	// Settings
	$is_fixed = NorebroSettings::header_is_fixed();
	$mobile_is_fixed = NorebroSettings::get( 'header_mobile_menu_fixed', 'global' );
	$fixed_initial_offset = NorebroSettings::get( 'header_fixed_initial_offset', 'global' );

	$use_wrapper = NorebroSettings::header_use_wrapper();
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

<header id="masthead" class="site-header light-text header-1<?php echo esc_attr($header_classes); ?>"
<?php if ( $is_fixed ) { echo ' data-header-fixed="true"'; } ?>
<?php if ( $mobile_is_fixed ) { echo ' data-mobile-header-fixed="true"'; } ?>
<?php if ( $fixed_initial_offset ) { echo ' data-fixed-initial-offset="' . $fixed_initial_offset . '"'; } ?>>
	<div class="header-wrap<?php if ( $use_wrapper ) { echo ' page-container'; } ?>">
		<?php get_template_part( 'parts/elements/header-menu-logo' ); ?>
		<div class="right">
			<?php get_template_part( 'parts/elements/header-menu-nav' ); ?>
			<?php get_template_part( 'parts/elements/header-menu-optional-nav' ); ?>
			<?php 
				if ( ! NorebroSettings::hamburger_in_panel() ) {
					get_template_part( 'parts/elements/header-menu-hamburger' );
				}
			?>
			<div class="close-menu"></div>
		</div>
	</div><!-- .header-wrap -->
</header><!-- #masthead -->

<?php get_template_part( 'parts/elements/header-menu-fullscreen-nav' ); ?>