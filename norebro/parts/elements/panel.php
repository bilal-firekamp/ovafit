<?php
	$links = NorebroSettings::get( 'side_panel_social', 'global' );
	$social_enable = NorebroSettings::get( 'side_panel_social_enable', 'global' );
	$show_share_on_mobile = NorebroSettings::get( 'side_panel_show_share_on_mobile', 'global' );

	switch ( NorebroSettings::get( 'side_panel_position', 'global' ) ) {
		case 'hide':
			$panel_position = 'hide';
			break;
		case 'right':
			$panel_position = 'right';
			break;
		case 'left':
		default:
			$panel_position = 'left';
			break;
	}
	$panel_text = NorebroSettings::get( 'side_panel_text', 'global' );
	if ($panel_text === NULL) {
		$panel_text = '&copy; 2020, Norebro theme by <a href="https://clbthemes.com/" target="_blank">Colabrio</a>, All right reserved.';
	}

	ob_start();

	if ($links) {
        foreach ($links as $link) {
            switch ($link) {
                case 'facebook':
                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode(get_permalink()) . '"><span class="fab fa-facebook"></span></a>';
                    break;
                case 'twitter':
                    echo '<a href="https://twitter.com/intent/tweet?text=' . rawurlencode(get_permalink()) . '"><span class="fab fa-twitter"></span></a>';
                    break;
                case 'dribbble':
                    echo '<a href="http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&description=' . urlencode('title') . '"><span class="fab fa-dribbble"></span></a>';
                    break;
                case 'linkedin':
                    echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . rawurlencode(get_permalink()) . '&title=' . urlencode(the_title('', '', false)) . '&source=' . urlencode(get_bloginfo('name')) . '"><span class="fab fa-linkedin"></span></a>';
                    break;
                case 'pinterest':
                    echo '<a href="http://pinterest.com/pin/create/button/?url=' . rawurlencode(get_permalink()) . '"><span class="fab fa-pinterest-p"></span></a>';
                    break;
                case 'vk':
                    echo '<a href="http://vk.com/share.php?url=' . rawurlencode(get_permalink()) . '"><span class="fab fa-vk"></span></a>';
                    break;
            }
        }
    }

	$social_html = ob_get_clean();

?>
<?php if ( $panel_position != 'hide' ) : ?>

<div class="bar-hamburger">
	<?php
		if ( NorebroSettings::hamburger_in_panel() ) {
			get_template_part( 'parts/elements/header-menu-hamburger' );
		}
	?>
</div>
<div class="norebro-bar bar <?php if ( $panel_position == 'right' ) { echo ' right'; } ?>">

	<?php if ( $panel_text ) : ?>
	<div class="content font-titles uppercase">
		<div class="separator"></div>
		<?php echo wp_kses( $panel_text, 'default' ); ?>
	</div>
	<?php endif; ?>

	<?php if ( is_array( $links ) && $social_enable ) : ?>
	<div class="share">
		<div class="title">
			<div class="icon ion-android-add"></div>
			<span class="name font-titles uppercase"><?php esc_html_e( 'Share', 'norebro' ); ?></span>
		</div>
		<div class="links">
			<?php echo wp_kses($social_html, 'post'); ?>
		</div>
	</div>
	<?php endif; ?>

</div>
<?php endif; ?>

<?php if ( $show_share_on_mobile ) : ?>
	<div class="mobile-social">
		<div class="share-btn">
			<div class="icon ion-android-add"></div>
		</div>
		<div class="social">
            <?php echo wp_kses($social_html, 'post'); ?>
		</div>
	</div>
<?php endif; ?>
