<?php
/*
	Header title custom style

	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Background image
	# 3.1. Background image size
	# 3.2. Background image position
	# 3.3. Background image repeat
	# 4. Title settings
	# 5. Subtitle settings
	# 6. Choose background overlay color
	# 7. Header title height
	# 8. View
*/


# 1. Variables

$header_title_height 	= false;
$background_color 		= false;
$background_image 		= false;
$background_size 		   = false;
$background_position 	= false;
$background_repeat 		= false;
$title_typo				   = false;
$subtitle_typo 			= false;
$overlay_color 			= false;

$background_color_css 	 = '';
$background_image_css 	 = '';
$background_size_css 	 = '';
$background_position_css = '';
$background_repeat_css 	 = '';
$title_typo_css 		    = '';
$subtitle_typo_css 		 = '';
$overlay_color_css 		 = '';
$header_title_height_css = '';


# 2. Background color

if ( NorebroSettings::page_is( 'single' ) ) {
	$background_color = NorebroSettings::get( 'post_title_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'post_title_background' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'post_title_background_color', 'global' );
		if ( ! $background_color && in_array( NorebroSettings::get( 'post_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = NorebroSettings::get( 'header_background_color', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	$background_color = NorebroSettings::get( 'header_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'woocommerce_header_background_color', 'global' );
		if ( ! $background_color && in_array( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = NorebroSettings::get( 'header_background_color', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	$background_color = NorebroSettings::get( 'header_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = NorebroSettings::get( 'header_background_color', 'global' );
		} else {
			$background_color = NorebroSettings::get( 'portfolio_title_background_color', 'global' );
		}
	}
} else {
	$background_color = NorebroSettings::get( 'header_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'header_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Background image

if ( NorebroSettings::page_is( 'single' ) ) {
	switch ( NorebroSettings::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
			$post_thumbnail_images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail-size', true);
			if ( is_array( $post_thumbnail_images ) ) {
				$background_image = $post_thumbnail_images[0];
			}
			break;
		case 'loaded_image':
			$background_image = NorebroSettings::get( 'post_title_background_image' );
			break;
		case 'color':
			$background_image = false;
			break;
		case 'inherit':
		default:
			switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
					$post_thumbnail_images = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail-size', true);
					if ( is_array( $post_thumbnail_images ) ) {
						$background_image = $post_thumbnail_images[0];
					}
					break;
				case 'loaded_image':
					$background_image = NorebroSettings::get( 'post_title_background_image', 'global' );
					break;
				case 'color':
					$background_image = false;
					break;
                case 'custom':
                    $background_image = NorebroSettings::get( 'post_title_background_image', 'global' );
                    break;
				default:
					if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$background_image = NorebroSettings::get( 'header_title_background_image', 'global' );
					}
					break;
			}
			break;
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	$_woocommerce_inherit = true;
	if ( NorebroSettings::page_is( 'product_category' ) ) {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			$background_image = wp_get_attachment_url( $thumbnail_id );
			$_woocommerce_inherit = false;
		}
	}
	if ( $_woocommerce_inherit ) {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_image = NorebroSettings::get( 'header_background_image' );
		} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'image' ) {
				$background_image = NorebroSettings::get( 'woocommerce_header_background_image', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_image = NorebroSettings::get( 'header_title_background_image', 'global' );
				}
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		$background_image = NorebroSettings::get( 'header_background_image' );
	} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'custom' ) {
			$background_image = NorebroSettings::get( 'portfolio_title_background_image', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
			 	$background_image = NorebroSettings::get( 'header_title_background_image', 'global' );
			}
		}
	}
} elseif(is_archive()) {
    if (NorebroSettings::get('header_title_background_type', 'global') == 'image') {
        $background_image = NorebroSettings::get('header_title_background_image', 'global');
    }
} else {
    if(has_post_thumbnail()){
        $background_image = get_the_post_thumbnail_url($post, 'full');
    } else {
        if (NorebroSettings::get('header_background_type') == 'image') {
            $background_image = NorebroSettings::get('header_background_image');
        } elseif (NorebroSettings::get('header_background_type') == 'inherit'
            || NorebroSettings::get('header_background_type') === NULL) {
            if (NorebroSettings::get('header_title_background_type', 'global') == 'image') {
                $background_image = NorebroSettings::get('header_title_background_image', 'global');
            }
        }
    }
}

if ( $background_image ) {
	$background_image_css = 'background-image:url(\'' . $background_image . '\');';
}


# 3.1. Background image size

if ( NorebroSettings::page_is( 'single' ) ) {
	switch ( NorebroSettings::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
		case 'loaded_image':
		$background_size = NorebroSettings::get( 'post_title_background_size' );
			break;
		case 'color':
	 	$background_size = false;
			break;
		default:
			switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
				case 'custom':
					$background_size = NorebroSettings::get( 'post_title_background_size', 'global' );
					break;
				case 'color':
					$background_size = false;
					break;
				default:
					if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$background_size = NorebroSettings::get( 'header_title_background_size', 'global' );
					}
					break;
			}
			break;
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		$background_size = NorebroSettings::get( 'header_background_size' );
	} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
				|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
		if ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
			$background_size = NorebroSettings::get( 'woocommerce_header_background_size', 'global' );
		} elseif ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_size = NorebroSettings::get( 'header_title_background_size', 'global' );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		$background_size = NorebroSettings::get( 'header_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'custom' ) {
			$background_size = NorebroSettings::get( 'portfolio_title_background_size', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_size = NorebroSettings::get( 'header_title_background_size', 'global' );
			}
		}
	}
} else {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		$background_size = NorebroSettings::get( 'header_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
			$background_size = NorebroSettings::get( 'header_title_background_size', 'global' );
		}
	}
}

