<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */

	
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $post;
	$shop_page_id = wc_get_page_id( 'shop' );

	if ( $post && is_object( $post ) ) {
		$postID = $post->ID;
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$post->ID = get_option( 'woocommerce_shop_page_id' ); // woocomerce wrong post id fix
		}
	}

	$page_wrapped = NorebroSettings::page_is_wrapped();
	$page_container_class = '';
	if ( !$page_wrapped ) { 
		$page_container_class .= ' full';
	}

	$sidebar_page_position = NorebroSettings::get( 'page_sidebar' );
	$global_sidebar_position = NorebroSettings::get_woocommerce_sidebar_position();
	$sidebar_page_class = '';
	$sidebar_class = '';
	$sidebar_position = '';
	if ( $sidebar_page_position == 'left' ) {
		$sidebar_page_class = ' with-left-sidebar';
		$sidebar_class .= ' sidebar-' . $sidebar_page_position;
		$sidebar_position = 'left';
	} elseif ( $sidebar_page_position == 'right' ) {
		$sidebar_page_class = ' with-right-sidebar';
		$sidebar_class .= ' sidebar-' . $sidebar_page_position;
		$sidebar_position = 'right';
	} elseif ( $sidebar_page_position == 'inherit' ) {
		if ( is_active_sidebar( 'wc_shop' ) ) {
			if ( $global_sidebar_position == 'left' ) {
				$sidebar_page_class = ' with-left-sidebar';
				$sidebar_class .= ' sidebar-' . $sidebar_position;
				$sidebar_position = 'left';
			} elseif ( $global_sidebar_position == 'right' ) {
				$sidebar_page_class = ' with-right-sidebar';
				$sidebar_class .= ' sidebar-' . $sidebar_position;
				$sidebar_position = 'right';
			}
		}
	}

	$products_in_row = NorebroSettings::get( 'woocommerce_products_in_row', 'global' );
	if ( is_string( $products_in_row ) ) {
		$products_in_row = (object) json_decode( $products_in_row );
	}

	if( $products_in_row == NULL ){
		$products_in_row = (object) array(
			"large" => "3",
			"medium" => "2",
			"small" => "1"
		);
	}

	$product_now = 0;

	$row_class = '';
	if ( is_object( $products_in_row ) ) {
		$row_class = ' columns-' . $products_in_row->large;
		$row_class .= ' columns-md-' . $products_in_row->medium;
		$row_class .= ' columns-sm-' . $products_in_row->small;
	}

	get_header( 'shop' );

    $content_location = NorebroSettings::get( 'shop_content_position', 'global' );
    if ($content_location == NULL) {
        $content_location = 'top';
    }

?>

<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<?php
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<div class="page-container<?php echo esc_attr( $page_container_class ); ?> woo-shop-container bottom-offset">
	<?php if ( is_active_sidebar( 'wc_shop' ) && $sidebar_position == 'left'  ) : ?>
	<div class="page-sidebar sidebar-left woo-sidebar<?php echo esc_attr($sidebar_class); ?>">
		<ul class="sidebar-widgets">
			<?php dynamic_sidebar( 'wc_shop' ); ?>
		</ul>
	</div>
	<?php endif; ?>

    <!-- Custom content -->
    <?php if ($content_location == 'top'): ?>
        <div class="page_content shop_page_content">
            <?php do_action( 'woocommerce_archive_description' ); ?>
        </div>
    <?php endif; ?>

	<div class="page-content<?php echo esc_attr( $sidebar_page_class ); ?><?php echo esc_attr($row_class); ?>">
        <?php do_action( 'woocommerce_before_shop_loop' );?>
		<?php if ( have_posts() ) : ?>
		<?php 
			wc_print_notices();

			if ( is_shop() || is_product_category() || is_product_tag() ) {
				$post->ID = $postID;
			}

			woocommerce_product_loop_start();
			woocommerce_product_subcategories();

			while ( have_posts() ) {
				the_post();

				do_action( 'woocommerce_shop_loop' );
				wc_get_template_part( 'content', 'product' );
			}

			woocommerce_product_loop_end(); 
			do_action( 'woocommerce_after_shop_loop' );
		?>
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
		<?php endif; ?>
	</div>

    <!-- Custom content -->
    <?php if ($content_location == 'bottom'): ?>
        <div class="page_content shop_page_content">
            <?php do_action( 'woocommerce_archive_description' ); ?>
        </div>
    <?php endif; ?>

	<?php if ( is_active_sidebar( 'wc_shop' ) && $sidebar_position == 'right'  ) : ?>
	<div class="page-sidebar sidebar-right woo-sidebar<?php echo esc_attr($sidebar_class); ?>">
		<ul class="sidebar-widgets">
			<?php dynamic_sidebar( 'wc_shop' ); ?>
		</ul>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
</div><!--.page-container-->
<?php
	do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer( 'shop' ); ?>
