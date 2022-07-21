<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	global $product, $woocommerce_loop, $page_wrapped;

	$details_type = NorebroSettings::get( 'woocommerce_product_description_layout', 'global' );
	if ( ! $details_type ) { $details_type = 'default'; }

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}

	if ( ! $related = wc_get_related_products( $product->get_id(), $posts_per_page ) ) {
		return;
	}
?>

<?php

	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'            => 'product',
		'ignore_sticky_posts'  => 1,
		'no_found_rows'        => 1,
		'posts_per_page'       => $posts_per_page,
		'orderby'              => $orderby,
		'orderby'              => $orderby,
		'post__in'             => $related,
		'post__not_in'         => array( $product->get_id() )
	) );

	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'related';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

?>
</div>
	<div class="clear"></div>
	<?php if ( $products->have_posts() ) : ?>
	<div class="page-container">
		<div class="single-related-wrapper page-wrap-offset">
			<div class="product">
				<div class="related products columns-4">
					<div class="vc_col-sm-12">
						<h3 class="text-left title"><?php esc_html_e( 'Related products', 'norebro' ); ?></h3>
						<?php 
							woocommerce_product_loop_start();

							while ( $products->have_posts() ) {
								$products->the_post();
								wc_get_template_part( 'content', 'product' );
							}

							woocommerce_product_loop_end(); 
						?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
<?php
	wp_reset_postdata();
?>