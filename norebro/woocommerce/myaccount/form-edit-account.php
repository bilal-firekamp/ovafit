<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_edit_account_form' ); ?>


<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

	<div class="vc_row">
		<div class="vc_col-sm-6">
			<h4 class="title"><?php esc_html_e( 'Account Details', 'norebro' ); ?></h4>

			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

			<p class="woocommerce-FormRow woocommerce-FormRow--first form-row">
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" placeholder="<?php esc_attr_e( 'First name', 'norebro' ); ?>" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--last form-row">
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" placeholder="<?php esc_attr_e( 'Last name', 'norebro' ); ?>" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="<?php esc_attr_e( 'Email address', 'norebro' ); ?>" />
			</p>
		</div>
		<div class="vc_col-sm-6">
			
			<h4 class="title woocommerce-password-title">
				<?php esc_html_e( 'Password Change', 'norebro' ); ?>
			</h4>

			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" placeholder="<?php esc_attr_e( 'Current Password', 'norebro' ); ?>" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" placeholder="<?php esc_attr_e( 'New Password', 'norebro' ); ?>" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" placeholder="<?php esc_attr_e( 'Confirm New Password', 'norebro' ); ?>" />
			</p>
			<?php do_action( 'woocommerce_edit_account_form' ); ?>

		</div>
	</div>
	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<input type="submit" class="btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'norebro' ); ?>" />
		<input type="hidden" name="action" value="save_account_details" />
	</p>
		
	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
