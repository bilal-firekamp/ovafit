<?php
/**
 * Checkout terms and conditions checkbox
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>
	<?php do_action( 'woocommerce_checkout_before_terms_and_conditions' ); ?>
	<p class="form-row terms wc-terms-and-conditions">
		<input type="checkbox" class="input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" />
		<label for="terms" class="checkbox"><?php printf( esc_html__( 'I&rsquo;ve read and accept the %s terms &amp; conditions', 'norebro' ) . '</a>', '<a href="' . esc_url( wc_get_page_permalink( 'terms' ) ) . '" target="_blank">' ); ?> <span class="required">*</span></label>
		<input type="hidden" name="terms-field" value="1" />
	</p>
	<?php do_action( 'woocommerce_checkout_after_terms_and_conditions' ); ?>
<?php endif; ?>
