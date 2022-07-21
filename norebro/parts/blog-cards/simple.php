<?php
	$norebro_post = NorebroHelper::get_storage_item_data();
    global $post;
	$anim_attrs = '';
	if ( in_array( $norebro_post['animation_type'], array( 'sync', 'async' ) ) ) {
		$anim_attrs .= ' data-aos-once="true"';
		$anim_attrs .= ' data-aos="' . esc_attr( $norebro_post['animation_effect'] ) . '"';
		if ( $norebro_post['animation_type'] == 'async' ) {
			$anim_attrs .= '';
		}
	}

	$blog_grid_class = '';	
	if ( in_array( 'sticky', get_post_class( '', $norebro_post['post_id'] ) ) ) {
		$blog_grid_class .= ' sticky'; 
	}
	if ( $norebro_post['media']['blockquote'] ) {
		$blog_grid_class .= ' quote';
	}
	if ( ! $norebro_post['preview'] ) {
		$blog_grid_class .= ' no-preview';
	}
	
?>
<div class="blog-grid grid-4<?php echo esc_attr( $blog_grid_class ); ?>" <?php echo esc_attr( $anim_attrs ); ?>>
	
	<div class="content">
		<?php if ( $norebro_post['categories'] ) : ?>
		<div class="tags">
			<?php foreach ($norebro_post['categories'] as $_category) : ?>
				<a class="tag brand-bg-color brand-border-color" href="<?php echo esc_url( get_category_link( $_category->cat_ID ) ); ?>">
					<?php echo esc_html( $_category->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		
		<h3>
			<?php if ( in_array( 'sticky', get_post_class( '', $norebro_post['post_id'] ) ) ) : ?>
			<span class="ion-pin"></span>
			<?php endif; ?>
			<a href="<?php echo esc_url( $norebro_post['url'] ); ?>">
				<?php echo esc_html( $norebro_post['title'] ); ?>
			</a>
		</h3>
        
		<p><?php echo $norebro_post['preview']; ?></p>

		<footer>
			<?php if ( $norebro_post['author'] ) : ?>
			<span class="author"><?php echo esc_html( $norebro_post['author'] ); ?></span>
			<strong>&mdash;</strong>
			<?php endif; ?>
			<?php if ( $norebro_post['date'] ) : ?>
			<span class="data"><?php echo esc_html( $norebro_post['date'] ); ?></span>
			<?php endif; ?>
		</footer>
		<span class="plus ion-ios-plus-empty brand-color"></span>
	</div>
	
</div>