<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.8
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;

$link = esc_url( add_query_arg( 'add_to_wishlist', $product_id ) );
?>

<a href="<?php echo esc_url( $link ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" class="<?php echo esc_attr( $link_classes ); ?> font-titles">
	<i class="ion-android-favorite-outline"></i><?php esc_html_e( 'I Want This', 'norebro' ); ?>
</a>
