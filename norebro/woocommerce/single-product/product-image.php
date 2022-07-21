<?php
/**
 *
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>

<div class="vc_row">
	<div class="woo_product-container">
		<div class="vc_col-md-6 product-images">
			<div class="images <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
				<figure class="woocommerce-product-gallery__wrapper">
					<?php
					if ( has_post_thumbnail() && $post_thumbnail_id ) {
						$html  = wc_get_gallery_image_html( $post_thumbnail_id, true );

						$attachment_ids = $product->get_gallery_image_ids();
						$image_class = '';

						$loop = 1;

						foreach ( $attachment_ids as $attachment_id ) {

							$classes = array( 'zoom' );

							$image_class = implode( ' ', $classes );
							$props       = wc_get_product_attachment_props( $attachment_id, $post );

							if ( ! $props['url'] ) {
								continue;
							}
                            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
							$html .= apply_filters(
								'woocommerce_single_product_image_thumbnail_html',
								sprintf(
								        
									'<div class="image-wrap"><img class="gimg" src="%s"  alt="' . $alt_text . '"></div>',
									esc_url( wp_get_attachment_image_url( $attachment_id, 'original' ))
								),
								$attachment_id,
								$post->ID,
								esc_attr( $image_class )
							);

							$loop++;
						}
					} else {
						$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
						$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'norebro' ) );
						$html .= '</div>';
						// echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'norebro' ) ), $post->ID );
					}

					echo '<div class="slider" data-wc-slider="true">';
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
					echo '</div>';
					do_action( 'woocommerce_product_thumbnails' );
				?>
				</figure>
			</div>
		</div>