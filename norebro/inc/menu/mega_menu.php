<?php

if ( ! class_exists( 'Norebro_Mega_Menu' ) ) {
	class Norebro_Mega_Menu {
		var $_options;

		public function __construct() {
			$this->_options = self::options();
			$this->_add_filters();
		}
		
		public static function options() {
			return array(
				/*'norebro_mega_menu_subtitle' => array(
					'type' 		=> 'text',
					'label' 	=> esc_html__( 'Subtitle', 'norebro' ),
					'default' => '',
					'size' 		=> 'wide',
					'class' 	=> 'norebro-hide-only-depth-0',
				),
				'norebro_mega_menu_image' => array(
					'type' 		=> 'upload',
					'label' 	=> esc_html__( 'Image', 'norebro' ),
					'default' => '',
					'size' 		=> 'wide',
					'class' 	=> 'norebro-show-only-depth-0',
				),
				
				'norebro_mega_menu_bg_position' => array(
					'type' 		=> 'select',
					'label' 	=> esc_html__( 'Background position', 'norebro' ),
					'default' => 0,
					'options' => array(
						'left top' => esc_html__( 'Left top', 'norebro' ),
						'left center' => esc_html__( 'Left center', 'norebro' ),
						'left bottom' => esc_html__( 'Left bottom', 'norebro' ),
						'right top' => esc_html__( 'Right top', 'norebro' ),
						'right center' => esc_html__( 'Right center', 'norebro' ),
						'right bottom' => esc_html__( 'Right bottom', 'norebro' ),
						'center top' => esc_html__( 'Center top', 'norebro' ),
						'center center' => esc_html__( 'Center center', 'norebro' ),
						'center bottom' => esc_html__( 'Center bottom', 'norebro' )
					),
					'size' => 'thin',
					'class' => 'norebro-show-only-depth-0',
				),
				'norebro_mega_menu_bg_repeat' => array(
					'type' => 'select',
					'label' => esc_html__( 'Background repeat', 'norebro' ),
					'default' => 'no-repeat',
					'options' => array(
						'no-repeat' => esc_html__( 'No-repeat', 'norebro' ),
						'repeat' => esc_html__( 'Repeat', 'norebro' ),
						'repeat-x' => esc_html__( 'Repeat-x', 'norebro' ),
						'repeat-y' => esc_html__( 'Repeat-y', 'norebro' ),
					),
					'size' 	=> 'thin',
					'class' => 'norebro-show-only-depth-0',
				),*/
				'norebro_wide_menu_enabled' => array(
					'type' 		=> 'select',
					'label' 	=> esc_html__( 'Enable wide menu', 'norebro' ),
					'default' => 0,
					'options' => array( 
						1 => esc_html__( 'Yes', 'norebro' ),
						0 => esc_html__( 'No', 'norebro' ) 
					),
					'size' => 'thin',
					'class' => 'norebro-show-only-depth-0',
				),
				/*'norebro_full_width_menu_enabled' => array(
					'type' => 'select',
					'label' => esc_html__( 'Enable full-width menu', 'norebro' ),
					'default' => 0,
					'options' => array( 
						1 => esc_html__( 'Yes', 'norebro' ),
						0 => esc_html__( 'No', 'norebro' ) 
					),
					'size' => 'thin',
					'class' => 'norebro-show-only-depth-0',
				),*/
			);
		}

		private function _add_filters() {
			# Add custom options to menu
			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_options' ) );

			# Update custom menu options
			add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_options' ), 10, 3 );

			# Set edit menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'apply_edit_walker_class' ), 10, 2 );

			# Addition style
			add_action('admin_enqueue_scripts', array( $this, 'add_menu_css' ) );

			# Mega menu javascript
			add_action( 'admin_enqueue_scripts', array( $this, 'norebro_mega_menu_admin_scripts' ), 80 );
		}
 
		function norebro_mega_menu_admin_scripts() {
			wp_enqueue_media();
			wp_register_script( 'norebro-mega-menu-loader', get_template_directory_uri() . '/inc/menu/js/image-upload.js', array( 'jquery' ) );
			wp_enqueue_script( 'norebro-mega-menu-loader' );
		}

		/**
		 * Register custom options and load options values
		 * 
		 * @param obj $item Menu Item
		 * @return obj Menu Item
		 */
		public function add_custom_options( $item ) {

			foreach( $this->_options as $option => $params ) {

				// For qTranslate
				$id = 0;
				if ( isset( $item->ID ) ) {
					$id = $item->ID;
				}
				

				$item->$option = get_post_meta( $id, $option, true );
				if ( $item->$option === false ) {
					$item->$option = $params['default'];
				}
			}

			return $item;
		}

		public function update_custom_options( $menu_id, $menu_item_id, $args ) {
			foreach( $this->_options as $option => $params ) {
				$key = 'menu-item-'. $option;
				
				$option_value = '';
				
				if ( isset( $_REQUEST[$key], $_REQUEST[$key][$menu_item_id] ) ) {
					$option_value = wp_unslash( $_REQUEST[$key][$menu_item_id] );
				}
				
				update_post_meta( $menu_item_id, $option, $option_value );
			}
		}

		public function add_menu_css() {
			$css = ".menu-item-settings { overflow: hidden; }";
			wp_add_inline_style('wp-admin', $css);
		}

		public function apply_edit_walker_class( $walker, $menu_id ) {
			return NOREBRO_EDIT_MENU_WALKER_CLASS;
		}
	}
}
