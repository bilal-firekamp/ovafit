<?php
	$project = NorebroHelper::get_storage_item_data();
	$_project_uniqid = false;
	if ( $project['overlay'] && preg_match("/^\#[a-zA-Z0-9]{6}$/i", trim( $project['overlay'] ) ) ) {
		$_project_uniqid = uniqid( 'norebro_post_style_' );
		$_overlay_color = NorebroHelper::hex_to_rgba( $project['overlay'], 0.5 );
	}

	$css_class = '';
	if ( $project['metro_style'] ) {
		$css_class .= ' metro-style';
	}

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

<div class="portfolio-item grid-1<?php echo esc_attr( $css_class ); ?>"<?php if ( $_project_uniqid ) { echo ' id="' . esc_attr( $_project_uniqid ) . '"'; } ?><?php if ( $project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $project['popup_id'] ) . '"'; } ?>>
	<a href="<?php echo esc_url( $project['url'] ); ?>"<?php if ( $project['external'] ) { echo ' target="_blank"'; } ?>>
		<div class="image-wrap"
		<?php if ( $project['metro_style'] ) { echo ' data-norebro-bg-image="' . esc_url( $project['featured_image'] ) . '"'; } ?>>
			<?php if ( $project['featured_image'] && !$project['metro_style'] ) : ?>
				<img src="<?php echo esc_url( $project['featured_image'] ); ?>" alt="<?php echo esc_attr( $project['title'] ); ?>">
			<?php endif; ?>
		</div>
		<div class="description overlay">
			<div class="content-center">
				<div class="wrap text-center">

					<?php if ( $project['category_visible'] !== false ) :  ?>
					<?php if ( $project['categories_plain'] ) : ?>
						<?php $categories = explode( ', ', $project['categories_plain'] ) ?>
						<?php foreach ( $categories as $category ) : ?>
							<span class="category<?php echo esc_attr( $category_class ); ?>"><?php echo esc_html( $category ); ?></span>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php endif; ?>
					
					<h4 class="title<?php echo esc_attr( $title_class ); ?>"><?php echo esc_html( $project['title'] ); ?></h4>
					<?php if ( $project['more_visible'] !== false ) :  ?>
					<div class="more brand-color<?php echo esc_attr( $more_class ); ?>">
						<span class="ion-ios-plus-empty"></span>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</a>
</div>

<?php

if ( $project['overlay'] ) {
	$custom_css = '#' . $_project_uniqid . ' .description { background: ' . $_overlay_color . '; } '; 
	wp_add_inline_style( 'argenta-style', $custom_css );
}