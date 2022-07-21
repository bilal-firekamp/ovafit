<?php

if ( ! function_exists( 'norebro_setup' ) ) :

	function norebro_setup_enqueue(){
		wp_enqueue_script( 'hide-how-to-notification', get_template_directory_uri() . '/js/hide-how-to-notification.js' );
	}

	function norebro_setup() {
		load_theme_textdomain( 'norebro', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		set_post_thumbnail_size( 200, 200, true );

		add_image_size( 'norebro_thumbnail_next_and_prev', 200, 140, true );

		add_image_size( 'norebro_full', 1920, 9999, false );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'norebro' ),
		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote' ) );

		$GLOBALS['content_width'] = apply_filters( 'norebro_content_width', 640 );
		
		$GLOBALS['norebro_google_fonts'] = array();
		$GLOBALS['norebro_icon_fonts'] = array();
		$GLOBALS['norebro_required_scripts'] = array();

		if ( ! get_option( 'norebro_version' ) || get_option( 'norebro_version' ) < 10 ) {
			add_option( 'norebro_version', 10, '', 'yes' );
		}

		$show_how_to = get_option( 'norebro_how_to_notification' );
		$show_how_to = ( ! $show_how_to || ( strlen( $show_how_to ) > 0 && $show_how_to != 'hidden' ) );

		if ( isset( $_COOKIE['norebro_how_to_closed'] ) && $_COOKIE['norebro_how_to_closed'] == 'yep' ) {
			update_option( 'norebro_how_to_notification', 'hidden' );
			$show_how_to = false;
		}
		if ( !$show_how_to ) {
			add_action( 'admin_enqueue_scripts', 'norebro_setup_enqueue' );
		}

        // Adding support for core block visual styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for custom color scheme.
        // add_theme_support( 'disable-custom-colors' );

        $brand_color = NorebroSettings::get( 'page_brand_color', 'global' );


        if(!$brand_color){
            $brand_color = '#174EE2';
        }

        add_theme_support( 'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'Brand color', 'norebro' ),
                'slug'  => 'brand-color',
                'color' => $brand_color,
            ),
            array(
                'name'  => esc_html__( 'Blue Dark', 'norebro' ),
                'slug'  => 'blue_dark',
                'color' => '#174EE2',
            ),
            array(
                'name'  => esc_html__( 'Dark Strong', 'norebro' ),
                'slug'  => 'dark_strong',
                'color' => '#24262B',
            ),
            array(
                'name'  => esc_html__( 'Dark Light', 'norebro' ),
                'slug'  => 'dark_light',
                'color' => '#32353C',
            ),
            array(
                'name'  => esc_html__( 'Grey Strong', 'norebro' ),
                'slug'  => 'grey_strong',
                'color' => '#6A707E',
            ),
            array(
                'name'  => esc_html__( 'Grey Light', 'norebro' ),
                'slug'  => 'grey_light',
                'color' => '#949597',
            ),
        ) );

        // Add support for custom sizes
        // add_theme_support('disable-custom-font-sizes');
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => esc_html__( 'Extra Small', 'norebro' ),
                'size' => 12,
                'slug' => 'extra-small'
            ),
            array(
                'name' => esc_html__( 'Small', 'norebro' ),
                'size' => 13,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__( 'Normal', 'norebro' ),
                'size' => 14,
                'slug' => 'normal'
            ),
            array(
                'name' => esc_html__( 'Large', 'norebro' ),
                'size' => 17,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__( 'Extra Large', 'norebro' ),
                'size' => 20,
                'slug' => 'larger'
            )
        ) );

        // Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

        // Add editor styles support
        add_editor_style( 'assets/style_editor/style-editor.css' );
		add_theme_support('editor-styles');

	}

endif;

add_action( 'after_setup_theme', 'norebro_setup' );