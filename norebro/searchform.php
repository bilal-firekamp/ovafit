<form role="search" class="search search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
	<label>
		<span class="screen-reader-text"><?php echo esc_html__( 'Search for', 'norebro' ) . ':'; ?></span>
		<input type="text" class="search-field" name="s" placeholder="<?php esc_html_e( 'Search...', 'norebro' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
	</label>
	<button type="submit" class="search search-submit">
		<span class="ion-ios-search-strong"></span>
	</button>
</form>