<?php
	global $post, $wp_embed;

	$project = NorebroObjectParser::parse_to_project_object( $post );
	if ( is_array( $project['images_full'] ) && count( $project['images_full'] ) > 0 ) {
		$project['images'] = $project['images_full'];
	}

	if ( !$project['hide_breadcrumbs'] ) {
		get_template_part( 'parts/elements/breadcrumbs' );
	}
?>


<?php if ( is_array( $project['images'] ) ) : ?>
<!-- Vertical slider -->
<div class="portfolio-page-onepage">
	<div class="norebro-onepage full-vh" data-norebro-onepage="true" data-options='{ "dots": "true", "dotsClass": "slider-vertical-numbers" }'>
		<div class="onepage-stage">
			<?php foreach ( $project['images'] as $art ) : ?>
				<div class="onepage-section" data-norebro-bg-image="<?php echo esc_url( $art ); ?>"></div>
			<?php endforeach; ?>
		</div>

		<?php if ( $project['show_navigation'] != 'none' ) : ?>
		<div class="onepage-navigation">

			<?php if ( $project['prev'] ) : ?>
			<a href="<?php echo esc_url( $project['prev']['url'] ); ?>" class="prev slider-nav">
				<div>
					<i class="ion-ios-arrow-thin-left"></i>
				</div>
			</a>
			<?php endif; ?>

			<?php if ( $project['link_to_all'] ) : ?>
			<a href="<?php echo esc_url( $project['link_to_all'] ); ?>" class="grid slider-nav">
				<div class="norebro-icon-grid">
					<div class="icon"></div>
				</div>
			</a>
			<?php endif; ?>

			<?php if ( $project['next'] ) : ?>
			<a href="<?php echo esc_url( $project['next']['url'] ); ?>" class="next slider-nav">
				<div>
					<i class="ion-ios-arrow-thin-right"></i>
				</div>
			</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
	<div class="portfolio-page fullscreen">
		<div class="portfolio-content">
			<div class="toggle-btn brand-color-hover" data-opened="ion-android-remove" data-closed="ion-android-add">
				<i class="ion-android-remove"></i>
			</div>
			<div class="title-content <?php if ( ! $project['categories_plain'] ) { echo ' without-categories'; } ?> hidden">

				<?php if ( $project['categories_plain'] ) : ?>
					<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
					<?php foreach ( $categories as $category ) : ?>
						<span class="tag"><?php echo esc_html( $category ); ?></span>
					<?php endforeach; ?>
				<?php endif; ?>

				<?php the_title( '<h2 class="title text-left">', '</h2>'); ?>
			</div>
			<div class="hidden-content">
				<?php if ( $project['categories_plain'] ) : ?>
					<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
					<?php foreach ( $categories as $category ) : ?>
						<span class="tag"><?php echo esc_html( $category ); ?></span>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php the_title( '<h2 class="title text-left">', '</h2>'); ?>
				<div class="text-justify">
					<div class="description">
						<?php echo $wp_embed->run_shortcode( do_shortcode( wp_kses_post( $project['description'] ) ) ); ?>
						<?php 
							setup_postdata( $post );
							the_content(); 
						?>
					</div>
					<?php if ( $project['task'] ) :?>
					<h5><?php esc_html_e( 'Task', 'norebro' ); ?></h5>
					<p class="task"><?php echo wp_kses( $project['task'], 'default' ); ?></p>
					<?php endif; ?>
				</div>
				<div class="info">
					<ul class="info-list">
						<?php if ( $project['date'] ) : ?>
						<li>
							<div class="title"><?php esc_html_e( 'Date', 'norebro' ); ?></div>
							<p><?php echo esc_html( $project['date'] ); ?></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['skills'] ) : ?>
						<li>
							<div class="title"><?php esc_html_e( 'Skills', 'norebro' ); ?></div>
							<p><?php echo wp_kses( $project['skills'], 'default' ); ?></p>
						</li>
						<?php endif; ?>

						<?php if ( $project['client'] ) : ?>
						<li>
							<div class="title"><?php esc_html_e( 'Client', 'norebro' ); ?></div>
							<p><?php echo wp_kses( $project['client'], 'default' ); ?></p>
						</li>
						<?php endif; ?>

						<?php
						$tags = wp_get_post_terms($post->ID, 'norebro_portfolio_tags');
						if (!empty($tags)) {
							?>
							<li>
								<div class="title"><?php esc_html_e( 'Tags', 'norebro' ); ?></div>
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
                            <h5 class="title"><?php echo esc_html( $custom_field['title'] ); ?></h5>
							<p><?php echo esc_html( $custom_field['value'] ); ?></p>
						</li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

				<?php if ( ! $project['hide_sharing'] && $project['sharing_links'] && count( $project['sharing_links'] ) > 0 ) : ?>
				<h4><?php esc_html_e( 'Share project', 'norebro' ); ?></h4>
				<div class="socialbar inline">
                    <?php echo wp_kses($project['sharing_links_html'], 'post'); ?>
				</div>
				<?php endif; ?>

				<?php if ( $project['link'] ) : ?>
				<a href="<?php echo esc_url( $project['link'] ); ?>" class="open-website btn btn-outline btn-white" target="_blank">
					<span class="text">
						<?php esc_html_e( 'Open Website', 'norebro' ); ?>
					</span>
					<span class="icon ion-right ion-android-arrow-forward"></span>
				</a>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if ( comments_open() || get_comments_number() ) : ?>
	<div class="portfolio-comments">
		<?php comments_template(); ?>
	</div>
<?php endif; ?>
