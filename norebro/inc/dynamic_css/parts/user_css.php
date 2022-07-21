<?php
/*
	Custom user CSS style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Global custom CSS
	# 3. Current page custom CSS
	# 4. Current page custom CSS
	# 5. Current project custom CSS
	# 6. View
*/


# 1. Variables

$global_css		= false;
$page_css 		= false;
$post_css 		= false;
$project_css 	= false;


# 2. Global custom CSS
$global_css            = NorebroSettings::get( 'page_custom_css', 'global' );
$global_large_css      = NorebroSettings::get( 'page_custom_large_css', 'global' );
$global_medium_css     = NorebroSettings::get( 'page_custom_medium_css', 'global' );
$global_small_css      = NorebroSettings::get( 'page_custom_small_css', 'global' );
$global_extrasmall_css = NorebroSettings::get( 'page_custom_extrasmall_css', 'global' );

# 3. Current page custom CSS
$page_css = NorebroSettings::get( 'page_custom_css' );

# 4. Current page custom CSS
$post_css = NorebroSettings::get( 'post_custom_css' );

# 5. Current project custom CSS
$project_css = NorebroSettings::get( 'project_custom_css' );


# 6. View

if ( $global_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $global_css );
}
if ( $global_large_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $global_large_css, 'desktop' );
}
if ( $global_medium_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $global_medium_css, 'tablet' );
}
if ( $global_small_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $global_small_css, 'mobile' );
}
if ( $global_extrasmall_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $global_extrasmall_css, 'extrasmall' );
}
if ( $page_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $page_css );
}
if ( $post_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $post_css );
}
if ( $project_css ) {
	NorebroLayout::append_to_dynamic_css_buffer( $project_css );
}