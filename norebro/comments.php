<?php
	if ( post_password_required() ) return;

	function wpb_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
	 
	add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

	$comments_class = '';
	if ( !have_comments() ) { 
		$comments_class .= ' no-comments'; 
	}

	$page_wrapped = NorebroSettings::page_is_wrapped();
?>

<div class="page-container<?php if ( ! $page_wrapped ) {	echo ' full'; } ?>">

<div id="comments" class="comments-area<?php echo esc_attr( $comments_class ); ?>">

	<?php if ( have_comments() ) : ?>
		<h3 class="title text-left comments-title">
			<?php 
				/* translators: %1: count comments */
				printf( esc_html( _nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'norebro' ) ),
					esc_html( number_format_i18n( get_comments_number() ) ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="title screen-reader-text"><?php esc_html_e( 'Comment navigation', 'norebro' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'norebro' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'norebro' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( 'callback=norebro_comment' );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="title screen-reader-text"><?php esc_html_e( 'Comment navigation', 'norebro' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'norebro' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'norebro' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().

	if ( comments_open() ) {

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$req_mark = ( $req ? '*' : '' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$args = array(
			'title_reply' => '<h3 class="title text-left">' . esc_html__( 'Post a Comment', 'norebro' ) . '</h3>',
			/* translators: %s: nickname */
			'title_reply_to' => esc_html__( 'Post a Reply to %s', 'norebro' ),
			'cancel_reply_link' => esc_html__( 'Click here to cancel reply', 'norebro' ),
			'label_submit' => esc_html__( 'Submit Comment', 'norebro' ),
			'comment_field' => '<textarea id="comment" placeholder="' . esc_attr__( 'Comment', 'norebro' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="input-group"><div class="input-wrap"><label for="author" class="col-4"><input id="author" name="author" placeholder="' . esc_attr__( 'Name', 'norebro' ) . $req_mark . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></label>',
				'url' => '<label for="email" class="col-4"><input id="email" name="email" placeholder="'. esc_attr__( 'E-mail', 'norebro' ) . $req_mark . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></label>',
				'email' => '<label for="url" class="col-4"><input id="url" name="url" type="text" placeholder="'. esc_attr__( 'Website', 'norebro' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></label></div></div>'
				) 
			),
			'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-outline submit-comment %3$s" value="%4$s" />',
		);

		comment_form( $args );

	}

?>

</div><!-- #comments -->

</div><!-- .page-container -->
