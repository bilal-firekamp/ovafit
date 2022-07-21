<?php
	// Settings
	$footer_is_visible = (bool) ! NorebroSettings::footer_is_hidden();
	$footer_layout_is_hidden = (bool) ! $footer_is_visible;
	$footer_is_wrapped = NorebroSettings::footer_is_wrapped();
	$footer_is_sticky = NorebroSettings::footer_is_sticky();

	$copyright_is_visible = NorebroSettings::footer_copytight_is_displayed();
	$copyright_alignment = NorebroSettings::get( 'footer_copyright_alignment', 'global' );
	$copyright_text_left = NorebroSettings::get( 'footer_copyright_left', 'global' );
	$copyright_text_right = NorebroSettings::get( 'footer_copyright_right', 'global' );
	$copyright_text_center = NorebroSettings::get( 'footer_copyright_center', 'global' );

	if ( $copyright_is_visible === NULL ) $copyright_is_visible = true;
	if ( $copyright_text_right === NULL && $copyright_text_left === NULL ) {
		$copyright_text_left = '&copy; 2019, Norebro theme by <a href="https://clbthemes.com/">Colabrio</a>.';
		$copyright_text_right = 'All rights reserved.';
	}

	$project_layout_type = NorebroSettings::get( 'project_layout_type' );
	if ( $project_layout_type == 'inherit' ) {
		$project_layout_type = NorebroSettings::get( 'project_layout_type', 'global' );
	}
	if ( $project_layout_type == 'style_7' ) {
		$footer_layout_is_hidden = true;
		$show_copyright = false;
	}

	$footer_widgets_count = 0;
	if ( is_active_sidebar( 'norebro-sidebar-footer-1' ) ) { $footer_widgets_count++; }
	if ( is_active_sidebar( 'norebro-sidebar-footer-2' ) ) { $footer_widgets_count++; }
	if ( is_active_sidebar( 'norebro-sidebar-footer-3' ) ) { $footer_widgets_count++; }
	if ( is_active_sidebar( 'norebro-sidebar-footer-4' ) ) { $footer_widgets_count++; }

	$header_menu_style = NorebroSettings::header_menu_style();

	$footer_class = '';
	if ( $footer_is_sticky ) {
		$footer_class .= ' sticky'; 
	}

	$page_container_class = '';
	if ( ! $footer_is_wrapped ) { 
		$page_container_class .= ' full'; 
	}
?>
<?php if ( $footer_is_visible || $copyright_is_visible ) : ?>
</div>
</div> <!-- Closed id="content" tag -->
<footer id="colophon" class="site-footer<?php echo esc_attr( $footer_class ); ?>">

	<?php if ( $footer_is_visible ) : ?>
	<?php if ( $footer_widgets_count > 0 && $footer_widgets_count <= 4 ) : ?>
	<div class="page-container<?php echo esc_attr( $page_container_class ); ?>">
		<div class="widgets">
			<?php if ( is_active_sidebar('norebro-sidebar-footer-1') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'norebro-sidebar-footer-1' ); ?></ul>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'norebro-sidebar-footer-2' ) ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'norebro-sidebar-footer-2' ); ?></ul>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar('norebro-sidebar-footer-3') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'norebro-sidebar-footer-3' ); ?></ul>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar('norebro-sidebar-footer-4') ) : ?>
				<div class="vc_col-md-<?php echo esc_attr( intval( 12 / $footer_widgets_count ) ); ?> widgets-column">
					<ul><?php dynamic_sidebar( 'norebro-sidebar-footer-4' ); ?></ul>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</div><!-- wrapper -->
	<?php endif; ?>
	<?php endif; ?>

	<?php if ( $copyright_is_visible ) : ?>
		<div class="site-info">
			<div class="page-container">
				<div class="wrap">
					<?php if ( $copyright_alignment == 'center' ) : ?>
						<div>
							<?php if ( $copyright_text_center ) {
								echo wp_kses( $copyright_text_center, 'default' );
							} ?>
						</div>
					<?php else : ?>
						<div class="left">
							<?php /* if ( $copyright_text_left ) {
								echo wp_kses( $copyright_text_left, 'default' );
							} */?>

							<?php if ( $copyright_text_left ) {
								echo wp_kses( $copyright_text_left, 'post' );
							} ?>
						</div>
						<div class="right">
							<?php if ( $copyright_text_right ) {
								echo wp_kses( $copyright_text_right, 'default' );
							} ?>
						</div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div><!-- .site-info -->
	<?php endif; ?>

</footer><!-- #colophon -->

<?php endif; ?>