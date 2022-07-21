<?php
	get_header();

	$show_breadcrumbs = NorebroSettings::breadcrumbs_is_displayed();
	$page_wrapped = NorebroSettings::page_is_wrapped();
	$sidebar_position = NorebroSettings::get_post_sidebar_position();

	$hide_author_widget = NorebroSettings::get( 'post_hide_author_widget', 'global' );
	if ( ! isset( $hide_author_widget ) ) {
		$hide_author_widget = false;
	}

	$hide_comments = NorebroSettings::get( 'post_hide_comments', 'global' );

	$sidebar_row_class = '';
	if ( $sidebar_position == 'right' ) {
		$sidebar_row_class = ' with-right-sidebar';
	} elseif ( $sidebar_position == 'left' ) {
		$sidebar_row_class = ' with-left-sidebar';
	}
	$sidebar_layout = NorebroSettings::page_sidebar_layout();
	$sidebar_class = '';
	if ( $sidebar_layout ) {
		$sidebar_class .= ' sidebar-' . $sidebar_layout;
	}

	$page_container_class = '';

	if ( !$show_breadcrumbs ) {
		$page_container_class .= ' without-breadcrumbs';
	}
	if ( !$page_wrapped ) {
		$page_container_class .= ' full';
	}

	while ( have_posts() ) : the_post();
?>

<?php get_template_part( 'parts/elements/header-title' ); ?>

<?php get_template_part( 'parts/elements/breadcrumbs' ); ?>

<div class="page-container <?php echo esc_attr($page_container_class); ?>">
	
	<?php if ( is_active_sidebar( 'norebro-sidebar-blog' ) && $sidebar_position == 'left' ) : ?>
	<div class="page-sidebar sidebar-left<?php echo esc_attr($sidebar_class); ?>">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>


	<div class="page-content<?php echo esc_attr( $sidebar_row_class ); ?>">
		<div id="primary" class="content-area">
			<main id="main" class="site-main page-offset-bottom">
				<?php get_template_part( 'parts/content', get_post_format() ); ?>
				<?php
					$author = get_the_author_meta( 'ID' );
					if ( $author && get_the_author_meta( 'description', $author ) && ! $hide_author_widget ) {
						the_widget( 'norebro_widget_about_author', array( 'words' => '' ) );
					}
				?>
				<?php get_template_part( 'parts/elements/related-posts' ); ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>

	<?php if ( is_active_sidebar( 'norebro-sidebar-blog' ) && $sidebar_position == 'right' ) : ?>
	<div class="page-sidebar sidebar-right<?php echo esc_attr($sidebar_class); ?>">
		<aside id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'norebro-sidebar-blog' ); ?>
		</aside>
	</div>
	<?php endif; ?>

</div>

<?php if ( !$hide_comments && (comments_open() || get_comments_number()) ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>

<div class="page-container">
	<?php get_template_part( 'parts/elements/next-n-prev-posts' ); ?>
</div>

<?php
	endwhile;

	get_footer();