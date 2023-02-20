<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
//wc_get_template_part('content', 'single-product');
?>

<?php
$imageSrc = wp_get_attachment_image_url($product->get_image_id(), apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full')));

function getVariationsYaakov($var, $p)
{
    $variations_ids = $p->get_children();
    $childrens = $p->get_children();
    $variations = [];

    foreach ($childrens as $index => $child) {
        $data = $p->get_child($child)->get_data();
        $attr = $data['attributes'][$var];
        $variations[$variations_ids[$index]] = $attr;
    }

    return $variations;
}

?>
    <main class="single-product">
        <input type="checkbox" id="zoomPhoto"/>
        <label for="zoomPhoto" class="zoomView">
            <img
                    src="<?php echo $imageSrc; ?>" <?php the_title('alt="', '"'); ?> />
        </label>
        <?php do_action('woocommerce_before_add_to_cart_form'); ?>
        <form class="product-section"
              action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
              method="post" enctype='multipart/form-data'>

            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
            <input type="hidden" id="variation_input" name="variation_id" value="">

            <label for="zoomPhoto">
                <img class="product-image"
                     src="<?php echo $imageSrc; ?>" <?php the_title('alt="', '"'); ?> />
            </label>

            <script defer>
                document.querySelector('#zoomPhoto').addEventListener('click', (e) => {
                    if (e.target.checked) {
                        document.body.style.overflow = 'hidden'
                    } else {
                        document.body.style.overflow = 'auto'
                    }
                })
            </script>

            <div class="product-details">
                <header>
                    <h2 class="tags"><?php echo $product->get_tags(); ?></h2>
                    <?php the_title('<h1 class="product_title entry-title">', '</h1>'); ?>
                    <p class="product-page-price"><?php echo $product->get_price_html(); ?></p>
                    <p>Taxes incluses</p>
                    <p>Plus que <?php echo $product->get_stock_quantity(); ?> en stock</p>
                </header>

                <?php if ($product->attributes['taille']['options']): ?>
                    <div class="choose-size">
                        <h3>Choisissez votre taille</h3>

                        <div class="product-options">
                            <?php foreach (getVariationsYaakov('taille', $product) as $product_attribute_key => $product_attribute) : ?>
                                <label class="product-option" for="<?php echo $product_attribute ?>-id">
                                    <?php echo $product_attribute ?>
                                    <input type="radio" name="attribute_taille"
                                           id="<?php echo $product_attribute ?>-id"
                                           value="<?php echo $product_attribute ?>"
                                           onclick="document.getElementById('variation_input').value = '<?php echo $product_attribute_key ?>'">
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($product->attributes['finition']['options']): ?>
                    <div class="choose-paper">
                        <h3>Choisissez votre finition d'impression</h3>

                        <div class="product-options">
                            <?php foreach (getVariationsYaakov('finition', $product) as $product_attribute_key => $product_attribute) : ?>
                                <label class="product-option" for="<?php echo $product_attribute ?>-id">
                                    <?php echo $product_attribute ?>
                                    <input type="radio" name="product_attribute_finition"
                                           id="<?php echo $product_attribute ?>-id">
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php echo apply_filters('woocommerce_short_description', $post->post_content); ?>

                <div class="cta">

                    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

                    <button type="submit" name="add-to-cart"
                            value="<?php echo esc_attr($product->get_id()); ?>"
                            class="primary-button"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

                    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                </div>

                <footer>
                    <details>
                        <summary>Formats</summary>
                        <p>
                            Parce que je souhaite vous offrir des choix divers, et de qualité. Vous pouvez commander vos
                            photos sur mon site sous 4 dimensions : 40 x 60, 40 x 90, 80 x 120, 100 x 140.
                            Parfait pour de la décoration, avec les cadres disponibles sur mon site dans la section
                            “accessoires”, vous pourrez décorer votre pièce à vivre, chambre.. De la meilleure des
                            manières grâce à ces photos de grandes tailles.
                        </p>
                    </details>

                    <details>
                        <summary>Impression</summary>
                        <p>
                            Pour l’impression de vos photos, vous aurez le choix entre différents types de papiers. Cela
                            est permis d’ailleurs grâce à notre imprimeur partenaire : Artlabs (Une imprimerie
                            bordelaise) qui accepte de me suivre dans ce projet !
                            Nous vous offrons la possibilité d’obtenir des tirages de qualité et sous différentes formes
                            de papiers.
                        </p>
                    </details>

                    <details>
                        <summary>Expédition & retours</summary>
                        <p>
                            Pour l’expédition en Europe, je passe par UPS pour vous envoyer dans les meilleurs délais
                            vos photos (1 à 4 jours ouvrables en Europe). Vos photos arrivent emballées, sous blisters
                            afin que le transport ne détériore pas votre commande. Pour la politique retour, si votre
                            commande présente un défaut de fabrication que ce soit lors de la production, ou pendant
                            l'expédition si celle-ci est importante, vous avez jusqu’à 30 jours pour nous contacter !
                            Afin que nous puissions voir avec vous les conditions de renvoi et de remboursement de votre
                            commande. (Attention, chaque commande est faite avec soins et prise en photo pour certifier
                            la qualité du produit dès l'envoi afin d’éviter toute fraude dès la réception !)
                        </p>
                    </details>
                </footer>
            </div>
        </form>
        <?php do_action('woocommerce_after_add_to_cart_form'); ?>

        <?php
        if (wc_products_array_orderby(array_filter(array_map('wc_get_product', $product->get_upsell_ids()), 'wc_products_array_filter_visible'), $orderby, $order)) : ?>
            <section class="crosssells">
                <h2>Nos recommandations de cadres et d’attaches</h2>

                <div>
                    <?php woocommerce_product_loop_start(); ?>
                    <?php foreach (wc_products_array_orderby(array_filter(array_map('wc_get_product', $product->get_upsell_ids()), 'wc_products_array_filter_visible'), $orderby, $order) as $upsell) : ?>

                        <li class="crossell-product">
                            <a href="<?php echo get_permalink($upsell->id) ?>">
                                <img src="<?php echo wp_get_attachment_image_url($upsell->get_image_id(), apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'))); ?>"
                                     alt="<?php echo $upsell->name ?>">
                                <h2><?php echo $upsell->name ?></h2>
                                <p>À partir de <?php echo $upsell->price ?>€</p>
                            </a>
                        </li>

                    <?php endforeach; ?>
                    <?php woocommerce_product_loop_end(); ?>
                </div>
            </section>
        <?php endif;

        wp_reset_postdata();
        ?>

        <ul class="reassurance">
            <li>
                <svg width="96" height="98" viewBox="0 0 96 98" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M57.0366 0.753906C57.5019 1.20017 58.0842 1.57364 58.4166 2.10535C59.8566 4.39997 61.4106 6.54583 63.6103 8.2296C64.5345 8.93539 65.177 10.0874 65.7625 11.1414C66.2436 12.0086 66.8449 12.4802 67.8007 12.5403C68.3008 12.572 68.8009 12.6036 69.3009 12.6194C71.2885 12.6764 72.3836 13.436 72.7951 15.3603C73.0673 16.6295 73.7382 17.0662 74.9441 17.272C76.2797 17.4967 77.8147 17.6929 78.8117 18.4715C80.198 19.5571 81.5431 20.5635 83.2079 21.1427C83.575 21.2725 83.9548 21.5447 84.1858 21.8548C84.9391 22.8835 86.012 23.1462 87.1799 23.3772C88.6516 23.6652 90.1075 24.0545 91.5349 24.5166C92.2977 24.7603 93.0383 25.1623 93.6903 25.6338C95.257 26.7701 95.5956 28.5108 94.6588 30.2104C94.4499 30.5902 94.2315 31.0206 93.8992 31.2738C91.7438 32.9291 91.5539 35.3503 91.2659 37.7589C91.0697 39.4047 90.864 41.0568 90.5221 42.6741C90.212 44.1522 89.4271 45.3105 87.8351 45.7726C87.4141 45.8961 87.0565 46.2854 86.7115 46.5987C85.3506 47.8489 83.8757 48.8617 81.9735 49.1022C81.1411 49.2098 80.8436 49.8301 80.8025 50.5802C80.7613 51.2987 81.0905 51.7355 81.8374 51.9064C82.4419 52.0456 83.0338 52.2767 83.6035 52.533C85.0562 53.185 85.9171 54.2643 86.0912 55.9037C86.1925 56.8596 86.4393 57.8027 86.6767 58.7396C86.9869 59.9581 86.4615 60.8664 85.6133 61.7431C86.5469 62.8097 87.2274 63.9745 87.0122 65.4588C86.797 66.9305 85.9234 67.8737 84.4644 68.4814C84.7809 68.8707 85.0625 69.222 85.3506 69.5733C87.3097 71.9724 87.259 73.0896 85.0594 75.2513C85.6228 76.1723 86.3285 76.8243 87.5249 76.7641C88.0851 76.7357 88.6611 76.7641 89.2087 76.8654C90.6772 77.1439 91.2817 78.3783 90.7279 79.7835C90.4652 80.4482 90.2436 81.1382 90.1075 81.8344C89.6866 83.9708 88.4871 85.4932 86.5121 86.3382C85.3949 86.8161 84.1859 87.0725 83.0496 87.5093C82.6667 87.6549 82.2426 87.9872 82.0748 88.3448C80.372 91.9466 75.8208 93.279 72.5165 91.0667C71.6588 90.4938 70.8771 89.807 70.089 89.1392C69.2186 88.4081 68.2691 88.1897 67.1234 88.2973C65.8574 88.4176 64.544 88.4366 63.3001 88.2182C62.4962 88.079 61.705 87.5251 61.053 86.9807C60.5846 86.5883 60.1858 86.4173 59.6351 86.5566C58.9989 86.718 58.3596 86.8731 57.7361 87.0788C54.2704 88.2372 53.0867 90.2343 53.7071 93.8487C53.7387 94.0355 53.783 94.2159 53.821 94.4026C53.9919 95.2793 53.9666 96.1117 53.1595 96.6909C52.3271 97.2891 51.5327 97.1182 50.7193 96.5801C50.4946 96.4314 50.0452 96.4282 49.7951 96.5548C48.2854 97.3144 46.8422 97.2163 45.4021 96.3807C45.1458 96.232 44.8229 96.118 44.5286 96.118C41.2244 96.0959 40.6515 95.7097 39.5533 92.684C38.9456 92.7157 38.3284 92.7663 37.7081 92.779C36.4357 92.8075 35.4198 92.3137 34.5842 91.3357C34.3658 91.0794 33.8594 90.9591 33.4891 90.9591C31.7769 90.9718 30.0203 91.3231 28.3682 91.0287C26.6844 90.7312 25.0007 90.1963 23.3517 89.6899C21.4274 89.0981 19.6044 88.1581 17.7655 87.3035C16.3223 86.6326 15.5817 85.4489 15.6608 83.8379C15.6893 83.2587 15.4203 83.0023 14.9613 82.7681C12.7205 81.6161 12.2489 80.4482 13.3598 78.1378C14.3758 76.0267 15.607 74.0169 16.7369 71.9597C18.3669 68.9878 19.9462 65.9747 20.4272 62.5692C20.6994 60.6322 20.9463 58.7237 21.8958 56.9798C21.9654 56.8532 22.0414 56.6443 21.9844 56.5462C21.0444 54.8213 21.2122 52.8907 20.959 51.0423C20.883 50.4821 20.6425 50.2004 20.1614 49.9093C17.4902 48.292 16.4869 45.6777 16.0691 42.7627C16.0248 42.4557 16.164 42.0601 16.3476 41.7942C16.8951 41.0062 16.8129 40.2086 16.3286 39.506C15.7304 38.6356 15.1164 37.6988 14.2967 37.0689C12.3154 35.5466 10.2328 34.154 8.14396 32.7867C7.61857 32.4449 6.89695 32.4196 6.28611 32.1949C5.06759 31.7486 3.75096 31.4384 2.67487 30.7579C0.750556 29.5426 0.459375 27.5423 1.69372 25.6054C1.8583 25.3458 2.03237 25.0863 2.17796 24.8647C1.81082 24.4122 1.41837 24.0387 1.162 23.5893C0.472038 22.3802 0.858159 21.0098 2.10516 20.0318C4.33015 18.2911 7.64389 18.1297 10.005 19.6489C10.1347 19.7343 10.2708 19.8134 10.4386 19.9147C12.4578 18.5538 14.6353 18.9842 16.7654 19.5096C17.2654 19.633 17.7718 20.2565 18.0187 20.7724C18.8954 22.6018 19.1359 22.7062 21.1362 22.2315C22.0034 22.0258 22.9371 22.0986 23.9657 22.0353C23.8423 21.4086 23.703 20.5224 23.491 19.652C23.2409 18.6171 22.9498 17.5916 22.6364 16.5757C21.5382 12.9897 24.0417 10.9515 27.3617 11.5687C29.5361 11.9738 31.2198 13.1227 32.3434 15.0723C33.1916 16.5503 34.5747 17.2087 36.0338 16.8542C36.306 16.7877 36.6731 16.5187 36.7301 16.2813C37.3979 13.5404 39.2336 12.8695 41.4427 12.8283C43.2215 12.7967 44.8578 12.3726 46.3421 11.4357C46.6776 11.2237 46.8644 10.7489 47.0638 10.366C47.3359 9.8469 47.4974 9.26455 47.8012 8.76764C48.3203 7.92576 48.545 7.07754 48.3266 6.0869C47.9689 4.46643 48.4753 3.30488 50.0388 2.66239C51.5644 2.03256 53.1848 1.63694 54.7642 1.13687C55.144 1.0166 55.5206 0.886836 55.9004 0.760236C56.277 0.760236 56.6537 0.760236 57.0303 0.760236L57.0366 0.753906ZM16.8318 79.4765C18.5409 80.4197 19.5284 81.7142 19.4556 83.6765C19.4493 83.8664 19.8259 84.1481 20.0791 84.262C21.5603 84.9171 23.051 85.5501 24.5512 86.1578C24.8899 86.2939 25.2918 86.2686 25.6526 86.3635C26.5167 86.5883 27.3681 86.8573 28.2321 87.0725C29.112 87.2909 30.0045 87.465 31.0394 87.6928C31.0394 87.0345 31.0394 86.6674 31.0394 86.3002C31.0394 78.3688 31.0394 70.4373 31.0394 62.5059C31.0394 61.1323 31.7769 60.2714 32.9036 60.2746C34.0335 60.2746 34.771 61.145 34.7963 62.5091C34.8026 62.7591 34.7963 63.0091 34.7963 63.2623C34.7963 70.8171 34.7963 78.372 34.7963 85.9268V87.0345C34.8722 86.9775 34.9482 86.9206 35.021 86.8636C35.6951 87.332 36.537 87.677 37.0023 88.3005C37.5466 89.0285 38.0879 89.1107 38.838 88.9335C39.1418 88.8607 39.452 88.8037 39.7621 88.7658C41.4301 88.5695 42.6169 89.3576 43.0949 90.9812C43.2278 91.4275 43.3259 91.8833 43.462 92.4308C44.9495 92.0637 46.2694 92.4277 47.5037 93.2157C47.643 93.3044 47.9278 93.2537 48.105 93.1777C48.6716 92.9372 49.2159 92.6524 49.7762 92.3802C49.6464 87.1485 53.2703 83.246 61.1416 82.651C61.1574 82.3883 61.1922 82.1161 61.1922 81.8408C61.1922 58.4864 61.1986 35.1288 61.1669 11.7744C61.1669 11.3629 60.8536 10.8787 60.5561 10.5495C59.4199 9.30569 58.2108 8.13148 57.0651 6.89714C56.4732 6.25781 56.0681 5.17222 55.3813 4.97599C54.6344 4.76394 53.6659 5.37162 52.7829 5.57734C52.2448 5.70394 52.0961 5.9698 52.1625 6.50785C52.3176 7.76434 51.9758 8.92906 51.3903 10.0305C51.2004 10.3881 50.8839 10.7331 50.8427 11.1066C50.6275 13.1068 49.2856 14.1576 47.6841 15.0185C45.7724 16.0471 43.7405 16.5946 41.5598 16.5852C41.0883 16.5852 40.4964 16.4775 40.4173 17.2276C40.1989 19.3102 38.7367 20.1046 36.9485 20.5097C36.2617 20.6648 35.5464 20.6933 34.7899 20.7883V21.9435C34.7899 29.4666 34.7899 36.9898 34.7868 44.5161C34.7868 44.9213 34.7741 45.339 34.6728 45.7252C34.4291 46.6525 33.6411 47.1589 32.6852 47.0703C31.8085 46.988 31.1407 46.3202 31.0489 45.4118C31.0141 45.07 31.0268 44.7219 31.0268 44.3769C31.0268 36.2872 31.0299 28.2006 31.0141 20.1109C31.0141 19.7406 30.9065 19.3102 30.7008 19.0127C30.1532 18.2183 29.5013 17.4998 28.9347 16.7181C28.2701 15.7971 27.4124 15.3002 26.1907 15.2305C26.311 15.6863 26.4249 16.0344 26.4977 16.3921C26.8997 18.3164 27.4852 20.228 27.6403 22.1745C27.865 24.9913 25.5355 26.7384 22.7567 26.1086C22.263 25.9978 21.7059 25.982 21.2122 26.0833C18.5061 26.6466 16.5976 25.8459 15.1481 23.4722C14.6322 22.6271 13.3092 22.5068 12.6256 23.2601C11.885 24.0767 10.9893 24.3267 9.99547 23.9026C9.22322 23.5734 8.5016 23.1208 7.77999 22.6872C6.98874 22.2125 6.88112 22.1872 5.88415 22.5765C7.57742 24.6717 5.89998 26.1434 4.71312 27.8462C5.49803 28.0867 6.11203 28.2734 6.72604 28.4633C7.82429 28.8052 9.03648 28.9539 9.99547 29.5299C12.1635 30.8276 14.3188 32.2012 16.2653 33.8058C17.5883 34.8977 18.6612 36.3568 19.636 37.7937C20.5412 39.1293 20.7438 40.7023 20.2437 42.3038C19.7531 43.8673 20.7532 46.1113 22.2661 46.7411C23.3327 47.1842 24.0448 47.9438 24.3044 49.0357C24.5639 50.1276 24.681 51.2512 24.8582 52.3621C24.9722 53.0711 24.8519 53.9604 25.238 54.451C26.3679 55.8784 25.9058 57.1761 25.3298 58.5845C24.9184 59.5878 24.5924 60.6354 24.336 61.6893C23.9246 63.3858 23.7283 65.1455 23.2124 66.8071C22.0414 70.5734 19.9652 73.9125 18.0155 77.3054C17.6136 78.0048 17.2401 78.7201 16.8223 79.486L16.8318 79.4765ZM91.2976 28.4317C90.6677 28.2038 90.1518 27.9664 89.6106 27.8335C88.0313 27.441 86.414 27.1847 84.8695 26.6909C83.9516 26.3966 83.1382 25.7668 82.2869 25.2699C81.5462 24.8363 80.831 24.3615 80.0904 23.9342C79.3403 23.5006 78.3496 23.2759 77.8622 22.6493C76.9317 21.4529 75.7797 21.0541 74.3871 20.9275C71.6557 20.6775 69.8263 19.3355 69.225 16.5567C69.2155 16.5092 69.1458 16.4712 69.1807 16.5092C67.7406 16.2781 66.3923 16.0629 65.025 15.8414V84.6861C65.6074 84.6576 66.1454 84.6956 66.655 84.6007C68.8895 84.1797 70.7948 84.8538 72.5039 86.2559C73.2318 86.8509 73.9345 87.4871 74.7099 88.0062C75.9632 88.8449 78.1629 88.2151 78.587 86.7845C79.0997 85.0596 80.3404 84.3728 81.8659 83.9075C82.8819 83.5974 83.92 83.3378 84.9011 82.939C86.0627 82.4675 86.4456 81.73 86.3412 80.5178C81.771 79.3721 80.1948 75.8716 82.597 72.1559C82.1856 71.6559 81.752 71.159 81.3563 70.6367C80.9417 70.0892 80.505 69.5448 80.179 68.9435C79.1915 67.1173 79.9827 65.3892 81.9893 64.8923C82.3312 64.8068 82.673 64.734 83.1351 64.6296C82.7363 64.3036 82.4419 64.0757 82.1634 63.832C80.8563 62.6895 80.6727 61.107 81.9039 59.9866C82.6445 59.3156 82.8755 58.7174 82.4989 57.8375C82.4514 57.7268 82.4578 57.5907 82.4451 57.4672C82.2837 55.9512 82.29 55.9291 80.7582 55.505C79.6378 55.1948 78.6629 54.6979 77.9761 53.7199C75.7733 50.5834 77.5552 46.1619 81.2899 45.3549C82.1349 45.1713 82.942 44.6839 83.6921 44.2186C84.6701 43.6141 85.5879 42.9115 86.5058 42.2152C86.7242 42.0474 86.9299 41.7468 86.9742 41.4809C87.1862 40.1833 87.3635 38.8793 87.5091 37.5753C87.8699 34.3407 88.2465 31.1219 91.0285 28.8653C91.1203 28.7925 91.1615 28.6596 91.2944 28.4412L91.2976 28.4317Z"
                          fill="#D26438"/>
                    <path d="M32.9225 55.5366C31.8749 55.543 31.0678 54.7612 31.052 53.7199C31.0362 52.6913 31.8337 51.8399 32.8497 51.8019C33.8783 51.764 34.7993 52.6597 34.793 53.6914C34.7867 54.7042 33.9511 55.5303 32.9225 55.5366Z"
                          fill="#D26438"/>
                </svg>

                <p class="bold">Made in France</p>
                <p>Impression et expédition 100% française</p>
            </li>

            <li>
                <svg width="62" height="87" viewBox="0 0 62 87" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M45.9288 68.954L30.9985 83.8843L16.0682 68.954C11.9441 64.8299 11.9441 58.1479 16.0682 54.0237C20.1895 49.8996 26.8744 49.8996 30.9985 54.0237C35.1226 49.8996 41.8046 49.8996 45.9288 54.0237C50.0529 58.1479 50.0529 64.8299 45.9288 68.954Z"
                          stroke="#D26438" stroke-width="3.62541" stroke-miterlimit="10"/>
                    <path d="M14.0958 66.2195H6.84217C4.32063 66.2195 2.27539 64.1742 2.27539 61.6527V6.50672C2.27539 3.98519 4.32063 1.93994 6.84217 1.93994H55.1576C57.6791 1.93994 59.7244 3.98519 59.7244 6.50672V61.6527C59.7244 64.1742 57.6791 66.2195 55.1576 66.2195H47.904"
                          stroke="#D26438" stroke-width="3.62541" stroke-miterlimit="10"/>
                    <path d="M19.1389 18.3916H42.8582" stroke="#D26438" stroke-width="3.62541" stroke-miterlimit="10"
                          stroke-linecap="round"/>
                    <path d="M13.2104 29.5312H48.7893" stroke="#D26438" stroke-width="3.62541" stroke-miterlimit="10"
                          stroke-linecap="round"/>
                </svg>

                <p class="bold">Expédié avec soin</p>
                <p>Enroulé ou à plat, votre tirage est en sécurité</p>
            </li>

            <li>
                <svg width="100" height="72" viewBox="0 0 100 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M69.9652 23.4135C73.8995 23.4135 77.7059 23.4052 81.5151 23.4135C85.9833 23.4246 89.9704 24.8232 93.3792 27.7176C97.5721 31.2794 99.8187 35.8532 99.9049 41.3501C100.011 48.1121 99.9494 54.8769 99.9272 61.6418C99.9188 64.5529 97.7584 66.7522 94.839 66.6688C93.0261 66.616 91.7805 67.0052 90.4653 68.5094C86.3503 73.2195 78.8236 72.6328 75.2035 67.5196C74.7725 66.9107 74.3583 66.6855 73.6159 66.6882C60.6424 66.7133 47.6688 66.7133 34.6981 66.6882C33.9668 66.6882 33.5359 66.8884 33.0993 67.5029C29.1233 73.1222 20.8459 73.086 16.8755 67.439C16.4918 66.894 16.1192 66.6799 15.4519 66.6882C12.0875 66.7244 8.72321 66.7133 5.35888 66.7022C2.11689 66.691 0.0371195 64.6029 0.0371195 61.347C0.0343391 42.7209 0.0343391 24.0947 0.0371195 5.46576C0.0371195 2.1626 2.11967 0.102295 5.45063 0.102295C25.1528 0.102295 44.855 0.102295 64.5572 0.102295C67.8854 0.102295 69.9568 2.15982 69.9624 5.4741C69.9707 11.0239 69.9624 16.5736 69.9624 22.1234V23.4107L69.9652 23.4135ZM33.3357 15.0388C33.3357 12.9062 33.3496 10.8932 33.3301 8.88292C33.3218 8.02377 33.4914 7.29529 34.3561 6.90881C35.1874 6.53901 35.813 6.92827 36.4275 7.44265C42.817 12.7755 49.2147 18.1001 55.607 23.4302C57.0167 24.6063 57.0111 25.5517 55.5986 26.7278C49.2314 32.0356 42.8614 37.3379 36.4998 42.6486C35.8603 43.1824 35.2264 43.6328 34.345 43.2352C33.4302 42.821 33.319 42.0341 33.3301 41.1499C33.3523 39.1508 33.3384 37.1489 33.3384 35.1358H3.44872V46.6607H66.5842C66.6064 46.4717 66.6314 46.341 66.6314 46.2075C66.6314 32.575 66.637 18.9453 66.6314 5.31284C66.6314 4.01159 65.9697 3.43326 64.5628 3.43326C44.8606 3.43048 25.1584 3.43048 5.4562 3.43326C3.95476 3.43326 3.37365 4.01159 3.36809 5.50191C3.35974 7.85972 3.36809 10.2203 3.36809 12.5781C3.36809 13.3956 3.36809 14.213 3.36809 15.0388H33.3357V15.0388ZM36.6666 38.1693C41.98 33.7428 47.1405 29.4415 52.3789 25.0762C47.1322 20.7026 41.9856 16.4151 36.6666 11.9803C36.6666 13.4818 36.6666 14.7524 36.6666 16.0203C36.6666 17.9305 36.18 18.4143 34.2727 18.4143C24.391 18.4143 14.5093 18.4143 4.62762 18.4143H3.44594V31.7354C3.94364 31.7354 4.35792 31.7354 4.77221 31.7354C14.6873 31.7354 24.6051 31.7354 34.5201 31.7354C36.0883 31.7354 36.6555 32.3026 36.6638 33.8568C36.6722 35.2081 36.6638 36.5594 36.6638 38.1693H36.6666ZM66.5897 50.1252H3.41535V56.6231C3.55716 56.6592 3.65169 56.7037 3.74623 56.7037C7.76952 56.7092 11.7928 56.7259 15.8133 56.6814C16.1525 56.6787 16.5863 56.3116 16.8115 55.9975C20.8487 50.3226 29.1233 50.2753 33.1243 55.9474C33.5331 56.5257 33.939 56.7287 34.6341 56.7287C44.9329 56.7065 55.2344 56.712 65.5331 56.712C65.8696 56.712 66.206 56.712 66.5869 56.712V50.1252H66.5897ZM69.9874 56.7093C71.4527 56.7093 72.8346 56.7371 74.2109 56.6842C74.4778 56.6731 74.8059 56.3978 74.9811 56.1559C79.2796 50.1947 87.2456 50.2114 91.6137 56.1949C91.7749 56.4173 92.0641 56.6787 92.3032 56.687C93.7101 56.7343 95.1226 56.7093 96.535 56.7093V43.3909H95.3283C89.7452 43.3909 84.1621 43.3993 78.579 43.3882C75.4009 43.3826 73.31 41.2834 73.2989 38.1026C73.2878 34.7049 73.2989 31.3072 73.2989 27.9067V26.8223H69.9902V56.7093H69.9874ZM96.6546 40.06C96.2153 38.5836 95.9373 37.2212 95.4145 35.9588C92.5201 28.9633 84.6403 25.1652 76.6271 26.889C76.6271 30.512 76.6271 34.1488 76.6271 37.7856C76.6271 39.5428 77.1498 40.0572 78.9349 40.0572C84.4151 40.0572 89.8954 40.0572 95.3756 40.0572H96.6518L96.6546 40.06ZM31.6674 61.6529C31.6507 57.9883 28.6228 55.0187 24.9304 55.0493C21.3075 55.0799 18.3491 58.0717 18.3519 61.7085C18.3519 65.3898 21.3603 68.3843 25.036 68.3676C28.7118 68.351 31.6841 65.3425 31.6702 61.6557L31.6674 61.6529ZM83.2418 68.3649C86.9258 68.3788 89.9287 65.4009 89.9426 61.7196C89.9565 58.0439 86.9592 55.0465 83.2723 55.0465C79.6383 55.0465 76.6521 58.0077 76.6243 61.6362C76.5965 65.3231 79.5744 68.3509 83.239 68.3649H83.2418ZM73.3434 60.1042H34.9511V63.31H73.3434V60.1042V60.1042ZM3.36531 60.0764C3.36531 60.4156 3.36531 60.6547 3.36531 60.891C3.34862 62.9069 3.8213 63.3712 5.87048 63.374C7.5304 63.374 9.19311 63.374 10.853 63.374H15.0571V60.0764H3.36531V60.0764ZM93.2263 63.2905C96.1764 63.6214 96.9577 62.8512 96.4822 60.0986H93.2263V63.2905Z"
                          fill="#D26438"/>
                </svg>

                <p class="bold">Livraison rapide</p>
                <p>Préparation et expédition entre 2 et 6 jours</p>
            </li>
        </ul>
    </main>
<?php
get_footer();