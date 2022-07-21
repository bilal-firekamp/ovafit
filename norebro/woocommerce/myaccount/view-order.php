<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p><?php
	$test = esc_html__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'norebro' );
	printf(
		$test,
		'<mark class="order-number">' . wp_kses( $order->get_order_number(), 'default' ) . '</mark>',
		'<mark class="order-date">' . wp_kses( date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) ), 'default' ) . '</mark>',
		'<mark class="order-status">' . wp_kses( wc_get_order_status_name( $order->get_status() ), 'default' ) . '</mark>'
	);
?></p>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	<h4 class="title"><?php esc_html_e( 'Order Updates', 'norebro' ); ?></h4>

	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta">
						<?php echo esc_html( date_i18n( 'l jS \o\f F Y, h:ia', strtotime( $note->comment_date ) ) ); ?>
					</p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>