switch ( $background_size ) {
	case 'auto':
		$background_size_css = 'background-size:auto;';
		break;
	case 'cover':
		$background_size_css = 'background-size:cover;';
		break;
	case 'contain':
		$background_size_css = 'background-size:contain;';
		break;
	case '100per':
		$background_size_css = 'background-size:100% 100%;';
		break;
}


# 3.2. Background image position

if ( $background_size == 'auto' || $background_size == 'contain' ) {
	if ( NorebroSettings::page_is( 'single' ) ) {
		switch ( NorebroSettings::get( 'post_title_background' ) ) {
			case 'post_thumbnail':
			case 'loaded_image':
				$background_position = NorebroSettings::get( 'post_title_background_position' );
				break;
			case 'color':
		 		$background_position = false;
				break;
			default:
				switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						$background_position = NorebroSettings::get( 'post_title_background_position', 'global' );
						break;
					case 'color':
						$background_position = false;
						break;
					default:
						if ( NorebroSettings::get( 'header_title_background_type' == 'image' ) ) {
							$background_position = NorebroSettings::get( 'header_title_background_position', 'global' );
						}
						break;
				}
				break;
		}
	} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_position = NorebroSettings::get( 'header_background_position' );
		} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
					|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
			if ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				$background_position = NorebroSettings::get( 'woocommerce_header_background_position', 'global' );
			} elseif ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
						|| NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
				if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_position = NorebroSettings::get( 'header_background_position', 'global' );
				}
			}
		}
	} elseif ( NorebroSettings::page_is( 'project' ) ) {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_position = NorebroSettings::get( 'header_background_position' );
		} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'image' ) {
				$background_position = NorebroSettings::get( 'portfolio_title_background_position', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_position = NorebroSettings::get( 'header_background_position', 'global' );
				}
			}
		}
	} else {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_position = NorebroSettings::get( 'header_background_position' );
		} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
					|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
			if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_position = NorebroSettings::get( 'header_background_position', 'global' );
			}
		}
	}

	if ( $background_position ) {
		switch ( $background_position ) {
			case 'left_top':
				$background_position_css = 'background-position:left top;';
				break;
			case 'left_center':
				$background_position_css = 'background-position:left center;';
				break;
			case 'left_bottom':
				$background_position_css = 'background-position:left bottom;';
				break;
			case 'center_top':
				$background_position_css = 'background-position:center top;';
				break;
			case 'center':
				$background_position_css = 'background-position:center center;';
				break;
			case 'center_right':
				$background_position_css = 'background-position:center bottom;';
				break;
			case 'right_top':
				$background_position_css = 'background-position:right top;';
				break;
			case 'right_center':
				$background_position_css = 'background-position:right center;';
				break;
			case 'right_bottom':
				$background_position_css = 'background-position:right bottom;';
				break;
		}
	}
}


# 3.3. Background image repeat

