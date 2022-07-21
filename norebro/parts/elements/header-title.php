<?php
	// Settings
	$show_header_title = NorebroSettings::header_title_is_displayed();
	$header_subtitle_type = NorebroSettings::header_subtitle_type();
	$show_header_subtitle = (bool) ( $header_subtitle_type != 'without' );
	$show_header_cap = NorebroSettings::header_cap_is_displayed();
	$header_subtitle_custom_text = NorebroSettings::header_subtitle_custom_text();
	$full_height = NorebroSettings::header_title_is_full_height();
	$full_height_class = ( $full_height ) ? ' title-full' : '';

	$title_align = NorebroSettings::header_title_align();
	$title_align_class = '';
	if ( $title_align == 'left' ) {
		$title_align_class = ' text-left';
	} elseif ( $title_align == 'right' ) {
		$title_align_class = ' text-right';
	} else {
		$title_align_class = ' text-center';
	}

	$page_wrapped = NorebroSettings::page_is_wrapped();

	// Title and subtitle
	$title_text = get_the_title();
	$subtitle_text = wp_kses( NorebroSettings::get( 'header_subtitle' ), 'default' );

	if ( NorebroSettings::page_is( 'home' ) ) {
		$title_text = esc_html__( 'Blog', 'norebro' );
		$subtitle_text = esc_html__( 'Our recent posts', 'norebro' );
	} else if ( NorebroSettings::page_is( 'category' ) ) {
		$title_text = single_cat_title( '', false ); 
		$subtitle_text = esc_html__( 'Category', 'norebro' );
	} elseif ( NorebroSettings::page_is( 'tag' ) ) {
		$title_text = single_tag_title( '', false ); 
		$subtitle_text = esc_html__( 'Tag', 'norebro' );
	} elseif ( NorebroSettings::page_is( 'search' ) ) {
		$title_text =  esc_html__( 'Search Results for: ', 'norebro' ) . '<span>' . get_search_query() . '</span>';
		$subtitle_text = false;
	} elseif ( is_day() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'd' ) . ', ' . get_the_time( 'Y' );
		$subtitle_text = 'Posts by date';
	} elseif ( is_month() ) {
		$title_text = get_the_time( 'F' ) . ' ' . get_the_time( 'Y' );
		$subtitle_text = false;
	} elseif ( is_year() ) {
		$title_text = get_the_time( 'Y' );
		$subtitle_text = false;
	} elseif ( NorebroSettings::page_is( 'single' ) ) {
		if ( ! $title_text ) {
			$title_text = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		if ( $header_subtitle_type == 'generated' ) {
			ob_start();
			norebro_return_posted_on();
			
			echo ' <strong>-</strong>';

			echo ' <span class="comments">';
			printf( esc_html( _nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'norebro' ) ),
				esc_html( number_format_i18n( get_comments_number() ) ) );
			echo ' </span>';

			$subtitle_text = ob_get_clean();
		}
		if ( $header_subtitle_type == 'custom' ) {
			$subtitle_text = $header_subtitle_custom_text;
		}
	} elseif ( NorebroSettings::page_is( 'project' ) ) {
		if ( ! $title_text ) {
			$title_text = '[' . get_the_date( get_option( 'date_format' ), $post->ID ) . ']';
		}
		$subtitle_text = NorebroSettings::get( 'header_subtitle' );
	} elseif ( NorebroSettings::page_is( 'author' ) ) {
		$author = get_the_author();
		$title_text = ( $author ) ? $author : esc_html__( 'Undefined', 'norebro' );
		$subtitle_text = esc_html__( 'Author', 'norebro' );
	} elseif ( NorebroSettings::page_is( 'product' ) ) {
		$subtitle_text = wp_kses( NorebroSettings::get( 'woocommerce_header_subtitle', 'global' ), 'default' );
	} elseif ( NorebroSettings::page_is( 'shop' ) ) {
		$title_text = get_the_title( isset($post->ID) ? $post->ID : false );
		if ( empty( $title_text ) ) {
			$title_text = __( 'Shop', 'norebro' );
		}
	} elseif ( NorebroSettings::page_is( 'product_category' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product category', 'norebro' );
	} elseif ( NorebroSettings::page_is( 'product_tag' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$title_text = $cat->name;
		$subtitle_text = esc_html__( 'Product tag', 'norebro' );
	} elseif ( NorebroSettings::page_is( 'page' ) ) {
		$subtitle_text = NorebroSettings::get( 'header_subtitle' );
	} elseif ( is_404() ) {
		$title_text = esc_html__( 'Page not found!', 'norebro' );
	}

	$allowed_html = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);
?>

<?php if ( $show_header_title ) : ?>

	<div class="header-title<?php if ( ! $show_header_cap ) { echo ' without-cap'; } echo esc_attr( $full_height_class ) . esc_attr( $title_align_class ); ?>">
		<div class="bg-image"></div>
		<div class="title-wrap">
			<div class="content">
				<div class="page-container<?php if ( !$page_wrapped ) { echo ' full'; } ?>">
					<div class="wrap-container">
						<?php 
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( ' ' );
							if ( $categories_list && norebro_categorized_blog() ) {
								$categories_list = preg_replace( '/(<a)(.+?>)/i', '$1 class="tag" $2 ', $categories_list );
								printf( '<div class="tags">%1$s</div>', $categories_list ); // WPCS: XSS OK.
							}
						?>
						<h1 class="page-title"><?php echo wp_kses( $title_text, 'default' ); ?></h1>
						<?php if ( $subtitle_text && $show_header_subtitle ) : ?>
							<br>
							<p class="subtitle"><?php echo wp_kses( $subtitle_text, $allowed_html ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif;