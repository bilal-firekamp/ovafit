<?php if ( NorebroSettings::get( 'page_show_arrow', 'global' ) ) : ?>

<a class="scroll-top" id="page-scroll-top">
	<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/scroll-top.svg' ); ?>" alt="<?php esc_attr_e( 'Scroll to top', 'norebro' ); ?>">
</a>

<?php endif; ?>