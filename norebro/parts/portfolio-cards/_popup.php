<?php
	$project = NorebroHelper::get_storage_item_data();


	if ( is_array( $project['images_full'] ) && count( $project['images_full'] ) > 0 ) {
		$project['images'] = $project['images_full'];
	}


	$popup_slider_scrolling = '';
	if( isset($project['popup_mouse_scrolling']) && $project['popup_mouse_scrolling'] == true) {
        $popup_slider_scrolling = ' mousewheel-true';
    }

	$hide_description = NorebroSettings::get( 'portfolio_gallery_description' );
	if ( in_array( $hide_description, array( 'inherit', NULL ) ) ) {
		$hide_description = ( bool ) NorebroSettings::get( 'portfolio_gallery_description', 'global' );
	} else {
		$hide_description = ( $hide_description == 'yes' );
	}

	$hide_details = NorebroSettings::get( 'portfolio_gallery_details' );
	if ( in_array( $hide_details, array( 'inherit', NULL ) ) ) {
		$hide_details = ( bool ) NorebroSettings::get( 'portfolio_gallery_details', 'global' );
	} else {
		$hide_details = ( $hide_details == 'yes' );
	}

	$view_text = NorebroSettings::get( 'portfolio_gallery_link_text', 'global' );
	if ( ! $view_text ) {
		$view_text = 'View Project';
	}

	$autoplay = false;
	if ( isset( $project['popup_autoplay'] ) && $project['popup_autoplay'] ) {
		$autoplay = ' data-autoplay="' . $project['popup_autoplay_time'] . '"';
	}

	if ( $project ) :



?>

	<div class="portfolio-gallery<?php if ( NorebroSettings::get( 'portfolio_gallery_light', 'global' ) != 'light' ) { echo ' gallery-dark'; } ?>" id="<?php echo esc_attr( $project['popup_id'] ); ?>" data-lazy-to-footer="true">
		<div class="slider<?php echo esc_attr($popup_slider_scrolling) ?>"<?php echo esc_attr($autoplay); ?>>

			<?php foreach ( $project['images'] as $i => $art ) : ?>
			<div class="portfolio-img" style="background-image: url(<?php echo esc_url( $art ); ?>);"></div>
			<?php endforeach; ?>

		</div>

		<div class="gallery-content">
			<div class="content-center">
				<div class="wrap">
					<div class="portfolio-page">

						<?php if ( $project['categories_plain'] ) : ?>
							<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
							<?php foreach ( $categories as $category ) : ?>
								<span class="tag"><?php echo esc_html( $category ); ?></span>
							<?php endforeach; ?>
						<?php endif; ?>

						<h2 class="title text-left"><?php echo esc_html( $project['title'] ); ?></h2>
						<?php if ( !$hide_description ) : ?>
						<div class="description">
                            <?php $project['short_description'] = strip_tags($project['short_description']); ?>
							<?php echo wp_kses($project['short_description'], 'post'); ?>
						</div>
						<?php endif; ?>
						<?php if ( !$hide_details ) : ?>
						<div class="info">
							<ul class="info-list">
								<?php if ( $project['date'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Date', 'norebro' ); ?></h5>
									<p><?php echo esc_html( $project['date'] ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $project['skills'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Skills', 'norebro' ); ?></h5>
									<p><?php echo wp_kses( $project['skills'], 'default' ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $project['client'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Client', 'norebro' ); ?></h5>
									<p><?php echo wp_kses( $project['client'], 'default' ); ?></p>
								</li>
								<?php endif; ?>

								<?php if ( $project['link'] ) : ?>
								<li>
									<h5 class="title uppercase"><?php esc_html_e( 'Project link', 'norebro' ); ?></h5>
									<p><a href="<?php echo esc_url( $project['link'] ); ?>" target="_blank"><?php echo esc_html( $project['link'] ); ?></a></p>
								</li>
								<?php endif; ?>

								<?php if ( $project['custom_fields'] ) : ?>
									<?php foreach ( $project['custom_fields'] as $custom_field ) : ?>
									<li>
										<h5 class="title uppercase"><?php echo esc_html( $custom_field['title'] ); ?></h5>
										<p><?php echo esc_html( $custom_field['value'] ); ?></p>
									</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
						<?php endif; ?>
						<?php if ( ! $project['hide_view_link_in_popup'] ) : ?>
						<a href="<?php echo esc_url( $project['url'] ); ?>" class="view-project font-titles hover-underline"<?php echo esc_attr($project['external']) ? ' target="_blank"' : ''?>>
							<?php echo esc_html( $view_text, 'norebro' ); ?>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="gallery-close" data-popup-close="true">
			<span class="ion-ios-close-empty"></span>
		</div>
	</div>

<?php endif;
