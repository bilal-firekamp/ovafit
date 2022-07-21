<?php
	get_header(); 
?>

	<?php get_template_part( 'parts/elements/header-title' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-container">
					<div class="page-error">
						<div class="content-center">
							<div class="wrap">
								<div class="page-error-content">
									<h1 class="title"><?php esc_html_e( '404', 'norebro' ); ?></h1>
									<h3 class="text-center"><?php esc_html_e( 'Oops! That page can\'t be found', 'norebro' ); ?></h3>
								</div>
								<form class="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
									<input type="text" placeholder="<?php esc_attr_e( 'Search', 'norebro' ); ?>" name="s">
									<button class="btn btn-outline" type="submit">
										<span class="icon ion-ios-search"></span>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	get_footer();