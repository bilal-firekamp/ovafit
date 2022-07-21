<?php
/*
	Brand color
	
	Table of contents: (you can use search)
	# 1. Variables
	# 2. Brand color
	# 3. View
*/


# 1. Variables

$brand_color = false;


# 2. Brand color

$brand_color = NorebroSettings::get( 'page_brand_color', 'global' );


# 3. View
if ( !$brand_color ) {
	$brand_color = '#174EE2';
}

if ( $brand_color ) {
	// --- start of CSS ---
	$_style_block = '.accordion-box .title:hover .control,.accordion-box .item.active .control,.accordion-box.title-brand-color .title,.accordion-box.active-brand-color .item.active .control,.accordion-box.active-brand-color .title:hover .control,.slider .owl-dot.brand,.socialbar.brand a:hover,.socialbar.brand.outline a,.socialbar.brand.flat a,.socialbar.brand.inline a:hover,.video-module .btn-play.outline.btn-brand,.video-module.boxed:hover .btn-play.btn-brand,.widget_tag_cloud .tagcloud a:hover, .widget_product_tag_cloud .tagcloud a:hover,.widget_nav_menu .menu-item a:hover,.widget_pages .menu-item a:hover,.widget_nav_menu .current-menu-item a,.widget_pages .current-menu-item a,.widget-sidebar-menu-left .menu-item a:hover,.widget_rss ul a,.widget_norebro_widget_recent_posts ul.recent-posts-list h4 a:hover,.widget_norebro_widget_login a,.widget div.star-rating:before,.widget div.star-rating span:before, .widget span.star-rating:before,.widget span.star-rating span:before,a:hover,p a,.btn-brand:hover,.btn-outline.btn-brand,a.btn-outline.btn-brand,.btn-outline.btn-brand.disabled:hover,a.btn-outline.btn-brand.disabled:hover,.btn-link.btn-brand,a.btn-link.btn-brand,a.tag:hover,.tag-wrap a:hover,a[class^="tag-link-"]:hover,nav.pagination li a.page-numbers.active,.fullscreen-navigation .copyright .content > a,.fullscreen-navigation.simple ul.menu li:hover > a,.fullscreen-navigation.centered .fullscreen-menu-wrap ul.menu > li a:hover,.post-navigation .box-wrap > a:hover h4, .post-navigation .box-wrap > a:hover .icon,.bar .content a:hover,.bar .share .links a:hover,.portfolio-sorting li a:hover,.portfolio-item h4.title a:hover, .portfolio-item .widget h4 a:hover, .widget .portfolio-item h4 a:hover,.portfolio-item .category.outline,.portfolio-item.grid-2:hover h4.title, .portfolio-item.grid-2:hover .widget h4, .widget .portfolio-item.grid-2:hover h4,.portfolio-item.grid-2.hover-2 .overlay span,.portfolio-item.grid-5 .more span,.blog-grid .tags a:hover,.blog-grid:hover h3 a,.blog-grid.grid-4:hover .tags a,.post .entry-content a:not(.wp-block-button__link):not(.wp-block-file__button),.page-links a,.entry-footer .share .title:hover,.toggle-post:hover .arrow,.toggle-post:hover .content h3,.post .comments-link a:hover,.comments-area .comment-body .comment-meta .reply a,.comments-area .comment-body .comment-meta a.comment-edit-link,.comments-area .reply a,.comments-area .reply-cancle a,.comments-area a.comment-edit-link,input.brand-color,input[type="submit"].brand-color,button.brand-color,a.brand-color,div.brand-color,span.brand-color,input.brand-color-hover:hover,input[type="submit"].brand-color-hover:hover,button.brand-color-hover:hover,a.brand-color-hover:hover,div.brand-color-hover:hover,span.brand-color-hover:hover,.brand-color,.brand-color-after:after,.brand-color-before:before,.brand-color-hover:hover,.brand-color-hover-after:after,.brand-color-hover-before:before,.woocommerce .product div.summary .woo-review-link:hover,.woocommerce .product .product_meta a,ul.woo-products li.product:hover h3 a,.woocommerce form.login a,.woocommerce #payment li.wc_payment_method a.about_paypal,.woocommerce .woo-my-nav li.is-active a,.woocommerce .woo-my-content p a:hover, .has-brand-color-color, .is-style-outline .has-brand-color-color {';
	$_style_block .= 'color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '.video-module.btn-brand-color-hover:hover .btn-play .icon,.brand-color-i,.brand-color-after-i:after,.brand-color-before-i:before,.brand-color-hover-i:hover,.brand-color-hover-i-after:after,.brand-color-hover-i-before:before{';
	$_style_block .= 'color:' . $brand_color . ' !important;';
	$_style_block .= '}';

	$_style_block .= '.accordion-box.outline.title-brand-border-color .title,.contact-form.without-label-offset .focus.active,.contact-form.flat input:not([type="submit"]):focus, .contact-form.flat select:focus, .contact-form.flat textarea:focus,.socialbar.brand a,.video-module .btn-play.btn-brand,.widget_tag_cloud .tagcloud a:hover, .widget_product_tag_cloud .tagcloud a:hover,.widget_calendar tbody tr td#today,.btn-brand,.btn-outline.btn-brand,a.btn-outline.btn-brand,.btn-outline.btn-brand:hover,a.btn-outline.btn-brand:hover,.btn-outline.btn-brand.disabled:hover,a.btn-outline.btn-brand.disabled:hover,input:not([type="submit"]):focus,textarea:focus,select:focus,a.tag:hover,.tag-wrap a:hover,a[class^="tag-link-"]:hover,.portfolio-gallery .gallery-content .tag,.header-search form input:focus,.fullscreen-navigation.simple ul.menu li:hover > a:after, .fullscreen-navigation.simple ul.menu li:hover > a:before,.portfolio-item .category.outline,.portfolio-page.fullscreen .content .tag,.portfolio-page.portfolio-header-title.invert .tag,.entry-footer .share .title:hover,input.brand-border-color,input[type="submit"].brand-border-color,button.brand-border-color,a.brand-border-color,div.brand-border-color,span.brand-border-color,input.brand-border-color-hover:hover,input[type="submit"].brand-border-color-hover:hover,button.brand-border-color-hover:hover,a.brand-border-color-hover:hover,div.brand-border-color-hover:hover,span.brand-border-color-hover:hover,.brand-border-color,.brand-border-color-after:after,.brand-border-color-before:before,.brand-border-color-hover:hover,.brand-border-color-hover-after:after,.brand-border-color-hover-before:before, .has-brand-color-background-color, .is-style-outline .has-brand-color-color {';
	$_style_block .= 'border-color:' . $brand_color . ';';
	$_style_block .= '}';



	$_style_block .= '.brand-border-color-i,.brand-border-color-after-i:after,.brand-border-color-before-i:before,.brand-border-color-hover-i:hover,.brand-border-color-hover-i-after:after,.brand-border-color-hover-i-before:before{';
	$_style_block .= 'border-color:' . $brand_color . ' !important;';
	$_style_block .= '}';


	$_style_block .= '.divider,h1.with-divider:after, h2.with-divider:after, h3.with-divider:after, h4.with-divider:after, h5.with-divider:after, h6.with-divider:after,.accordion-box.title-brand-bg-color .title,.list-box li:after, .widget_recent_comments li:after, .widget_recent_entries li:after, .widget_meta li:after, .widget_archive li:after, .widget_nav_menu li:after,.widget_pages li:after, .widget_categories li:after, .widget_rss li:after, .widget_product_categories li:after,.list-box.icon-fill li .icon, .icon-fill.widget_recent_comments li .icon, .icon-fill.widget_recent_entries li .icon, .icon-fill.widget_meta li .icon, .icon-fill.widget_archive li .icon, .icon-fill.widget_nav_menu li .icon,.icon-fill.widget_pages li .icon, .icon-fill.widget_categories li .icon, .icon-fill.widget_rss li .icon, .icon-fill.widget_product_categories li .icon,.socialbar.brand a,.socialbar.brand.outline a:hover,.socialbar.brand.flat a:hover,.video-module .btn-play.btn-brand,.video-module.boxed:hover .btn-play.outline.btn-brand,.widget_calendar caption,.widget_price_filter .ui-slider-range,.widget_price_filter .ui-slider-handle:after,a.hover-underline.underline-brand:before,.btn-brand,button[disabled].btn-brand:hover,input[type="submit"][disabled].btn-brand:hover,.btn-outline.btn-brand:hover,a.btn-outline.btn-brand:hover,.radio input:checked + .input:after,.radio:hover input:checked + .input:after,.portfolio-gallery .gallery-content .tag,nav.pagination li a.hover-underline:before,.portfolio-sorting li a:hover .name:before,.portfolio-item .category,.portfolio-page.fullscreen .content .tag,.portfolio-page.portfolio-header-title.invert .tag,input.brand-bg-color,input[type="submit"].brand-bg-color,button.brand-bg-color,a.brand-bg-color,div.brand-bg-color,span.brand-bg-color,input.brand-bg-color-hover:hover,input[type="submit"].brand-bg-color-hover:hover,button.brand-bg-color-hover:hover,a.brand-bg-color-hover:hover,div.brand-bg-color-hover:hover,span.brand-bg-color-hover:hover,.brand-bg-color,.brand-bg-color-after:after,.brand-bg-color-before:before,.brand-bg-color-hover:hover,.brand-bg-color-hover-after:after,.brand-bg-color-hover-before:before,.woocommerce .product .product_meta > span:after,.select2-dropdown .select2-results__option[aria-selected="true"],.woocommerce .woo-my-content mark, .has-brand-color-background-color {';
	$_style_block .= 'background-color:' . $brand_color . ';';
	$_style_block .= '}';

	$_style_block .= '.brand-bg-color-i,.brand-bg-color-after-i:after,.brand-bg-color-before-i:before,.brand-bg-color-hover-i:hover,.brand-bg-color-hover-i-after:after,.brand-bg-color-hover-i-before:before{';
	$_style_block .= 'background-color:' . $brand_color . ' !important;';
	$_style_block .= '}';

	// --- end of CSS ---
	NorebroLayout::append_to_dynamic_css_buffer( $_style_block );
} 
