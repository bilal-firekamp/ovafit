<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


if ( !isset( $use_masonry_grid ) ) {
	$use_masonry_grid = false;
}

$li_class = '';
if ( $use_masonry_grid ) {
	$li_class .= ' masonry-block grid-item';
}

$products_autoplay = NorebroSettings::get( 'woocommerce_products_autoplay', 'global' );
if ( $products_autoplay === NULL ) {
	$products_autoplay = true;
}

?>

<li <?php post_class( $li_class ); ?> data-product-item="true" data-lazy-item="" data-lazy-scope="products">
	<div class="product-content trans-shadow">
		<a href="<?php echo esc_url( get_post_permalink() ); ?>" class="static">
			<div class="image-wrap">
				<?php woocommerce_show_product_loop_sale_flash(); ?>

				<div class="slider"<?php if ( $products_autoplay ) { echo ' data-autoplay="true"'; } ?>>
					<?php
					/**
					 * woocommerce_before_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					//do_action( 'woocommerce_before_shop_loop_item' );

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					//do_action( 'woocommerce_before_shop_loop_item_title' );
						echo woocommerce_get_product_thumbnail('large');

						$attachment_ids = $product->get_gallery_image_ids();
						foreach ( $attachment_ids as $attachment_id ) {
							echo wp_get_attachment_image( $attachment_id, 'large' );
						}
					?>
				</div>

			</div>

		<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

		?>
		<div class="wc-product-title-wrap<?php if ( $product->get_price_html() == '' ) { echo ' without-price'; } ?>">
			<?php
				$categories = explode(', ', wc_get_product_category_list( $product->get_id() ) );
				$categories = array_filter( $categories );
				$i = 0;
				if ( !empty( $categories ) ) :
					foreach ( $categories as $category ):
			 ?>
				<div class="category">
					<?php
						echo preg_replace('/(<a)(.+\/a>)/i', '${1} class="trans-hover" ${2}', $category);
						if ( (++$i) < count( $categories ) ) {
							echo ',';
						}
					?>
				</div>
			<?php
					endforeach;
				endif;
			?>
			<h3>
				<a href="<?php echo esc_url( get_post_permalink() ); ?>" class="color-dark">
					<?php echo esc_attr( get_post( $product->get_id() )->post_title ); ?>
				</a>
			</h3>
			<div class="price">
				<?php echo wp_kses($product->get_price_html(), 'post'); ?>
			</div>
			<?php
			if ( function_exists( 'YITH_WCWL' ) ) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			}
			?>
			<div class="clear"></div>
		</div>
	</div>
</li>
