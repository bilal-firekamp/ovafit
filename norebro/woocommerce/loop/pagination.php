<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
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
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

// Pagination
$pagination_type = NorebroSettings::get( 'woocommerce_pagination_type', 'global' );
if ( $pagination_type == NULL ){
	$pagination_type = 'simple';
}
$pagination_position = NorebroSettings::get( 'woocommerce_pagination_position', 'global' );
if ( $pagination_position == NULL ){
	$pagination_position = 'left';
}


?>
<nav class="pagination text-<?php echo esc_attr($pagination_position); ?>">
	<?php

		$large_number = 10000000;
		$paginator_pattern = str_replace( $large_number, '{{page}}', get_pagenum_link( $large_number ) );

		switch ( $pagination_type ) {
			case 'simple':
				$paginate = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base'         => esc_url_raw( str_replace( $large_number, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( $large_number, false ) ) ) ),
					'format'       => '',
					'add_args'     => false,
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'total'        => $wp_query->max_num_pages,
					'prev_text'    => '<span class="icon-left ion-android-arrow-back"></span> Prev',
					'next_text'    => 'Next <span class="icon-right ion-android-arrow-forward"></span>',
					'type'         => 'list',
					'end_size'     => 3,
					'mid_size'     => 3,
				) ) );


				$paginate = str_replace( '<a class="', '<a class="hover-underline ', $paginate );
				echo str_replace( '<a class=\'', '<a class=\'hover-underline ', $paginate );
				break;
		 	case 'lazy_scroll':
				echo '<div class="lazy-load loading font-titles text-' . $pagination_position . '" data-lazy-load="scroll" data-lazy-pages-count="' . esc_attr( $wp_query->max_num_pages ) . '" data-lazy-load-url-pattern="' . esc_attr( $paginator_pattern ) . '" data-lazy-load-scope="products">';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';
				break;
			case 'lazy_button':
				echo '<div class="lazy-load load-more font-titles text-' . $pagination_position . '" data-lazy-load="click" data-lazy-pages-count="' . esc_attr( $wp_query->max_num_pages ) . '" data-lazy-load-url-pattern="' . esc_attr( $paginator_pattern ) . '" data-lazy-load-scope="products">';
				echo '<span class="loadmore-text">' . esc_html__( 'Load More', 'norebro' ) . '</span>';
				echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro' ) . '</span>';
				echo '<span class="icon ion-refresh"></span>';
				echo '</div>';
				break;
		}

	?>
</nav>
