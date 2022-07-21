<?php
/*
	Custom style for other elements
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. "Go top" arrow background color
	# 3. Preloader shape color
	# 3.1. Preloader background color
	# 4. Portfolio filter text color
	# 4.1. Accent color
	# 5. Fullscreen menu
	# 5.1. Text typo
	# 6. View
*/


# 1. Variables

$go_top_border = false;
$preloader_color = false;
$preloader_background = false;
$portfolio_page_text = false;
$portfolio_page_accent = false;
$fullscreen_background_color = false;
$fullscreen_links_color = false;
$fullscreen_links_typo = false;

$go_top_border_css = '';
$preloader_color_css = '';
$preloader_background_css = '';
$portfolio_page_text_css = '';
$portfolio_page_accent_css = '';
$fullscreen_background_color_css = '';
$fullscreen_links_typo_css = '';
$fullscreen_links_icon_color_css = '';


# 2. "Go top" arrow border color

$go_top_border = NorebroSettings::get( 'page_arrow_color', 'global' );

if ( $go_top_border ) {
	$go_top_border_css = 'border-color:' . $go_top_border . ';';
}


# 3. Preloader shape color

$preloader_color = NorebroSettings::get( 'preloader_shapes_color', 'global' );

if ( $preloader_color ) {
	$preloader_color_css = 'color:' . $preloader_color . ';'; // ?
}


# 3.1. Preloader background color

$preloader_background = NorebroSettings::get( 'preloader_background_color', 'global' );

if ( $preloader_background ) {
	$preloader_background_css = 'background-color:' . $preloader_background . ';';
}


# 4. Portfolio filter text color

$portfolio_page_text = NorebroSettings::get( 'project_filter_text_color' );
if ( ! $portfolio_page_text ) {
	$portfolio_page_text = NorebroSettings::get( 'project_filter_text_color', 'global' );
}

if ( $portfolio_page_text ) {
	$portfolio_page_text_css = 'color:' . $portfolio_page_text  .';';
}


# 4.1. Accent color

$portfolio_page_accent = NorebroSettings::get( 'project_filter_accent_color' );
if ( ! $portfolio_page_accent ) {
	$portfolio_page_accent = NorebroSettings::get( 'project_filter_accent_color', 'global' );
}

if ( $portfolio_page_accent ) {
	$portfolio_page_accent_css = 'color:' . $portfolio_page_accent  .';border-color:' . $portfolio_page_accent . ';';
}


# 5. Fullscreen menu

$fullscreen_background_color = NorebroSettings::get( 'fullscreen_menu_background_color', 'global' );

if ( $fullscreen_background_color ) {
	$fullscreen_background_color_css = 'background-color:' . $fullscreen_background_color  .';';
}


# 5.1. Text typo

$fullscreen_links_typo = NorebroSettings::get( 'fullscreen_menu_text_typo', 'global' );

if ( $fullscreen_links_typo ) {
	$fullscreen_links_typo = json_decode( $fullscreen_links_typo );
	$fullscreen_links_typo_css = NorebroHelper::parse_acf_typo_to_css( $fullscreen_links_typo );
	$fullscreen_links_color = NorebroHelper::parse_acf_typo_to_css( $fullscreen_links_typo, array( 'rule' => 'only_color' ) );
	if ( $fullscreen_links_color ) {
		$fullscreen_links_icon_color_css = NorebroHelper::parse_acf_typo_to_css( $fullscreen_links_typo, array( 'rule' => 'include', 'fields' => array( 'color' ) ) );
	}
}


# 6. View

if ( $preloader_color_css ) {
	// --- start of CSS ---
	$_style_block = '.page-preloader .la-dark{';
	$_style_block .= $preloader_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $preloader_background_css ) {
	// --- start of CSS ---
	$_style_block = '.page-preloader{';
	$_style_block .= $preloader_background_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $go_top_border_css ) {
	// --- start of CSS ---
	$_style_block  = '.scroll-top{';
	$_style_block .= 'opacity:.6;';
	$_style_block .= $go_top_border_css;
	$_style_block .= '}';
	$_style_block .= '.scroll-top:hover{';
	$_style_block .= 'opacity:.9;';
	$_style_block .= $go_top_border_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $portfolio_page_text_css ) {
	// --- start of CSS ---
	$_style_block  = '.portfolio-sorting ul.unstyled,';
	$_style_block  .= '.portfolio-sorting ul.unstyled li a,';
	$_style_block .= '.portfolio-sorting ul.unstyled li a:hover{';
	$_style_block .= $portfolio_page_text_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $portfolio_page_accent_css ) {
	// --- start of CSS ---
	$_style_block  = '.portfolio-sorting .title,';
	$_style_block .= '.portfolio-sorting ul.unstyled li a.active{';
	$_style_block .= $portfolio_page_accent_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $fullscreen_background_color_css ) {
	// --- start of CSS ---
	$_style_block  = '.fullscreen-navigation{';
	$_style_block .= $fullscreen_background_color_css;
	$_style_block .= '}';
	$_style_block .= '.fullscreen-navigation::after{background:rgba(255,255,255,.06);}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $fullscreen_links_typo_css ) {
	// --- start of CSS ---
	$_style_block  = '#fullscreen-mega-menu,';
	$_style_block  = '#fullscreen-mega-menu .copyright,';
	$_style_block .= '.fullscreen-navigation #secondary-menu li a,';
	$_style_block .= '.fullscreen-navigation #secondary-menu li:hover > a.menu-link,';
	$_style_block .= '.fullscreen-navigation #secondary-menu li div.sub-nav a,';
	$_style_block .= '.fullscreen-navigation #secondary-menu li .sub-sub-menu a{';
	$_style_block .= $fullscreen_links_typo_css;
	$_style_block .= '}';

	$_style_block .= '.fullscreen-navigation .ion-ios-close-empty{';
	$_style_block .= $fullscreen_links_icon_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

