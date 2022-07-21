<?php
	get_header();

	$show_breadcrumbs = NorebroSettings::breadcrumbs_is_displayed();

	$published_posts = $GLOBALS['wp_query']->found_posts;
	
	if ( get_query_var( 'paged' ) ) { 
		$pagination_page = get_query_var( 'paged' ); 
	} elseif ( get_query_var( 'page' ) ) {
		$pagination_page = get_query_var( 'page' ); 
	} else { 
		$pagination_page = 1;
	}

	$posts_per_page = NorebroSettings::posts_per_page();

	$posts_offset = ( $pagination_page - 1 ) * $posts_per_page;
	$paginator_all = ceil( $published_posts / (int) $posts_per_page );

	$pagination_type = NorebroSettings::get( 'blog_pagination_type', 'global' );
	if ( $pagination_type == NULL ){
		$pagination_type = 'simple';
	}

	$pagination_position = NorebroSettings::get( 'blog_pagination_position', 'global' );
	if ( $pagination_position == NULL ){
		$pagination_position = 'left';
	}

	$posts_show_from = $posts_offset + 1;
	$posts_show_to = $posts_offset + $posts_per_page;
	if ( $posts_show_to > $published_posts ) {
		$posts_show_to = $published_posts;
	}

	// Sidebar
	$sidebar_position = NorebroSettings::get( 'blog_sidebar', 'global' );
	if ( ! $sidebar_position ) { $sidebar_position = 'without'; }
	$sidebar_page_class = '';
	if ( is_active_sidebar( 'norebro-sidebar-blog' ) ) {	
		if ( $sidebar_position == 'left' ) {
			$sidebar_page_class = ' with-left-sidebar';
		}
		if ( $sidebar_position == 'right' ) {
			$sidebar_page_class = ' with-right-sidebar';
		}
	}

	$sidebar_layout = NorebroSettings::page_sidebar_layout();
	$sidebar_class = '';
	if ( $sidebar_layout ) {
		$sidebar_class .= ' sidebar-' . $sidebar_layout;
	}

	$page_wrapped = NorebroSettings::page_is_wrapped();

	// Grid style
	$posts_grid = NorebroSettings::get( 'blog_page_layout', 'global' );
	if ( ! $posts_grid ) { $posts_grid = 'masonry'; }
	$grid_style_class = ( $posts_grid == 'masonry' ) ? 'norebro-masonry blog-posts-masonry' : 'blog-posts-classic';

	$posts_layout_item = NorebroSettings::get( 'blog_item_layout_type', 'global' );

	// Columns
	$columns_num = NorebroSettings::get( 'blog_columns_in_row', 'global' );
	if ( $posts_grid == 'classic' ) { 
		$columns_num = '2-1-1-1'; 
	}
	if ( $posts_layout_item == 'striped' ) { 
		$columns_num = '1-1-1-1'; 
	}
	if ( ! isset( $columns_num ) ) {
		$columns_num = '2-1-1-1';
	}
	$columns_class = NorebroHelper::parse_columns_to_css( $columns_num, false );
	$columns_double_class = NorebroHelper::parse_columns_to_css( $columns_num, true );

	$grid_item_style_class = '';
	$posts_without_paddings = NorebroSettings::get( 'blog_items_without_padding' );
	if ( in_array( $posts_without_paddings, array( 'inherit', NULL ) ) ) {
		$posts_without_paddings = NorebroSettings::get( 'blog_items_without_padding', 'global' );
	} else {
		$posts_without_paddings = ( $posts_without_paddings == 'yes' ) ? true : false;
	}
	if ( $posts_without_paddings ) {
		$grid_item_style_class .= ' post-offset';
	}

	$page_container_class = '';
	if ( !$show_breadcrumbs ) { 
		$page_container_class .= ' without-breadcrumbs'; 
	}
	if ( !$page_wrapped ) { 
		$page_container_class .= ' full';
	}

	if ( have_posts() ) :
