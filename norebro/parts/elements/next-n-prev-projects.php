<?php 
	$project = NorebroObjectParser::parse_to_project_object( $post );
	$border_class = ' ';
	switch ( $project['navigation_position'] ) {
		case 'top':
			$border_class .= 'with-border-bottom';
			break;
		case 'bottom':
			$border_class .= 'with-border-top';
			break;
	}
?>

<div class="post-navigation <?php echo esc_attr( $border_class ); ?>">
	<div class="page-container">
		<div class="vc_col-md-6 box-wrap">
			<?php if ( $project['prev'] ) : ?>
			<a href="<?php echo esc_url( $project['prev']['url'] ); ?>" class="text-left">
				<div class="content-center">
					<div class="wrap">
						<div class="icon">
							<span class="ion-android-arrow-back"></span>
						</div>
						<div class="content">
							<p class="subtitle"><?php esc_html_e( 'Previous project', 'norebro' ); ?></p>
							<h4><?php echo wp_kses( $project['prev']['title'], 'default' ); ?></h4>
						</div>
					</div>
				</div>
			</a>
			<?php endif; ?>
		</div>
		<div class="vc_col-md-6 box-wrap">
			<?php if ( $project['next'] ) : ?>
			<a href="<?php echo esc_url( $project['next']['url'] ); ?>" class="text-right">
				<div class="content-center">
					<div class="wrap">
						<div class="content">
							<p class="subtitle"><?php esc_html_e( 'Next project', 'norebro' ); ?></p>
							<h4><?php echo wp_kses( $project['next']['title'], 'default' ); ?></h4>
						</div>
						<div class="icon">
							<span class="ion-android-arrow-forward"></span>
						</div>
					</div>
				</div>
			</a>
			<?php endif; ?>
		</div>
		<a href="<?php echo esc_url( $project['link_to_all'] ); ?>" class="grid norebro-icon-grid">
			<div class="icon"></div>
		</a>
		<div class="clear"></div>
	</div>
</div>