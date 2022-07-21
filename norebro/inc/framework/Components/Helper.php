<?php

class NorebroHelper {

	/* Return CSS code for element and add Google Fonts to queue */
	static function parse_acf_typo_to_css( $typo_object, $cond = false ) {
		$result_css = '';
		$result_fields = array(
			'font-family',
			'font-size',
			'font-style',
			'line-height',
			'font-weight',
			'letter-spacing',
			'color'
		);
		if ( $typo_object && is_string( $typo_object ) ) {
			$typo_object = json_decode( $typo_object );
		}

		if ( is_array( $cond ) && isset( $cond['rule'] ) ) {
			if ( $cond['rule'] == 'only_color' && isset( $typo_object->color ) ) {
				return $typo_object->color;
			}
			if ( isset( $cond['fields'] ) ) {
				if ( $cond['rule'] == 'include' && is_array( $cond['fields'] ) ) {
					$result_fields = $cond['fields'];
				}
				if ( $cond['rule'] == 'exclude' ) {
					foreach ( $cond['fields'] as $field ) {
						if ( ( $key = array_search( $field, $result_fields ) ) !== false ) {
							unset( $result_fields[$key] );
						}
					}
				}
			}
		}

		if ( $typo_object && is_object( $typo_object ) ) {

			if ( isset( $typo_object->font_family ) && in_array( 'font-family', $result_fields ) ) {
				$result_css .= 'font-family:\'' . $typo_object->font_family . '\', sans-serif;';
				
				$font_key_array = array();
				$font_key_array['font'] = $typo_object->font_family;
				$font_key_array['variants'] = array();
				$font_key_array['subsets'] = array();
				if ( isset( $typo_object->font_variants ) && is_array( $typo_object->font_variants ) ) {
					foreach ( $typo_object->font_variants as $font_variant ) {
						$font_key_array['variants'][] = $font_variant;
					}
				}
				if ( isset( $typo_object->font_subsets ) && is_array( $typo_object->font_subsets ) ) {
					foreach ( $typo_object->font_subsets as $font_subset ) {
						$font_key_array['subsets'][] = $font_subset;
					}
				}
				$GLOBALS['norebro_google_fonts'][] = $font_key_array;
			}
			if ( isset( $typo_object->size ) && $typo_object->size && in_array( 'font-size', $result_fields )  ) {
				$result_css .= 'font-size:' . $typo_object->size . ';';
			}
			if ( isset( $typo_object->style ) && $typo_object->style && in_array( 'font-style', $result_fields )  ) {
				$result_css .= 'font-style:' . $typo_object->style . ';';
			}
			if ( isset( $typo_object->height ) && $typo_object->height && in_array( 'line-height', $result_fields )  ) {
				$result_css .= 'line-height:' . $typo_object->height . ';';
			}
			if ( isset( $typo_object->weight ) && $typo_object->weight && in_array( 'font-weight', $result_fields )  ) {
				$result_css .= 'font-weight:' . $typo_object->weight . ';';
			}
			if ( isset( $typo_object->spacing ) && $typo_object->spacing && in_array( 'letter-spacing', $result_fields )  ) {
				$result_css .= 'letter-spacing:' . $typo_object->spacing . ';';
			}
			if ( isset( $typo_object->color ) && $typo_object->color && in_array( 'color', $result_fields ) ) {
				$result_css .= 'color:' . $typo_object->color . ';';
			}
		}
		return ( $result_css ) ? $result_css : false;
	}


	/* Parse global array with Google Fonts list */
	static function parse_google_fonts_to_query_string( $list ) {

        $fonts_type = NorebroSettings::get('font_type', 'global');
        if( $fonts_type == 'adobe_fonts') {
            $fonts_url = 'https://use.typekit.net/' . NorebroSettings::get('adobekit_url', 'global') . '.css';
            return $fonts_url;
        } else {
            if (is_array($list) && count($list) > 0) {
                $names = array();
                $subsets = array();
                foreach ($list as $font_item) {
                    $_name = $font_item['font'];
                    $_weights = array();
                    if (is_array($font_item['variants'])) {
                        foreach ($font_item['variants'] as $weight) {
                            if ($weight == 'regular') {
                                $weight = '400';
                            }
                            if ($weight == 'italic') {
                                $weight = '400italic';
                            }
                            $weight = str_replace('italic', 'i', $weight);
                            $_weights[] = $weight;
                        }
                    }
                    if (count($_weights) > 0) {
                        $_name .= ':' . implode(',', $_weights);
                    }
                    $names[] = $_name;

                    if (is_array($font_item['subsets'])) {
                        foreach ($font_item['subsets'] as $subset) {
                            if ($subset != 'latin') {
                                $subsets[] = $subset;
                            }
                        }
                    }
                }
                $names = array_unique($names);
                $family_string = implode('|', $names);
                if (count($subsets) > 0) {
                    $family_string .= '&subset=' . implode(',', $subsets);
                }
                return add_query_arg('family', urlencode($family_string), "//fonts.googleapis.com/css");
            } else {
                return false;
            }
        }
	}


