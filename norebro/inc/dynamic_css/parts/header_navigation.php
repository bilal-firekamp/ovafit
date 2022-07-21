<?php
/*
	Header navigation custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Header menu typography
	# 4. Border state
	# 4.1. Border type
	# 4.2. Border color
	# 5. Header height
	# 6. Site name typography
	# 7. View
*/


# 1. Variables

$background_color 	= false;
$fixed_background_color = false;
$mobile_background_color = false;
$header_typo 		   = false;
$fixed_typo 		   = false;
$mobile_typo 		   = false;
$mobile_color 		   = false;
$border_hide 		   = false;
$border_type 		   = false;
$border_color 		   = false;
$fixed_border_hide   = false;
$fixed_border_type   = false;
$fixed_border_color  = false;
$header_height 		= false;
$fixed_height        = false;
$sitename_typo 		= false;

$background_color_css 	= '';
$fixed_background_color_css = '';
$mobile_background_color_css = '';
$mobile_header_menu_color_css = '';
$background_color_css_border = '';
$header_typo_css 		   = '';
$fixed_typo_css 		   = '';
$mobile_typo_css 		   = '';
$mobile_color_css 		= '';
$border_css 			   = '';
$fixed_border_css 	   = '';
$header_height_css 		= '';
$fixed_height_css 		= '';
$sitename_typo_css 		= '';


# 2. Background color

if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
	$background_color = NorebroSettings::get( 'header_menu_background_color' );
} else {
	if ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
			$background_color = NorebroSettings::get( 'woocommerce_header_menu_background_color', 'global' );
		} else {
			$background_color = NorebroSettings::get( 'header_menu_background_color', 'global' );
		}
	} else {
		$background_color = NorebroSettings::get( 'header_menu_background_color', 'global' );
	}
}
if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}

$fixed_background_color = NorebroSettings::get( 'header_fixed_background_color', 'global' );
if ( $fixed_background_color ) {
	$fixed_background_color_css = 'background-color:' . $fixed_background_color . ';';
}

$mobile_background_color = NorebroSettings::get( 'mobile_menu_background_color', 'global' );
if ( $mobile_background_color ) {
	$mobile_background_color_css = 'background-color:' . $mobile_background_color . ';';
}

$mobile_header_menu_color = NorebroSettings::get( 'mobile_header_menu_color', 'global' );
if ( $mobile_header_menu_color ) {
	$mobile_header_menu_color_css = 'color:' . $mobile_header_menu_color . ';';
}


# 3. Header menu typography

if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
	$header_typo = NorebroSettings::get( 'header_menu_text_typo' );
} else {
	if ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
			$header_typo = NorebroSettings::get( 'woocommerce_header_menu_text_typo', 'global' );
		} else {
			$header_typo = NorebroSettings::get( 'header_menu_text_typo', 'global' );
		}
	} else {
		$header_typo = NorebroSettings::get( 'header_menu_text_typo', 'global' );
	}
}

$header_typo_css = NorebroHelper::parse_acf_typo_to_css( $header_typo );

$fixed_typo = NorebroSettings::get( 'header_fixed_text_typo', 'global' );
$fixed_typo_css = NorebroHelper::parse_acf_typo_to_css( $fixed_typo );

$mobile_typo = NorebroSettings::get( 'mobile_menu_typo', 'global' );
$mobile_typo_css = NorebroHelper::parse_acf_typo_to_css( $mobile_typo );

// $mobile_color = NorebroSettings::get( 'mobile_menu_color', 'global' );

if ( $mobile_color ) {
	$mobile_color_css = 'color:' . $mobile_color . ';';
}

# 4. Border state

if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
	$border_hide = NorebroSettings::get( 'header_menu_hide_border' );
} else {
	if ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
			$border_hide = NorebroSettings::get( 'woocommerce_header_menu_hide_border', 'global' );
		} else {
			$border_hide = NorebroSettings::get( 'header_menu_hide_border', 'global' );
			$border_hide = ( $border_hide ) ? 'yes' : 'no';
		}
	} else {
		$border_hide = NorebroSettings::get( 'header_menu_hide_border', 'global' );
		$border_hide = ( $border_hide ) ? 'yes' : 'no';
	}
}

