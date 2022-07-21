<?php
/*
	Breadcrumbs custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Text color
	# 4. View
*/


# 1. Variables

$background_color 	= false;
$text_color 		= false;

$background_color_css 	= '';
$text_color_css 		= '';


# 2. Background color

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_breadcrumbs_background_color' ) ) {
		$background_color = NorebroSettings::get( 'post_breadcrumbs_background_color' );
	} else {
		$background_color = NorebroSettings::get( 'breadcrumbs_background_color', 'global' );
	}
} else {
	if ( NorebroSettings::get( 'breadcrumbs_background_color' ) ) {
		$background_color = NorebroSettings::get( 'breadcrumbs_background_color' );
	} else {
		$background_color = NorebroSettings::get( 'breadcrumbs_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Text color

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_breadcrumbs_text_color' ) ) {
		$text_color = NorebroSettings::get( 'post_breadcrumbs_text_color' );
	} else {
		$text_color = NorebroSettings::get( 'breadcrumbs_text_color', 'global' );
	}
} else {
	if ( NorebroSettings::get( 'breadcrumbs_background_color' ) ) {
		$text_color = NorebroSettings::get( 'breadcrumbs_text_color' );
	} else {
		$text_color = NorebroSettings::get( 'breadcrumbs_text_color', 'global' );
	}
}

if ( $text_color ) {
	$text_color_css = 'color:' . $text_color . ';';
}


# 4. View

if ( $background_color_css || $text_color_css ) {
	// --- start of CSS ---
	$_style_block = '.breadcrumbs{';
	$_style_block .= $background_color_css;
	$_style_block .= $text_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}