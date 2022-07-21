<?php
/*
	Side panel custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Separator color
	# 4. Panel content color
	# 5. Panel typography settings
	# 6. View
*/


# 1. Variables

$background_color = false;
$content_color = false;
$separator_color = false;
$text_typo = false;


# 2. Background color

$background_color = NorebroSettings::get( 'side_panel_background', 'global' );
if ( $background_color ) {
	$background_color = 'background-color:' . $background_color . ';'; 
}

# 3. Separator color

$separator_color = NorebroSettings::get( 'side_panel_separator', 'global' );
if ( $separator_color ) {
	$separator_color = 'background-color:' . $separator_color . ';';
}


# 4. Panel content color

$content_color = NorebroSettings::get( 'side_panel_color', 'global' );
if ( $content_color ) {
	$content_color = 'color:' . $content_color . ';';
}

# 5. Panel typography settings

$text_typo = NorebroSettings::get( 'side_panel_typo', 'global' );


# 6. View

if ( $background_color || $content_color ) {
	// --- start of CSS ---
	$_style_block  = '.norebro-bar{';
	$_style_block .= $background_color;
	$_style_block .= $content_color;
	$_style_block .= '}';
	$_style_block .= '.bar-hamburger{';
	$_style_block .= $content_color;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $text_typo ) {
	// --- start of CSS ---
	$_style_block  = '.norebro-bar .content{';
	$_style_block .= NorebroHelper::parse_acf_typo_to_css( $text_typo );
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}


if ( $separator_color ) {
	// --- start of CSS ---
	$_style_block  = '.norebro-bar .separator{';
	$_style_block .= $separator_color;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}