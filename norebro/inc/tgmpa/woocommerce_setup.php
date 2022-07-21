<?php

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter('loop_shop_per_page', function($cols) {return 12;});

// Widgets
function norebro_woocommerce_tag_cloud_widget() {
	$args = array(
		'smallest' => 11,
		'largest' => 11,
		'unit'  => 'px',
		'number' => 15,
		'taxonomy' => 'product_tag'
	);
	return $args;
}

add_filter( 'woocommerce_product_tag_cloud_widget_args', 'norebro_woocommerce_tag_cloud_widget' );

function norebro_woocommerce_scripts(){
	wp_register_script( 'woocommerce-hack', get_template_directory_uri() . '/assets/js/woocommerce-hack.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'woocommerce-hack' );
}

add_action( 'wp_enqueue_scripts', 'norebro_woocommerce_scripts' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );


function norebro_woocommerce_message_filter_function( $message ) {
	$message = preg_replace( '/(<a)(.+\/a>)(.+)/i', '${3} ${1} ${2}', $message );
	$message = preg_replace( '/"button/i', '"', $message );
	return $message;
}

add_filter( 'woocommerce_add_message', 'norebro_woocommerce_message_filter_function', 10, 1 );
add_filter( 'woocommerce_add_error', 'norebro_woocommerce_message_filter_function', 10, 1 );
add_filter( 'woocommerce_add_notice', 'norebro_woocommerce_message_filter_function', 10, 1 );


// Custom icon for PayPal payment option on WooCommerce checkout page.
function norebro_woocommerce_isa_extended_paypal_icon() {
	return get_stylesheet_directory_uri() . '/assets/images/paypal-logo.png';
}
add_filter( 'woocommerce_paypal_icon', 'norebro_woocommerce_isa_extended_paypal_icon' );

// WooCommerce sidebar
function norebro_woocommerce_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Shop', 'norebro' ),
		'id' => 'wc_shop',
		'description' => esc_html__( 'WooCommerce sidebar.', 'norebro' ),
		'before_title'  => '<h3 class="title widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'norebro_woocommerce_widgets_init' );

function norebro_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	$fragments['span.cart-count'] = '<span class="cart-count">' . esc_attr( $woocommerce->cart->cart_contents_count ) . '</span>';
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'norebro_woocommerce_header_add_to_cart_fragment' );

// WooCommerce size images
function norebro_woocommerce_image_dimensions() {
	$catalog = array(
		'width'   => '800',
		'height'  => '',
		'crop'    => 1
	);
	$single = array(
		'width'   => '600',
		'height'  => '',
		'crop'    => 1
	);
	$thumbnail = array(
		'width'   => '120',
		'height'  => '',
		'crop'    => 1
	);

	update_option( 'shop_catalog_image_size', $catalog );
	update_option( 'shop_single_image_size', $single );
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}

add_action( 'init', 'norebro_woocommerce_image_dimensions', 1 );

// Wishlist

if( ! function_exists( 'yith_wcwl_is_wishlist_page' ) && function_exists( 'yith_wcwl_object_id' ) ){
    /**
     * Check if current page is wishlist
     *
     * @return bool
     * @since 2.0.13
     */
    function yith_wcwl_is_wishlist_page(){
        $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );

        if( ! $wishlist_page_id ){
            return false;
        }

        return is_page( $wishlist_page_id );
    }
}

//	WooProduct fallback
if ( ! function_exists( 'is_product' ) ) {
	function is_product() { return false; }
}

// Standart user avatar
function norebro_override_new_gravatar( $avatar_defaults ) {
	$myavatar = get_template_directory_uri() . '/assets/images/user.png';
	$avatar_defaults[$myavatar] = esc_html__( 'Norebro Default Avatar', 'norebro' );
	return $avatar_defaults;
}

add_filter( 'avatar_defaults', 'norebro_override_new_gravatar' );