$border_hide = ( bool ) ( $border_hide == 'yes' );

$fixed_border_hide = ( bool ) ( NorebroSettings::get( 'fixed_header_menu_hide_border', 'global' ) == 'yes' );

if ( $border_hide ) {
	$border_css .= 'border:none;';
}

if ( $fixed_border_hide ) {
	$fixed_border_css .= 'border:none;';
}

# 4.1. Border type

if ( ! $border_hide ) {
	if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
		$border_type = NorebroSettings::get( 'header_menu_border_type' );
	} else {
		if ( NorebroSettings::page_is( 'ecommerce' ) ) {
			if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
				$border_type = NorebroSettings::get( 'woocommerce_header_menu_border_type', 'global' );
			} else {
				$border_type = NorebroSettings::get( 'header_menu_border_type', 'global' );
			}
		} else {
			$border_type = NorebroSettings::get( 'header_menu_border_type', 'global' );
		}
	}

	if ( $border_type ) {
		$border_css .= 'border-bottom-style:' . $border_type . ';';
	}
}

if ( ! $fixed_border_hide ) {
	$fixed_border_type = NorebroSettings::get( 'fixed_header_menu_border_type', 'global' );

	if ( $fixed_border_type ) {
		$fixed_border_css .= 'border-bottom-style:' . $fixed_border_type . ';';
	}
}


# 4.2. Border color

if ( ! $border_hide ) {
	if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
		$border_color = NorebroSettings::get( 'header_menu_border_color' );
	} else {
		if ( NorebroSettings::page_is( 'ecommerce' ) ) {
			if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
				$border_color = NorebroSettings::get( 'woocommerce_header_menu_border_color', 'global' );
			} else {
				$border_color = NorebroSettings::get( 'header_menu_border_color', 'global' );
			}
		} else {
			$border_color = NorebroSettings::get( 'header_menu_border_color', 'global' );
		}
	}

	if ( $border_color ) {
		$border_css .= 'border-bottom-color:' . $border_color . ';';
	}
}

if ( ! $fixed_border_hide ) {
	$fixed_border_color = NorebroSettings::get( 'fixed_header_menu_border_color', 'global' );

	if ( $fixed_border_color ) {
		$fixed_border_css .= 'border-bottom-color:' . $fixed_border_color . ';';
	}
}


# 5. Header height
if ( NorebroSettings::get( 'header_menu_style_settings' ) == 'custom' ) {
	$header_height = NorebroSettings::get( 'header_menu_height' );
} else {
	if ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'woocommerce_header_menu_style_settings', 'global' ) == 'custom' ) {
			$header_height = NorebroSettings::get( 'woocommerce_header_menu_height', 'global' );
		} else {
			$header_height = NorebroSettings::get( 'header_menu_height', 'global' );
		}
	} else {
		$header_height = NorebroSettings::get( 'header_menu_height', 'global' );
	}
}


if ( $header_height ) {

	$header_height_css .= 'height:${height}px;';
	$header_height_css .= 'max-height:${height}px;';
	$header_height_css .= 'line-height:${height}px;';

	$header_height_css = NorebroHelper::parse_responsive_height_to_css( $header_height, $header_height_css );
}


$fixed_height = NorebroSettings::get( 'header_fixed_height', 'global' );

if ( $fixed_height ) {

	$fixed_height_css .= 'height:${height}px;';
	$fixed_height_css .= 'max-height:${height}px;';
	$fixed_height_css .= 'line-height:${height}px;';

	$fixed_height_css = NorebroHelper::parse_responsive_height_to_css( $fixed_height, $fixed_height_css );
}



# 6. Site name typography

