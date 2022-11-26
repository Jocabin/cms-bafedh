<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CMS_Bafedh
 */

get_header();
?>
    <main id="primary" class="site-main">
        <h1>titre</h1>
        <p>baseline</p>

        <section class="contact-section">
            <img width="437" height="244" src="" alt="">
            <div>
                <h2>Me contacter</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad cumque dolore dolorem eos est eveniet
                    inventore pariatur, porro quas quidem recusandae reiciendis rem repellendus tempore vero vitae
                    voluptatum. Accusamus, nostrum!
                </p>
                <a href="mailto:bastiendb@gmail.com" class="primary-button">Me contacter</a>
            </div>
        </section>
    </main>
<?php
get_footer();
