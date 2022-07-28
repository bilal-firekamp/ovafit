<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
 * @version 3.5.2
 */

if (!defined('ABSPATH')) {
	exit;
}

?>

<div class="vc_row wpb_row vc_row-no-padding vc_row-fluid" data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true">
	<div class="vc_col-md-5 wpb_column vc_column_container leftsideoflogin">
		<img src="/wp-content/uploads/2022/07/Rectangle-4857@2x-1.png" alt="" />
	</div>
	<div class="vc_col-md-7 wpb_column vc_column_container tab-box_login">

		<h3 class="second-title text-left">
			<?php esc_html_e('Forgot Your Password?', 'norebro'); ?>
		</h3>
		<form method="post" class="woocommerce-ResetPassword lost_reset_password">
			<p style="font-size: 16px;line-height: 22px" class="text-left"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Please enter your email address or User name, we will send you an email to reset your password.', 'norebro')); ?></p>
			<p class="woocommerce-FormRow form-row">
				<input placeholder="<?php esc_html_e('Username or email', 'norebro'); ?>" type="text" name="user_login" id="user_login" />
			</p>
			<?php do_action('woocommerce_lostpassword_form'); ?>
			<p class="woocommerce-FormRow form-row">
				<input type="hidden" name="wc_reset_password" value="true" />
				<input type="submit" class="btn left" value="<?php esc_attr_e('Reset Password', 'norebro'); ?>" />
			</p>
			<div class="clear"></div>
			<?php wp_nonce_field('lost_password'); ?>
		</form>
	</div>
</div>