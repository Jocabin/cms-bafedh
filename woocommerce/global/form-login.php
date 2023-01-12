<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     7.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
    return;
}

?>
<form class="form-login" method="post">
    <?php do_action('woocommerce_login_form_start'); ?>

    <?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine ?>

    <p class="textfield">
        <label for="username">Votre e-mail ou nom d'utilisateur</label>
        <input type="text" name="username" id="username" autocomplete="username"/>
    </p>
    <p class="textfield">
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password" autocomplete="current-password"/>
    </p>

    <?php do_action('woocommerce_login_form'); ?>

    <div class="form-row">
        <label for="rememberme">
            <input name="rememberme" type="checkbox" id="rememberme" value="forever"/>
            Rester connecté
        </label>

        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>

        <p class="lost_password">
            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
        </p>

        <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>"/>
    </div>

    <button type="submit" class="primary-button" name="login"
            value="<?php esc_attr_e('Login', 'woocommerce'); ?>"><?php esc_html_e('Login', 'woocommerce'); ?></button>

    <?php do_action('woocommerce_login_form_end'); ?>

</form>
