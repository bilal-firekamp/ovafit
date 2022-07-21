<?php

if ( ! function_exists( 'norebro_return_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function norebro_posted_time() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		// MODIFIED DATA REFUND
		// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		// 	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		// }

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )

			// MODIFIED DATA REFUND
			//esc_attr( get_the_modified_date( 'c' ) ),
			//esc_html( get_the_modified_date() )
		);

		return $time_string;
	}

	function norebro_return_posted_on() {
		$time_string = norebro_posted_time();

		$posted_on = sprintf( '%s', $time_string );

		echo '<span class="author">' . esc_html( get_the_author() ) . '</span>';
		echo ' <strong>-</strong>';
		echo ' <span class="data">' . $posted_on . '</span>';

	}
}



if ( ! function_exists( 'norebro_return_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function norebro_return_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			global $post;
			$hide_tags = NorebroSettings::get( 'post_hide_tags', 'global' );
			$hide_social = NorebroSettings::get( 'post_hide_social', 'global' );

			if ( !$hide_tags ) {
				echo '<div class="left">';
				/* translators: used between list items, there is a space after the comma */
				/*$categories_list = get_the_category_list( ' ' );
				if ( $categories_list && norebro_categorized_blog() ) {
					$categories_list = preg_replace( '/(<a)(.+?>)/i', '$1 class="brand-color brand-border-color" $2 ', $categories_list );
					printf( '<span class="category subtitle-font">%1$s</span>', $categories_list ); // WPCS: XSS OK.
				}*/
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ) {
					$tags = explode( ', ', $tags_list );
					foreach( $tags as $tag ) {
						printf( '<span class="tag-wrap">%1$s</span>', $tag ); // WPCS: XSS OK.
					}
				}
				echo '</div>';
			}

			echo '<div class="right">';
			if ( !$hide_social ) {
				do_shortcode( '[norebro_share_blog]' );
			}
			echo '</div><div class="clear"></div>';
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: post title */
			comments_popup_link( sprintf( esc_html__( 'Leave a Comment %1$s on %2$s', 'norebro' ), '<span class="screen-reader-text">', get_the_title() . '</span>' ) );
			echo '</span>';
		}

		edit_post_link(
			get_the_title( '<span class="screen-reader-text">"', '"</span>', false )
		);
	}

}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function norebro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'norebro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'norebro_categories', $all_the_cool_cats );
	}

	return true;
}

/**
 * Flush out the transients used in norebro_categorized_blog.
 */
function norebro_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'norebro_categories' );
}

// add_action( 'edit_category', 'norebro_category_transient_flusher' );
// add_action( 'save_post',     'norebro_category_transient_flusher' );
