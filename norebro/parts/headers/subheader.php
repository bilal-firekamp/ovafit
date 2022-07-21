<?php
	// Settings
	$show_subheader = NorebroSettings::subheader_is_displayed();
	$use_wrapper = NorebroSettings::header_use_wrapper();
	$is_fixed = NorebroSettings::header_is_fixed();

	$header_menu_style = NorebroSettings::header_menu_style();
	if ( $header_menu_style == 'style3' ) $use_wrapper = true;
	if ( $header_menu_style == 'style6' ) $use_wrapper = false;

	$subheader_have_items_left = have_rows( 'global_header_menu_subheader_items_left', 'option' );
	$subheader_have_items_right = have_rows( 'global_header_menu_subheader_items_right', 'option' );
?>

<?php if ( $show_subheader ) : ?>

<div class="subheader<?php if ( $is_fixed ) { echo ' fixed'; } ?>">
	<div class="content">

		<div class="page-container<?php if ( !$use_wrapper ) { echo ' full'; } ?>">

		<?php if ( $subheader_have_items_left  ) : ?>
		<ul class="left">
			<?php while( have_rows( 'global_header_menu_subheader_items_left', 'option' ) ): the_row(); ?>
			<li><?php echo get_sub_field( 'items' ); ?></li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>

		<?php if ( $subheader_have_items_right  ) : ?>
		<ul class="right">
			<?php while( have_rows( 'global_header_menu_subheader_items_right', 'option' ) ): the_row(); ?>
			<li><?php echo get_sub_field( 'items' ); ?></li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>

		</div>
	</div>
</div><!-- .subheader -->

<?php endif; ?>