<?php

	add_action( 'wp_enqueue_scripts', 'norebro_child_local_enqueue_parent_styles' );

	function norebro_child_local_enqueue_parent_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_script( 'tilt-js', '/wp-content/themes/norebro-child/assets/tilt.jquery.js', array('jquery'), '0.0.1', true);
// 		wp_enqueue_script( 'app-js', '/wp-content/themes/norebro-child/assets/app.js', array('jquery'), '', false);

	}


// function that runs when shortcode is called
function wp_order_summary()
{
	get_template_part('woocommerce/checkout/review-order', '');
}
// register shortcode
add_shortcode('Wp-Order-Summary', 'wp_order_summary');


add_action('woocommerce_thankyou', 'bbloomer_redirectcustom');



function wp_lost_password()
{
	get_template_part('woocommerce/myaccount/form-lost-password', '');
}
// register shortcode
add_shortcode('lost-password', 'wp_lost_password');



add_action('woocommerce_thankyou', 'bbloomer_redirectcustom');



function bbloomer_redirectcustom($order_id)
{
	$order = wc_get_order($order_id);
	$url = '/order-confirmation';
	if (!$order->has_status('failed')) {
		wp_safe_redirect($url);
		exit;
	}
}

/**
 * Redirect to Checkout Page after Add to Cart @ WooCommerce
 */
add_filter('woocommerce_add_to_cart_redirect', 'misha_skip_cart_redirect_checkout');

function misha_skip_cart_redirect_checkout($url)
{
	return wc_get_checkout_url();
}