?>

	<?php get_template_part( 'parts/elements/header-title' ); ?>

	<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

	<div class="page-container bottom-offset<?php echo esc_attr( $page_container_class ); ?>">

		<?php if ( is_active_sidebar( 'norebro-sidebar-blog' ) && $sidebar_position == 'left' ) : ?>
		<div class="page-sidebar sidebar-left<?php echo esc_attr($sidebar_class); ?>">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>

		<div id="primary" class="page-content content-area<?php echo esc_attr( $sidebar_page_class ); ?>">
			<main id="main" class="site-main">
				<div class="vc_row <?php echo esc_attr( $grid_style_class ); ?>" data-lazy-container="posts">
				<?php
					$posts_layout_item = NorebroSettings::get( 'blog_item_layout_type', 'global' );
					$_post_i = 0;
					while ( have_posts() ) : the_post();

						$parsed_post = NorebroObjectParser::parse_to_post_object( $post, 'index' );
						NorebroHelper::set_storage_item_data( $parsed_post );

						$col_class = $columns_class;
						$grid_class = ' grid-item';

						if ( $parsed_post['grid_style'] == '2col' ) {
							$col_class = $columns_double_class;
							$grid_class = '';
						}

						// Animation calculating
						$_anim_attrs = '';
						if ( in_array( $parsed_post['animation_type'], array( 'sync', 'async' ) ) ) {
							$_anim_attrs .= ' data-aos-once="true"';
							$_anim_attrs .= ' data-aos="' . $parsed_post['animation_effect'] . '"';
							if ( $parsed_post['animation_type'] == 'async' ) {
								$columns_num = (int) substr( $columns_num, 0, 1);
								$_delay = ( 400 / $columns_num ) * ( $_post_i % $columns_num );
								$_delay = (int) $_delay - ( $_delay % 50 );
								$_anim_attrs .= ' data-aos-delay="' . $_delay . '"';
							}
						}

						$grid_class = (( $parsed_post['grid_style'] != '2col' ) ? ' grid-item' : '' );

						echo '<div class="' . esc_attr( $col_class . $grid_class . $grid_item_style_class . ( ( $posts_grid == 'masonry' ) ? ' masonry-block' : '' ) ) . '" ' . $_anim_attrs . '  data-lazy-item="" data-lazy-scope="posts">';

							switch ( $posts_layout_item ) {
								case 'side_image':
									get_template_part( 'parts/blog-cards/side_image' );
									break;
								case 'overlay':
									get_template_part( 'parts/blog-cards/overlay' );
									break;
								case 'simple':
									get_template_part( 'parts/blog-cards/simple' );
									break;
								case 'striped':
									get_template_part( 'parts/blog-cards/striped' );
									break;
								case 'classic':
								default:
									get_template_part( 'parts/blog-cards/classic' );
									break;
							}
						echo '</div>';

						$_post_i++;
					endwhile;
				?>
				</div>

				<?php
					// Paginator
					if ( $paginator_all > 1 ) {
						$large_number = 10000000;
						$paginator_pattern = str_replace( $large_number, '{{page}}', get_pagenum_link( $large_number ) );

						switch ( $pagination_type ) {
							case 'simple':
								NorebroLayout::the_paginator_layout( $pagination_page, $paginator_all, $pagination_position );
								break;
						 	case 'lazy_scroll':
								echo '<div class="lazy-load loading font-titles text-' . $pagination_position . '" data-lazy-load="scroll" data-lazy-pages-count="' . esc_attr( $paginator_all ) . '" data-lazy-load-url-pattern="' . esc_attr( $paginator_pattern ) . '" data-lazy-load-scope="posts">';
								echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro' ) . '</span>';
								echo '<span class="icon ion-refresh"></span>';
								echo '</div>';
								break;
							case 'lazy_button':
								echo '<div class="lazy-load load-more font-titles text-' . $pagination_position . '" data-lazy-load="click" data-lazy-pages-count="' . esc_attr( $paginator_all ) . '" data-lazy-load-url-pattern="' . esc_attr( $paginator_pattern ) . '" data-lazy-load-scope="posts">';
								echo '<span class="loadmore-text">' . esc_html__( 'Load More', 'norebro' ) . '</span>';
								echo '<span class="loading-text">' . esc_html__( 'Loading', 'norebro' ) . '</span>';
								echo '<span class="icon ion-refresh"></span>';
								echo '</div>';
								break;
						}
					}
				?>
			</main>
		</div><!-- #primary -->

		<?php if ( is_active_sidebar( 'norebro-sidebar-blog' ) && $sidebar_position == 'right' ) : ?>
		<div class="page-sidebar sidebar-right<?php echo esc_attr($sidebar_class); ?>">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>

	</div><!--.page-container-->

<?php else : ?>

	<?php get_template_part( 'parts/content', 'none' ); ?>

<?php endif;

	get_footer();
?>