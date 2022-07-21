<?php
/*
	Typography custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Text typography
	# 2.1. Text responsive typography
	# 2.2. Post text typography
	# 3. Title typography
	# 3.1. Title responsive sizes
	# 3.2. Post title typography
	# 4. Subtitle typography
	# 4.1. Subtitle responsive typography
	# 5. View
*/


# 1. Variables

$title_typo = false;
$title_responsive_sizes = false;
$subtitle_typo = false;
$subtitle_responsive_sizes = false;
$text_typo = false;
$text_responsive_sizes = false;
$post_title_typo = false;
$post_text_typo = false;


# 2. Text typography

$text_typo = NorebroSettings::get( 'page_text_typo', 'global' );


# 2.1. Text responsive typography

$_text_font_sizes_raw = NorebroSettings::get( 'page_paragraphs_font_sizes', 'global' );
$text_responsive_sizes = NorebroHelper::parse_responsive_font_sizes( $_text_font_sizes_raw );


# 2.2. Post text typography

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'custom' ) {
		$post_text_typo = NorebroSettings::get( 'post_page_text_typo', 'global' );
	}
}


# 3. Title typography

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'custom' ) {
		$title_typo = NorebroSettings::get( 'post_header_title_typo', 'global' );
	} else {
		$title_typo = NorebroSettings::get( 'page_headings_typo', 'global' );
	}
} else {
	$title_typo = NorebroSettings::get( 'page_headings_typo', 'global' );
}


# 3.1. Title responsive sizes

$_title_font_sizes_raw = NorebroSettings::get( 'page_titles_font_sizes', 'global' );
$title_responsive_sizes = NorebroHelper::parse_responsive_font_sizes( $_title_font_sizes_raw );


# 3.2. Post title typography

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'custom' ) {
		$post_title_typo = NorebroSettings::get( 'post_header_title_typo', 'global' );
	}
}


# 4. Subtitle typography

$subtitle_typo = NorebroSettings::get( 'page_subtitles_typo', 'global' );


# 4.1. Subtitle responsive typography

$_subtitle_font_sizes_raw = NorebroSettings::get( 'page_subtitles_font_sizes', 'global' );
$subtitle_responsive_sizes = NorebroHelper::parse_responsive_font_sizes( $_subtitle_font_sizes_raw );

# 5. View

// Global settings
/* Texts */
$_style_selectors = 'body, .font-main, .font-main a, p';	
$_responsive_selectors = $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $text_typo );	
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = 'input, select, textarea, .accordion-box .buttons h5.title, .woocommerce div.product accordion-box.outline h5';
$_responsive_selectors .= ', ' . $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $text_typo, array( 'rule' => 'exclude', 'fields' => array( 'color' ) ) );	
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $text_responsive_sizes ) {
	$_responsive_css = NorebroHelper::get_all_responsive_font_css( $text_responsive_sizes, $_responsive_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_responsive_css );
}

