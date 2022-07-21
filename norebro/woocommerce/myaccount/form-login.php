<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">
	<div class="u-column1 col-1">

	<?php endif; ?>
		<div class="vc_row">
			<div class="vc_col-md-12 myaccount-login-form">
				<div class="norebro-tabs-sc tab-box tabs-center" id="norebro-5b28a6d084e39" data-norebro-tab-box="true" data-options="{}">
				<div class="buttons-wrap">
					<div class="buttons <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'no' ){ echo single;}?>" role="tablist">
						<div class="line brand-bg-color" style="width: 60px; transform: translateX(0px);"></div>

						<h2 class="button active second-title text-left">
							<?php esc_html_e( 'Sign in', 'norebro' ); ?>
						</h2>
						<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) { ?>
							<h2 class="button title text-left">
								<?php esc_html_e( 'Registration', 'norebro' ); ?>
							</h2> 
						<?php } ?>
					</div>
				</div>

				<div class="items" role="tabpanel">
					<div class="item active" data-title="<?php esc_html_e( 'Sign In', 'norebro' ); ?>">
						<form method="post" class="login">

							<?php do_action( 'woocommerce_login_form_start' ); ?>

							<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
								<input type="text" placeholder="<?php esc_attr_e( 'Username or email address', 'norebro' ); ?>"  name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
							</p>
							<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
								<input placeholder="<?php esc_attr_e( 'Password', 'norebro' ); ?>" type="password" name="password" id="password" />
							</p>

							<?php do_action( 'woocommerce_login_form' ); ?>

							<p class="form-row">
								<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
								<input type="submit" class="woocommerce-Button btn" name="login" value="<?php esc_attr_e( 'Login', 'norebro' ); ?>" />
								<span class="clear"></span>
								<label for="rememberme" class="inline left">
									<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'norebro' ); ?>
								</label>
								<a class="lost-link right" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'norebro' ); ?></a>
								<span class="clear"></span>
							</p>

							<?php do_action( 'woocommerce_login_form_end' ); ?>

						</form>
					</div>
				
					<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
						<div class="item" data-title="<?php esc_html_e( 'Registration', 'norebro' ); ?>">
								<form method="post" class="register">

								<?php do_action( 'woocommerce_register_form_start' ); ?>

								<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<input type="text" placeholder="<?php esc_attr_e( 'Username', 'norebro' ); ?>" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
									</p>

								<?php endif; ?>

								<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
									<input type="email" placeholder="<?php esc_attr_e( 'Email address', 'norebro' ); ?>" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
								</p>

								<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

									<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
										<input type="password" placeholder="<?php esc_attr_e( 'Password', 'norebro' ); ?>" name="password" id="reg_password" />
									</p>

								<?php endif; ?>

								<!-- Spam Trap -->
								<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'norebro' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

								<?php do_action( 'woocommerce_register_form' ); ?>
								<?php do_action( 'register_form' ); ?>

								<p class="woocomerce-FormRow form-row">
									<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
									<input type="submit" class="woocommerce-Button btn" name="register" value="<?php esc_attr_e( 'Register', 'norebro' ); ?>" />
								</p>

								<?php do_action( 'woocommerce_register_form_end' ); ?>

							</form>
						</div>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>