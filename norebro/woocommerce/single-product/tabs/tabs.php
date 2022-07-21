<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
global $post;
global $product;

$hide_sharing = NorebroSettings::get( 'woocommerce_sharing', 'global' );

?>
						<?php if ( ! empty( $tabs ) ) : ?>
						<div class="accordion-box outline" data-norebro-accordion="0">
							<?php foreach ( $tabs as $key => $tab ) : ?>
								<div class="item">
									<div class="title"<?php if ( $tab['callback'] == 'comments_template' ) { echo ' id="accordion-reviews"'; } ?>>
										<h4><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ); ?></h4>
										<div class="control">
											<span class="ion-plus"></span>
										</div>
									</div>
									<div class="content">
										<div class="wrap">
											<?php call_user_func( $tab['callback'], $key, $tab ); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div><!--.site-container-->
				</div><!--.wrap-->
			</div><!--.woo-summary-content-->

			<?php
				if ( !$hide_sharing ) {
					do_shortcode( '[norebro_share_woo]' );
				}
			?>
		</div><!--.summary-->
	</div><!--.woo-single-summary-wrap-->
</div>