if ( $background_size == 'auto' || $background_size == 'contain' ) {
	if ( NorebroSettings::page_is( 'single' ) ) {
		switch ( NorebroSettings::get( 'post_title_background' ) ) {
			case 'post_thumbnail':
			case 'loaded_image':
				$background_repeat = NorebroSettings::get( 'post_title_background_repeat' );
				break;
			case 'color':
		 		$background_repeat = false;
				break;
			default:
				switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						$background_repeat = NorebroSettings::get( 'post_title_background_repeat', 'global' );
						break;
					case 'color':
						$background_repeat = false;
						break;
					default:
						if ( NorebroSettings::get( 'header_title_background_type' == 'image' ) ) {
							$background_repeat = NorebroSettings::get( 'header_title_background_repeat', 'global' );
						}
						break;
				}
				break;
		}
	} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = NorebroSettings::get( 'header_background_repeat' );
		} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
					|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
			if ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				$background_repeat = NorebroSettings::get( 'woocommerce_header_background_repeat', 'global' );
			} elseif ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'inherit'
						|| NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) === NULL ) {
				if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_repeat = NorebroSettings::get( 'header_background_repeat', 'global' );
				}
			}
		}
	} elseif ( NorebroSettings::page_is( 'project' ) ) {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = NorebroSettings::get( 'header_background_repeat' );
		} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'image' ) {
				$background_repeat = NorebroSettings::get( 'portfolio_title_background_repeat', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$background_repeat = NorebroSettings::get( 'header_background_repeat', 'global' );
				}
			}
		}
	} else {
		if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
			$background_repeat = NorebroSettings::get( 'header_background_repeat' );
		} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
					|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
			if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$background_repeat = NorebroSettings::get( 'header_background_repeat', 'global' );
			}
		}
	}

	if ( $background_repeat ) {
		switch ( $background_repeat ) {
			case 'repeat':
				$background_repeat_css = 'background-repeat: repeat;';
				break;
			case 'no_repeat':
				$background_repeat_css = 'background-repeat: no-repeat;';
				break;
			case 'repeat_x':
				$background_repeat_css = 'background-repeat: repeat-x;';
				break;
			case 'repeat_y':
				$background_repeat_css = 'background-repeat: repeat-y;';
				break;
		}
	}
}


# 4. Title typography

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'post_header_title_typo' ) ) {
			$title_typo = json_decode( NorebroSettings::get( 'post_header_title_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'post_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'post_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'post_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'post_header_title_typo', 'global' ) );
			}
		} elseif ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'post_typography_settings', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( NorebroSettings::get( 'page_header_title_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'page_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'page_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'woocommerce_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'woocommerce_header_title_typo', 'global' ) );
			}
		} elseif ( NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( NorebroSettings::get( 'page_header_title_typo' ) );
		}
	} elseif ( in_array( NorebroSettings::get( 'page_typography_settings' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'portfolio_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'project_header_title_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'project_header_title_typo', 'global' ) );
			}
		} elseif ( in_array( NorebroSettings::get( 'portfolio_typography_settings', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_tilte_typo', 'global' ) ) {
				$title_typo = json_decode( NorebroSettings::get( 'header_tilte_typo', 'global' ) );
			}
		}
	}
} else {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_title_typo' ) ) {
			$title_typo = json_decode( NorebroSettings::get( 'page_header_title_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'page_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'page_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'header_tilte_typo', 'global' ) ) {
			$title_typo = json_decode( NorebroSettings::get( 'header_tilte_typo', 'global' ) );
		}
	}
}

$title_typo_css = NorebroHelper::parse_acf_typo_to_css( $title_typo );


