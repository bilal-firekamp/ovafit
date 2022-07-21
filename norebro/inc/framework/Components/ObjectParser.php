<?php

class NorebroObjectParser {

	/**
	* Parse post data from object
	*/
	static function parse_to_post_object( $_post, $_context = 'index', $_index = false ) {
		$post_object = array( 'index' => $_index, 'media' => array() );

		$post_object['post_id'] = $_post->ID;

		$post_object['date'] = get_the_date( get_option( 'date_format' ), $_post->ID );
		$post_object['title'] = $_post->post_title;
		if ( ! $post_object['title'] ) { 
			$post_object['title'] = '[' . get_the_date( get_option( 'date_format' ), $_post->ID ) . ']';
		}
		$post_object['url'] = get_permalink( $_post->ID );
		$post_object['author'] = get_the_author_meta( 'display_name', $_post->post_author );
		
		$categories = wp_get_post_categories( $_post->ID );
		foreach ($categories as $_i => $_category) {
			$categories[$_i] = get_category( $_category );
		}
		$post_object['categories'] = $categories;


        if( function_exists('get_field')){
            $post_object['overlay'] = get_field( 'post_overlay_color', $_post->ID );
        } else {
            $post_object['overlay'] = get_post_meta( $_post->ID, 'post_overlay_color' );
        }


		// formats
		$format = get_post_format( $_post->ID );

		$image_id = get_post_thumbnail_id( $_post->ID );
		if ( $image_id ) {
			$image = wp_get_attachment_image_src( $image_id, 'full' );
			if ( is_array( $image ) ) {
				$post_object['media']['image'] = $image[0];
				// fix vertical images
				if ( $image[1] < $image[2] ) {
					$_image_basename = basename( get_attached_file( $image_id ) );
					$_image_new_basename = substr( $_image_basename, 0, strrpos( $_image_basename, '.' ) ) . '-' . $image[1] . 'x' . $image[1] . substr( $_image_basename, strrpos( $_image_basename, '.' ));
					$_image_new_uri = str_replace( $_image_basename, $_image_new_basename, get_attached_file( $image_id ) );
					$_image_new_url = str_replace( $_image_basename, $_image_new_basename, $image[0] );
					if ( file_exists( $_image_new_uri ) ) {
						$post_object['media']['image'] = $_image_new_url;
					} else {
						$_image = wp_get_image_editor( get_attached_file( $image_id ) );
						if ( ! is_wp_error( $_image ) ) {
							$_image->resize( $image[1], $image[1] - ( (int) ( $image[1] / 3 ) ), true );
							if ( $_image->save( $_image_new_uri ) ) {
								$post_object['media']['image'] = $_image_new_url;
							}
						}
					}
				}
			} else {
				$post_object['media']['image'] = $image;
			}
		} else {
			$post_object['media']['image'] = false;
		}

		$post_object['media']['audio'] = false;
		if ( $format == 'audio' ) {
			preg_match( '/\[audio.+?\](\s)*(\[\/audio\])?/', $_post->post_content, $audio_matches);
			preg_match( '/\<iframe[^\>]*soundcloud\.com\/player[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $soundcloud_matches);
			if ( is_array( $audio_matches ) && $audio_matches ) {
				$post_object['media']['audio'] = do_shortcode( $audio_matches[0] );
			}
			if ( is_array( $soundcloud_matches ) && $soundcloud_matches ) {
				if ( is_array( $audio_matches ) && $audio_matches ) {
					if ( strpos( $_post->post_content, $soundcloud_matches[0] ) < strpos( $_post->post_content, $audio_matches[0] ) ) {
						$post_object['media']['audio'] = $soundcloud_matches[0];
					}
				} else {
					$post_object['media']['audio'] = $soundcloud_matches[0];
				}
			}
		}

		$post_object['media']['video'] = false;
		if ( $format == 'video' ) {
			preg_match( '/\[video.+?\](\s)*(\[\/video\])?/', $_post->post_content, $video_matches );
			preg_match( '/(http:|https:)?\/\/(www\.)?youtube\.com\/watch?[^\s\"\]]*/', $_post->post_content, $youtube_link_matches );
			preg_match( '/(http:|https:)?\/\/(www\.)?vimeo\.com\/[\d]+[^\s\"\]]*/', $_post->post_content, $vimeo_link_matches );
			preg_match( '/\<iframe[^\>]*youtube\.com\/embed[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $youtube_frame_matches );
			preg_match( '/\<iframe[^\>]*vimeo\.com\/video[^\>]*>(\s)*(\<\/iframe\>)?/', $_post->post_content, $vimeo_frame_matches );
			if ( is_array( $video_matches ) && $video_matches ) {
				$post_object['media']['video'] = do_shortcode( $video_matches[0] );
			}
			if ( is_array( $vimeo_link_matches ) && $vimeo_link_matches ) {
				$video_key = urlencode( substr( $vimeo_link_matches[0], strpos( $vimeo_link_matches[0], 'vimeo.com/' ) + 10 ) );
				$post_object['media']['video'] = '<iframe src="https://player.vimeo.com/video/' . $video_key . '" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe>';
			}
			if ( is_array( $vimeo_frame_matches ) && $vimeo_frame_matches ) {
				$vimeo_frame_matches[0] = preg_replace( array( '/height\=\"[\d]+?\"/', '/width\=\"[\d]+?\"/' ), '', $vimeo_frame_matches[0] );
				$post_object['media']['video'] = do_shortcode( $vimeo_frame_matches[0] );
			}
			if ( is_array( $youtube_link_matches ) && $youtube_link_matches ) {
				$video_key = urlencode( substr( $youtube_link_matches[0], strpos( $youtube_link_matches[0], 'v=' ) + 2 ) );
				$post_object['media']['video'] = '<iframe src="https://www.youtube.com/embed/' . $video_key . '" frameborder="0" allowfullscreen></iframe>';
			}
			if ( is_array( $youtube_frame_matches ) && $youtube_frame_matches ) {
				$youtube_frame_matches[0] = preg_replace( array( '/height\=\"[\d]+?\"/', '/width\=\"[\d]+?\"/' ), '', $youtube_frame_matches[0] );
				$post_object['media']['video'] = do_shortcode( $youtube_frame_matches[0] );
			}
		}

		$post_object['media']['blockquote'] = false;
		if ( $format == 'quote' ) {
			preg_match( '/\<blockquote(.|\s)*?\>(.|\s)+?\<\/blockquote\>/', $_post->post_content, $blockquotes_matches );
			if ( is_array( $blockquotes_matches ) && $blockquotes_matches ) {
				$blockquote = $blockquotes_matches[0];
				$post_object['media']['blockquote'] = wp_kses( str_replace( '\<a.*?\>', '', $blockquote ), 'default' );
			}
		}

		$post_object['media']['gallery'] = false;
		if ( $format == 'gallery' ) {
			preg_match( '/\[gallery.*?\]/', $_post->post_content, $galleries_matches );
			if ( is_array( $galleries_matches ) && $galleries_matches ) {
				$post_object['media']['gallery'] = do_shortcode( $galleries_matches[0] );
			}
		}

		$content_preview = '';
		if ($post_object['media']['blockquote']) {
			$content_preview = wp_kses($post_object['media']['blockquote'], 'post');
		} else {
			if ( strpos( $_post->post_content, '<!--more-->' ) ) { 
				$content_preview = substr( $_post->post_content, 0, strpos( $_post->post_content, '<!--more-->' ) );
				$content_preview = preg_replace( '/\[.+?\]/', '', $content_preview );
			} else {
				$content_preview = get_the_excerpt( $_post->post_content );
				if ( ! $content_preview ) {
					$excerpt_length = (int) apply_filters( 'excerpt_length', 55 );
					$content_preview = preg_replace( '/\[.+?\]/', '', $_post->post_content );
					$content_preview = wp_trim_words( $content_preview, $excerpt_length, apply_filters( 'excerpt_more', '&hellip;' ) );
				}
			}
		}
        $post_object['preview'] = $content_preview;
		

		$post_object['boxed'] = true;
        if(function_exists('get_field')) {
            if (is_home()) {
                $boxed = NorebroSettings::get( 'blog_item_layout_type', 'global' );
                if ($boxed == 'classic' || $boxed == 'simple') {
                    $post_object['boxed'] = (bool) NorebroSettings::get( 'blog_items_boxed_style', 'global' );
                } else {
                    $post_object['boxed'] = false;
                }
            } else {

                if ( get_field( 'blog_item_layout_type', get_queried_object_id() ) == 'classic' || get_field( 'blog_item_layout_type', get_queried_object_id() ) == 'simple') {
                    $boxed = get_field('blog_items_boxed_style', get_queried_object_id() );
                    if( in_array( $boxed, array('inherit', NULL) ) ) {
                        $post_object['boxed'] = (bool) NorebroSettings::get( 'blog_items_boxed_style', 'global' );
                    } else {
                        if( $boxed == 'default') {
                            $post_object['boxed'] = false;
                        } else {
                            $post_object['boxed'] = true;
                        }
                    }
                }
            }
        }

		// striped and indented
		$post_object['grid_card_striped'] = false;
		$post_object['grid_card_indented'] = false;
		if ( NorebroSettings::page_is( 'blog_template' ) ) {
			$post_object['grid_card_striped'] = NorebroSettings::get( 'blog_posts_grid_is_striped' );
			$post_object['grid_card_indented'] = NorebroSettings::get( 'blog_posts_grid_is_indented' );
		} else {
			//case 'search':
			//case 'archive':
			//default:
			$post_object['grid_card_striped'] = NorebroSettings::get( 'blog_page_grid_is_striped', 'global' );
			$post_object['grid_card_indented'] = NorebroSettings::get( 'blog_page_grid_is_indented', 'global' );
		}

        if( function_exists('get_field')){
		    $post_object['grid_style'] = get_field( 'post_style_in_grid', $_post->ID );
        } else {
		    $post_object['grid_style'] = get_post_meta( $_post->ID,'post_style_in_grid' );
        }

		$post_object['animation_type'] = false;
		$post_object['animation_effect'] = false;
		switch ( $_context ) {
			case 'index':
			default:
				$post_object['animation_type'] = NorebroSettings::get( 'blog_page_animation_type', 'global' );
				if ( in_array( $post_object['animation_type'], array( 'sync', 'async' ) ) ) {
					$post_object['animation_effect'] = NorebroSettings::get( 'blog_page_animation_effect', 'global' );
					if ( ! $post_object['animation_effect'] ) {
						$post_object['animation_effect'] = 'fade-up';
					}
				}
				break;
		}

		return $post_object;
	}


	/*
	* Project post
	*/
	static function parse_to_project_object( $_post ) {
		$project_object = array();
		// title
		$project_object['id'] = $_post->ID;
		$project_object['title'] = get_the_title( $_post->ID );
		if ( ! $project_object['title'] ) {
			$project_object['title'] = '[' . get_the_date( get_option( 'date_format' ), $_post->ID ) . ']';
		}
		// description
		$project_object['description'] = trim( get_field( 'project_description', $_post->ID ) );
		$project_object['short_description'] = trim( get_field( 'project_description', $_post->ID ) );
		if ( ! $project_object['short_description'] ) {
			$project_object['short_description'] = '';
		} elseif ( strlen( $project_object['short_description'] ) > 200 ) {
			$_desc_first_space = substr( $project_object['short_description'], 200 );
			$_desc_first_space = 200 + strpos( $_desc_first_space, ' ');
			$project_object['short_description'] = substr( $project_object['short_description'], 0, $_desc_first_space ) . '&hellip;';
		}

		// Visible
		$project_object['category_visible'] = NorebroSettings::get( 'portfolio_page_category', 'global' );
		$project_object['description_visible'] = NorebroSettings::get( 'portfolio_page_description', 'global' );
		$project_object['more_visible'] = NorebroSettings::get( 'portfolio_page_more', 'global' );
		$project_object['counter_visible'] = NorebroSettings::get( 'portfolio_page_numbers', 'global' );
		$project_object['date_visible'] = NorebroSettings::get( 'portfolio_page_date', 'global' );

		// Images
        $gallery = get_field( 'project_content', $_post->ID );
        $project_object['images'] = array();
        $project_object['images_full'] = array();
        if ( is_array( $gallery ) && count( $gallery ) > 0 ) {
            foreach ( $gallery as $key => $value ) {
                if ( $value && is_string( $value ) ) {
                    $project_object['images'][$key] = wp_get_attachment_url( $value );
                    $project_object['images_full'][$key] = wp_get_attachment_url( $value, 'full' );
                } elseif ( is_array( $value ) && isset( $value['sizes'] ) && isset( $value['sizes']['large'] ) ) {
                    $project_object['images'][$key] = $value['sizes']['large'];
                    if ( isset( $value['sizes']['norebro_full'] ) ) {
                        $project_object['images_full'][$key] = $value['sizes']['norebro_full'];
                    } else {
                        $project_object['images_full'][$key] = $value['sizes']['large'];
                    }
                }
            }
        } else {
            $project_object['images'] = array();
            $project_object['images_full'] = array();
        }

		// Featured image
        $thumbnailSize = NorebroSettings::get('portfolio_images_size', 'global');
        if($thumbnailSize) {
            $project_object['featured_image'] = get_the_post_thumbnail_url( $_post->ID, $thumbnailSize );
        } else {
            $project_object['featured_image'] = get_the_post_thumbnail_url( $_post->ID, 'medium_large' );
        }

		// Get norebro_full size for full image
		if ( get_the_post_thumbnail_url( $_post->ID, 'norebro_full' ) ) {
			$project_object['featured_image_full'] = get_the_post_thumbnail_url( $_post->ID, 'norebro_full' );
		} else {
			$project_object['featured_image_full'] = get_the_post_thumbnail_url( $_post->ID, 'full' );
		}

		// If .gif then get full size
		if( $project_object['featured_image'] && pathinfo( $project_object['featured_image'], PATHINFO_EXTENSION ) == 'gif' ){
			$project_object['featured_image'] = get_the_post_thumbnail_url( $_post->ID, 'full' );
		}

		// If thumbnail empty
		if( ! $project_object['featured_image'] && is_array( $project_object['images'] ) && count( $project_object['images'] ) > 0 ){

			// If .gif then get full size
			if( $project_object['images'][0] && pathinfo( $project_object['images'][0], PATHINFO_EXTENSION ) == 'gif' ){
				$project_object['featured_image'] = $project_object['images_full'][0];
			} else {
                if ($thumbnailSize) {
                    if($thumbnailSize == 'full') {
                        $project_object['featured_image'] = $gallery[0]['url'];
                    } else {
                        $project_object['featured_image'] = $gallery[0]['sizes'][$thumbnailSize];
                    }
                } else {
                    $project_object['featured_image'] = $project_object['images'][0];
                }
			}

			$project_object['featured_image_full'] = $project_object['images_full'][0];
		}

		// info
		$project_object['date'] = get_field( 'project_date', $_post->ID );
		$project_object['task'] = get_field( 'project_task', $_post->ID );
		$project_object['skills'] = get_field( 'project_skills', $_post->ID );
		$project_object['client'] = get_field( 'project_client', $_post->ID );
		$project_object['link'] = get_field( 'project_link', $_post->ID );
		// custom info
		$project_object['custom_fields'] = array();
		$_custom_fields = get_field( 'project_custom_fields', $_post->ID );
		if ( is_array( $_custom_fields ) && $_custom_fields ) {
			foreach ( $_custom_fields as $field ) {
				$project_object['custom_fields'][] = array(
					'title' => $field['project_custom_field_title'],
					'value' => $field['project_custom_field_value']
				);
			}
		}
		// show navigation
		$project_object['show_navigation'] = get_field( 'project_show_navigation', $_post->ID );
		if ( in_array( $project_object['show_navigation'], array( 'inherit', NULL ) ) ) {
			$project_object['show_navigation'] = NorebroSettings::get( 'project_show_navigation', 'global' );
		}

		$project_object['navigation_position'] = get_field( 'project_navigation_position', $_post->ID );
		if ( in_array( $project_object['navigation_position'] , array( 'inherit', NULL ) ) 
				|| in_array( $project_object['show_navigation'], array( 'inherit', NULL ) ) ) {
			$project_object['navigation_position'] = NorebroSettings::get( 'project_navigation_position', 'global' );
		}
		// custom content position
		$project_object['custom_content_position'] = get_field( 'project_custom_content_position', $_post->ID );
		if ( in_array( $project_object['custom_content_position'], array( 'inherit', NULL ) ) ) {
			$project_object['custom_content_position'] = NorebroSettings::get( 'project_custom_content_position', 'global' );
			if ( $project_object['custom_content_position'] == NULL ) {
				$project_object['custom_content_position'] = 'top';
			}
		}
		// breadcrumbs
		$project_object['hide_breadcrumbs'] = get_field( 'page_show_breadcrumbs', $_post->ID );
		if ( in_array( $project_object['hide_breadcrumbs'], array( 'inherit', NULL ) ) ) {
			$project_object['hide_breadcrumbs'] = ( NorebroSettings::get( 'project_hide_breadcrumbs', 'global' ) == 'yes' );
		} else {
			$project_object['hide_breadcrumbs'] = ( NorebroSettings::get( 'page_show_breadcrumbs' ) == 'no' );
		}
		// sharing
		$project_object['hide_sharing'] = (bool) NorebroSettings::get( 'project_hide_sharing_buttons', 'global' );
		$project_object['sharing_links'] = NorebroSettings::get( 'project_social_sharing_buttons', 'global' );
		$project_object['sharing_links_html'] = '';

		// Build share links
		if ( ! $project_object['hide_sharing'] && $project_object['sharing_links'] && count( $project_object['sharing_links'] ) > 0 ) {

			ob_start();

			foreach( $project_object['sharing_links'] as $share_link ) {

				if ( $share_link == 'twitter' ) : ?>
					<a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $project_object['title'] ); ?>,+<?php echo rawurlencode( get_permalink() ); ?>" class="twitter hover-underline">
						<i class="fab fa-twitter"></i>
						<span class="social-text"><?php esc_html_e( 'Twitter', 'norebro' ); ?></span>
					</a>
				<?php endif;

				if ( $share_link == 'facebook' ) : ?>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" class="facebook hover-underline">
						<i class="fab fa-facebook"></i>
						<span class="social-text"><?php esc_html_e( 'Facebook', 'norebro' ); ?></span>
					</a>
				<?php endif;

				if ( $share_link == 'linkedin' ) : ?>
					<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo urlencode( $project_object['title'] ); ?>&source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" class="linkedin hover-underline">
						<i class="fab fa-linkedin"></i>
						<span class="social-text"><?php esc_html_e( 'LinkedIn', 'norebro' ); ?></span>
					</a>
				<?php endif;

				if ( $share_link == 'pinterest' ) : ?>
					<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink() ); ?>&description=<?php echo urlencode( $project_object['title'] ); ?>" class="pinterest hover-underline">
						<i class="fab fa-pinterest-p"></i>
						<span class="social-text"><?php esc_html_e( 'Pinterest', 'norebro' ); ?></span>
					</a>
				<?php endif;

				if ( $share_link == 'vk' ) : ?>
					<a href="http://vk.com/share.php?url=<?php echo rawurlencode( get_permalink() ); ?>" class="vk hover-underline">
						<i class="fab fa-vk"></i>
						<span class="social-text"><?php esc_html_e( 'Vkontakte', 'norebro' ); ?></span>
					</a>
				<?php endif;

			}

			$project_object['sharing_links_html'] = ob_get_clean();
		}

		// portfolio link
		$project_object['link_to_all'] = NorebroSettings::get( 'portfolio_page', 'global' );
		if ( ! $project_object['link_to_all'] ) {
			$project_object['link_to_all'] = esc_url( home_url( '/' ) );
		}
		// custom info
		$project['custom_fields'] = array();
		$_custom_fields = get_field( 'project_custom_fields', $_post->ID );
		if ( is_array( $_custom_fields ) && $_custom_fields ) {
			foreach ( $_custom_fields as $field ) {
				$project['custom_fields'][] = array(
					'title' => $field['project_custom_field_title'],
					'value' => $field['project_custom_field_value']
				);
			}
		}
		// categories
		$_categories = wp_get_post_terms( $_post->ID, 'norebro_portfolio_category' );
		$project_object['categories'] = $_categories;
		if ( $project_object['categories'] && is_array( $project_object['categories'] ) && count( $project_object['categories'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project_object['categories'] as $category) {
				$_project_categories[] = '<span class="brand-color brand-border-color">' . $category->name . '</span>';
			}
			$project_object['categories'] = implode( ' ', $_project_categories );
		} else {
			$project_object['categories'] = '';
		}
		$project_object['categories_plain'] = $_categories;
		if ( $project_object['categories_plain'] && is_array( $project_object['categories_plain'] ) && count( $project_object['categories_plain'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project_object['categories_plain'] as $category) {
				$_project_categories[] = $category->name;
			}
			$project_object['categories_plain'] = implode( ', ', $_project_categories );
		} else {
			$project_object['categories_plain'] = '';
		}
		$project_object['categories_group'] = $_categories;
		if ( $project_object['categories_group'] && is_array( $project_object['categories_group'] ) && count( $project_object['categories_group'] ) > 0 ) {
			$_project_categories = array();
			foreach ($project_object['categories_group'] as $category) {
				$_project_categories[] = 'norebro-filter-project-' . hash( 'md4', $category->slug, false );
			}
			$project_object['categories_group'] = implode( ' ', $_project_categories );
		} else {
			$project_object['categories_group'] = '';
		}
		// next n prev
		$project_object['next'] = get_adjacent_post( false, '', true );
		if ( is_a( $project_object['next'], 'WP_Post' ) ) {
			$images = get_field( 'project_content', $project_object['next']->ID );
			$image = ( is_array( $images ) && count( $images ) > 0 ) ? $images[0] : false;
			if ( $image && is_string( $image ) ) {
				$image = wp_get_attachment_url( $image );
			} elseif ( is_array( $image ) ) {
				$image = $image['sizes']['thumbnail'];
			}
			$project_object['next'] = array(
				'title' => $project_object['next']->post_title,
				'url' => get_permalink( $project_object['next']->ID ),
				'image' => $image
			);
		} else {
			$project_object['next'] = false;
		}
		$project_object['prev'] = get_adjacent_post( false, '', false );
		if ( is_a( $project_object['prev'], 'WP_Post' ) ) {
			$images = get_field( 'project_content', $project_object['prev']->ID );
			$image = ( is_array( $images ) && count( $images ) > 0 ) ? $images[0] : false;
			if ( $image && is_string( $image ) ) {
				$image = wp_get_attachment_url( $image );
			} elseif ( is_array( $image ) ) {
				$image = $image['sizes']['thumbnail'];
			}
			$project_object['prev'] = array(
				'title' => $project_object['prev']->post_title,
				'url' => get_permalink( $project_object['prev']->ID ),
				'image' => $image
			);
		} else {
			$project_object['prev'] = false;
		}
		// overlay color
		$project_object['overlay'] = get_field( 'project_overlay_color', $_post->ID );
		if ( ! $project_object['overlay'] ) {
			$project_object['overlay'] = false;
		}
		// grid
		$project_object['grid_style'] = get_field( 'project_style_in_grid', $_post->ID );
		// animation
		$project['with_animation'] = get_field( 'global_portfolio_with_animation', 'option' );
		if ( $project['with_animation'] == NULL ) {
			$project['with_animation'] = true;
		}
		// popup
		$project_object['in_popup'] = false;
		$project_object['popup_id'] = uniqid( 'norebro-popup-' );
		switch ( get_field( 'project_open_type', $_post->ID ) ) {
			case 'external_target':
				$project_object['url'] = $project_object['link'];
				$project_object['external'] = false;
				break;
			case 'external_blank':
				$project_object['url'] = $project_object['link'];
				$project_object['external'] = true;
				break;
			case 'project':
			default:
				$project_object['url'] = get_post_permalink( $_post->ID );
				$project_object['external'] = false;
				break;
		}
		return $project_object;
	}

}