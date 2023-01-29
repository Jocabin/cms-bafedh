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
                    <!--image-->
                    <?php
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                    if (!$product_permalink) {
                        echo $thumbnail; // PHPCS: XSS ok.
                    } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                    }
                    ?>

                    <div>
                        <!--nom produit-->
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
                        <p>Taille : <?php echo $_product->attributes['taille']; ?></p>
                        <p>Finition : <?php echo $_product->attributes['finition']; ?></p>
                    </div>
                </div>

                <div class="product-cart-price">
                    <!--prix produit-->
                    <?php
                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                    <!--suppr produit-->
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

    <?php do_action('woocommerce_after_cart_table'); ?>
</form>

<!--total panier-->
<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-footer">
    <div class="cart-collaterals">
        <div class="moyen-paiement">
            <h2>Moyen de paiement</h2>
            <ul>
                <li>
                    <svg width="64" height="44" viewBox="0 0 64 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.456929" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M32.4421 31.358C30.2643 33.2374 27.4392 34.372 24.3523 34.372C17.4642 34.372 11.8804 28.7233 11.8804 21.7553C11.8804 14.7873 17.4642 9.13858 24.3523 9.13858C27.4393 9.13858 30.2643 10.2731 32.4421 12.1525C34.62 10.2731 37.445 9.1386 40.532 9.1386C47.42 9.1386 53.0039 14.7873 53.0039 21.7553C53.0039 28.7233 47.42 34.372 40.532 34.372C37.445 34.372 34.62 33.2374 32.4421 31.358Z"
                              fill="#ED0006"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M32.4424 31.3581C35.124 29.0439 36.8244 25.6005 36.8244 21.7553C36.8244 17.9101 35.124 14.4667 32.4424 12.1525C34.6202 10.2732 37.4453 9.13861 40.5322 9.13861C47.4203 9.13861 53.0041 14.7873 53.0041 21.7553C53.0041 28.7233 47.4203 34.372 40.5322 34.372C37.4453 34.372 34.6202 33.2374 32.4424 31.3581Z"
                              fill="#F9A000"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M32.4425 31.3579C35.1241 29.0438 36.8244 25.6004 36.8244 21.7553C36.8244 17.9101 35.1241 14.4667 32.4425 12.1526C29.7609 14.4667 28.0605 17.9101 28.0605 21.7553C28.0605 25.6004 29.7609 29.0438 32.4425 31.3579Z"
                              fill="#FF5E00"/>
                    </svg>
                </li>

                <li>
                    <svg width="65" height="44" viewBox="0 0 65 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.27333" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M18.9109 27.856H16.0677C15.8732 27.856 15.7077 27.9975 15.6773 28.1895L14.5274 35.4803C14.5045 35.6242 14.616 35.7539 14.7619 35.7539H16.1193C16.3138 35.7539 16.4793 35.6125 16.5096 35.4201L16.8198 33.4537C16.8497 33.2611 17.0156 33.1199 17.2098 33.1199H18.1098C19.9828 33.1199 21.0636 32.2135 21.346 30.4175C21.4732 29.6318 21.3514 29.0144 20.9834 28.5819C20.5794 28.1073 19.8625 27.856 18.9109 27.856ZM19.239 30.5189C19.0835 31.5392 18.304 31.5392 17.5503 31.5392H17.1212L17.4222 29.6337C17.4401 29.5187 17.5398 29.4339 17.6563 29.4339H17.8529C18.3663 29.4339 18.8507 29.4338 19.101 29.7265C19.2501 29.9012 19.2959 30.1605 19.239 30.5189ZM27.41 30.4862H26.0485C25.9325 30.4862 25.8322 30.5711 25.8143 30.6863L25.7541 31.0671L25.6589 30.9291C25.3641 30.5012 24.7069 30.3583 24.0509 30.3583C22.5462 30.3583 21.2612 31.4978 21.0109 33.0964C20.8808 33.8937 21.0657 34.6561 21.518 35.1879C21.933 35.6768 22.5267 35.8805 23.233 35.8805C24.4453 35.8805 25.1177 35.1009 25.1177 35.1009L25.0569 35.4794C25.034 35.624 25.1454 35.7537 25.2904 35.7537H26.5169C26.712 35.7537 26.8765 35.6123 26.9073 35.4199L27.6432 30.7598C27.6665 30.6165 27.5555 30.4862 27.41 30.4862ZM25.5121 33.1362C25.3807 33.9141 24.7633 34.4362 23.976 34.4362C23.5807 34.4362 23.2646 34.3094 23.0618 34.0691C22.8605 33.8306 22.784 33.4908 22.848 33.1126C22.9708 32.3413 23.5986 31.8022 24.3739 31.8022C24.7604 31.8022 25.0748 31.9305 25.2818 32.1729C25.4892 32.4178 25.5715 32.7595 25.5121 33.1362ZM33.2932 30.486H34.6615C34.8531 30.486 34.9649 30.7009 34.856 30.8581L30.3053 37.4268C30.2316 37.5331 30.1102 37.5964 29.9806 37.5964H28.614C28.4216 37.5964 28.3093 37.3798 28.4207 37.2222L29.8376 35.2221L28.3306 30.7994C28.2785 30.6457 28.392 30.486 28.5555 30.486H29.9C30.0746 30.486 30.2288 30.6007 30.2792 30.7679L31.0789 33.4391L32.9661 30.6594C33.04 30.5509 33.1627 30.486 33.2932 30.486Z"
                              fill="#253B80"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M48.1282 35.4803L49.2951 28.0561C49.3129 27.9408 49.4128 27.856 49.5288 27.8556H50.8425C50.9875 27.8556 51.0989 27.9856 51.076 28.1296L49.9253 35.42C49.8953 35.6124 49.7299 35.7538 49.535 35.7538H48.3618C48.2167 35.7538 48.1053 35.6242 48.1282 35.4803ZM39.1918 27.856H36.3481C36.1539 27.856 35.9885 27.9974 35.9581 28.1894L34.8082 35.4803C34.7853 35.6242 34.8967 35.7538 35.0419 35.7538H36.501C36.6367 35.7538 36.7527 35.6549 36.7738 35.5203L37.1001 33.4536C37.1301 33.261 37.296 33.1198 37.4901 33.1198H38.3897C40.263 33.1198 41.3437 32.2134 41.6263 30.4175C41.7539 29.6317 41.6313 29.0144 41.2635 28.5819C40.8596 28.1072 40.1434 27.856 39.1918 27.856ZM39.5198 30.5189C39.3648 31.5391 38.5852 31.5391 37.831 31.5391H37.4024L37.7038 29.6337C37.7217 29.5186 37.8206 29.4338 37.9374 29.4338H38.134C38.6471 29.4338 39.132 29.4338 39.3821 29.7264C39.5314 29.9011 39.5768 30.1604 39.5198 30.5189ZM47.6901 30.4862H46.3295C46.2126 30.4862 46.1133 30.571 46.0958 30.6862L46.0356 31.067L45.9399 30.929C45.6452 30.5012 44.9884 30.3582 44.3323 30.3582C42.8276 30.3582 41.543 31.4978 41.2927 33.0963C41.163 33.8936 41.3472 34.6561 41.7995 35.1878C42.2152 35.6767 42.8082 35.8804 43.5145 35.8804C44.7267 35.8804 45.3989 35.1009 45.3989 35.1009L45.3383 35.4793C45.3154 35.624 45.4268 35.7536 45.5729 35.7536H46.7988C46.9929 35.7536 47.1584 35.6122 47.1888 35.4198L47.925 30.7597C47.9475 30.6164 47.8362 30.4862 47.6901 30.4862ZM45.7924 33.1362C45.6617 33.914 45.0436 34.4361 44.2561 34.4361C43.8615 34.4361 43.5449 34.3094 43.3419 34.0691C43.1406 33.8305 43.065 33.4907 43.1283 33.1125C43.2517 32.3412 43.8787 31.8021 44.654 31.8021C45.0407 31.8021 45.3549 31.9304 45.5621 32.1729C45.7703 32.4178 45.8526 32.7595 45.7924 33.1362Z"
                              fill="#179BD7"/>
                        <path d="M29.4331 25.2478L29.7827 23.0276L29.0041 23.0095H25.2861L27.87 6.62617C27.8778 6.5767 27.904 6.53059 27.9421 6.49784C27.9802 6.4651 28.0291 6.44705 28.0798 6.44705H34.3489C36.4302 6.44705 37.8664 6.88014 38.6164 7.73496C38.9679 8.13598 39.1918 8.55503 39.3001 9.01619C39.4136 9.50009 39.4157 10.0782 39.3047 10.7833L39.2967 10.8348V11.2866L39.6483 11.4858C39.9444 11.6428 40.1795 11.8226 40.36 12.0285C40.6609 12.3713 40.8554 12.8071 40.9376 13.3237C41.0224 13.8551 40.9943 14.4873 40.8554 15.2031C40.695 16.0265 40.4356 16.7437 40.0855 17.3305C39.7632 17.8712 39.3528 18.3196 38.8657 18.6672C38.4005 18.9974 37.8478 19.248 37.2229 19.4085C36.6172 19.5661 35.9269 19.6457 35.1697 19.6457H34.6818C34.333 19.6457 33.994 19.7714 33.7281 19.9966C33.4614 20.2266 33.2848 20.5405 33.2307 20.8841L33.194 21.084L32.5764 24.9971L32.5483 25.1408C32.541 25.1864 32.5283 25.2091 32.5097 25.2245C32.4929 25.2383 32.4689 25.2478 32.4454 25.2478H29.4331Z"
                              fill="#253B80"/>
                        <path d="M39.9816 10.8871C39.9629 11.0067 39.9416 11.129 39.9175 11.2547C39.0906 15.4994 36.2623 16.9658 32.6497 16.9658H30.8105C30.3687 16.9658 29.9965 17.2866 29.9276 17.7223L28.9858 23.6948L28.7192 25.3877C28.6744 25.6737 28.895 25.9317 29.1836 25.9317H32.446C32.8323 25.9317 33.1603 25.651 33.2211 25.2701L33.2533 25.1043L33.8676 21.2064L33.907 20.9927C33.967 20.6104 34.2958 20.3297 34.6822 20.3297H35.1701C38.3307 20.3297 40.805 19.0464 41.5282 15.333C41.8303 13.7817 41.6739 12.4865 40.8745 11.5755C40.6326 11.3008 40.3325 11.0729 39.9816 10.8871Z"
                              fill="#179BD7"/>
                        <path d="M39.116 10.5425C38.9897 10.5058 38.8593 10.4723 38.7256 10.4423C38.5913 10.4129 38.4535 10.3868 38.3119 10.3641C37.816 10.2839 37.2726 10.2458 36.6905 10.2458H31.7768C31.6558 10.2458 31.5409 10.2732 31.438 10.3226C31.2114 10.4316 31.043 10.6461 31.0022 10.9088L29.9568 17.5295L29.9268 17.7226C29.9956 17.2869 30.3679 16.9661 30.8096 16.9661H32.6489C36.2614 16.9661 39.09 15.499 39.9167 11.255C39.9413 11.1293 39.9621 11.007 39.9808 10.8874C39.7716 10.7765 39.545 10.6816 39.301 10.6007C39.241 10.5806 39.1789 10.5613 39.116 10.5425Z"
                              fill="#222D65"/>
                        <path d="M31.0026 10.9086C31.0434 10.646 31.2119 10.4314 31.4384 10.3232C31.5421 10.2737 31.6563 10.2463 31.7772 10.2463H36.691C37.2732 10.2463 37.8165 10.2844 38.3123 10.3646C38.4541 10.3873 38.5919 10.4134 38.7262 10.4428C38.8599 10.4729 38.9901 10.5063 39.1165 10.543C39.1792 10.5618 39.2414 10.5811 39.3022 10.6005C39.5461 10.6814 39.7728 10.777 39.9819 10.8873C40.228 9.31863 39.98 8.2506 39.1319 7.28349C38.1969 6.21881 36.5092 5.763 34.3498 5.763H28.0806C27.6394 5.763 27.2633 6.08379 27.195 6.52023L24.5838 23.072C24.5323 23.3994 24.7849 23.6949 25.115 23.6949H28.9856L29.9573 17.5293L31.0026 10.9086Z"
                              fill="#253B80"/>
                    </svg>
                </li>

                <li>
                    <svg width="65" height="44" viewBox="0 0 65 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1.08974" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M20.0526 29.7154H16.1773L13.2713 18.6288C13.1333 18.1188 12.8405 17.6679 12.4097 17.4554C11.3345 16.9214 10.1498 16.4964 8.85742 16.2821V15.8552H15.1003C15.9619 15.8552 16.6081 16.4964 16.7158 17.2411L18.2236 25.2383L22.0971 15.8552H25.8647L20.0526 29.7154ZM28.0188 29.7154H24.3589L27.3726 15.8552H31.0325L28.0188 29.7154ZM35.7674 19.6949C35.8751 18.9484 36.5213 18.5216 37.2752 18.5216C38.46 18.4144 39.7505 18.6288 40.8275 19.1609L41.4737 16.1768C40.3967 15.7499 39.212 15.5356 38.1369 15.5356C34.5846 15.5356 31.9998 17.4554 31.9998 20.1199C31.9998 22.1469 33.8307 23.2113 35.1231 23.8524C36.5213 24.4918 37.0598 24.9186 36.9521 25.5579C36.9521 26.5169 35.8751 26.9438 34.8 26.9438C33.5076 26.9438 32.2152 26.6241 31.0324 26.0901L30.3862 29.0761C31.6786 29.6083 33.0768 29.8226 34.3692 29.8226C38.3523 29.9279 40.8275 28.01 40.8275 25.1311C40.8275 21.5058 35.7674 21.2933 35.7674 19.6949ZM53.6365 29.7154L50.7305 15.8552H47.609C46.9628 15.8552 46.3166 16.2821 46.1012 16.9214L40.7199 29.7154H44.4876L45.2396 27.6903H49.8688L50.2996 29.7154H53.6365ZM48.1475 19.5878L49.2226 24.8114H46.2089L48.1475 19.5878Z"
                              fill="#172B85"/>
                    </svg>
                </li>

                <li>
                    <svg width="65" height="44" viewBox="0 0 65 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.906147" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M15.7037 16.3269C16.5628 16.3994 17.4219 15.8921 17.9589 15.2489C18.4868 14.5876 18.8359 13.6999 18.7464 12.794C17.9857 12.8302 17.0461 13.3013 16.5091 13.9626C16.0169 14.5333 15.5963 15.4573 15.7037 16.3269ZM25.9235 27.9945V13.872H31.1587C33.8613 13.872 35.7495 15.7562 35.7495 18.51C35.7495 21.2639 33.8255 23.1662 31.0871 23.1662H28.0892V27.9945H25.9235ZM18.7374 16.499C17.9806 16.4549 17.29 16.7294 16.7322 16.9511C16.3732 17.0938 16.0692 17.2146 15.838 17.2146C15.5784 17.2146 15.2619 17.0873 14.9065 16.9444C14.4409 16.7572 13.9085 16.5431 13.3502 16.5533C12.0705 16.5715 10.8802 17.3052 10.227 18.4738C8.88462 20.8109 9.87796 24.2714 11.1756 26.1737C11.8109 27.1158 12.5716 28.1485 13.5739 28.1122C14.0148 28.0954 14.332 27.9592 14.6603 27.8182C15.0382 27.6558 15.4308 27.4872 16.0438 27.4872C16.6355 27.4872 17.011 27.6514 17.3714 27.8091C17.714 27.959 18.0431 28.103 18.5316 28.0941C19.5697 28.076 20.223 27.152 20.8583 26.2099C21.544 25.1988 21.8453 24.212 21.8911 24.0622L21.8964 24.0449C21.8953 24.0438 21.8869 24.0399 21.8719 24.0329C21.6427 23.9267 19.8908 23.1148 19.874 20.9378C19.8571 19.1104 21.2635 18.1846 21.4849 18.0388C21.4984 18.0299 21.5075 18.024 21.5116 18.0209C20.6167 16.6802 19.2207 16.5352 18.7374 16.499ZM39.705 28.1032C41.0653 28.1032 42.3271 27.4057 42.8998 26.3005H42.9446V27.9945H44.9491V20.9649C44.9491 18.9267 43.3383 17.6132 40.8595 17.6132C38.5596 17.6132 36.8593 18.9449 36.7966 20.7747H38.7475C38.9086 19.9051 39.705 19.3344 40.7968 19.3344C42.1213 19.3344 42.864 19.9594 42.864 21.1099V21.8889L40.1614 22.052C37.6468 22.206 36.2865 23.2477 36.2865 25.0595C36.2865 26.8893 37.6915 28.1032 39.705 28.1032ZM40.2865 26.4273C39.1321 26.4273 38.3983 25.8657 38.3983 25.0051C38.3983 24.1174 39.1052 23.601 40.4565 23.5195L42.8638 23.3655V24.1627C42.8638 25.4852 41.7541 26.4273 40.2865 26.4273ZM51.5982 28.5471C50.7302 31.0201 49.7368 31.8354 47.6249 31.8354C47.4638 31.8354 46.9269 31.8173 46.8016 31.781V30.087C46.9358 30.1052 47.2669 30.1233 47.4369 30.1233C48.3945 30.1233 48.9314 29.7156 49.2625 28.6558L49.4594 28.0307L45.7903 17.7491H48.0544L50.6049 26.0922H50.6496L53.2001 17.7491H55.4015L51.5982 28.5471ZM28.089 15.72H30.5858C32.4651 15.72 33.539 16.7346 33.539 18.5191C33.539 20.3037 32.4651 21.3273 30.5769 21.3273H28.089V15.72Z"
                              fill="black"/>
                    </svg>
                </li>

                <li>
                    <svg width="65" height="44" viewBox="0 0 65 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.722554" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M30.4778 28.8012V23.2798H33.3275C34.4952 23.2798 35.4809 22.8885 36.2843 22.1168L36.4772 21.9211C37.9449 20.3234 37.8485 17.8344 36.2843 16.3562C35.5023 15.5737 34.431 15.1498 33.3275 15.1715H28.7529V28.8012H30.4778ZM30.478 21.606V16.8453H33.371C33.9925 16.8453 34.5818 17.0845 35.0211 17.5192C35.9533 18.4322 35.9748 19.9539 35.0747 20.8995C34.6354 21.3668 34.0139 21.6277 33.371 21.606H30.478ZM44.5229 20.2039C43.7837 19.5191 42.7766 19.1713 41.5018 19.1713C39.8626 19.1713 38.6306 19.78 37.8164 20.9864L39.3377 21.9538C39.8948 21.1277 40.6554 20.7147 41.6196 20.7147C42.2303 20.7147 42.8195 20.943 43.2802 21.356C43.7301 21.7473 43.9872 22.3125 43.9872 22.9102V23.3124C43.323 22.9429 42.4874 22.7472 41.4589 22.7472C40.259 22.7472 39.2948 23.0298 38.577 23.6059C37.8593 24.1819 37.495 24.9427 37.495 25.9101C37.4736 26.7905 37.8485 27.6274 38.5128 28.1926C39.1877 28.8012 40.0448 29.1056 41.0518 29.1056C42.241 29.1056 43.1837 28.573 43.9015 27.5078H43.9765V28.8012H45.6264V23.0515C45.6264 21.8451 45.2621 20.8886 44.5229 20.2039ZM39.8415 27.0839C39.4879 26.8231 39.2736 26.3992 39.2736 25.9427C39.2736 25.4318 39.5094 25.0079 39.9701 24.671C40.4416 24.3341 41.0309 24.1602 41.7274 24.1602C42.6917 24.1493 43.4418 24.3667 43.9775 24.8014C43.9775 25.5405 43.6882 26.1818 43.1203 26.7252C42.606 27.2469 41.9095 27.5404 41.1809 27.5404C40.6987 27.5513 40.2273 27.3882 39.8415 27.0839ZM49.3332 32.8988L55.0969 19.4756H53.2221L50.5545 26.1709H50.5223L47.7905 19.4756H45.9156L49.6974 28.2034L47.5548 32.8988H49.3332Z"
                              fill="#3C4043"/>
                        <path d="M24.5235 22.0842C24.5235 21.5516 24.4806 21.0191 24.3949 20.4973H17.1206V23.5081H21.2881C21.1166 24.4754 20.5596 25.3449 19.7454 25.8884V27.8448H22.2308C23.6878 26.4862 24.5235 24.4754 24.5235 22.0842Z"
                              fill="#4285F4"/>
                        <path d="M17.1206 29.736C19.1989 29.736 20.9559 29.0403 22.2308 27.8448L19.7453 25.8883C19.0489 26.3666 18.1597 26.6383 17.1206 26.6383C15.1065 26.6383 13.4031 25.2579 12.7924 23.4102H10.2319V25.4318C11.539 28.073 14.2066 29.736 17.1206 29.736Z"
                              fill="#34A853"/>
                        <path d="M12.7929 23.4103C12.4715 22.4429 12.4715 21.3886 12.7929 20.4104V18.3997H10.232C9.12839 20.6061 9.12839 23.2146 10.232 25.421L12.7929 23.4103Z"
                              fill="#FBBC04"/>
                        <path d="M17.1206 17.1823C18.224 17.1606 19.2846 17.5845 20.0774 18.3562L22.2843 16.1171C20.8809 14.7911 19.0382 14.0629 17.1206 14.0846C14.2066 14.0846 11.539 15.7585 10.2319 18.3996L12.7924 20.4213C13.4031 18.5627 15.1065 17.1823 17.1206 17.1823Z"
                              fill="#EA4335"/>
                    </svg>
                </li>

                <li>
                    <svg width="64" height="44" viewBox="0 0 64 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.487202" y="0.456929" width="63.0562" height="42.9513" rx="5.02622" fill="white"
                              stroke="#D9D9D9" stroke-width="0.913857"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M34.4013 14.8811L31.1517 15.5785V12.9439L34.4013 12.2594V14.8811ZM21.1958 13.7575L18.0369 14.4291L18.0239 24.7737C18.0239 26.6851 19.461 28.0928 21.3771 28.0928C22.4387 28.0928 23.2154 27.8991 23.6427 27.6666V25.0449C23.2284 25.2128 21.1829 25.8069 21.1829 23.8955V19.3108H23.6427V16.56H21.1829L21.1958 13.7575ZM55.7756 22.2554C55.7756 18.9492 54.1703 16.3404 51.102 16.3404C48.0208 16.3404 46.1565 18.9492 46.1565 22.2295C46.1565 26.1169 48.3574 28.0799 51.5163 28.0799C53.0569 28.0799 54.2221 27.7312 55.1024 27.2404V24.6575C54.2221 25.0966 53.2123 25.3678 51.9306 25.3678C50.6748 25.3678 49.5614 24.9287 49.419 23.4048H55.7497C55.7497 23.3337 55.7544 23.1722 55.7598 22.9861L55.7598 22.9856C55.767 22.7325 55.7756 22.4339 55.7756 22.2554ZM49.3799 21.0285C49.3799 19.5691 50.2732 18.9621 51.0888 18.9621C51.8786 18.9621 52.7201 19.5691 52.7201 21.0285H49.3799ZM13.5448 19.143C12.8587 19.143 12.4444 19.3367 12.4444 19.8404C12.4444 20.3903 13.1574 20.6322 14.0419 20.9323C15.4839 21.4216 17.3819 22.0656 17.3899 24.4509C17.3899 26.7627 15.5386 28.0929 12.8457 28.0929C11.7323 28.0929 10.5154 27.8733 9.31136 27.3567V24.283C10.3989 24.8771 11.7712 25.3162 12.8457 25.3162C13.5707 25.3162 14.0886 25.1225 14.0886 24.5284C14.0886 23.9193 13.3157 23.6408 12.3826 23.3047C10.9615 22.7928 9.16895 22.147 9.16895 19.9954C9.16895 17.7095 10.9167 16.3405 13.5448 16.3405C14.6194 16.3405 15.681 16.5084 16.7555 16.9346V19.9695C15.7716 19.44 14.5287 19.143 13.5448 19.143ZM27.6693 17.5157L27.4621 16.56H24.6657V27.8604H27.9023V20.2019C28.6661 19.2075 29.9608 19.3883 30.3621 19.5304V16.56C29.9478 16.405 28.4331 16.1209 27.6693 17.5157ZM31.1515 16.56H34.4011V27.8604H31.1515V16.56ZM38.6215 17.3478C39.0746 16.9345 39.8902 16.3404 41.159 16.3404C43.4246 16.3404 45.5607 18.381 45.5737 22.1262C45.5737 26.2202 43.4634 28.0799 41.146 28.0799C40.0068 28.0799 39.3206 27.6021 38.8545 27.2663L38.8416 30.9212L35.605 31.6056V16.5471H38.4532L38.6215 17.3478ZM38.8545 24.6317C39.1652 24.9674 39.6183 25.2387 40.3822 25.2387C41.5732 25.2387 42.3759 23.9472 42.3759 22.2166C42.3759 20.5248 41.5603 19.2075 40.3822 19.2075C39.6442 19.2075 39.1782 19.4658 38.8416 19.8403L38.8545 24.6317Z"
                              fill="#6461FC"/>
                    </svg>
                </li>
            </ul>
        </div>

        <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

        <div class="total-cart">
            <div>
                <h2>Total TTC</h2>
                <?php wc_cart_totals_order_total_html(); ?>
            </div>

            <div>
                <p>Hors frais de livraison</p>
                <p>dont TVA 20%</p>
            </div>
        </div>

        <?php do_action('woocommerce_cart_totals_after_order_total'); ?>
    </div>

    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="primary-button">
        Passer au paiement
    </a>
</div>

<?php do_action('woocommerce_after_cart'); ?>