# 5. Subtitle typography

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'post_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( NorebroSettings::get( 'post_header_subtitle_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'post_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'post_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'post_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'post_header_subtitle_typo', 'global' ) );
			}
		} elseif ( NorebroSettings::get( 'post_typography_settings', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'post_typography_settings', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( NorebroSettings::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'page_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'page_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'woocommerce_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'woocommerce_header_subtitle_typo', 'global' ) );
			}
		} elseif ( NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'woocommerce_page_typography_settings', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( NorebroSettings::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( in_array( NorebroSettings::get( 'page_typography_settings' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'portfolio_typography_settings', 'global' ) == 'custom' ) {
			if ( NorebroSettings::get( 'project_header_subtitle_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'project_header_subtitle_typo', 'global' ) );
			}
		} elseif ( in_array( NorebroSettings::get( 'portfolio_typography_settings', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_subtilte_typo', 'global' ) ) {
				$subtitle_typo = json_decode( NorebroSettings::get( 'header_subtilte_typo', 'global' ) );
			}
		}
	}
} else {
	if ( NorebroSettings::get( 'page_typography_settings' ) == 'custom' ) {
		if ( NorebroSettings::get( 'page_header_subtitle_typo' ) ) {
			$subtitle_typo = json_decode( NorebroSettings::get( 'page_header_subtitle_typo' ) );
		}
	} elseif ( NorebroSettings::get( 'page_typography_settings' ) == 'inherit'
				|| NorebroSettings::get( 'page_typography_settings' ) === NULL ) {
		if ( NorebroSettings::get( 'header_subtilte_typo', 'global' ) ) {
			$subtitle_typo = json_decode( NorebroSettings::get( 'header_subtilte_typo', 'global' ) );
		}
	}
}

$subtitle_typo_css = NorebroHelper::parse_acf_typo_to_css( $subtitle_typo );


# 6. Choose background overlay color

if ( NorebroSettings::page_is( 'single' ) ) {
	switch ( NorebroSettings::get( 'post_title_background' ) ) {
		case 'post_thumbnail':
		case 'loaded_image':
			if ( NorebroSettings::get( 'post_title_use_overlay' ) == 'yes' ) {
				$overlay_color = NorebroSettings::get( 'post_title_background_overlay' );
			} elseif ( NorebroSettings::get( 'post_title_use_overlay' ) == 'inherit'
						|| NorebroSettings::get( 'post_title_use_overlay' ) === NULL ) {
				switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
					case 'post_thumbnail':
					case 'custom':
						if ( NorebroSettings::get( 'post_use_title_overlay', 'global' ) ) {
							$overlay_color = NorebroSettings::get( 'post_title_background_overlay_color', 'global' );
						}
						break;
					case 'color':
						break;
					default:
						if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
							if ( NorebroSettings::get( 'header_use_overlay', 'global' ) ) {
								$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
							}
						}
						break;
				}
			}
			break;
		case 'color':
			break;
		default:
			switch ( NorebroSettings::get( 'post_title_background_type', 'global' ) ) {
				case 'post_thumbnail':
				case 'custom':
					if ( NorebroSettings::get( 'post_use_title_overlay', 'global' ) ) {
						$overlay_color = NorebroSettings::get( 'post_title_background_overlay_color', 'global' );
					}
					break;
				case 'color':
					break;
				default:
					if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
						if ( NorebroSettings::get( 'header_use_overlay', 'global' ) ) {
							$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
						}
					}
					break;
			}
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		if ( NorebroSettings::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = NorebroSettings::get( 'header_overlay_color' );
		} elseif ( NorebroSettings::get( 'header_use_overlay' ) == 'inherit'
					|| NorebroSettings::get( 'header_use_overlay' ) === NULL ) {
			if ( NorebroSettings::get( 'woocommerce_header_title_background_type', 'global' ) == 'custom' ) {
				if ( NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) == 'yes' ) {
					$overlay_color = NorebroSettings::get( 'woocommerce_header_overlay_color', 'global' );
				} elseif ( NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) == 'inherit'
							|| NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) === NULL ) {
					if ( NorebroSettings::get( 'header_use_overlay', 'global' )
						&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
					}
				}
			} elseif ( NorebroSettings::get( 'woocommerce_title_background_type', 'global' ) == 'inherit'
						|| NorebroSettings::get( 'woocommerce_title_background_type', 'global' ) === NULL ) {
				if ( NorebroSettings::get( 'header_use_overlay', 'global' )
					&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
				}
			}
		}
	} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
				|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
		if ( NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) == 'yes' ) {
			$overlay_color = NorebroSettings::get( 'woocommerce_header_overlay_color', 'global' );
		} elseif ( NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) == 'inherit'
					|| NorebroSettings::get( 'woocommerce_header_use_overlay', 'global' ) === NULL ) {
			if ( NorebroSettings::get( 'header_use_overlay', 'global' )
				&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
			}
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		if ( NorebroSettings::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = NorebroSettings::get( 'header_overlay_color' );
		} elseif ( in_array( NorebroSettings::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'custom' ) {
				if ( NorebroSettings::get( 'portfolio_use_title_overlay', 'global' ) == 'yes' ) {
					$overlay_color = NorebroSettings::get( 'portfolio_title_background_overlay_color', 'global' );
				} elseif ( in_array( NorebroSettings::get( 'portfolio_use_title_overlay', 'global' ), array( 'inherit', NULL ) ) ) {
					if ( NorebroSettings::get( 'header_use_overlay', 'global' )
						&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
						$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
					}
				}
			} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
				if ( NorebroSettings::get( 'header_use_overlay', 'global' )
					&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
					$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
				}
			}
		}
	} elseif ( in_array( NorebroSettings::get( 'header_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'portfolio_header_title_type', 'global' ) == 'custom'
				&& NorebroSettings::get( 'portfolio_use_title_overlay', 'global' ) ) {
			$overlay_color = NorebroSettings::get( 'portfolio_title_background_overlay_color', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'portfolio_header_title_type', 'global' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_use_overlay', 'global' )
					&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
			}
		}
	}
} else {
	if ( NorebroSettings::get( 'header_background_type' ) == 'image' ) {
		if ( NorebroSettings::get( 'header_use_overlay' ) == 'yes' ) {
			$overlay_color = NorebroSettings::get( 'header_overlay_color' );
		} elseif ( in_array( NorebroSettings::get( 'header_use_overlay' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'header_use_overlay', 'global' )
				&& NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
				$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
			}
		}
	} elseif ( NorebroSettings::get( 'header_background_type' ) == 'inherit'
				|| NorebroSettings::get( 'header_background_type' ) === NULL ) {
		if ( NorebroSettings::get( 'header_title_background_type', 'global' ) == 'image' ) {
			if ( NorebroSettings::get( 'header_use_overlay', 'global' ) ) {
				$overlay_color = NorebroSettings::get( 'header_overlay_color', 'global' );
			}
		}
	}
}

