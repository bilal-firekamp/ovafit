<?php
/*
	Page custom style
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Background color
	# 3. Background image
	# 3.1. Background size
	# 3.2. Background position
	# 3.3. Background repeat
	# 3.4. Background attachment
	# 4. Links & border color
	# 5. Full width container margins
	# 6. View
*/


# 1. Variables

$background_color 		= false;
$background_image 		= false;
$background_size 		   = false;
$background_position 	= false;
$background_repeat 		= false;
$background_attachment	= false;
$links_color            = false;
$borders_color          = false;
$buttons_color          = false;
$full_width_margins		= false;
$content_wrapper_width  = false;

$background_color_css 		= '';
$background_image_css 		= '';
$background_size_css 		= '';
$background_position_css 	= '';
$background_repeat_css 		= '';
$background_attachment_css = '';
$full_width_margins_css 	= '';
$content_wrapper_width_css = '';


# 2. Background color

if ( NorebroSettings::page_is( 'single' ) ) {
	$background_color = NorebroSettings::get( 'post_page_background' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'page_background_color', 'global' );
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	$background_color = NorebroSettings::get( 'page_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'woocommerce_page_background_color', 'global' );
		if ( ! $background_color && in_array( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_color = NorebroSettings::get( 'page_background_color', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	# Project page
	$background_color = NorebroSettings::get( 'page_background_color' );

	if ( ! $background_color && in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		# Global project page
		$background_color = NorebroSettings::get( 'project_page_background_color', 'global' );

		if ( ! $background_color && in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			# Global page
			$background_color = NorebroSettings::get( 'page_background_color', 'global' );
		}
	}
} else {
	$background_color = NorebroSettings::get( 'page_background_color' );
	if ( ! $background_color && in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_color = NorebroSettings::get( 'page_background_color', 'global' );
	}
}

if ( $background_color ) {
	$background_color_css = 'background-color:' . $background_color . ';';
}


# 3. Background image

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_page_background_type' ) == 'custom' ) {
		$background_image = NorebroSettings::get( 'post_page_background_image' );
	} elseif ( in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_image = NorebroSettings::get( 'page_background_image', 'global' );
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_image = NorebroSettings::get( 'page_background_image' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'woocommerce_page_background_type' ) == 'custom' ) {
			$background_image = NorebroSettings::get( 'woocommerce_page_background_image', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'woocommerce_page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_image = NorebroSettings::get( 'page_background_image', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	# Project page
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_image = NorebroSettings::get( 'page_background_image' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		# Global project page
		if ( NorebroSettings::get( 'project_page_background_type', 'global' ) == 'custom' ) {
			$background_image = NorebroSettings::get( 'project_page_background_image', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			# Global page
			$background_image = NorebroSettings::get( 'page_background_image', 'global' );
		}
	}
} else {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_image = NorebroSettings::get( 'page_background_image' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_image = NorebroSettings::get( 'page_background_image', 'global' );
	}
}

if ( $background_image ) {
	$background_image_css = 'background-image:url(\'' . $background_image . '\');';
}


# 3.1. Background image size

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_page_background_type' ) == 'custom' ) {
		$background_size = NorebroSettings::get( 'post_page_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_size = NorebroSettings::get( 'page_background_size', 'global' );
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_size = NorebroSettings::get( 'page_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ) == 'custom' ) {
			$background_size = NorebroSettings::get( 'woocommerce_page_background_size', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_size = NorebroSettings::get( 'page_background_size', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	# Project page
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_size = NorebroSettings::get( 'page_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		# Global project page
		if ( NorebroSettings::get( 'project_page_background_type', 'global' ) == 'custom' ) {
			$background_size = NorebroSettings::get( 'project_page_background_size', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			# Global page
			$background_size = NorebroSettings::get( 'page_background_size', 'global' );
		}
	}
} else {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_size = NorebroSettings::get( 'page_background_size' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_size = NorebroSettings::get( 'page_background_size', 'global' );
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
		if ( NorebroSettings::get( 'post_page_background_type' ) == 'custom' ) {
			$background_position = NorebroSettings::get( 'post_page_background_position' );
		} elseif ( in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_position = NorebroSettings::get( 'page_background_position', 'global' );
		}
	} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_position = NorebroSettings::get( 'page_background_position' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'woocommerce_page_background_type' ,'global' ) == 'custom' ) {
				$background_position = NorebroSettings::get( 'woocommerce_page_background_position', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_position = NorebroSettings::get( 'page_background_position', 'global' );
			}
		}
	} elseif ( NorebroSettings::page_is( 'project' ) ) {
		# Project page
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_position = NorebroSettings::get( 'page_background_position' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			# Global project page
			if ( NorebroSettings::get( 'project_page_background_type', 'global' ) == 'custom' ) {
				$background_position = NorebroSettings::get( 'project_page_background_position', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				# Global page
				$background_position = NorebroSettings::get( 'page_background_position', 'global' );
			}
		}
	} else {
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_position = NorebroSettings::get( 'page_background_position' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_position = NorebroSettings::get( 'page_background_position', 'global' );
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
		if ( NorebroSettings::get( 'post_page_background_type' ) == 'custom' ) {
			$background_repeat = NorebroSettings::get( 'post_page_background_repeat' );
		} elseif ( in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
			// Need more settings!
			$background_repeat = NorebroSettings::get( 'page_background_position', 'global' );
		}
	} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = NorebroSettings::get( 'page_background_repeat' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			if ( NorebroSettings::get( 'woocommerce_page_background_type' ,'global' ) == 'custom' ) {
				$background_repeat = NorebroSettings::get( 'woocommerce_page_background_repeat', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				$background_repeat = NorebroSettings::get( 'page_background_repeat', 'global' );
			}
		}
	} elseif ( NorebroSettings::page_is( 'project' ) ) {
		# Project page
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = NorebroSettings::get( 'page_background_repeat' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			# Global project page
			if ( NorebroSettings::get( 'project_page_background_type', 'global' ) == 'custom' ) {
				$background_repeat = NorebroSettings::get( 'project_page_background_repeat', 'global' );
			} elseif ( in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
				# Global page
				$background_repeat = NorebroSettings::get( 'page_background_repeat', 'global' );
			}
		}
	} else {
		if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
			$background_repeat = NorebroSettings::get( 'page_background_repeat' );
		} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
			$background_repeat = NorebroSettings::get( 'page_background_repeat', 'global' );
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


# 3.4. Background image attachment

if ( NorebroSettings::page_is( 'single' ) ) {
	if ( NorebroSettings::get( 'post_page_background_type' ) == 'custom' ) {
		$background_attachment = NorebroSettings::get( 'post_page_attach_background' );
	} elseif ( in_array( NorebroSettings::get( 'post_page_background_type' ), array( 'inherit', NULL ) ) ) {
		// Need more settings!
		$background_attachment = NorebroSettings::get( 'page_background_attach', 'global' );
	}
} elseif ( NorebroSettings::page_is( 'ecommerce' ) ) {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = NorebroSettings::get( 'page_background_is_attached' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		if ( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ) == 'custom' ) {
			$background_attachment = NorebroSettings::get( 'woocommerce_page_background_is_attached', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'woocommerce_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			$background_attachment = NorebroSettings::get( 'page_background_attach', 'global' );
		}
	}
} elseif ( NorebroSettings::page_is( 'project' ) ) {
	# Project page
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = NorebroSettings::get( 'page_background_is_attached' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		# Global project page
		if ( NorebroSettings::get( 'project_page_background_type', 'global' ) == 'custom' ) {
			$background_attachment = NorebroSettings::get( 'project_page_background_is_attached', 'global' );
		} elseif ( in_array( NorebroSettings::get( 'project_page_background_type', 'global' ), array( 'inherit', NULL ) ) ) {
			# Global page
			$background_attachment = NorebroSettings::get( 'page_background_attach', 'global' );
		}
	}
} else {
	if ( NorebroSettings::get( 'page_background_type' ) == 'custom' ) {
		$background_attachment = NorebroSettings::get( 'page_background_is_attached' );
	} elseif ( in_array( NorebroSettings::get( 'page_background_type' ), array( 'inherit', NULL ) ) ) {
		$background_attachment = NorebroSettings::get( 'page_background_attach', 'global' );
	}
}

if ( $background_attachment ) {
	$background_attachment_css = 'background-attachment:fixed;';
}

# 4.1. Links color
$links_color = NorebroSettings::get( 'page_links_color', 'global' );
if ( $links_color ) {
	$_style_block = '.widget a:hover, p a, #comments p a, .page-content p a, .post .entry-content p a, #comments.comments-area a.comment-reply-link,';
	$_style_block .= '#comments.comments-area a.comment-edit-link, .comments-area a:hover, .post .entry-content ul a, .post .entry-content ol a{';
	$_style_block .= 'color:' . $links_color . ';';
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

# 4.2. Buttons color
$buttons_color = NorebroSettings::get( 'page_buttons_color', 'global' );
if ( $buttons_color ) {
	$_style_block = '.btn:not(.btn-outline):not(.btn-flat):hover, a.btn:not(.btn-outline):not(.btn-flat):hover,';
	$_style_block .= '.btn-outline, a.btn-outline,';
	$_style_block .= '.btn-flat:not(:hover), a.btn-flat:not(:hover){';
	$_style_block .= 'color:' . $buttons_color . ';';
	$_style_block .= '}';

	$_style_block .= '.btn:not(.btn-outline):not(.btn-flat):not(:hover), a.btn:not(.btn-outline):not(.btn-flat):not(:hover),';
	$_style_block .= '.btn-outline:hover, a.btn-outline:hover,';
	$_style_block .= '.btn-flat:hover, a.btn-flat:hover{';
	$_style_block .= 'background-color:' . $buttons_color . ';';
	$_style_block .= 'border-color:' . $buttons_color . ';';
	$_style_block .= '}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

# 4.3. Borders color
$borders_color = NorebroSettings::get( 'page_borders_color', 'global' );
if ( $borders_color ) {
	$_style_block = '.widget_search form input, input:not([type="submit"]), textarea, select, .comments-area .comment-respond:after,';
	$_style_block .= '.comments-area .comment-list > li, .comments-area .comment-respond:before, .blog-grid.grid-4{';
	$_style_block .= 'border-color:' . $borders_color . ';';
	$_style_block .= '}';

	$_style_block .= '@media screen and (min-width: 769px){ #mega-menu-wrap > ul .sub-nav .sub-menu-wide > .mega-menu-item > a.menu-link {';
	$_style_block .= 'border-color:' . $borders_color . ';';
	$_style_block .= '}}';
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

# 5. Full width container margins
$content_wrapper_width = NorebroSettings::get( 'content_wrapper_width' );
if ( $content_wrapper_width == NULL ) {
	if ( NorebroSettings::page_is( 'project' ) ) {
		$content_wrapper_width = NorebroSettings::get( 'project_content_wrapper_width', 'global' );
	} elseif ( NorebroSettings::page_is( 'single' ) ) {
		$content_wrapper_width = NorebroSettings::get( 'post_content_wrapper_width', 'global' );
	}
	if ( $content_wrapper_width == NULL ) {
		$content_wrapper_width = NorebroSettings::get( 'content_wrapper_width', 'global' );
	}
}
if ( $content_wrapper_width ) {
	$content_wrapper_width_css = 'max-width:' . $content_wrapper_width;
}

$full_width_margins = NorebroSettings::get( 'full_width_margins_size' );
if ( $full_width_margins == NULL ) {
	if ( NorebroSettings::page_is( 'project' ) ) {
		$full_width_margins = NorebroSettings::get( 'project_full_width_margins_size', 'global' );
		if ( $full_width_margins == NULL ) {
			$full_width_margins = NorebroSettings::get( 'full_width_margins_size', 'global' );
		}
	} else {
		$full_width_margins = NorebroSettings::get( 'full_width_margins_size', 'global' );
	}
}
if ( $full_width_margins ) {
	$full_width_margins_css = 'margin-left:' . $full_width_margins . ';margin-right:' . $full_width_margins . ';';
}


# 6. View

if ( $background_color_css || $background_image_css || $background_size_css || $background_position_css 
	|| $background_repeat_css || $background_attachment_css ) {
	// --- start of CSS ---
	$_style_block = 'body .site-content{';
	$_style_block .= $background_color_css;
	$_style_block .= $background_image_css;
	$_style_block .= $background_size_css;
	$_style_block .= $background_position_css;
	$_style_block .= $background_repeat_css;
	$_style_block .= $background_attachment_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $full_width_margins_css ) {
	// --- start of CSS ---
	$_style_block = '.page-container.full{';
	$_style_block .= $full_width_margins_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

if ( $content_wrapper_width_css ) {
	// --- start of CSS ---
	$_style_block = '.page-container{';
	$_style_block .= $content_wrapper_width_css;
	$_style_block .= '}';
	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
}

