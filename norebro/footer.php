<?php
	$header_menu_style = NorebroSettings::header_menu_style();
?>
		</div><!-- #content -->
		<?php get_template_part( 'parts/elements/footer' ); ?>
	</div><!-- #page -->

	<?php if ( $header_menu_style == 'style6' ) : ?>
	</div><!--.content-right-->
	<?php endif; ?>

	<?php if ( NorebroSettings::page_is_boxed() ) : ?>
	</div> <!-- .boxed-container -->
	<?php endif; ?>

	<?php
		NorebroLayout::get_footer_buffer_content( true );
		wp_footer(); 
	?>

	</body>
</html>