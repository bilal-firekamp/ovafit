<?php get_template_part( 'parts/elements/header-title' ); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<section class="no-result">
			<div class="page-content">
				<div class="page-error">
					<div class="content-center">
						<div class="wrap">
							<div class="icon-shape">
								<i class="ion-android-search"></i>
							</div>
							<div class="page-error-content">
								<h1><?php esc_html_e( 'No Result', 'norebro' ); ?></h1>
								<p class="subtitle">
									<?php esc_html_e( 'Sorry, but nothing matched your search criteria', 'norebro' ); ?>
								</p>
							</div>
							<?php get_search_form( true ); ?>
						</div>
					</div>
				</div>
			</div><!-- .page-content -->
		</section>

	</main><!-- #main -->
</div><!-- #primary -->
