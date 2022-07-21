<?php

// Register sidebars
register_sidebar( array(
	'name' => esc_html__( 'Blog', 'norebro' ),
	'id' => 'norebro-sidebar-blog',
	'description' => esc_html__( 'Add widgets here.', 'norebro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget' => '</section>',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => esc_html__( 'Pages', 'norebro' ),
	'id' => 'norebro-sidebar-page',
	'description' => esc_html__( 'Add widgets here.', 'norebro' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget' => '</section>',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => esc_html__( 'Footer column 1', 'norebro' ),
	'id' => 'norebro-sidebar-footer-1',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 2', 'norebro' ),
	'id' => 'norebro-sidebar-footer-2',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 3', 'norebro' ),
	'id' => 'norebro-sidebar-footer-3',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
));
register_sidebar( array(
	'name' => esc_html__( 'Footer column 4', 'norebro' ),
	'id' => 'norebro-sidebar-footer-4',
	'before_title' => '<h3 class="title widget-title">',
	'after_title' => '</h3>',
));