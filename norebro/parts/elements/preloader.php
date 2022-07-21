<?php if ( NorebroSettings::get( 'page_preloader', 'global' ) || NorebroSettings::get( 'page_mobile_preloader', 'global' ) ) : ?>
<?php
$classes = '';
if ( NorebroSettings::get( 'page_preloader', 'global' ) ) {
	$classes .= ' page-preloader';
}
if ( NorebroSettings::get( 'page_mobile_preloader', 'global' ) ) {
	$classes .= ' mobile-preloader';
}
$classes = trim($classes);
?>
<div class="preloader <?php echo esc_attr($classes) ?>" id="page-preloader">
		<?php
			switch ( NorebroSettings::get( 'preloader_type', 'global' ) ) {
				case 'ball_scale_pulse':
					echo '<div class="loader"><div class="la-ball-scale-pulse la-dark">
						<div></div>
						<div></div>
					</div></div>';
					break;
				case 'ball_scale_ripple':
					echo '<div class="la-ball-scale-ripple la-dark">
						<div></div>
					</div>';
					break;
				case 'ball_clip_rotate':
					echo '<div class="la-ball-clip-rotate la-dark">
						<div></div>
					</div>';
					break;
				case 'line_scale':
					echo '<div class="la-line-scale la-dark">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>';
					break;
				case 'line_spin_clockwise_fade':
					echo '<div class="la-line-spin-clockwise-fade la-dark">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>';
					break;
				case 'square_loader':
					echo '<div class="la-square-loader la-dark">
						<div></div>
					</div>';
					break;
				case 'ball_fall':
					echo '<div class="la-ball-fall la-dark">
						<div></div>
						<div></div>
						<div></div>
					</div>';
					break;
				case 'custom_loader':
					$preloader = NorebroSettings::get( 'custom_preloader', 'global' );
					echo '<div class="custom-preloader">
							<img src="'.$preloader.'" alt="preloader" />
						</div>';
					break;
				default:
					echo '<div class="la-ball-beat la-dark">
						<div></div>
						<div></div>
						<div></div>
					</div>';
		} ?>
</div>

<?php endif; ?>
