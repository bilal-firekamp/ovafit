<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ) ?>">
	<?php if( ! ( $disable_wishlist && ! is_user_logged_in() ) ): ?>
	    <div class="yith-wcwl-add-button <?php echo esc_attr( $exists && ! $available_multi_wishlist ) ? 'hide': 'show' ?>" style="display:<?php echo esc_attr( $exists && ! $available_multi_wishlist ) ? 'none': 'block' ?>">

	        <?php yith_wcwl_get_template( 'add-to-wishlist-' . $template_part . '.php', $atts ); ?>

	    </div>

	    <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
	        <i class="ion-android-favorite"></i> <?php echo wp_kses( $product_added_text, 'default' ); ?>
	    </div>

	    <div class="yith-wcwl-wishlistexistsbrowse <?php echo esc_attr( $exists && ! $available_multi_wishlist ) ? 'show' : 'hide' ?>" style="display:<?php echo esc_attr( $exists && ! $available_multi_wishlist ) ? 'block' : 'none' ?>">
	       <i class="ion-android-favorite"></i> <?php echo wp_kses( $product_added_text, 'default' ); ?>
	    </div>

	    <div style="clear:both"></div>
	    <div class="yith-wcwl-wishlistaddresponse"></div>
	<?php else: ?>
		<a href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true', 'add_to_wishlist' => $product_id ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) ); ?>" rel="nofollow" class="<?php echo esc_attr( str_replace( 'add_to_wishlist', '', $link_classes ) ); ?>" >
			<?php echo wp_kses( $icon, 'default' ); ?>
			<?php echo esc_attr( $label ); ?>
		</a>
	<?php endif; ?>

</div>

<div class="clear"></div>