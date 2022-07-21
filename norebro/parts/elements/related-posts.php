<?php
	// Settings
	$post_hide_related = NorebroSettings::get( 'post_hide_related_posts', 'global' );

	if ( ! $post_hide_related ) {
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$tag_ids = array();
		foreach ( $tags as $individual_tag ) {
			$tag_ids[] = intval( $individual_tag->term_id );
		}
		$categories = wp_get_post_categories( $post->ID );
		$category_ids = array();
		foreach ( $categories as $individual_category ) {
			$category_ids[] = intval( $individual_category );
		}

		$args = array(
			'tag__in' => $tag_ids,
			'category__in' => $category_ids,
			'post__not_in' => array( $post->ID ),
			'posts_per_page' => 3,
			'ignore_sticky_posts' => 1
		);

		$related_query = new wp_query( $args );

		if ( $related_query->found_posts > 0 ) {
			$posts_count = intval( $related_query->found_posts );
			if ( $posts_count >= 3 ) { $grid_size = 4; }
			if ( $posts_count == 2 ) { $grid_size = 6; }
			if ( $posts_count == 1 ) { $grid_size = 6; }
?>
			<h3 class="title text-left related-post-heading">
				<?php esc_html_e( 'Related posts', 'norebro' ); ?>
			</h3>
			<div class="vc_row related-posts">
				<?php
				while( $related_query->have_posts() ):
					$related_query->the_post();
					$category =	get_the_category();
				?>
				<div class="vc_col-md-<?php echo esc_attr( $grid_size ); ?> vc_col-xs-12">
					<div class="blog-grid grid-1">
						<?php
							// thumbnail
							$thumb_id = get_post_thumbnail_id();
							if ( $thumb_id ) {
								$image = wp_get_attachment_image_src( $thumb_id, 'large' );
								if ( is_array( $image ) ) {
									$img_url = $image[0];
									// fix vertical images
									if ( $image[1] < $image[2] ) {
										$_image_basename = basename( get_attached_file( $thumb_id ) );
										$_image_new_basename = substr( $_image_basename, 0, strrpos( $_image_basename, '.' ) ) . '-' . $image[1] . 'x' . $image[1] . substr( $_image_basename, strrpos( $_image_basename, '.' ));
										$_image_new_uri = str_replace( $_image_basename, $_image_new_basename, get_attached_file( $thumb_id ) );
										$_image_new_url = str_replace( $_image_basename, $_image_new_basename, $image[0] );
										if ( file_exists( $_image_new_uri ) ) {
											$img_url = $_image_new_url;
										} else {
											$_image = wp_get_image_editor( get_attached_file( $thumb_id ) );
											if ( ! is_wp_error( $_image ) ) {
												$_image->resize( $image[1], $image[1] - ( (int) ( $image[1] / 3 ) ), true );
												if ( $_image->save( $_image_new_uri ) ) {
													$img_url = $_image_new_url;
												}
											}
										}
									} else {
										$img_url = wp_get_attachment_image_src( $thumb_id, 'large' );
										$img_url = $img_url[0];
									}
								} else {
									$img_url = $image;
								}
							}
						?>
						<?php if ( $thumb_id ) : ?>
						<header>
							<a rel="external" href="<?php echo esc_url( get_the_permalink() ); ?>">
								<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo get_the_title(); ?>">
							</a>
							<div class="tags">
								<a class="tag brand-bg-color brand-border-color" href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
									<?php echo esc_html( $category[0]->name ); ?>
								</a>
							</div>
						</header>
						<?php endif; ?>

						<div class="content">
							<h3 class="title text-left">
								<a rel="external" href="<?php echo esc_url( get_the_permalink() ); ?>">
									<?php
										$recent_title = get_the_title();
										if ( empty( $recent_title ) ) {
											echo esc_html( '[' . get_the_date() . ']' );
										} else {
											echo esc_html( $recent_title );
										}
									?>
								</a>
							</h3>
						</div>
						<footer>
							<?php echo norebro_return_posted_on(); ?>
						</footer>
					</div>
				</div>
			<?php 
			endwhile;
			?>
			</div>
		<?php
		}
		
		wp_reset_postdata();
	}