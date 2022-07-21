<?php

function norebro_enqueue_admin_style() {
	wp_enqueue_style( "admin-styles", get_template_directory_uri() . "/assets/admin/admin_styles.css" );
    $fonts_type = NorebroSettings::get('font_type', 'global');
    if( $fonts_type == 'adobe_fonts') {
        $fonts_url = 'https://use.typekit.net/' . NorebroSettings::get('adobekit_url', 'global') . '.css';
        wp_enqueue_style("adobe-font", esc_url($fonts_url));
    }

	wp_enqueue_style( "ionicons-font", get_template_directory_uri() . "/assets/css/ionicons.min.css" );
	wp_enqueue_style( 'select2css', get_template_directory_uri() . '/assets/css/select2.min.css' );
	wp_enqueue_script( 'select2', get_template_directory_uri() . '/assets/js/libs/select2.min.js' );
	wp_enqueue_script( "admin-scripts", get_template_directory_uri() . "/assets/js/admin.js" );

	if ( function_exists('vc_mode') && vc_mode() == 'admin_frontend_editor' ) {
		wp_enqueue_script( 'norebro-main', get_template_directory_uri() . '/assets/js/main.js' );
	}
}

add_action( "admin_head", "norebro_enqueue_admin_style" );


// Styles including
function norebro_enqueue_own_styles() {
	wp_enqueue_style( 'norebro-style', get_stylesheet_uri(), array(), '1.2.0' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'norebro-rtl', get_template_directory_uri() . '/rtl.css' );
	}
	wp_enqueue_style( 'norebro-grid', get_template_directory_uri() . '/assets/css/grid.min.css', false );
	get_template_part( 'inc/dynamic_css/index' );

	# User custom js
	$custom_js_header = NorebroSettings::get( 'header_javascript', 'global' );
	if ( $custom_js_header ) {
		echo '<script type="text/javascript">' .  $custom_js_header . '</script>';
	}

	if ( function_exists('vc_mode') && vc_mode() == 'page_editable' ) {
		wp_enqueue_script( 'norebro-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), false, true );
	}
}

add_action( 'wp_enqueue_scripts', 'norebro_enqueue_own_styles' );


function norebro_enqueue_own_styles_secondary() {
	wp_enqueue_style( 'aos', get_template_directory_uri() . '/assets/css/aos.css', false );
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', false );
	wp_enqueue_style( 'fontawesome-font', get_template_directory_uri() . '/assets/fonts/fa/css/fontawesome.min.css', false );
	wp_register_style( 'shortcodes-settings', false );
	wp_enqueue_style( 'shortcodes-settings' );
	wp_add_inline_style( 'shortcodes-settings', NorebroLayout::get_shortcodes_css_buffer( false ) );

	# User custom js
	$custom_js_footer = NorebroSettings::get( 'footer_javascript', 'global' );
	if ( $custom_js_footer ) {
		echo '<script type="text/javascript">' .  $custom_js_footer . '</script>';
	}
}

add_action( 'wp_footer', 'norebro_enqueue_own_styles_secondary' );


// Scripts including
function norebro_enqueue_own_scripts() {

	if ( NorebroSettings::get( 'global_page_smooth_scroll', 'option' ) ) {
		NorebroHelper::add_required_script( 'smooth-scroll' );
	}

	if ( isset( $GLOBALS['norebro_google_fonts'] ) ) {
		$google_fonts_string = NorebroHelper::parse_google_fonts_to_query_string( $GLOBALS['norebro_google_fonts'] );
		if ( $google_fonts_string ) {
			wp_enqueue_style( 'norebro-global-fonts', $google_fonts_string, array(), '1.0.0' );
		}
	}

	wp_enqueue_script( 'jquery-masonry' );
	wp_enqueue_script( 'underscore' );
	wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/libs/aos.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/libs/isotope.pkgd.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'jquery-mega-menu', get_template_directory_uri() . '/assets/js/libs/jquery.mega-menu.min.js', array( 'jquery' ), false, true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'norebro-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'norebro-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true  );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/libs/owl.carousel.min.js', array( 'jquery' ), false, true );

	if ( NorebroHelper::is_script_required( 'norebro-login' ) ) { // AJAX Login & Register
		wp_enqueue_script( 'norebro-login', get_template_directory_uri() . '/assets/js/norebro-login.js', array('jquery'), false, true );
		wp_localize_script( 'norebro-login', 'norebro_login_obj', array( 'url' => esc_url( admin_url( 'admin-ajax.php' ) ) ) );
	}
	if ( NorebroHelper::is_script_required( 'smooth-scroll' ) ) { // Smooth scroll
		wp_enqueue_script( 'scroll-smooth', get_template_directory_uri() . '/assets/js/libs/scroll-smooth.min.js', array('jquery'), false, true );
	}
	if ( NorebroHelper::is_script_required( 'multiscroll' ) ) { // Multiscreen
		wp_enqueue_script( 'multiscroll', get_template_directory_uri() . '/assets/js/libs/jquery.multiscroll.min.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( NorebroHelper::is_script_required( 'chart-box' ) ) { // Chart box
		wp_enqueue_script( 'jquery-easypiechart', get_template_directory_uri() . '/assets/js/libs/jquery.easypiechart.min.js', array('jquery'), false, true );
	}
	if ( NorebroHelper::is_script_required( 'countdown-box' ) ) { // Count box
		wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/libs/jquery.countdown.min.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( NorebroHelper::is_script_required( 'one-page-scroll' ) ) { // One page scroll
		wp_enqueue_script( 'page-scroll', get_template_directory_uri() . '/assets/js/libs/jquery.onepage-scroll.min.js', array( 'jquery' ), '1.0.0', true );
	}
	if ( NorebroHelper::is_script_required( 'typed' ) ) { // Typed.js
		wp_enqueue_script( 'typed', get_template_directory_uri() . '/assets/js/libs/typed.min.js', array( 'jquery' ), '1.0.0', true );
	}
    if (NorebroHelper::is_script_required('google-maps')) { // Google Maps
        wp_enqueue_script('jquery-maps', get_template_directory_uri() . '/assets/js/libs/jquery.google-maps.min.js', array('jquery'), '1.0.0', true);
    }
	if ( ( isset( $GLOBALS['norebro_use_map'] ) && $GLOBALS['norebro_use_map'] ) || NorebroHelper::is_script_required( 'google-maps' ) ) { // Google Maps
		$api_key = '';
		if ( function_exists( 'get_field' ) ) {
			$settings_api_key = get_field( 'global_google_maps_api_key', 'option' );
		} else {
            $settings_api_key = get_option('options_global_google_maps_api_key');
            if (empty($settings_api_key)) {
                $settings_api_key = false;
			}
		}
		if ( $settings_api_key ) {
			$api_key = $settings_api_key;
		}
		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=' . urlencode( esc_attr( $api_key ) ), false, NULL, true);
	}

	wp_enqueue_script( 'norebro-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), false, true );
}

add_action( 'wp_footer', 'norebro_enqueue_own_scripts' );


// Pixellove icons in footer
function norebro_enqueue_icon_fonts() {
	$fonts = NorebroHelper::parse_iconset_to_url( $GLOBALS['norebro_icon_fonts'] );
	if ( $fonts ) {
		foreach ( $fonts as $key => $value ) {
			wp_enqueue_style( 'icon-pack-' . $key, $value, array(), '2.0.0' );
		}
	}
}

add_action( 'wp_footer', 'norebro_enqueue_icon_fonts' );