	/* Format HEX-color to rgba with alpha value */
	static function hex_to_rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		$opacity = (float) abs( $opacity );

		if( empty( $color ) ) { 
			return $default;
		} 
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		$rgb = array_map( 'hexdec', $hex );

		if( $opacity && $opacity < 1 ){
			return 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
		} else {
			return 'rgb(' . implode( ",", $rgb ) . ')';
		}
	}


	/*
	* Get post excerpt
	*/
	static function get_post_excerpt( $post_id ) {
		return get_the_excerpt( get_post( $post_id ) );
	}


	/*
	* Get new post gallery layout
	*/
	static function parse_gallery_layout( $atts = false ) {

		if ( $atts && isset( $atts['ids'] ) ) {
			if (is_array($atts['ids'])) {
				$attach_ids = $atts['ids'];
			} else {
				$attach_ids = explode( ',', $atts['ids'] );
			}
		} else {
			return false;
		}

		$layout = '<div class="slider blog-slider" data-norebro-slider-simple="true">';

		foreach ($attach_ids as $attach_id) {
			$_url = wp_get_attachment_url( $attach_id );
			$layout .= '<img class="full-width" src="' . esc_url( $_url ) . '" alt="' . esc_attr__( 'Gallery slide', 'norebro' ) . '">';

		}
		$layout .= '</div>';


		return $layout;
	}


	/*
	* Add required script
	*/
	static function add_required_script( $key ) {
		$GLOBALS['norebro_required_scripts'][] = $key;
	}


	/*
	* Check required script including
	*/
	static function is_script_required( $key ) {
		if  ( is_array ($GLOBALS['norebro_required_scripts'] ) ) {
			$list = array_unique( $GLOBALS['norebro_required_scripts'] );
			return (bool) in_array( $key, $list );
		} else {
			return false;
		}
	}

	/*
	* Bridge for locate temp variables to views
	*/
	static function get_storage_item_data( ) {
		$temp_data = $GLOBALS['norebro_storage_tmp_data'];
		$GLOBALS['norebro_storage_tmp_data'] = false;
		return ( $temp_data ) ? $temp_data : false;
	}

	static function set_storage_item_data( $data ) {
		$GLOBALS['norebro_storage_tmp_data'] = $data;
		return true;
	}

	/*
	* Insert icon link-tag with font style by key value
	*/
	static function iconset_url_by_icon( $font_key ) {
		$key_allias = array(
			"fontawesome" => "FontAwesome",
			"linea-arrows" => "linea/arrows",
			"linea-basic-elaboration" => "linea/basic_ela",
			"linea-basic" => "linea/basic",
			"linea-ecommerce" => "linea/ecommerce",
			"linea-music" => "linea/music",
			"linea-software" => "linea/software",
			"linea-weather" => "linea/weather",
		);
		if ( isset( $key_allias[$font_key] ) ) {
			if ( file_exists( get_template_directory() . '/assets/fonts/' . $key_allias[$font_key] . '/style.css' ) ) {
				return get_template_directory_uri() . '/assets/fonts/' . $key_allias[$font_key] . '/style.css';
			}
		}
	}


	/*
	* Insert icon link-tag with font style by key value
	*/
	static function parse_iconset_to_url( $list ) {
		if ( is_array( $list ) && count( $list ) > 0 ) {
			$urls = array();
			foreach ( $list as $font_class ) {
				if ( substr( $font_class, 0, 6 ) == 'fa fa-' ) { // fontawesome required
					$icon_key = "fontawesome";
				} else if ( substr( $font_class, 0, 6 ) == 'linea-' ) { // linea required
					$icon_key = 'linea-' . substr( substr( $font_class, 6 ), 0, strpos( substr( $font_class, 6 ), '-' ) );
					if ( $icon_key == 'linea-basic' && substr( $font_class, 0, 23 ) == 'linea-basic-elaboration' ){
						$icon_key = 'linea-basic-elaboration';
					}
				} else {
					$icon_key = substr( substr( $font_class, 8 ), 0, strpos( substr( $font_class, 8 ), '-' ) );
				}
				$icon_value = NorebroHelper::iconset_url_by_icon( $icon_key );
				$urls[$icon_key] = $icon_value;
			}
			return $urls;
		} else {
			return false;
		}
	}

	/* Parse acf columns css */
	static function parse_columns_to_css( $value, $is_double = false, $parent = false ) {
		$value_array = explode( '-', $value );

		if ( $parent !== false ) {
			$parent = explode( '-', $parent );

			for ( $i = 0; $i < count( $value_array ); $i++ ) {
				if ( $value_array[$i] == 'i' ) {
					$value_array[$i] = ( isset($parent[$i]) ) ? $parent[$i] : 1;
				}
			}
		}

		for ( $i = 0; $i < count( $value_array ); $i++ ) {
			switch ( intval( $value_array[$i] ) ) {
				case '1':
					$value_array[$i] = 12;
					break;
				case '2':
					$value_array[$i] = ( $is_double ) ? 12 : 6;
					break;
				case '3':
					$value_array[$i] = ( $is_double ) ? 8 : 4;
					break;
				case '4':
					$value_array[$i] = ( $is_double ) ? 6 : 3;
					break;
				case '5':
					$value_array[$i] = ( $is_double ) ? '2_5th' : '5th';
					break;
				case '6':
					$value_array[$i] = ( $is_double ) ? 4 : 2;
					break;
				case '12':
					$value_array[$i] = ( $is_double ) ? 2 : 1;
					break;
			}
		}
		$classes = '';

		if ( isset( $value_array[0] ) ) {
			$classes .= ' vc_col-lg-' . $value_array[0];
		}
		if ( isset( $value_array[1] ) ) {
			$classes .= ' vc_col-md-' . $value_array[1];
		}
		if ( isset( $value_array[2] ) ) {
			$classes .= ' vc_col-sm-' . $value_array[2];
		}
		if ( isset( $value_array[3] ) ) {
			$classes .= ' vc_col-xs-' . $value_array[3];
		}

		return $classes;
	}

	/* Parse acf responsive height css */
	static function parse_responsive_height_to_css( $value, $css = '${height}' ) {
		$value_array = explode( '-', $value );

		return array(
			'desktop' => empty( $value_array[0] ) ? false : str_replace( '${height}', $value_array[0], $css ),
			'tablet' =>  empty( $value_array[1] ) ? false : str_replace( '${height}', $value_array[1], $css ),
			'mobile' =>  empty( $value_array[2] ) ? false : str_replace( '${height}', $value_array[2], $css )
		);
	}

	static function parse_responsive_font_sizes( $value ) {

		$result = new stdClass();
		$parsed_data = json_decode($value);

		$result->laptop_size = (isset($parsed_data->laptop_size)) ? $parsed_data->laptop_size : false;
		$result->tablet_size = (isset($parsed_data->tablet_size)) ? $parsed_data->tablet_size : false;
		$result->mobile_size = (isset($parsed_data->mobile_size)) ? $parsed_data->mobile_size : false;
		$result->laptop_height = (isset($parsed_data->laptop_height)) ? $parsed_data->laptop_height : false;
		$result->tablet_height = (isset($parsed_data->tablet_height)) ? $parsed_data->tablet_height : false;
		$result->mobile_height = (isset($parsed_data->mobile_height)) ? $parsed_data->mobile_height : false;

		return $result;
	}

	static function get_responsive_font_css( $data, $selector = '' ) {
		$result = new stdClass();
		$result->laptop = $result->tablet = $result->mobile = '';

		// laptop devices
		if ((isset($data->laptop_size) && !empty($data->laptop_size))) {
			$result->laptop .= '@media screen and (max-width: 768px) { ';
			$result->laptop .= $selector . ' { font-size:' . $data->laptop_size . '; } ';
			$result->laptop .= '}';
		}
		if ((isset($data->laptop_height) && !empty($data->laptop_height))) {
			$result->laptop .= '@media screen and (max-width: 768px) { ';
			$result->laptop .= $selector . ' { line-height:' . $data->laptop_height . '; } ';
			$result->laptop .= '}';
		}

		// tablet devices
		if (isset($data->tablet_size) && !empty($data->tablet_size)) {
			$result->tablet .= '@media screen and (max-width: 1024px) { ';
			$result->tablet .= $selector . ' { font-size:' . $data->tablet_size . '; } ';
			$result->tablet .= '}';
		}
		if (isset($data->tablet_height) && !empty($data->tablet_height)) {
			$result->tablet .= '@media screen and (max-width: 1024px) { ';
			$result->tablet .= $selector . ' { line-height:' . $data->tablet_height . '; } ';
			$result->tablet .= '}';
		}

		// mobile devices
		if (isset($data->mobile_size) && !empty($data->mobile_size)) {
			$result->mobile .= '@media screen and (max-width: 1440px) { ';
			$result->mobile .= $selector . ' { font-size:' . $data->mobile_size . '; } ';
			$result->mobile .= '}';
		}
		if (isset($data->mobile_height) && !empty($data->mobile_height)) {
			$result->mobile .= '@media screen and (max-width: 1440px) { ';
			$result->mobile .= $selector . ' { line-height:' . $data->mobile_height . '; } ';

			$result->mobile .= '}';
		}

		return $result;
	}

	static function get_all_responsive_font_css( $data, $selector = '' ) {
		$result = self::get_responsive_font_css($data, $selector);
		return $result->laptop . ' ' . $result->tablet . ' ' . $result->mobile;		
	}

	static function wrap_css_to_selector($css, $selector) {
		return $selector . '{' . $css . '} ';
	}

    static function get_image_id_by_url($attachment_url = '') {
        global $wpdb;
        $attachment_id = false;

        // If there is no url, return.
        if ( '' == $attachment_url )
            return;

        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();

        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }

        return $attachment_id;
    }
}