if ( $overlay_color && substr( trim( $overlay_color ), 0, 4 ) != 'rgba' ) {
	$overlay_color = NorebroHelper::hex_to_rgba( $overlay_color, 0.6 );
}
if ( ! $background_image || ! NorebroSettings::header_title_use_overlay() ) {
	$overlay_color = 'transparent';
}

if ( $overlay_color ) {
	$overlay_color_css = 'background-color:' . $overlay_color . ';';
}


# 7. Header title height

if ( NorebroSettings::page_is( 'single' ) ) {
	$header_title_height = NorebroSettings::get( 'post_title_height' );
	if ( ! $header_title_height ) {
		$header_title_height = NorebroSettings::get( 'post_header_height', 'global' );
		if ( ! $header_title_height ) {
			$header_title_height = NorebroSettings::get( 'header_height', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	$header_title_height = NorebroSettings::get( 'header_height' );
	if ( ! $header_title_height ) {
		$header_title_height = NorebroSettings::get( 'woocommerce_header_height', 'global' );
		if ( ! $header_title_height ) {
			$header_title_height = NorebroSettings::get( 'header_height', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	$header_title_height = NorebroSettings::get( 'header_height' );
	if ( ! $header_title_height ) {
		if ( NorebroSettings::get( 'project_header_title_height_settings', 'global' ) == 'custom' ) {
			$header_title_height = NorebroSettings::get( 'project_header_height', 'global' );
		} else {
			$header_title_height = NorebroSettings::get( 'header_height', 'global' );
		}
	}
} else {
	$header_title_height = NorebroSettings::get( 'header_height' );
	if ( ! $header_title_height ) {
		$header_title_height = NorebroSettings::get( 'header_height', 'global' );
	}
}

if ( NorebroSettings::header_title_is_full_height() ) {
	$header_title_height = false;
}

if ( $header_title_height ) {
	$header_title_height_css .= 'height:${height}px;';
	$header_title_height_css .= 'min-height:${height}px;';

	$header_title_height_css = NorebroHelper::parse_responsive_height_to_css( $header_title_height, $header_title_height_css );
}


# 8. View

if ( $background_color_css || $background_image_css || $background_image_css || $background_size_css
	|| $background_position_css || $background_repeat_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title .bg-image{';
	$_style_block .= $background_color_css;
	$_style_block .= $background_image_css;
	$_style_block .= $background_size_css;
	$_style_block .= $background_position_css;
	$_style_block .= $background_repeat_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $header_title_height_css ) {
	$header_title_height_classes = '.header-title';

	if ( $header_title_height_css['desktop'] ) {
		$_style_block = $header_title_height_classes . '{' . $header_title_height_css['desktop'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'desktop' );
	}
	if ( $header_title_height_css['tablet'] ) {
		$_style_block = $header_title_height_classes . '{' . $header_title_height_css['tablet'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'tablet' );
	}
	if ( $header_title_height_css['mobile'] ) {
		$_style_block = $header_title_height_classes . '{' . $header_title_height_css['mobile'] . '}';
		NorebroLayout::append_to_dynamic_css_buffer( $_style_block, 'mobile' );
	}
}

if ( $overlay_color_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title::after{';
	$_style_block .= $overlay_color_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

// Title and subtitle
if ( $title_typo_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title h1.page-title{';
	$_style_block .= $title_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
if ( $subtitle_typo_css ) {
	// --- start of CSS ---
	$_style_block = '.header-title .subtitle{';
	$_style_block .= $subtitle_typo_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}
