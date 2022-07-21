<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

	//get_option( 'woocommerce_shop_page_id' );

	NorebroHelper::add_required_script( 'accordion' );
	NorebroHelper::add_required_script( 'tabs' );

	$page_wrapped = NorebroSettings::page_is_wrapped();

	get_header( 'shop' );

	$page_container_class = '';
	if ( !$page_wrapped ) {
		$page_container_class .= ' full'; 
	}

	$submenu = NorebroSettings::get( 'header_menu_hide_contacts_bar', 'global' );
	$header_spacer = NorebroSettings::get( 'header_menu_add_cap', 'global' );
?>

<div class="<?php echo esc_attr($submenu ? 'subheader_excluded' : 'subheader_included');?> <?php echo esc_attr($header_spacer == 'yes' ? 'spacer_included' : 'spacer_excluded');?>">
	<?php 
		while ( have_posts() ) {
			the_post();
			wc_get_template_part( 'content', 'single-product' );
		}
		do_action( 'woocommerce_after_main_content' );
	?>
</div>
<div class="page-container"></div>
<?php get_footer( 'shop' );?>