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


<div class="portfolio-item grid-5 overlay"<?php if ( $project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $project['popup_id'] ) . '"'; } ?>>
	<div class="description overlay">
		<div class="content-center">
			<div class="wrap text-left">
			
				<?php if ( $project['category_visible'] !== false ) :  ?>
				<?php if ( $project['categories_plain'] ) : ?>
					<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
					<?php foreach ( $categories as $category ) : ?>
						<span class="category<?php echo esc_attr( $category_class ); ?>"><?php echo esc_html( $category ); ?></span>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php endif; ?>

				<h4 class="title<?php echo esc_attr( $title_class ); ?>"><?php echo esc_html( $project['title'] ); ?></h4>
				<?php if ( $project['description_visible'] !== false ) :  ?>
					<div class="text-description">
						<?php echo wp_kses( $project['short_description'], 'default' ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $project['more_visible'] !== false ) :  ?>
				<a href="<?php echo esc_url( $project['url'] ); ?>"<?php if ( $project['external'] ) { echo ' target="_blank"'; } ?> class="more hover-underline<?php echo esc_attr( $more_class ); ?>">
					<?php echo esc_html__( 'View Project', 'norebro' ); ?>
					<span class="ion-ios-plus-empty"></span>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>