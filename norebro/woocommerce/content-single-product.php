<?php
/**
 * 
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	$shop_page_id = wc_get_page_id( 'shop' );

	$show_breadcrumbs = false;
	if ( is_product() ) {
		$show_breadcrumbs = NorebroSettings::get( 'woocommerce_page_show_breadcrumbs', 'global' );
	} else {
		$show_breadcrumbs = NorebroSettings::get( 'page_show_breadcrumbs' ); 
	}

	if ( $show_breadcrumbs == 'inherit' ) {
		$show_breadcrumbs = (bool) NorebroSettings::get( 'page_show_breadcrumbs', 'global' );
	} else {
		$show_breadcrumbs = ( $show_breadcrumbs == 'yes' );
	}

	if ($show_breadcrumbs) {
        $category_in_breadcrumb = NorebroSettings::get('page_show_category_breadcrumbs');
        if ( $category_in_breadcrumb == 'inherit') {
            $category_in_breadcrumb = NorebroSettings::get('woocommerce_page_show_category_breadcrumbs', 'global');
        }
        $category_in_breadcrumb = ( $category_in_breadcrumb == 'yes' );
    }


	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}

?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="norebro-content-wrap-right">
	<!-- Slider in single-product/product-image.php -->
	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
		<div class="vc_col-md-6 woo-single-summary-wrap">
			<div class="summary entry-summary">

				<?php if ( $show_breadcrumbs ) : ?>
				<div class="breadcrumbs">
					<a class="brand-color-hover hover-underline underline-brand" href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">
						<?php echo NorebroSettings::breadcrumbs_woocommerce_slug(); ?>
					</a>
					<?php


						$ancestors = get_ancestors( get_the_ID(), 'page', 'post_type' );

						for( $i = count( $ancestors ) - 1; $i >= 0; $i-- ) {
							$page = get_page( $ancestors[$i] );
							printf( ' / <a class="brand-color-hover hover-underline underline-brand" href="%s">%s</a>', $page->guid, $page->post_title );
						}
					?>
                    <?php
                    if($category_in_breadcrumb) {
                        $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'taxonomy' => 'product_cat' ) );

                        if ( is_array( $terms ) && is_object( $terms[0] ) ) {
                            printf( ' / <a class="brand-color-hover hover-underline underline-brand" href="%s">%s</a>', get_term_link( $terms[0] ), $terms[0]->name );
                        }
                    }
                    ?>
					/ <span class="current"><?php the_title(); ?></span>
				</div>
				<?php endif; ?>
				<div class="woo-summary-content">
					<div class="wrap"><!-- For scroll -->
						<?php do_action( 'woocommerce_before_main_content' ); ?>
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
						<?php
							// Tabs
							do_action( 'woocommerce_after_single_product_summary' ); 
						?>
						<?php do_action( 'woocommerce_after_single_product' ); ?>