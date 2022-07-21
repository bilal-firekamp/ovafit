<?php

	$logo = NorebroSettings::get_logo( false );

	switch ( NorebroSettings::get_menu_style() ) {
		case 'simple':
			$logo = NorebroSettings::get_logo( true );
			break;
		case 'centered':
			$logo = NorebroSettings::get_logo( true );
			break;
		case 'split':
			$logo = NorebroSettings::get_logo( true );
			break;
	}
	$logo_as_image = is_array( $logo );
	$have_wpml = function_exists( 'icl_get_languages' );

	$menu_class = '';
	switch ( NorebroSettings::get_menu_style() ) {
		case 'simple': $menu_class .= ' simple'; break;
		case 'centered': $menu_class .= ' centered'; break;
		case 'split': $menu_class .= ' split'; break;
	}
	if ( NorebroSettings::side_panel_have_padding() ) {
		$menu_class .= ' with-panel-offset';
	}
	$header_have_social = have_rows( 'global_header_menu_social_links', 'option' );


	$overlay = NorebroSettings::get( 'overlay_menu_logo', 'global' );
?>

<div class="fullscreen-navigation<?php echo esc_attr( $menu_class ); ?>" id="fullscreen-mega-menu">
	<div class="site-branding">
		<p class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( $overlay ) : ?>
				<?php if ( $overlay['global_overlay_logo'] || $overlay['global_overlay_logo_retina'] ) : ?>
					<span class="first-logo">
						<img src="<?php echo esc_url( ( $overlay['global_overlay_logo'] ) ? $overlay['global_overlay_logo'] : $overlay['global_overlay_logo_retina'] ); ?>"
							<?php if ( $overlay['global_overlay_logo_retina'] ) { echo ' srcset="' . esc_attr( $overlay['global_overlay_logo_retina'] ) . ' 2x"'; } ?>
							alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</span>
				<?php endif; ?>
			<?php else : ?>
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			<?php endif; ?>
			</a>
		</p>
	</div>
	<div class="fullscreen-menu-wrap font-titles">
		<div id="fullscreen-mega-menu-wrap">
            <?php
            $page_menu_type = NorebroSettings::get( 'menu_type' );
            if ( in_array( $page_menu_type, array( 'inherit', NULL ) ) ) {
                if (NorebroSettings::get('hamburger_menu', 'global')) {
                    wp_nav_menu(array('menu' => NorebroSettings::get('hamburger_menu' , 'global'), 'menu_id' => 'secondary-menu'));
                } else {
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'secondary-menu' ) );
                    } else {
                        echo '<span class="menu-not-assigned">' . sprintf( esc_html__( 'Please %1$s assign a menu %2$s to the primary menu location', 'norebro' ), '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">', '</a>' ) . '</span>';
                    }
                }
            } else {
                $norebro_menu = NorebroSettings::get('hamburger_menu');
                if(in_array($norebro_menu, array(NULL, 'inherit'))) {
                    if (NorebroSettings::get('hamburger_menu', 'global')) {
                        wp_nav_menu(array('menu' => NorebroSettings::get('hamburger_menu' , 'global'), 'menu_id' => 'secondary-menu'));
                    } else {
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'secondary-menu' ) );
                        } else {
                            echo '<span class="menu-not-assigned">' . sprintf( esc_html__( 'Please %1$s assign a menu %2$s to the primary menu location', 'norebro' ), '<a href="' . esc_url( home_url( '/' ) ) . 'wp-admin/nav-menus.php">', '</a>' ) . '</span>';
                        }
                    }
                } else {
                    wp_nav_menu(array('menu' => NorebroSettings::get('hamburger_menu'), 'menu_id' => 'secondary-menu'));
                }
            }
            ?>
		</div>
	</div>

	<?php if ( $have_wpml ) : ?>
	<div class="languages">
		<?php
		$languages = icl_get_languages('orderby=name');
		foreach( $languages as $language ) {
			$class = ( $language['active'] ) ? ' class="active"' : '';
			printf( '<a href="%1$s"%2$s><span>%3$s</span></a> ', $language['url'], $class,
				$language['language_code'] );
		}
		?>
	</div>
	<?php endif; ?>

	<div class="copyright">
		<span class="content">
			<?php echo wp_kses( NorebroSettings::get( 'footer_copyright_left', 'global' ), 'post' ); ?>
			<br>
			<?php echo wp_kses( NorebroSettings::get( 'footer_copyright_right', 'global' ), 'post' ); ?>
		</span>

		<?php if ( $header_have_social ) : ?>
		<div class="socialbar small outline">
			<?php while( have_rows( 'global_header_menu_social_links', 'option' ) ): the_row(); ?>
				<?php switch ( get_sub_field( 'social_network' ) ) {
					case 'behance':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="behance"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-behance"></i></a>';
						break;
					case 'digg':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="digg"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-digg"></i></a>';
						break;
					case 'discord':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="discord"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-discord"></i></a>';
						break;
					case 'dribbble':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="dribbble"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-dribbble"></i></a>';
						break;
					case 'facebook':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="facebook"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-facebook-f"></i></a>';
						break;
					case 'flickr':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="flickr"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-flickr"></i></a>';
						break;
					case 'github':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="github"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-github-alt"></i></a>';
						break;
					case 'instagram':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="instagram"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-instagram"></i></a>';
						break;
					case 'kaggle':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="kaggle"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-kaggle"></i></a>';
						break;
					case 'linkedin':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="linkedin"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-linkedin"></i></a>';
						break;
					case 'medium':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="medium"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-medium-m"></i></a>';
						break;
					case 'mixer':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="mixer"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-mixer"></i></a>';
						break;
					case 'pinterest':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="pinterest"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-pinterest"></i></a>';
						break;
					case 'quora':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="quora"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-quora"></i></a>';
						break;
					case 'reddit':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="reddit"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-reddit-alien"></i></a>';
						break;
					case 'snapchat':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="snapchat"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-snapchat"></i></a>';
						break;
					case 'soundcloud':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="soundcloud"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-soundcloud"></i></a>';
						break;
					case 'spotify':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="spotify"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-spotify"></i></a>';
						break;
					case 'teamspeak':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="teamspeak"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-teamspeak"></i></a>';
						break;
					case 'telegram':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="telegram"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-telegram-plane"></i></a>';
						break;
					case 'tiktok':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="tiktok"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-tiktok"></i></a>';
						break;
					case 'tumblr':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="tumblr"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-tumblr"></i></a>';
						break;
					case 'twitch':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="twitch"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-twitch"></i></a>';
						break;
					case 'twitter':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="twitter"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-twitter"></i></a>';
						break;
					case 'vimeo':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vimeo"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-vimeo"></i></a>';
						break;
					case 'vine':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vine"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-vine"></i></a>';
						break;
					case 'vk':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="vk"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-vk"></i></a>';
						break;
					case 'whatsapp':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="whatsapp"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-whatsapp"></i></a>';
						break;
					case 'xing':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="xing"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-xing"></i></a>';
						break;
					case 'youtube':
						echo '<a href="' . esc_url( get_sub_field( 'url' ) ) . '" class="youtube"'. (get_sub_field( 'in_new_tab' ) ? 'target="_blank"' : '') .'><i class="fab fa-youtube"></i></a>';
						break;
				} ?>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="close" id="fullscreen-menu-close">
		<span class="ion-ios-close-empty"></span>
	</div>
</div>
