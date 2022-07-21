<?php
	// Settings
	$prev_post = get_adjacent_post( false, '', false );
	$next_post = get_adjacent_post( false, '', true );
	$toggle_post_column = '6';

	$hide_prev_n_next = NorebroSettings::get( 'post_hide_previous_n_next', 'global' );

	if ( ( $prev_post || $next_post ) && ! $hide_prev_n_next ) :
?>

	<div class="vc_row toggle">
	<?php if ( ! empty( $prev_post ) ) : ?>
		<div class="vc_col-md-<?php echo esc_attr( $toggle_post_column ); ?>">
			<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
				<table class="toggle-post">
					<tbody>
						<tr>
							<td class="arrow">
								<span class="ion-ios-arrow-thin-left"></span>
							</td>
							<td class="content text-left">
								<p class="subtitle small"><?php esc_html_e( 'Previous post', 'norebro' ); ?></p>
								<h3 class="title text-left">
									<?php
										$prev_title = get_the_title( $prev_post->ID );
										if ( empty( $prev_title ) ) {
											echo wp_kses( '[' . get_the_date( false, $prev_post->ID ) . ']', 'default' );
										} else {
											echo wp_kses( $prev_title, 'default' );
										}
									?>
								</h3>
							</td>
							<td class="image left">
								<?php echo get_the_post_thumbnail( $prev_post, 'norebro_thumbnail_next_and_prev' ); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</a>
		</div>
	<?php endif; ?>

	<?php
        $blog_page = NorebroSettings::get('blog_page', 'global');
        if(! empty( $blog_page ) ) {
        echo '<a href="' . get_permalink($blog_page) . '" class="norebro-icon-grid">';
            } else {
        echo '<a href="/" class="norebro-icon-grid">';
        }
        echo '<div class="icon"></div></a>';
    ?>

	<?php if ( ! empty( $next_post ) ) : ?>
		<div class="vc_col-md-<?php echo esc_attr( $toggle_post_column ); ?><?php echo empty( $prev_post ) ? ' vc_col-md-offset-6' : ''?>">
			<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
				<table class="toggle-post right">
					<tbody>
						<tr>
							<td class="image right">
								<?php echo get_the_post_thumbnail( $next_post, 'norebro_thumbnail_next_and_prev' ); ?>
							</td>
							<td class="content text-right">
								<p class="subtitle small"><?php esc_html_e( 'Next post', 'norebro' ); ?></p>
								<h3 class="title text-right">
									<?php
										$next_title = get_the_title( $next_post->ID );
										if ( empty( $next_title ) ) {
											echo wp_kses( '[' . get_the_date( false, $next_post->ID ) . ']', 'default' );
										} else {
											echo wp_kses( $next_title, 'default' );
										}
									?>
								</h3>
							</td>
							<td class="arrow">
								<span class="ion-ios-arrow-thin-right"></span>
							</td>
						</tr>
					</tbody>
				</table>
			</a>
		</div>
	<?php endif; ?>
	</div>
	<?php endif; ?>
