<?php
/*
	Page custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Colors
	# 3. View
*/

if ( ! NorebroSettings::page_is( 'projects_page' ) ) {
	return false;
}

# 1. Variables

$title_color       = false;
$category_color    = false;
$category_bg_color = false;
$description_color = false;
$more_color        = false;
$numbers_color     = false;
$date_color        = false;
$overlay_color     = false;
$background_color  = false;

$title_color_css       = '';
$category_color_css    = '';
$category_bg_color_css = '';
$description_color_css = '';
$more_color_css        = '';
$numbers_color_css     = '';
$date_color_css        = '';
$overlay_color_css     = '';
$background_color_css  = '';

// Get layout
$projects_layout_item = NorebroSettings::get( 'portfolio_item_layout_type' );
if ( ! $projects_layout_item || $projects_layout_item == 'inherit' ) {
	$projects_layout_item = NorebroSettings::get( 'portfolio_item_layout_type', 'global' );
}


# 2. Colors

$title_color = NorebroSettings::get( 'portfolio_page_title_color' );
if ( ! $title_color ) {
	$title_color = NorebroSettings::get( 'portfolio_page_title_color', 'global' );
}
if ( $title_color ) {
	$title_color_css = 'color:' . $title_color . ';';
}

$category_color = NorebroSettings::get( 'portfolio_page_category_color' );
if ( ! $category_color ) {
	$category_color = NorebroSettings::get( 'portfolio_page_category_color', 'global' );
}
if ( $category_color ) {
	$category_color_css = 'color:' . $category_color . ';';
}

$description_color = NorebroSettings::get( 'portfolio_page_description_color' );
if ( ! $description_color ) {
	$description_color = NorebroSettings::get( 'portfolio_page_description_color', 'global' );
}
if ( $description_color ) {
	$description_color_css = 'color:' . $description_color . ';';
}

$more_color = NorebroSettings::get( 'portfolio_page_more_color' );
if ( ! $more_color ) {
	$more_color = NorebroSettings::get( 'portfolio_page_more_color', 'global' );
}
if ( $more_color ) {
	$more_color_css = 'color:' . $more_color . ';border-color:' . $more_color . ';';
}

switch ( $projects_layout_item ) {
	case "grid_1_hover_1":
	case "grid_1_hover_2":
	case "grid_1_hover_3":
	case "grid_4":
	case "grid_5":
	case "grid_7":
	case "grid_8":
		$category_bg_color = NorebroSettings::get( 'portfolio_page_category_bg_color' );
		if ( ! $category_bg_color ) {
			$category_bg_color = NorebroSettings::get( 'portfolio_page_category_bg_color', 'global' );
		}
		if ( $category_bg_color ) {
			$category_bg_color_css = 'background-color:' . $category_bg_color . ';border-color:' . $category_bg_color . ';';
		}
		break;
} 

$overlay_color = NorebroSettings::get( 'portfolio_page_overlay_color' );
if ( ! $overlay_color ) {
	$overlay_color = NorebroSettings::get( 'portfolio_page_overlay_color', 'global' );
}
if ( $overlay_color ) {
	$overlay_color_css = 'background-color:' . $overlay_color . ';';
}

$background_color = NorebroSettings::get( 'portfolio_page_background_color' );
if ( ! $background_color ) {
	$background_color = NorebroSettings::get( 'portfolio_page_background_color', 'global' );
}
if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}

if ( $projects_layout_item == 'grid_8' ) {
	
	$numbers_color = NorebroSettings::get( 'portfolio_page_numbers_color' );
	if ( ! $numbers_color ) {
		$numbers_color = NorebroSettings::get( 'portfolio_page_numbers_color', 'global' );
	}
	if ( $numbers_color ) {
		$numbers_color_css = 'color:' . $numbers_color . ';';
	}

	$date_color = NorebroSettings::get( 'portfolio_page_date_color' );
	if ( ! $date_color ) {
		$date_color = NorebroSettings::get( 'portfolio_page_date_color', 'global' );
	}
	if ( $date_color ) {
		$date_color_css = 'color:' . $date_color . ';';
	}
}




# 6. View

if ( $title_color_css ) {
	// --- start of CSS ---
	$_style_block = '.portfolio-item .description h4.title{';
	$_style_block .= $title_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $category_color_css || $category_bg_color_css ) {
	// --- start of CSS ---
	$_style_block = '.portfolio-item span.category, .portfolio-item.grid-2 span.category, .portfolio-item.grid-8 span.category{';
	$_style_block .= $category_color_css;
	$_style_block .= $category_bg_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $description_color_css ) {
	// --- start of CSS ---
	$_style_block = '.portfolio-item .text-description{';
	$_style_block .= $description_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $more_color_css ) {
	// --- start of CSS ---
	$_style_block = '';
	switch ( $projects_layout_item ) {
		case 'grid_2_hover_2':
			$_style_block .= '.portfolio-item.grid-2.hover-2 div.overlay span{';
			break;
		case 'grid_7':
		case 'grid_8':
			$_style_block .= '.portfolio-item.grid-7 a.more{';
			break;
		default:
			$_style_block .= '.portfolio-item div.more, .portfolio-item a.more{';
			break;
	}
	$_style_block .= $more_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $overlay_color_css ) {
	// --- start of CSS ---
	$_style_block = '';
	switch ( $projects_layout_item ) {
		case 'grid_1_hover_3':
			$_style_block .= '.portfolio-item.grid-1.hover-3 .description{';
			break;
		case 'grid_2_hover_2':
			$_style_block .= '.portfolio-item.grid-2.hover-2 .overlay{';
			break;
		case 'grid_4':
			$_style_block .= '.portfolio-item.grid-4 .overlay{';
			break;
		case 'grid_7':
		case 'grid_8':
			$_style_block .= '.portfolio-item.grid-7 .description{';
			break;
		default:
			$_style_block .= 'div.portfolio-item.grid-1:after{';
			break;
	}
	$_style_block .= $overlay_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $numbers_color_css && $projects_layout_item == 'grid_8' ) {
	// --- start of CSS ---
	$_style_block = '';
	$_style_block .= '.portfolio-item.grid-8 .date{';
	$_style_block .= $numbers_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $date_color_css && $projects_layout_item == 'grid_8' ) {
	// --- start of CSS ---
	$_style_block = '';
	$_style_block .= '.portfolio-item.grid-8 .date-left{';
	$_style_block .= $date_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $background_color_css && $projects_layout_item == 'grid_8' ) {
	// --- start of CSS ---
	$_style_block = '';
	$_style_block .= '.portfolio-item.grid-8:after{';
	$_style_block .= $background_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}