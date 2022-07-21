<?php
	$project = NorebroHelper::get_storage_item_data();
?>

<div class="portfolio-item grid-5 overlay"<?php if ( $project['in_popup'] ) { echo ' data-portfolio-popup="' . esc_attr( $project['popup_id'] ) . '"'; } ?>>
	<?php if ( $project['featured_image_full'] ) : ?>
	<div class="image-wrap overlay" data-norebro-bg-image="<?php echo esc_url( $project['featured_image_full'] ); ?>"></div>
	<?php endif; ?>
</div>