<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>

    <div class="recap-content">
        <ul>
            <?php
            do_action('woocommerce_review_order_before_cart_contents');

            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    ?>
                    <li class="recap-cart-item">
                        <?php echo $_product->get_image(); ?>
                        <div>
                            <p class="recap-item-title"><?php echo explode("-", $_product->get_name())[0]; ?></p>
                            <p>Taille&nbsp;:&nbsp;<?php echo $_product->attributes['taille']; ?></p>
                            <p>Finition&nbsp;:&nbsp;<?php echo $_product->attributes['finition']; ?></p>
                            <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
                            <p class="recap-item-price">
                                Prix&nbsp;:&nbsp;<span><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?></span>
                            </p>
                        </div>
                    </li>
                    <?php
                }
            }
            do_action('woocommerce_review_order_after_cart_contents');
            ?>
        </ul>

        <hr/>

        <div>
            <p>Sous total&nbsp;:&nbsp;<span><?php wc_cart_totals_subtotal_html(); ?></span></p>

            <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                <p>
                    <?php echo esc_html($fee->name); ?>&nbsp;:&nbsp;
                    <span><?php wc_cart_totals_fee_html($fee); ?></span>
                </p>
            <?php endforeach; ?>

            <?php do_action('woocommerce_review_order_before_order_total'); ?>
            <p style="font-weight: bold;">Total&nbsp;:&nbsp;<span><?php wc_cart_totals_order_total_html(); ?></span></p>
            <?php do_action('woocommerce_review_order_after_order_total'); ?>
        </div>
    </div>

<?php /*if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : */ ?><!--

    <?php /*do_action('woocommerce_review_order_before_shipping'); */ ?>

    <?php /*wc_cart_totals_shipping_html(); */ ?>

    <?php /*do_action('woocommerce_review_order_after_shipping'); */ ?>

--><?php /*endif; */ ?>