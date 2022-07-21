<?php
/*
	Typography custom style
	
	Table of contents: (you can use search)
	# 1. Widgets heading
	# 2. Widgets content
	# 3. View
*/


# 1. Variables

$widgets_heading_typo = false;
$widgets_content_typo = false;


# 2. Typography

$widgets_heading_typo = NorebroSettings::get( 'widgets_heading_typo', 'global' );
$widgets_content_typo = NorebroSettings::get( 'widgets_content_typo', 'global' );


$widgets_heading_css = NorebroHelper::parse_acf_typo_to_css( $widgets_heading_typo );
$widgets_content_css = NorebroHelper::parse_acf_typo_to_css( $widgets_content_typo );


# 3. View

if ( $widgets_heading_css ) {
	// --- start of CSS ---
	$_style_block = 'h3.widget-title{';
	$_style_block .= $widgets_heading_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $widgets_content_css ) {
	// --- start of CSS ---
	$_style_block = '.widget, .widget a, .widget input, .widget select, .widget_recent_entries ul a, .widget_recent_comments ul span, .widget_recent_comments ul a{';
	$_style_block .= $widgets_content_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}