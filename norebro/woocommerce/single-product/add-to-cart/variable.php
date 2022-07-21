<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

function is_color_attr($options, $attribute_name)
{
    $custom = false;

    foreach ($options as $option):
        $term = get_term_by('slug', $option, $attribute_name);
        if ($term) {
            if (get_field('color', $term)) {
                $custom = true;
                break;
            }
        }
    endforeach;

    return $custom;
}

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data'
      data-product_id="<?php echo absint($product->get_id()); ?>"
      data-product_variations="<?php echo htmlspecialchars(json_encode($available_variations)) ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <button type="submit" class="single_add_to_cart_button btn btn-small alt" disabled="true">
            <?php echo _e('This product is currently out of stock and unavailable.', 'norebro'); ?>
        </button>
    <?php else : ?>
        <div class="variations">

            <?php foreach ($attributes as $attribute_name => $options) :

                $is_custom_attribute = wp_get_post_terms($product->get_id(), $attribute_name, array("fields" => "all"));

                $display = ('variation_' . sanitize_title($attribute_name) == 'variation_pa_frame') ? 'none' : 'block';
                ?>

                <div id="variation_<?php echo sanitize_title($attribute_name); ?>"
                     class="variation<?php echo is_wp_error($is_custom_attribute) ? ' custom_attribute' : ' registrated_attribute' ?>"
                     style="display:<?php echo esc_attr($display); ?>">

                    <div class="label">
                        <label for="<?php echo sanitize_title($attribute_name); ?>">
                            <?php echo wc_attribute_label($attribute_name); ?>:
                        </label>
                    </div>

                    <div class="value">
                        <?php

                        if (is_wp_error($is_custom_attribute)) {
                            $selected = isset($_REQUEST['attribute_' . sanitize_title($attribute_name)]) ? wc_clean(urldecode($_REQUEST['attribute_' . sanitize_title($attribute_name)])) : $product->get_variation_default_attribute($attribute_name);
                            wc_dropdown_variation_attribute_options(array('options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected, 'class' => 'test', 'show_option_none' => esc_html('Choose an option', 'norebro')));
                        } else {

                            echo '<div class="custom_select" style="display: none">';
                            $selected = isset($_REQUEST['attribute_' . sanitize_title($attribute_name)]) ? wc_clean(urldecode($_REQUEST['attribute_' . sanitize_title($attribute_name)])) : $product->get_variation_default_attribute($attribute_name);

                            wc_dropdown_variation_attribute_options(array('options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected, 'class' => 'test', 'show_option_none' => wc_attribute_label($attribute_name)));

                            echo "</div>";

                            echo '<div class="register_attr">';
                            $defalt_option = $product->get_variation_default_attribute($attribute_name);
                            foreach ($options as $option):
                                $active = '';
                                if ($defalt_option == $option) {
                                    $active = 'active';
                                }
                                $term = get_term_by('slug', $option, $attribute_name);

                                if (get_field('color', $term)) {
                                    echo '
                                    <a href="javascript:void(0);" class="variation_button">
                                    <span class="phoen_swatches color-item ' . $active . '"  data-option=' . $option . ' style="background-color: ' . get_field('color', $term) . ';"></span>
                                    </a>
                                    ';
                                } else {
                                    echo '
                                    <a href="javascript:void(0);" class="variation_button">
                                    <span class="phoen_swatches ' . $active . '"  data-option=' . $option . ' style="margin-right: 12px;">' . $term->name . '</span>
                                    </a>
                                    ';
                                }

                            endforeach;
                            echo '</div>';


                        } ?>


                    </div>
                </div>

                <?php
                echo end($attribute_keys) === $attribute_name ? apply_filters('woocommerce_reset_variations_link', '<td class="reset"><a class="reset_variations" href="#"><i class="ion-left ion-ios-close-outline"></i><span>' . esc_html__('Reset', 'norebro') . '</span></a></td>') : '';
                ?>

            <?php endforeach; ?>


        </div>

        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <div class="single_variation_wrap">
            <?php
            /**
             * woocommerce_before_single_variation Hook.
             */
            do_action('woocommerce_before_single_variation');

            /**
             * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
             * @since 2.4.0
             * @hooked woocommerce_single_variation - 10 Empty div for variation data.
             * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
             */
            do_action('woocommerce_single_variation');

            /**
             * woocommerce_after_single_variation Hook.
             */
            do_action('woocommerce_after_single_variation');
            ?>
        </div>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php
do_action('woocommerce_after_add_to_cart_form');
