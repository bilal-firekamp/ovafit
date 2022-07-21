<?php
	NorebroHelper::add_required_script( 'one-page-scroll' );

	$project_layout_type = NorebroSettings::get( 'project_layout_type' );

	if ( in_array( $project_layout_type, array( 'inherit', NULL ) ) ) {
		$project_layout_type = NorebroSettings::get( 'project_layout_type', 'global' );
	}

	get_header();
?>

<?php 
	if ( ! in_array( $project_layout_type, array( 'type_5', 'type_6', NULL ) ) ) {
		get_template_part( 'parts/elements/header-title' );
	}
?>

<?php
	if ( ! post_password_required() ) {
		switch ( $project_layout_type ) {
			case 'type_1':
				get_template_part( 'parts/portfolio/header-full' );
				break;
			case 'type_2':
				get_template_part( 'parts/portfolio/boxed-invert' );
				break;
			case 'type_3':
				get_template_part( 'parts/portfolio/full-width-invert' );
				break;
			case 'type_4':
				get_template_part( 'parts/portfolio/slider' );
				break;
			case 'type_5':
				get_template_part( 'parts/portfolio/header-title-invert' );
				break;
			case 'type_6':
				get_template_part( 'parts/portfolio/header-title' );
				break;
			case 'type_7':
				get_template_part( 'parts/portfolio/fullscreen' );
				break;
			case 'type_8':
				get_template_part( 'parts/portfolio/boxed' );
				break;
			case 'type_9':
				get_template_part( 'parts/portfolio/full-width' );
				break;
			default:
				get_template_part( 'parts/portfolio/header-full' );
				break;
		}
	} else {
?>
	<div class="page-container bottom-offset">
		<div class="content">
			<?php echo get_the_password_form(); ?>
		</div>
	</div>
<?php 
	}

	get_footer();