<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>

<form class="cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>

    <?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>

            <li class="product-cart-item">
                <div class="product-cart-info">
                    <!--                    image-->
                    <?php
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                    if (!$product_permalink) {
                        echo $thumbnail; // PHPCS: XSS ok.
                    } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                    }
                    ?>

                    <div>
                        <!--                        nom produit-->
                        <?php
                        if (!$product_permalink) {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                        } else {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                        }

                        do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                        // Meta data.
                        echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                        // Backorder notification.
                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                        }
                        ?>
                        <!--                        taille produit-->
                        <p>Taille : </p>
                        <p>Finition : </p>
                        <!--                        finition-->
                    </div>
                </div>

                <div class="product-cart-price">
                    <!--                    prix produit-->
                    <?php
                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                    <!--                    suppr produit-->
                    <?php
                    echo apply_filters(
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
<svg width="27" height="28" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.16699 6.92123H24.3522M9.78736 2.94901H17.7318M11.1114 20.162V12.2175M16.4077 20.162V12.2175M18.3938 25.4583H9.12533C7.66279 25.4583 6.47718 24.2727 6.47718 22.8101L5.87261 8.30042C5.84126 7.54818 6.44264 6.92123 7.19553 6.92123H20.3236C21.0765 6.92123 21.6779 7.54818 21.6466 8.30042L21.042 22.8101C21.042 24.2727 19.8564 25.4583 18.3938 25.4583Z" stroke="black" stroke-width="2.20679" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

</a>',
                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                            esc_html__('Remove this item', 'woocommerce'),
                            esc_attr($product_id),
                            esc_attr($_product->get_sku())
                        ),
                        $cart_item_key
                    );
                    ?>
                </div>
            </li>

            <?php
        }
    }
    ?>

    <!--<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <tbody>
            <?php /*do_action( 'woocommerce_cart_contents' ); */ ?>

            <tr>
                <td colspan="6" class="actions">

                    <?php /*do_action( 'woocommerce_cart_actions' ); */ ?>

                    <?php /*wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); */ ?>
                </td>
            </tr>

            <?php /*do_action( 'woocommerce_after_cart_contents' ); */ ?>
        </tbody>
    </table>-->
    <?php do_action('woocommerce_after_cart_table'); ?>
</form>

<!-- total panier-->
<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-collaterals">
    <?php
    do_action('woocommerce_cart_collaterals');
    ?>
</div>

<?php do_action('woocommerce_after_cart'); ?>
