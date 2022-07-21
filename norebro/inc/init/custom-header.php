<?php

function norebro_init_custom_header() {
	add_theme_support( 'custom-header', apply_filters( 'norebro_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'norebro_init_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'norebro_init_custom_header' );

if ( ! function_exists( 'norebro_init_header_style' ) ) {
	function norebro_init_header_style() {
		// Thats all
	}
}