/* Headings */
$_style_selectors = 'h1, h2, h3, h3.second-title, h4 ,h5, .counter-box .count, .counter-box .counter-box-count, ';
$_style_selectors .= 'h1 a, h2 a, h3 a, h4 a, h5 a';
$_responsive_selectors = $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.countdown-box .box-time .box-count, .chart-box-pie-content';
$_responsive_selectors .= ', ' . $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo, array( 'rule' => 'exclude', 'fields' => array( 'line-height' ) ) );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = 'button, .btn, a.btn, input[type="submit"], .socialbar.boxed-fullwidth a .social-text, .breadcrumbs, ';
$_style_selectors .= '.font-titles, h1, h2, h3, h4, h5, h6, .countdown-box .box-time .box-count, .counter-box .counter-box-count, ';
$_style_selectors .= '.vc_row .vc-bg-side-text, .slider-vertical-numbers li, .slider-vertical-numbers > div, .slider-vertical-numbers > .owl-dot, ';
$_style_selectors .= '.slider-vertical-dots li, .slider-vertical-dots > div, .slider-vertical-dots > .owl-dot, .socialbar.inline a, ';
$_style_selectors .= '.socialbar.boxed a .social-text, .widget_calendar caption, .breadcrumbs, nav.pagination, #masthead .site-title, ';
$_style_selectors .= '#masthead .site-title a, .header-search form input, #mega-menu-wrap > ul > li, #masthead .menu-other > li > a, ';
$_style_selectors .= '#masthead .menu-other > li .submenu .sub-nav.languages li a, .fullscreen-navigation .languages, ';
$_style_selectors .= '.portfolio-sorting li, .portfolio-item.grid-4 .more, .portfolio-item.grid-5 .more, .portfolio-grid-4 .scroll, ';
$_style_selectors .= '.portfolio-grid-5 .scroll, .portfolio-grid-7 .scroll';
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo, array( 'rule' => 'include', 'fields' => array( 'font-family' ) ) );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.portfolio-item h4, .portfolio-item h4.title, .portfolio-item h4 a, .portfolio-item.grid-4 h4.title, ';
$_style_selectors .= '.portfolio-item-2 h4, .portfolio-item-2 h4.title, .portfolio-item-2 h4 a, .woocommerce ul.products li.product a';
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo, array( 'rule' => 'exclude', 'fields' => array( 'font-size', 'line-height' ) ) );
if ($_css) {
	$_css .= 'font-size:inherit;';
	$_css .= 'line-height:inherit;';
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.blog-item h3.title';
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo, array( 'rule' => 'exclude', 'fields' => array( 'font-size', 'line-height' ) ) );
if ($_css) {
	$_css .= 'line-height: initial;';
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	$_style_block .= '.blog-item h3.title a{';
	$_style_block .= 'font-size: initial;';
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.portfolio-item-2 h4';
$_css = NorebroHelper::parse_acf_typo_to_css( $title_typo, array( 'rule' => 'exclude', 'fields' => array( 'font-size', 'color' ) ) );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $title_responsive_sizes ) {
	$_responsive_css = NorebroHelper::get_all_responsive_font_css( $title_responsive_sizes, $_responsive_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_responsive_css );
}


/* Subheadings */
$_style_selectors = 'p.subtitle, .subtitle-font, a.category';
$_responsive_selectors = $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = 'span.category > a, div.category > a';
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo, array( 'rule' => 'exclude', 'fields' => array( 'font-size', 'line-height' ) ) );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.portfolio-item .subtitle-font, .woocommerce ul.products li.product .subtitle-font.category, ';
$_style_selectors .= '.woocommerce ul.products li.product .subtitle-font.category > a';
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo, array( 'rule' => 'exclude', 'fields' => array( 'font-size', 'line-height' ) ) );
if ($_css) {
	$_css .= 'font-size:inherit;';
	$_css .= 'line-height:inherit;';
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = 'input.classic::-webkit-input-placeholder, .contact-form.classic input::-webkit-input-placeholder, ';
$_style_selectors .= '.contact-form.classic textarea::-webkit-input-placeholder, input.classic::-moz-placeholder';
$_responsive_selectors .= ', ' . $_style_selectors;
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = '.contact-form.classic input::-moz-placeholder, .contact-form.classic textarea::-moz-placeholder';
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

$_style_selectors = 'input.classic:-ms-input-placeholder, .contact-form.classic input:-ms-input-placeholder, ';
$_style_selectors .= '.contact-form.classic textarea:-ms-input-placeholder';
$_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo );
if ($_css) {
	$_style_block = NorebroHelper::wrap_css_to_selector( $_css, $_style_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $subtitle_responsive_sizes ) {
	$_responsive_css = NorebroHelper::get_all_responsive_font_css( $subtitle_responsive_sizes, $_responsive_selectors );
	NorebroLayout::append_to_dynamic_css_buffer( $_responsive_css );
}


// Post text
if ( NorebroHelper::parse_acf_typo_to_css( $post_text_typo ) ) {
	// --- start of CSS ---
	$_style_block  = '#main .post .entry-content, #main .post .entry-content p{';
	$_style_block .= NorebroHelper::parse_acf_typo_to_css( $post_text_typo );
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

// Post headings
if ( NorebroHelper::parse_acf_typo_to_css( $post_title_typo ) ) {
	// --- start of CSS ---
	$_style_block  = '#main .post .entry-content h1,';
	$_style_block .= '#main .post .entry-content h2,';
	$_style_block .= '#main .post .entry-content h3,';
	$_style_block .= '#main .post .entry-content h4,';
	$_style_block .= '#main .post .entry-content h5{';
	$_style_block .= NorebroHelper::parse_acf_typo_to_css( $post_title_typo );
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}