<?php
	$project = NorebroObjectParser::parse_to_project_object( $post );
	if ( is_array( $project['images_full'] ) && count( $project['images_full'] ) > 0 ) {
		$project['images'] = $project['images_full'];
	}

	if ( !$project['hide_breadcrumbs'] ) {
		get_template_part( 'parts/elements/breadcrumbs' );
	}
?>

<?php
	if ( $project['show_navigation'] == 'prev_n_next' && ( $project['prev'] || $project['next'] )
			&& $project['navigation_position'] == 'top' ) {
		get_template_part( 'parts/elements/next-n-prev-projects' );
	}
?>

<!-- Content -->
<div class="portfolio-page header-full" id="scroll-portfolio"
<?php if ( $project['images'] ) { echo ' data-norebro-bg-image="' . esc_url( $project['images'][0] ) . '"'; } ?>>

	<div class="content-center">
		<div class="wrap">

			<a href="<?php echo esc_url( $project['link_to_all'] ); ?>" class="back font-titles hover-underline">
				<span class="icon ion-android-arrow-back"></span>
				<?php esc_html_e( 'Back', 'norebro' ); ?>
			</a>

			<div class="portfolio-content">
				<?php if ( $project['categories_plain'] ) : ?>
					<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
					<?php foreach ( $categories as $category ) : ?>
						<span class="tag"><?php echo esc_html( $category ); ?></span>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php the_title( '<h2 class="title text-left">', '</h2>'); ?>
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

						<?php
						$tags = wp_get_post_terms($post->ID, 'norebro_portfolio_tags');
						if (!empty($tags)) {
							?>
							<li>
								<div class="title uppercase"><?php esc_html_e( 'Tags', 'norebro' ); ?></div>
								<p>
									<?php $i = 0; foreach ($tags as $tag):
										if ($i == 0):
											echo esc_html($tag->name);
										else:
											echo ', ' . $tag->name;
										endif;
										$i++; endforeach; ?>
								</p>
							</li>
							<?php
						}
						?>

						<?php if ( $project['custom_fields'] ) : ?>
							<?php foreach ( $project['custom_fields'] as $custom_field ) : ?>
							<li>
								<h5 class="title uppercase"><?php echo esc_html( $custom_field['title'] ); ?>:</h5>
								<p><?php echo esc_html( $custom_field['value'] ); ?></p>
							</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

			</div><!--.content-->

		</div>
		<div class="scroll font-titles"><?php esc_html_e( 'Scroll', 'norebro' ); ?></div>
	</div><!--.content-center-->

</div>
<div class="page-container">
	<div class="page-content">
		<?php 
			setup_postdata( $post );
			the_content(); 
		?>
	</div>
</div>

<?php
	if ( $project['show_navigation'] == 'prev_n_next' && ( $project['prev'] || $project['next'] )
			&& $project['navigation_position'] == 'bottom' ) {
		get_template_part( 'parts/elements/next-n-prev-projects' );
	}
?>

<?php if ( comments_open() || get_comments_number() ) : ?>
	<div class="portfolio-comments">
		<?php comments_template(); ?>
	</div>
<?php endif; ?>
