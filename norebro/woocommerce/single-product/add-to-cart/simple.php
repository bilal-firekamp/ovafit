<?php
/**
 * 
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<div class="single-cart-wrap">
	<form class="cart woocommerce-add-to-cart" method="post" enctype='multipart/form-data'>
		<?php if ( $product->is_in_stock() ) : ?>
		 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		 	<?php
		 		if ( ! $product->is_sold_individually() ) {
		 			woocommerce_quantity_input( array(
		 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
		 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
		 			) );
		 		}
		 	?>

		 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

		 	<button type="submit" class="single_add_to_cart_button btn brand-bg-color brand-border-color alt">
		 		<?php echo esc_html( $product->single_add_to_cart_text() ); ?>	
		 	</button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		<?php else: ?>
			<button type="submit" class="single_add_to_cart_button btn btn-small alt" disabled="true">
				<?php echo _e( 'This product is currently out of stock and unavailable.', 'norebro' ); ?>
			</button>
		<?php endif; ?>
	</form>
</div>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
