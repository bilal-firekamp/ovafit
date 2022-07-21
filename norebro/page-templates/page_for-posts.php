<?php /* Template Name: Blog page */ ?>

<?php
	get_header();

	$show_breadcrumbs = NorebroSettings::breadcrumbs_is_displayed();
	$page_wrapped = NorebroSettings::page_is_wrapped();
	$add_content_padding = NorebroSettings::page_add_top_padding();

	$categories = NorebroSettings::get( 'blog_categories' );
	$categories = ( is_array( $categories ) ) ? implode( ',', $categories ) : '';

	$count_args = array(
		'cat' => $categories,
		'post_type' => 'post',
		'post_status' => 'publish'
	);
	$the_query = new WP_Query( $count_args );
	$published_posts = $the_query->found_posts;

	if ( get_query_var( 'paged' ) ) {
		$pagination_page = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$pagination_page = get_query_var( 'page' );
	} else {
		$pagination_page = 1;
	}

	$posts_per_page = NorebroSettings::posts_per_page();
	$posts_offset = ( $pagination_page - 1 ) * $posts_per_page;

	$pagination_type = NorebroSettings::get( 'blog_pagination_type' );
	if ( in_array( $pagination_type, array( 'inherit', NULL ) ) ) {
		$pagination_type = NorebroSettings::get( 'blog_pagination_type', 'global' );
	}
	$pagination_position = NorebroSettings::get( 'blog_pagination_position' );
	if ( in_array( $pagination_position, array( 'inherit', NULL ) ) ) {
		$pagination_position = NorebroSettings::get( 'blog_pagination_position', 'global' );
	}

	if ( $pagination_position == NULL ) {
		$pagination_position = 'left';
	}
	if ( $pagination_type == NULL ) {
		$pagination_type = 'simple';
	}

	$paginator_current = $pagination_page;
	if ( ! $posts_per_page || $posts_per_page < 1 ) {
		$posts_per_page = 1;
	}
	$paginator_all = ceil( $published_posts / $posts_per_page );

	$posts_show_from = $posts_offset + 1;
	$posts_show_to = $posts_offset + $posts_per_page;
	if ( $posts_show_to > $published_posts ) {
		$posts_show_to = $published_posts;
	}

	$args = array(
		'posts_per_page' => $posts_per_page,
		'offset' => $posts_offset,
		'category' => $categories,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'post_mime_type' => '',
		'post_parent' => '',
		'author' => '',
		'author_name' => '',
		'post_status' => 'publish',
		'suppress_filters' => false
	);
	$posts_array = get_posts( $args );

	$sidebar_position = NorebroSettings::get( 'page_sidebar' );
	if ( in_array( $sidebar_position, array( 'inherit', NULL ) ) ) {
		$sidebar_position = NorebroSettings::get( 'blog_sidebar', 'global' );
		if ( in_array( $sidebar_position, array( 'inherit', NULL ) ) ) {
			$sidebar_position = NorebroSettings::get( 'page_sidebar', 'global' );
		}
	}
	$sidebar_page_class = '';
	if ( $sidebar_position == 'left' ) {
		$sidebar_page_class = ' with-left-sidebar';
	}
	if ( $sidebar_position == 'right' ) {
		$sidebar_page_class = ' with-right-sidebar';
	}

	$sidebar_layout = NorebroSettings::page_sidebar_layout();
	$sidebar_class = '';
	if ( $sidebar_layout ) {
		$sidebar_class .= ' sidebar-' . $sidebar_layout;
	}

	$posts_grid = NorebroSettings::get( 'blog_page_layout' );
	if ( in_array( $posts_grid, array( 'inherit', NULL ) ) ) {
		$posts_grid = NorebroSettings::get( 'blog_page_layout', 'global' );
	}

	$grid_style_class = ( $posts_grid == 'masonry' ) ? 'blog-posts-masonry norebro-masonry' : 'blog-posts-classic';

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

	$columns_num = NorebroSettings::get( 'blog_columns_in_row' );
	$columns_num_global = NorebroSettings::get( 'blog_columns_in_row', 'global' );

	if ( ! isset( $columns_num ) ) {
		$columns_num = 'i-i-i-i';
	}
	if ( ! isset( $columns_num_global ) ) {
		$columns_num = '1-1-1-1';
	}

	$posts_layout_item = NorebroSettings::get( 'blog_item_layout_type' );
	if ( in_array( $posts_layout_item, array( 'inherit', NULL ) ) ) {
		$posts_layout_item = NorebroSettings::get( 'blog_item_layout_type', 'global' );
	}

	$animation_type = NorebroSettings::get( 'blog_page_animation_type' );
	if ( in_array( $animation_type, array( 'inherit', NULL ) ) ) {
		$animation_type = NorebroSettings::get( 'blog_page_animation_type', 'global' );
	}
	$animation_effect = NorebroSettings::get( 'blog_page_animation_effect' );
	if ( in_array( $animation_effect, array( 'inherit', NULL ) ) ) {
		$animation_effect = NorebroSettings::get( 'blog_page_animation_effect', 'global' );
	}

	if ( $posts_grid == 'classic' ) { $columns_num = '1-1-1-1'; }
	if ( $posts_layout_item == 'striped' ) { $columns_num = '1-1-1-1'; }

	$columns_class = NorebroHelper::parse_columns_to_css( $columns_num, false, $columns_num_global );
	$columns_double_class = NorebroHelper::parse_columns_to_css( $columns_num, true, $columns_num_global );

	$page_container_class = '';
	if ( !$show_breadcrumbs && $add_content_padding ) {
		$page_container_class .= ' without-breadcrumbs';
	}
	if ( !$page_wrapped ) {
		$page_container_class .= ' full';
	}
	if ( $add_content_padding ) {
		$page_container_class .= ' bottom-offset';
	}

    $content_location = NorebroSettings::get( 'post_content_position', 'global' );
    if ($content_location == NULL) {
        $content_location = 'top';
    }
