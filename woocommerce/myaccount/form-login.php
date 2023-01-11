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
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>

<!--    register-->
<div id="customer_register">
    <h2>Créer un compte</h2>

    <form method="post"
          class="form-register" <?php do_action('woocommerce_register_form_tag'); ?> >

        <?php do_action('woocommerce_register_form_start'); ?>

        <div class="textfields">
            <p class="textfield">
                <label for="reg_username">Prénom</label>
                <input type="text" name="username"
                       id="reg_username" autocomplete="name"
                       value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </p>

            <p class="textfield">
                <label for="reg_email">Votre e-mail</label>
                <input type="email" name="email"
                       id="reg_email" autocomplete="email"
                       value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </p>

            <p class="textfield">
                <label for="reg_password">Votre mot de passe</label>
                <input type="password" name="password"
                       id="reg_password" autocomplete="new-password"/>
            </p>
        </div>

        <?php do_action('woocommerce_register_form'); ?>

        <div class="actions-login-button">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

            <button type="submit" class="primary-button" name="register"
                    value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                Créer mon compte
            </button>

            <div class="horizontal-side-line-text">
                <span></span>
                <p>ou</p>
                <span></span>
            </div>

            <a href="#" class="primary-button dark-button">Se connecter</a>
        </div>

        <?php do_action('woocommerce_register_form_end'); ?>

    </form>
</div>

<div id="customer_login">
    <!--login-->
    <div>
        <h2>Connexion</h2>

        <form class="form-login" method="post">
            <?php do_action('woocommerce_login_form_start'); ?>

            <div class="textfields">
                <p class="textfield">
                    <label for="username">Votre e-mail</label>
                    <input type="text" placeholder="mon.adresse@mail.fr" name="username" id="username"
                           autocomplete="username"
                           value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                </p>
                <p class="textfield">
                    <label for="password">Votre mot de passe</label>
                    <input type="password" placeholder="***********" name="password" id="password"
                           autocomplete="current-password"/>
                </p>
            </div>

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
            </div>

            <div class="actions-login-button">
                <button type="submit" class="primary-button" name="login"
                        value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">
                    Se connecter
                </button>

                <div class="horizontal-side-line-text">
                    <span></span>
                    <p>ou</p>
                    <span></span>
                </div>

                <a href="#customer_register" class="primary-button dark-button">Créer mon compte</a>
            </div>

            <?php do_action('woocommerce_login_form_end'); ?>

        </form>
    </div>
</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>
