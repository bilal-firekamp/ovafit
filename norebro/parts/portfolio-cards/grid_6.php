<?php
	$project = NorebroHelper::get_storage_item_data();

	if( ! isset( $title_class ) ){
		$title_class = '';
	}
	if( ! isset( $category_class ) ){
		$category_class = '';
	}
	if( ! isset( $more_class ) ){
		$more_class = '';
	}
?>

<div class="portfolio-item grid-2 grid-6"<?php if ( $project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $project['popup_id'] ) . '"'; } ?>>
	<a href="<?php echo esc_url( $project['url'] ); ?>"<?php if ( $project['external'] ) { echo ' target="_blank"'; } ?>>
		<div class="image-wrap">
			<?php if ( $project['featured_image'] ) : ?>
				<img src="<?php echo esc_url( $project['featured_image'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>">
			<?php endif; ?>
		</div>
		<div class="description">
			<div class="content-center">
				<div class="wrap text-center">
					<h4 class="title<?php echo esc_attr( $title_class ); ?>"><?php echo esc_html( $project['title'] ); ?></h4>
					<?php if ( $project['category_visible'] !== false ) :  ?>
					<?php if ( $project['categories_plain'] ) : ?>
						<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
						<?php foreach ( $categories as $category ) : ?>
							<span class="category<?php echo esc_attr( $category_class ); ?>"><?php echo esc_html( $category ); ?></span>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</a>
</div>