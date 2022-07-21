<?php


// Comments
function norebro_comment( $comment, $args, $depth ) {
	if ( $args['style'] === 'div' ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>

	<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) { echo get_avatar( $comment, 'thumbnail' ); } ?>
		<?php printf( '<h4 class="title text-left">%s</h4>', get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'norebro' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( esc_html__('%1$s at %2$s', 'norebro'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( 'Edit', 'norebro' ), '  ', '' );
		?>
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'reply_text' => esc_html__('Leave reply', 'norebro'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
	</div>
	<div class="comment-content">
		<?php comment_text(); ?>
	</div>

  <?php if ( 'div' != $args['style'] ) : ?>
	</div>
  <?php endif;
}

// Posts count ( with woocommerce compability )
function norebro_post_queries( $query ) {
	// not an admin page and it is the main query
	if ( ! is_admin() && $query->is_main_query() ){
		if ( isset( $query->query_vars['wc_query'] ) && $query->query_vars['wc_query'] == 'product_query' ) {
			if ( function_exists( 'get_field' ) ) {
				$posts_count = NorebroSettings::get( 'woocommerce_products_on_page', 'global' );
			} else {
                $posts_count = get_option('options_global_woocommerce_products_on_page');
                if (empty($posts_count)) {
                    $posts_count = false;
                }
			}
			if ( $posts_count && $posts_count > 0 ) {
				$query->set( 'posts_per_page', $posts_count );
			}
		} else {
			if ( function_exists( 'get_field' ) ) {
				$posts_count = NorebroSettings::posts_per_page();
			} else {
                $posts_count = get_option('options_global_blog_posts_per_page');
                if (empty($posts_count)) {
                    $posts_count = false;
                }
			}
			if ( $posts_count && $posts_count > 0 && $posts_count < 1000 ) {
				$query->set( 'posts_per_page', $posts_count );
			} else {
				$query->set( 'posts_per_page', 10 );
			}
		}
	}
}
add_action( 'pre_get_posts', 'norebro_post_queries' );



/**
 * TinyMCE Plugin
 */

function norebro_override_tmce_buttons() {
  add_filter( "mce_external_plugins", "norebro_tmce_add_buttons" );
  add_filter( 'mce_buttons', 'norebro_tmce_register_buttons' );
}

add_action( 'init', 'norebro_override_tmce_buttons' );


function norebro_tmce_add_buttons( $plugin_array ) {
  $plugin_array['norebro'] = get_template_directory_uri() . '/assets/js/norebro-tinymce.js';
  return $plugin_array;
}

function norebro_tmce_register_buttons( $buttons ) {
  array_push( $buttons, 'norebro_shortcodes' );
  return $buttons;
}


function norebro_tmce_editor_style( $url ) {
  add_editor_style( 'css/tinymce-styles.css' );
}

add_filter( 'admin_init', 'norebro_tmce_editor_style' );


/**
* Post gallery
*/
function norebro_post_gallery_override( $output, $atts, $instance ) {
	$return = $output; // fallback
	$my_result = NorebroHelper::parse_gallery_layout( $atts );
	if( !empty( $my_result ) ) {
		$return = $my_result;
	}
	return $return;
}

add_filter( 'post_gallery', 'norebro_post_gallery_override', 10, 3 );





// Contact form 7 custom loading image
add_filter( 'wpcf7_ajax_loader', 'norebro_wpcf7_ajax_loader' );

function norebro_wpcf7_ajax_loader () {
	return get_template_directory_uri() . '/assets/images/form_load.png';
}


// Fix wpautop shortcodes
function norebro_fix_wpautop_shortcodes( $content ){   
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr( $content, $array );
    return $content;
}

add_filter( 'the_content', 'norebro_fix_wpautop_shortcodes' );


// Hook for search widget
function norebro_override_search_form( $text ) {
	$text = str_replace( 'type="search"', 'type="text"', $text );
	return $text;
}

add_filter( 'get_search_form', 'norebro_override_search_form' );


// Custom arguments for cloud widget
function norebro_override_tag_cloud_widget( $args ) {
	$args['smallest'] = 11;
	$args['largest'] = 11;
	$args['unit'] = 'px';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'norebro_override_tag_cloud_widget' );


// Add content, except and feature image fields to portfolio posts
function norebro_override_save_portfolio_post ( $post_id, $post, $update ) {
	$post_type = get_post_type($post_id);

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if ( $post_type != "norebro_portfolio" || $update == false ) return;

	if ( isset( $_POST['acf'] ) && isset( $_POST['acf']['field_5819a27ed1cb0'] ) && is_array( $_POST['acf']['field_5819a27ed1cb0'] ) ) {
		set_post_thumbnail( $post, sanitize_text_field( $_POST['acf']['field_5819a27ed1cb0'][0] ) );
	}

	if ( isset( $_POST['acf'] ) && isset( $_POST['acf']['field_5818b9e99d327'] ) ) {
		$post_update = array( 'ID' => $post_id );
		$post_update['post_excerpt'] = substr( sanitize_text_field( $_POST['acf']['field_5818b9e99d327'] ), 0, 120 ) . '&hellip;';
		
		remove_action( 'save_post', 'norebro_override_save_portfolio_post' );
		wp_update_post( $post_update );
		add_action( 'save_post', 'norebro_override_save_portfolio_post' );
	}
}

add_action( 'save_post', 'norebro_override_save_portfolio_post', 10, 3 );


// AJAX sign in
add_action( 'wp_ajax_norebro_ajax_logout', 'norebro_ajax_login' );
add_action( 'wp_ajax_nopriv_norebro_ajax_login', 'norebro_ajax_logout' );
add_action( 'wp_ajax_nopriv_norebro_ajax_signup', 'norebro_ajax_signup' );

function norebro_ajax_login(){
	$info = array();
	$info['user_login'] = esc_attr( $_POST['username'] );
	$info['user_password'] = esc_attr( $_POST['password'] );
	$info['remember'] = esc_attr( $_POST['remember'] );

	$user_signon = wp_signon( $info, false );
	if ( is_wp_error( $user_signon ) ) {
		echo json_encode( array(
			'loggedin' => false,
			'message' => $user_signon->get_error_message()
		) );
	} else {
		echo json_encode( array( 
			'loggedin' => true,
			'message' => 'success',
			'username' => $user_signon->display_name
		) );
	}

	die();
}

function norebro_ajax_logout(){
	wp_logout();
	echo json_encode( array( 'logout' => true ) );
	die();
}

function norebro_ajax_signup(){
	$user_login = esc_attr( $_POST['username'] );
	$user_email = esc_attr( $_POST['email'] );

	$errors = register_new_user( $user_login, $user_email );
	if ( !is_wp_error($errors) ) {
		echo json_encode( array( 
			'success_reg' => true, 
			'message' => esc_html__( 'Registration complete. Check your email.', 'norebro' ) 
		) );
	} else {
		$first = key($errors->errors);
		echo json_encode( array( 
			'success_reg' => false, 
			'message' => $errors->errors[$first]
		) );
	}
	die();
}

// Body classes
function norebro_body_classes( $classes ){
	$classes[] = 'norebro-theme-1-0-0';

	if ( NorebroSettings::get_onepage_mode() ) {
		$classes[] = 'norebro-anchor-onepage';
	}
	if ( NorebroSettings::side_panel_have_padding() ) {
		$classes[] = 'norebro-with-panel';
	}
	if ( NorebroSettings::header_menu_style() == 'style6' ) {
		$classes[] = 'norebro-with-header-6';
	}

	return $classes;
}

add_filter( 'body_class', 'norebro_body_classes' );


add_filter( 'excerpt_length', function(){
    if ($length = NorebroSettings::get('posts_content_length', 'global')) {
        return $length;
    }
    return 14;
} );

add_filter('excerpt_more', function($more) {
    return '...';
});

// Search
function norebro_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'norebro_search_join' );

function norebro_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'norebro_search_where' );

function norebro_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'norebro_search_distinct' );

function norebro_wpkses_post_tags( $tags, $context ) {
    if ( 'post' === $context ) {
        $tags['iframe'] = array(
            'src' => true,
            'height' => true,
            'width' => true,
            'frameborder' => true,
            'allowfullscreen' => true,
        );
    }

    return $tags;
}
add_filter( 'wp_kses_allowed_html', 'norebro_wpkses_post_tags', 10, 2 );