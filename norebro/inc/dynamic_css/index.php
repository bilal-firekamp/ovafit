<?php

get_template_part( 'inc/dynamic_css/parts/subheader' );
get_template_part( 'inc/dynamic_css/parts/header_navigation' );
get_template_part( 'inc/dynamic_css/parts/header_title' );
get_template_part( 'inc/dynamic_css/parts/breadcrumbs' );
get_template_part( 'inc/dynamic_css/parts/panel' );
get_template_part( 'inc/dynamic_css/parts/page' );
get_template_part( 'inc/dynamic_css/parts/portfolio-page' );
get_template_part( 'inc/dynamic_css/parts/widgets' );
get_template_part( 'inc/dynamic_css/parts/elements' );
get_template_part( 'inc/dynamic_css/parts/footer' );
get_template_part( 'inc/dynamic_css/parts/typography' );
get_template_part( 'inc/dynamic_css/parts/brand' );
get_template_part( 'inc/dynamic_css/parts/user_css' );

$dynamic_style = NorebroLayout::get_dynamic_css_buffer();

$retina_buffer = NorebroLayout::get_dynamic_retina_css_buffer();
if ( $retina_buffer ) {
	$dynamic_style .= ' @media(-webkit-min-device-pixel-ratio:2),(min-resolution:192dpi){';
	$dynamic_style .= $retina_buffer;
	$dynamic_style .= '}';
}

wp_add_inline_style( 'norebro-style', $dynamic_style );