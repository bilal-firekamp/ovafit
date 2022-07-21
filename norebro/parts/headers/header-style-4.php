<?php
	// Settings
	$header_style = NorebroSettings::header_menu_style();

	$is_fixed = NorebroSettings::header_is_fixed();
	$mobile_is_fixed = NorebroSettings::get( 'header_mobile_menu_fixed', 'global' );
	$fixed_initial_offset = NorebroSettings::get( 'header_fixed_initial_offset', 'global' );

	$use_wrapper = NorebroSettings::header_use_wrapper();
	$show_search = ! NorebroSettings::get( 'header_hide_search', 'global' );
	$show_subheader = NorebroSettings::subheader_is_displayed();

	$have_woocomerce = function_exists( 'WC' );
	$have_woocomerce_wl = function_exists( 'YITH_WCWL' );

	$mobile_search_visibility = NorebroSettings::get( 'mobile_search_visibility', 'global' );

	$header_classes = '';

	if ( $show_subheader ) { 
		$header_classes .= ' with-subheader'; 
	}
	if ( $mobile_search_visibility == false ) {
		$header_classes .= ' without-mobile-search';
	}
?>

<header id="masthead" class="site-header dark-text header-4<?php echo esc_attr($header_classes); ?>"
	<?php if ( $is_fixed ) { echo ' data-header-fixed="true"'; } ?>
<?php if ( $mobile_is_fixed ) { echo ' data-mobile-header-fixed="true"'; } ?>
<?php if ( $fixed_initial_offset ) { echo ' data-fixed-initial-offset="' . $fixed_initial_offset . '"'; } ?>>
	<div class="header-wrap">
		
		<?php get_template_part( 'parts/elements/header-menu-logo' ); ?>

		<div class="menu-wrap">
			<?php if ( $use_wrapper ) : ?>
			<div class="page-container">
			<?php endif; ?>
				<div class="wrap">
					<?php if ( $show_search ) : ?>
					<ul class="menu-other left">
						<li class="search">
							<a href="#" data-nav-search="true">
								<span class="icon ion-android-search"></span>
							</a>
						</li>
						<?php if ( $have_woocomerce ) : ?>
						<li>
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart">
								<span class="icon">
									<svg version="1.1" viewBox="30 20 40 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="19px">
									<path d="M59.4,72.1H40.7c-4.1,0-7-2.6-7.1-6.1l-2.5-27c0-0.1,0-0.1,0-0.2c0-1.5,1.2-2.7,2.9-2.7h32.3c1.5,0,2.8,1.3,2.8,2.9  c0,0.1,0,0.1,0,0.2l-2.5,26.7C66.4,69.4,63.4,72.1,59.4,72.1z M35.1,40.1l2.4,25.6c0,0.1,0,0.1,0,0.2c0,1.5,1.6,2.2,3.1,2.2h18.7  c1.5,0,3.1-0.7,3.1-2.3c0-0.1,0-0.1,0-0.2l2.4-25.5H35.1z"/><path d="M58.4,40.1c-1.1,0-2-0.9-2-2v-2.6c0-3.8-2.6-6.7-6-6.7s-6,2.9-6,6.7v2.6c0,1.1-0.9,2-2,2s-2-0.9-2-2v-2.6  c0-6,4.4-10.7,10-10.7s10,4.7,10,10.7v2.6C60.4,39.2,59.5,40.1,58.4,40.1z"/></svg>
								</span>
								<?php if ( $header_style == 'style6' ) { esc_html_e( 'Cart', 'norebro' ); } ?>
								<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
							</a>
							<div class="submenu submenu_cart <?php if ( ! WC()->cart->is_empty() ) echo 'cart'; ?>">
								<div class="widget_shopping_cart_content">
									<?php woocommerce_mini_cart(); ?>
								</div>
							</div>
						</li>
						<?php if ( $have_woocomerce_wl ) : ?>
						<li>
							<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'user' . '/' . get_current_user_id() ) ); ?>" class="wishlist">
								<span class="icon ion-android-favorite-outline"></span>
								<?php if ( $header_style == 'style6' ) { esc_html_e( 'Wishlist', 'norebro' ); } ?>
							</a>
						</li>
						<?php endif; ?>
						<?php endif; ?>
					</ul>
					<?php endif; ?>
					<?php get_template_part( 'parts/elements/header-menu-nav' ); ?>
					<?php 
						if ( ! NorebroSettings::hamburger_in_panel() ) {
							get_template_part( 'parts/elements/header-menu-hamburger' );
						}
					?>
					<?php get_template_part( 'parts/elements/header-menu-optional-nav' ); ?>
					<div class="close-menu"></div>
				</div>
			<?php if ( $use_wrapper ) : ?>
			</div>
			<?php endif; ?>
		</div><!-- .menu-wrap -->
	</div><!-- .header-wrap -->
</header><!-- #masthead -->

<?php get_template_part( 'parts/elements/header-menu-fullscreen-nav' ); ?>