?>

<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<div class="page-container<?php echo esc_attr( $page_container_class ); ?>">
	<div id="primary" class="content-area">
			
		<?php if ( $sidebar_position == 'left' ) : ?>
		<div class="page-sidebar sidebar-left<?php echo esc_attr($sidebar_class); ?>">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>
			
		<div class="page-content<?php echo esc_attr( $sidebar_page_class ); ?>">
			<main id="main" class="site-main">

                <!-- Custom content -->
                <?php
                if ($content_location == 'top'):
                    if(have_posts()) :
                        echo '<div class="page_content blog_page_content">';
                        while(have_posts()) : the_post();
                            the_content();
                        endwhile;
                        echo '</div>';
                    endif;
                endif;
                ?>

				<div class="vc_row <?php echo esc_attr( $grid_style_class ); ?>" data-lazy-container="posts">
				<?php
				$_post_i = 0;
				foreach ( $posts_array as $post_index => $_post_object ) {
					$_parsed_post = NorebroObjectParser::parse_to_post_object( $_post_object, NULL, $_post_i + 1 );
					NorebroHelper::set_storage_item_data( $_parsed_post );

                    setup_postdata(get_post($_parsed_post['post_id']));
                    global $post;
                    $post = get_post($_parsed_post['post_id']);

					$col_class = $columns_class;
					$grid_class = ' grid-item';

					if ( $_parsed_post['grid_style'] == '2col' ) {
						$col_class = $columns_double_class;
						$grid_class = '';
					}

					// Animation calculating
					$_anim_attrs = '';
					if ( in_array( $animation_type, array( 'sync', 'async' ) ) ) {
						$_anim_attrs .= ' data-aos-once="true"';
						$_anim_attrs .= ' data-aos="' . $animation_effect . '"';
						if ( $animation_type == 'async' ) {
							$columns_num = (int) substr( $columns_num, 0, 1 );
							if ( $columns_num <= 0 ) { $columns_num = 1; }
							$_delay = ( 400 / $columns_num ) * ( $_post_i % $columns_num );
							$_delay = (int) $_delay - ( $_delay % 50 );
							$_anim_attrs .= ' data-aos-delay="' . $_delay . '"';
						}
					}

					echo '<div class="' . esc_attr( $col_class . $grid_class . $grid_item_style_class . ( ( $posts_grid == 'masonry' ) ? ' norebro-card-wrapper blog-post-masonry masonry-block' : '' ) ) . '" ' . $_anim_attrs . ' data-lazy-item="" data-lazy-scope="posts">';

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
					echo '<div class="clear"></div>';
					echo '</div>';

					$_post_i++;

					wp_reset_postdata();
				}
				?>
				</div>

				<?php
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

                <!-- Custom content -->
                <?php
                if ($content_location == 'bottom'):
                    if(have_posts()) :
                        echo '<div class="page_content blog_page_content">';
                        while(have_posts()) : the_post();
                            the_content();
                        endwhile;
                        echo '</div>';
                    endif;
                endif;
                ?>

			</main>
		</div>
		<?php if ( $sidebar_position == 'right' ) : ?>
		<div class="page-sidebar sidebar-right<?php echo esc_attr($sidebar_class); ?>">
			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
			</aside>
		</div>
		<?php endif; ?>
	</div>
</div>
	
<?php get_footer();