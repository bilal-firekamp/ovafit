<?php

function norebro_ocdi_import_files() {
	return array(
		array(
			'import_file_name' => 'Creative Agency',
			'preview_url'  => 'https://norebro.clbthemes.com/demo21',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/21/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/21/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/21/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/21/preview.jpg',
		),
		array(
			'import_file_name' => 'Business and Corporate',
            'preview_url'  => 'https://norebro.clbthemes.com/demo30',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/30/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/30/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/30/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/30/preview.jpg',
		),
		array(
			'import_file_name' => 'Coming Soon',
            'preview_url'  => 'https://norebro.clbthemes.com/demo24',
			'categories' => array( esc_html__( 'Split Page', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/24/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/24/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/24/preview.jpg',
		),
		array(
			'import_file_name' => 'Photographer',
            'preview_url'  => 'https://norebro.clbthemes.com/demo11',
			'categories' => array( esc_html__( 'Masonry Gallery', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/11/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/11/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/11/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/11/preview.jpg',
		),
		array(
			'import_file_name' => 'Event and Corporate',
            'preview_url'  => 'https://norebro.clbthemes.com/demo28',
			'categories' => array( esc_html__( 'One Page', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/28/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/28/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/28/preview.jpg',
		),
		array(
			'import_file_name' => 'Modern Agency',
            'preview_url'  => 'https://norebro.clbthemes.com/demo4',
			'categories' => array( esc_html__( 'Smooth Scroll', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/04/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/04/content.php',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/04/widgets.json',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/04/preview.jpg',
		),
		array(
			'import_file_name' => 'Designer Personal',
            'preview_url'  => 'https://norebro.clbthemes.com/demo1',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/01/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/01/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/01/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/01/preview.jpg',
		),
		array(
			'import_file_name' => 'Simple Potfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo6',
			'categories' => array( esc_html__( 'Masonry Grid', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/06/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/06/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/06/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/06/preview.jpg',
		),
		array(
			'import_file_name' => 'Clean Portfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo13',
			'categories' => array( esc_html__( 'Carousel Classic', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/13/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/13/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/13/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/13/preview.jpg',
		),
		array(
			'import_file_name' => 'Startup and App',
            'preview_url'  => 'https://norebro.clbthemes.com/demo16',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/16/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/16/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/16/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/16/preview.jpg',
		),
		array(
			'import_file_name' => 'Digital Agency',
            'preview_url'  => 'https://norebro.clbthemes.com/demo5',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/05/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/05/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/05/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/05/preview.jpg',
		),
		array(
			'import_file_name' => 'Fullscreen Portfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo7',
			'categories' => array( esc_html__( 'Split Screen', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/07/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/07/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/07/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/07/preview.jpg',
		),
		array(
			'import_file_name' => 'Fashion Blog',
            'preview_url'  => 'https://norebro.clbthemes.com/demo18',
			'categories' => array( esc_html__( 'Striped Layout', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/18/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/18/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/18/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/18/preview.jpg',
		),
		array(
			'import_file_name' => 'Creative Portfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo8',
			'categories' => array( esc_html__( 'Horizontal Scroll', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/08/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/08/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/08/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/08/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Simple',
            'preview_url'  => 'https://norebro.clbthemes.com/demo2',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/02/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/02/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/02/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/02/preview.jpg',
		),
		array(
			'import_file_name' => 'Restaurant and Caffe',
            'preview_url'  => 'https://norebro.clbthemes.com/demo22',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/22/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/22/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/22/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/22/preview.jpg',
		),
		array(
			'import_file_name' => 'Fullscreen Portfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo9',
			'categories' => array( esc_html__( 'Vertical Scroll', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/09/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/09/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/09/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/09/preview.jpg',
		),
		array(
			'import_file_name' => 'Creative Portfolio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo29',
			'categories' => array( esc_html__( 'Smooth Scroll', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/29/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/29/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/29/preview.jpg',
		),
		array(
			'import_file_name' => 'Sports and Fitness',
            'preview_url'  => 'https://norebro.clbthemes.com/demo23',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/23/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/23/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/23/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/23/preview.jpg',
		),
		array(
			'import_file_name' => 'Interior Studio',
            'preview_url'  => 'https://norebro.clbthemes.com/demo12',
			'categories' => array( esc_html__( 'Creative Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/12/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/12/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/12/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/12/preview.jpg',
		),
		array(
			'import_file_name' => 'Food Blog',
            'preview_url'  => 'https://norebro.clbthemes.com/demo19',
			'categories' => array( esc_html__( 'Overlay Cards', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/19/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/19/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/19/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/19/preview.jpg',
		),
		array(
			'import_file_name' => 'Mobile App',
            'preview_url'  => 'https://norebro.clbthemes.com/demo25',
			'categories' => array( esc_html__( 'Smooth Scroll', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/25/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/25/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/25/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Blog',
            'preview_url'  => 'https://norebro.clbthemes.com/demo17',
			'categories' => array( esc_html__( 'Right Sidebar', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/17/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/17/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/17/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/17/preview.jpg',
		),
		array(
			'import_file_name' => 'Personal Portfolio',
			'preview_url'  => 'https://norebro.clbthemes.com/demo3',
			'categories' => array( esc_html__( 'Simple Carousel', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/03/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/03/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/03/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/03/preview.jpg',
		),
		array(
			'import_file_name' => 'Simple Portfolio',
			'preview_url'  => 'https://norebro.clbthemes.com/demo10',
			'categories' => array( esc_html__( 'Left Menu', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/10/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/10/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/10/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/10/preview.jpg',
		),
		array(
			'import_file_name' => 'Barber Sallon',
			'preview_url'  => 'https://norebro.clbthemes.com/demo14',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/14/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/14/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/14/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/14/preview.jpg',
		),
		array(
			'import_file_name' => 'Single Product',
			'preview_url'  => 'https://norebro.clbthemes.com/demo15',
			'categories' => array( esc_html__( 'Fullscreen Hero', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/15/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/15/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/15/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/15/preview.jpg',
		),
		array(
			'import_file_name' => 'Traditional Shop',
			'preview_url'  => 'https://norebro.clbthemes.com/demo20',
			'categories' => array( esc_html__( 'Fullwidth Slider', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/20/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/20/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/20/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/20/preview.jpg'
		),
		array(
			'import_file_name' => 'Minimal Shop',
			'preview_url'  => 'https://norebro.clbthemes.com/demo27',
			'categories' => array( esc_html__( 'Creative Slider', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/27/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/27/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/27/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/27/preview.jpg'
		),
		array(
			'import_file_name' => 'Clothing Shop',
			'preview_url'  => 'https://norebro.clbthemes.com/demo26',
			'categories' => array( esc_html__( 'Fullwidth Slider', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/26/content.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'demo/26/widgets.json',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/26/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/26/preview.jpg'
		),
		array(
			'import_file_name' => 'About - Agency',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/about-agency/',
			'categories' => array( esc_html__( 'About us', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/about-agency/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/about-agency/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/about-agency/preview.jpg'
		),
		array(
			'import_file_name' => 'About - Corporate',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/about-corporate/',
			'categories' => array( esc_html__( 'About us', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/about-corporate/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/about-corporate/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/about-corporate/preview.jpg'
		),
		array(
			'import_file_name' => 'About - Creative',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/about-creative/',
			'categories' => array( esc_html__( 'About us', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/about-creative/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/about-creative/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/about-creative/preview.jpg'
		),
		array(
			'import_file_name' => 'About - Personal',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/about-personal/',
			'categories' => array( esc_html__( 'About us', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/about-personal/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/about-personal/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/about-personal/preview.jpg'
		),
		array(
			'import_file_name' => 'About - Split Sreen',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/about-split-screen/',
			'categories' => array( esc_html__( 'About us', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/about-split-screen/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/about-split-screen/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/about-split-screen/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Agency',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-agency/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-agency/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-agency/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-agency/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Corporate',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-corporate/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-corporate/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-corporate/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-corporate/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Extended',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-extended/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-extended/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-extended/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-extended/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Simple',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-simple/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-simple/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-simple/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-simple/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Split Page',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-split-page/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-split-page/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-split-page/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-split-page/preview.jpg'
		),
		array(
			'import_file_name' => 'Contact - Split Screen',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/contact-split-screen/',
			'categories' => array( esc_html__( 'Contact', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-split-screen/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-split-screen/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-split-screen/preview.jpg'
		),
		array(
			'import_file_name' => 'Team - Agency',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/team-agency/',
			'categories' => array( esc_html__( 'Team', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/team-agency/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/team-agency/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/team-agency/preview.jpg'
		),
		array(
			'import_file_name' => 'Team - Corporate',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/team-corporate/',
			'categories' => array( esc_html__( 'Team', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/team-corporate/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/team-corporate/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/team-corporate/preview.jpg'
		),
		array(
			'import_file_name' => 'Team - Split Page',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/team-split-page/',
			'categories' => array( esc_html__( 'Team', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/team-split-page/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/team-split-page/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/team-split-page/preview.jpg'
		),
		array(
			'import_file_name' => 'Services - Agency',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/services-agency/',
			'categories' => array( esc_html__( 'Services', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/services-agency/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/services-agency/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/services-agency/preview.jpg'
		),
		array(
			'import_file_name' => 'Services - Corporate',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/services-corporate/',
			'categories' => array( esc_html__( 'Services', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/services-corporate/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/services-corporate/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/services-corporate/preview.jpg'
		),
		array(
			'import_file_name' => 'Services - Personal',
			'preview_url'  => 'https://norebro.clbthemes.com/pages/services-personal/',
			'categories' => array( esc_html__( 'Services', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/services-personal/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/services-personal/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/services-personal/preview.jpg'
		),
		array(
			'import_file_name' => 'Partially: Contact Forms 7 Forms',
			'categories' => array( esc_html__( 'Partially', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact-forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact-forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact-forms/preview.jpg',
		)/*,
		array(
			'import_file_name' => '<a href="https://norebro.clbthemes.com/demo" target="_blank">Partially: Services Pages</a>',
			'categories' => array( esc_html__( 'Partially', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),
		array(
			'import_file_name' => '<a href="https://norebro.clbthemes.com/demo" target="_blank">Partially: Portfolio Projects</a>',
			'categories' => array( esc_html__( 'Partially', 'norebro' ) ),
			'local_import_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.xml',
			'import_execute_file' => trailingslashit( get_template_directory() ) . 'demo/contact_forms/content.php',
			'import_preview_image_url' => get_template_directory_uri() . '/demo/contact_forms/preview.jpg',
		),*/
	);
}

add_filter( 'pt-ocdi/import_files', 'norebro_ocdi_import_files' );


function norebro_ocdi_after_import_setup( $selected_import ) {
	global $wpdb;

	$front_page_id = get_page_by_title( str_replace( esc_html( '&' ), 'n', $selected_import['import_file_name'] ) );

	if ( $selected_import['import_file_name'] === 'Classic Blog' ) { // i dont know why
		$front_page_id = get_page_by_title( 'Blog Classic' );
	}

	if ( isset( $front_page_id ) and is_object( $front_page_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
	}

	// Set menu
	$main_menu = wp_get_nav_menus();
	if ( is_array( $main_menu ) && count( $main_menu ) > 0 ) {
		$main_menu = $main_menu[0];
	}
	if ( is_object( $main_menu ) ) {
		$locations = get_theme_mod('nav_menu_locations');
		$locations['primary'] = $main_menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// VC background images fix
	$site_url = get_site_url();
	$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->postmeta . ' SET meta_value = REPLACE( meta_value, \'{{this_domain}}\', %s )', $site_url ) );
	$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->posts . ' SET post_content = REPLACE( post_content, \'{{this_domain}}\', %s )', $site_url ) );

	// Update norebro portfolio categories count
	$wpdb->query( 'UPDATE wp_term_taxonomy SET count = (
	SELECT COUNT(*) FROM wp_term_relationships rel 
		LEFT JOIN wp_posts po ON (po.ID = rel.object_id) 
		WHERE 
			rel.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id 
			AND 
			wp_term_taxonomy.taxonomy NOT IN (\'link_category\')
			AND 
			po.post_status IN (\'publish\', \'future\')' );
}

add_action( 'pt-ocdi/after_import', 'norebro_ocdi_after_import_setup' );