if ( NorebroSettings::get( 'header_logo_style' ) == 'sitename' ) {
	$sitename_typo = NorebroSettings::get( 'header_menu_sitename_typo' );
} elseif ( in_array( NorebroSettings::get( 'header_logo_style' ), array( 'inherit', NULL ) ) ) {
	if ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'woocommerce_header_logo_style', 'global' ) == 'sitename' ) {
			$sitename_typo = NorebroSettings::get( 'woocommerce_header_sitename_typo', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'woocommerce_header_logo_style', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'logo_type', 'global' ) == 'sitename' ) {
				$sitename_typo = NorebroSettings::get( 'header_menu_logo_typo', 'global' );
			}
		}
	} else {
		if ( NorebroSettings::get( 'logo_type', 'global' ) == 'sitename' ) {
			$sitename_typo = NorebroSettings::get( 'header_menu_logo_typo', 'global' );
		}
	}
}

$sitename_typo_css = NorebroHelper::parse_acf_typo_to_css( $sitename_typo );


# 7. View
if ( $background_color_css || $header_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header, #mega-menu-wrap ul li, #mega-menu-wrap > ul#primary-menu > li, #masthead .menu-other > li > a, #masthead.site-header .header-bottom .copyright {';
	$_style_block .= $header_typo_css;
	$_style_block .= '}';

	// background
	$_style_block .= '#masthead.site-header{';
	$_style_block .= $background_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $fixed_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.header-fixed #mega-menu-wrap > ul > li > a, #masthead.header-fixed .menu-other > li > a {';
	$_style_block .= $fixed_typo_css;
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $mobile_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead #site-navigation.main-nav, #masthead #site-navigation.main-nav ul li, #masthead #sitenavigation.main-nav, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item.current-menu-item > a.menu-link, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item.current-menu-ancestor > a.menu-link, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item a.menu-link:hover, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item a.menu-link.open {';
	$_style_block .= $mobile_typo_css;
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
}
if ( $mobile_color_css ) {
	// --- start of CSS ---
	$_style_block = 'header#masthead{';
	$_style_block .= $mobile_color_css;
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
}

if ( $fixed_background_color_css ) {
	// background
	$_style_block = '#masthead.site-header.header-fixed{';
	$_style_block .= $fixed_background_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $mobile_background_color_css ) {
	// background
	$_style_block = '#masthead #site-navigation.main-nav, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item .sub-nav ul.sub-menu, #masthead #site-navigation.main-nav #mega-menu-wrap #primary-menu .mega-menu-item .sub-nav ul.sub-sub-menu{';
	$_style_block .= $mobile_background_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
}

if ( $mobile_header_menu_color_css ) {
	// background
	$_style_block = '#masthead.site-header, #masthead .menu-other > li > a{';
	$_style_block .= $mobile_header_menu_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
}

if ( $border_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header{';
	$_style_block .= $border_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $fixed_border_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header.header-fixed{';
	$_style_block .= $fixed_border_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}


if ( $header_height_css ) {
	$header_height_classes = 'header#masthead.site-header,#masthead.site-header .header-wrap, .header-cap';

	if ( $header_height_css['desktop'] ) {
		$_style_block = $header_height_classes . '{' . $header_height_css['desktop'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'desktop' );
	}
	if ( $header_height_css['tablet'] ) {
		$_style_block = $header_height_classes . '{' . $header_height_css['tablet'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'tablet' );
	}
	if ( $header_height_css['mobile'] ) {
		$_style_block = $header_height_classes . '{' . $header_height_css['mobile'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
	}
}

if ( $fixed_height_css ) {
	$fixed_height_classes = 'header#masthead.site-header.header-fixed,#masthead.site-header.header-fixed .header-wrap';

	if ( $fixed_height_css['desktop'] ) {
		$_style_block = $fixed_height_classes . '{' . $fixed_height_css['desktop'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'desktop' );
	}
	if ( $fixed_height_css['tablet'] ) {
		$_style_block = $fixed_height_classes . '{' . $fixed_height_css['tablet'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'tablet' );
	}
	if ( $fixed_height_css['mobile'] ) {
		$_style_block = $fixed_height_classes . '{' . $fixed_height_css['mobile'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
	}
}

if ( $sitename_typo_css ) {
	// --- start of CSS ---
	$_style_block = '#masthead.site-header .site-title a,.fullscreen-navigation .site-title,.fullscreen-navigation .site-title a{';
	$_style_block .= $sitename_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}