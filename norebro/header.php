<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php get_template_part( 'parts/elements/preloader' ); ?>

	<?php get_template_part( 'parts/elements/scroll-top' ); ?>

	<?php get_template_part( 'parts/elements/panel' ); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'norebro' ); ?></a>
	
		<?php if ( NorebroSettings::page_is_boxed() ) : ?>
		<div class="boxed-container">
		<?php endif; ?>
	
		<?php get_template_part( 'parts/headers/subheader' ); ?>

		<?php
			$header_menu_style = NorebroSettings::header_menu_style();
			$show_header = ! NorebroSettings::page_is( 'for_builder' );
			$append_header_cap = NorebroSettings::header_cap_is_displayed();
			$append_subheader = NorebroSettings::subheader_is_displayed();
			$show_search = ! NorebroSettings::get( 'header_hide_search', 'global' );

			$header_cap_class = '';
			if ( $header_menu_style == 'style3' ) {
				$header_cap_class .= ' header-3';
			}
			if ( $header_menu_style == 'style4' ) {
				$header_cap_class .= ' header-4';
			}
			if ( $append_subheader ) {
				$header_cap_class .= ' with-subheader';
			}

			if ( $show_header ) {
				switch ( $header_menu_style ) {
					case 'style1' : 
						get_template_part( 'parts/headers/header', 'style-1' );
						break;
					case 'style2' : 
						get_template_part( 'parts/headers/header', 'style-2' );
						break;
					case 'style3' :
						get_template_part( 'parts/headers/header', 'style-3' );
						break;
					case 'style4' : 
						get_template_part( 'parts/headers/header', 'style-4' );
						break;
					case 'style5' : 
						get_template_part( 'parts/headers/header', 'style-5' );
						break;
					case 'style6' : 
						get_template_part( 'parts/headers/header', 'style-6' );
						break;
					default : 
						get_template_part( 'parts/headers/header', 'style-1' );
						break;
				}
			}
		?>

		<?php if ( $show_search ) : ?>
		<div class="header-search">
			<div class="close">
				<span class="ion-ios-close-empty"></span>
			</div>
			<div class="search-wrap">
				<?php get_search_form( true ); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $header_menu_style == 'style6' ) : ?>
		<div class="content-right">
		<?php endif; ?>

		<div id="content" class="site-content">

			<?php if ( $append_header_cap && $show_header ) : ?>
			<div class="header-cap<?php echo esc_attr( $header_cap_class ); ?>"></div>
			<?php endif; ?>