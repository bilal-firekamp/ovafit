<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<section class="woo-cart-empty">
		<div class="page-container">
				<div class="content-center">
					<div class="wrap">
						<div class="page-error-content">
							<svg class="icon-bag" version="1.1" viewBox="20 20 60 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<path fill="#444" d="M59.4,72.1H40.7c-4.1,0-7-2.6-7.1-6.1l-2.5-27c0-0.1,0-0.1,0-0.2c0-1.5,1.2-2.7,2.9-2.7h32.3c1.5,0,2.8,1.3,2.8,2.9  c0,0.1,0,0.1,0,0.2l-2.5,26.7C66.4,69.4,63.4,72.1,59.4,72.1z M35.1,40.1l2.4,25.6c0,0.1,0,0.1,0,0.2c0,1.5,1.6,2.2,3.1,2.2h18.7  c1.5,0,3.1-0.7,3.1-2.3c0-0.1,0-0.1,0-0.2l2.4-25.5H35.1z"/>
								<path fill="#444" d="M58.4,40.1c-1.1,0-2-0.9-2-2v-2.6c0-3.8-2.6-6.7-6-6.7s-6,2.9-6,6.7v2.6c0,1.1-0.9,2-2,2s-2-0.9-2-2v-2.6  c0-6,4.4-10.7,10-10.7s10,4.7,10,10.7v2.6C60.4,39.2,59.5,40.1,58.4,40.1z"/>
							</svg>
							<h3 class="text-center"><?php esc_html_e( 'Oops! Your cart is empty', 'norebro' ); ?></h3>
							<p class="text-center"><?php esc_html_e( 'You may check out all the available products and buy some in the shop.', 'norebro' ); ?></p>
						</div>
						<a class="btn btn-outline" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
							<?php esc_html_e( 'Return To Shop', 'norebro' ) ?>
						</a>
					</div>
				</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
<?php endif; ?>

</div>
