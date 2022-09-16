
<?php

add_action('wp_enqueue_scripts', 'norebro_child_local_enqueue_parent_styles');

function norebro_child_local_enqueue_parent_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_script('tilt-js', '/wp-content/themes/norebro-child/assets/tilt.jquery.js', array('jquery'), '0.0.1', true);
	wp_enqueue_script('custom-js', '/wp-content/themes/norebro-child/assets/custom.js', array('jquery'), '0.0.1', true);
	// 		wp_enqueue_script( 'app-js', '/wp-content/themes/norebro-child/assets/app.js', array('jquery'), '', false);

}


// function that runs when shortcode is called
function wp_order_summary()
{
	get_template_part('woocommerce/checkout/review-order', '');
}
// register shortcode
add_shortcode('Wp-Order-Summary', 'wp_order_summary');



function wp_lost_password()
{
	get_template_part('woocommerce/myaccount/form-lost-password', '');
}
// register shortcode
add_shortcode('lost-password', 'wp_lost_password');



/**
 * Note : We added custom logic for update subscription next payment date as per requirement and pre order subscription start date
 * Ref: https://stackoverflow.com/questions/37068851/how-to-set-next-payment-date-in-woocommerce-subscriptions
 */
add_action('woocommerce_thankyou', 'bbloomer_redirectcustom');
function bbloomer_redirectcustom($order_id)
{
    $order = wc_get_order($order_id);
	if ( wcs_order_contains_subscription( $order_id ) && !$order->has_status('failed') ) {

		$order_datetime = $order->get_date_created();
		$order_date = date('Y-m-d',strtotime($order_datetime));
		$order_time = date('H:i:s',strtotime($order_datetime));

		$subid = $order_id + 1;
		$period = get_post_meta( $subid, '_billing_period', true );
		$interval = get_post_meta( $subid, '_billing_interval', true);

		$launch_date = date('2022-10-03');
		if($order_date < $launch_date){   /** pre order subscription update start date */
			$start_date = date( 'Y-m-d', strtotime( $launch_date ));
			$start_date = $start_date ." ".$order_time;
			update_post_meta( $subid , '_schedule_start', $start_date );
			$next_date = date( 'Y-m-d H:i:s', strtotime( '+'.$interval.' '.$period, strtotime( $launch_date )) );
			update_post_meta( $subid , '_schedule_next_payment', $next_date );
		}
		/** update subscription next payment date as per dynamic interval and period  */
		$nextdate = get_post_meta( $subid, '_schedule_next_payment', true );
		$threedays_ago = date( 'Y-m-d H:i:s', strtotime( '-3 days', strtotime( $nextdate )) );
		update_post_meta( $subid , '_schedule_next_payment', $threedays_ago );
    }

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

add_filter('woocommerce_ship_to_different_address_checked', '__return_true');

/**
 * Filter used to custom 90 days interval for subscription
 * Note : woocommerce subscription are not provide 90 day subscription so we added custom 90 day filter using below hook
 * Ref : https://isotropic.co/how-to-add-custom-billing-intervals-to-woocommerce-subscriptions/
 */
function custom_extend_subscription_period_intervals( $intervals ) {

	$intervals[90] = sprintf( __( 'every %s', 'custom' ), WC_Subscriptions::append_numeral_suffix( 90 ) );
	return $intervals;
}
add_filter( 'woocommerce_subscription_period_interval_strings', 'custom_extend_subscription_period_intervals' );

/**
 * Add country based hellobar text
 */
function get_hello_bar(){
	if( function_exists( 'geot_target' ) ) {
		if( geot_target( 'US' ) ) {
			return '<div class="header-hello-bar "><p>Pre-orders are open! First 100 pre-orders will get a free 3 month supply of Ovasitol with their purchase.</p>
			<a href="javascript:void(0);" class="pre-order-close_bar"><svg width="30" height="30" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M36.5738 10.2684L24.5014 22.3407L12.429 10.2684C12.1386 10.0027 11.757 9.85923 11.3635 9.86795C10.97 9.87667 10.595 10.0369 10.3167 10.3152C10.0384 10.5935 9.87824 10.9684 9.86952 11.3619C9.8608 11.7554 10.0042 12.1371 10.2699 12.4274L22.3362 24.4998L10.2669 36.5691C10.1194 36.7096 10.0015 36.8782 9.92019 37.065C9.83882 37.2517 9.79561 37.4528 9.79309 37.6565C9.79056 37.8601 9.82878 38.0623 9.9055 38.2509C9.98221 38.4396 10.0959 38.6111 10.2398 38.7552C10.3837 38.8994 10.555 39.0133 10.7436 39.0902C10.9322 39.1672 11.1342 39.2057 11.3379 39.2035C11.5416 39.2013 11.7428 39.1583 11.9296 39.0772C12.1165 38.9961 12.2852 38.8785 12.4259 38.7312L24.5014 26.6619L36.5738 38.7343C36.8641 39 37.2458 39.1434 37.6393 39.1347C38.0328 39.126 38.4077 38.9658 38.686 38.6875C38.9643 38.4092 39.1245 38.0343 39.1332 37.6408C39.142 37.2473 38.9985 36.8656 38.7328 36.5752L26.6604 24.5029L38.7328 12.4274C38.8803 12.2869 38.9981 12.1183 39.0795 11.9316C39.1609 11.7449 39.2041 11.5438 39.2066 11.3401C39.2091 11.1364 39.1709 10.9343 39.0942 10.7456C39.0175 10.5569 38.9038 10.3855 38.7599 10.2413C38.616 10.0972 38.4447 9.9833 38.2561 9.90631C38.0675 9.82933 37.8654 9.79083 37.6618 9.79306C37.4581 9.79529 37.2569 9.83822 37.0701 9.91932C36.8832 10.0004 36.7145 10.1181 36.5738 10.2653V10.2684Z" fill="#948D85" fill-opacity="0.51"/>
			</svg></a>
			</div>';
		} else {
			return '<div class="header-hello-bar "><p>Pre-orders are open! Get 15% OFF on your subscription + exciting giveaways when you order. <a href="javascript:void(0);" class="learn_more">Learn More >></a></p>
			<a href="javascript:void(0);" class="pre-order-close_bar"><svg width="30" height="30" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M36.5738 10.2684L24.5014 22.3407L12.429 10.2684C12.1386 10.0027 11.757 9.85923 11.3635 9.86795C10.97 9.87667 10.595 10.0369 10.3167 10.3152C10.0384 10.5935 9.87824 10.9684 9.86952 11.3619C9.8608 11.7554 10.0042 12.1371 10.2699 12.4274L22.3362 24.4998L10.2669 36.5691C10.1194 36.7096 10.0015 36.8782 9.92019 37.065C9.83882 37.2517 9.79561 37.4528 9.79309 37.6565C9.79056 37.8601 9.82878 38.0623 9.9055 38.2509C9.98221 38.4396 10.0959 38.6111 10.2398 38.7552C10.3837 38.8994 10.555 39.0133 10.7436 39.0902C10.9322 39.1672 11.1342 39.2057 11.3379 39.2035C11.5416 39.2013 11.7428 39.1583 11.9296 39.0772C12.1165 38.9961 12.2852 38.8785 12.4259 38.7312L24.5014 26.6619L36.5738 38.7343C36.8641 39 37.2458 39.1434 37.6393 39.1347C38.0328 39.126 38.4077 38.9658 38.686 38.6875C38.9643 38.4092 39.1245 38.0343 39.1332 37.6408C39.142 37.2473 38.9985 36.8656 38.7328 36.5752L26.6604 24.5029L38.7328 12.4274C38.8803 12.2869 38.9981 12.1183 39.0795 11.9316C39.1609 11.7449 39.2041 11.5438 39.2066 11.3401C39.2091 11.1364 39.1709 10.9343 39.0942 10.7456C39.0175 10.5569 38.9038 10.3855 38.7599 10.2413C38.616 10.0972 38.4447 9.9833 38.2561 9.90631C38.0675 9.82933 37.8654 9.79083 37.6618 9.79306C37.4581 9.79529 37.2569 9.83822 37.0701 9.91932C36.8832 10.0004 36.7145 10.1181 36.5738 10.2653V10.2684Z" fill="#948D85" fill-opacity="0.51"/>
			</svg></a>
			</div>';
		}
	}
}

/**
 * Add custom preorder popup for home page only as per country wise
 */
add_action('wp_footer','show_preorder_process');
function show_preorder_process(){
	if(is_front_page()){
		$display = "display:none"; 
		if( function_exists( 'geot_target' ) ) {
			if( geot_target( 'US' ) ) {
				$display = ""; 
			}
		}
		?>
		<div class="preorder-custom-model-main" style="<?php echo $display;?>">
			<div class="preorder-custom-model-wrap">
			<a href="javascript:;" class="preorder-close-btn close">×</a>

				<div class="preorder-pop-up-content-wrap">
					<h3>Pre-orders are open!</h3>
					<span class="subtitle">Place your order now and get a guaranteed shipment of metabolism plus
					</span>
					<p>All OveFit pre-orders will get one month free in <a href="javascript:void(0)" class="preordre-link">The Cysterhood</a>
					</p>
					<p>+</p>
					<p class="last-tag"><strong>The first 100 pre-orders</strong> will receive a <a href="#" class="preordre-link">3 month supply of Ovasital</a> with their purchase. All orders will be shipped October 3rd*.
					</p>
					<a href="javascript:void(0);" class="preorder-btn">Pre-order Now</a>

					<p class="subject-last">*Subject to change depending on shipment times.
					</p>
				</div>
			</div>  
		</div>	
	<?php 
	}
}

/**
 *  Hook change product name in checkout page for single time shipment
 */
add_filter( 'woocommerce_cart_item_name', 'cart_product_title', 20, 3);
function cart_product_title( $title, $values, $cart_item_key ) {
	if($values['product_id'] == '5649312'){
		$title =  "One time shipment (3 months supply) : $69 X 3";
	}
	return $title;
}

/**
 * Add shortcode into order-confirmation page for generate order no dynamic 
 */
add_shortcode('order_no','get_dynamic_orderno');
function get_dynamic_orderno(){
	$order_id = "OVA12345";
	// For logged in users only
    if ( is_user_logged_in() ) {

		$user_id = get_current_user_id(); // The current user ID
	
		// Get the WC_Customer instance Object for the current user
		$customer = new WC_Customer( $user_id );
	
		// Get the last WC_Order Object instance from current customer
		$last_order = $customer->get_last_order();
	
		$order_id     = "#".$last_order->get_id(); // Get the order id
	}
	return $order_id;
}