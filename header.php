<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CMS_Bafedh
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="favicon" href="./fav.svg" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'cms-bafedh'); ?></a>

<header id="masthead" class="site-header">
    <a class="logo-link" href="/">
        <svg id="Calque_2" width="200" height="36" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1430.76 252.27">
            <defs>
                <style>.cls-1 {
                        fill: none;
                        stroke: #000;
                        stroke-miterlimit: 10;
                        stroke-width: 6px;
                    }</style>
            </defs>
            <g id="Calque_1-2">
                <g>
                    <g>
                        <path d="M9.07,12.47H41.5c27.76,0,41.5,10.34,41.5,31.87,0,10.06-4.39,17.56-10.77,21.67,10.2,4.25,16.15,14.02,16.15,25.78,0,23.09-14.73,37.4-46.46,37.4H9.07V12.47ZM42.07,58.36c8.92,0,14.31-2.83,14.31-10.62,0-8.5-5.24-11.19-14.31-11.19h-6.23v21.81h6.23Zm-.99,44.9c12.18,0,18.41-2.83,18.41-12.04s-6.23-12.46-17.42-12.46h-6.23v24.5h5.24Z"/>
                        <path d="M167.43,114.73h-45.04l-4.82,14.45h-29.89L130.17,12.61h29.46l41.79,116.58h-29.18l-4.82-14.45Zm-7.37-22.24l-15.16-46.04-15.16,46.04h30.31Z"/>
                        <path d="M201.28,91.22h27.9c.28,7.65,4.82,14.17,14.02,14.17,7.93,0,12.89-4.82,12.89-11.47,0-7.79-6.52-10.91-18.98-15.3-20.26-7.08-31.73-16.01-31.73-35.13s16.29-33.29,37.39-33.29c22.66,0,37.54,14.73,37.68,36.97l-26.06-.14c-.28-6.8-3.97-12.18-11.62-12.18-6.37,0-10.48,3.97-10.48,9.07,0,7.22,7.22,9.63,15.86,12.61,19.83,6.66,36.69,12.61,36.69,37.82,0,23.09-17.99,36.69-41.5,36.69-25.07,0-41.93-16.15-42.07-39.8Z"/>
                        <path d="M310.35,39.38h-23.37V12.32h75.36v27.05h-23.51v89.8h-28.47V39.38Z"/>
                        <path d="M372.81,12.75h28.61v116.43h-28.61V12.75Z"/>
                        <path d="M418.85,12.75h66.57v26.77h-38.1v20.11h34.85v21.25h-34.85v21.25h38.1v27.05h-66.57V12.75Z"/>
                        <path d="M500.44,12.47h28.75l34,64.59V12.47h28.61v116.72h-28.33l-34.42-65.16v65.16h-28.61V12.47Z"/>
                        <path d="M648.17,12.32h27.34c44.62,0,63.6,26.35,63.6,58.07s-18.98,58.78-63.6,58.78h-27.34V12.32Zm30.88,88.1c21.95,0,31.45-13.6,31.45-30.03s-9.49-29.46-31.45-29.46h-2.41v59.49h2.41Z"/>
                        <path d="M752.42,12.75h66.57v26.77h-38.1v20.11h34.85v21.25h-34.85v21.25h38.1v27.05h-66.57V12.75Z"/>
                        <path d="M872.25,12.47h32.44c27.76,0,41.5,10.34,41.5,31.87,0,10.06-4.39,17.56-10.76,21.67,10.2,4.25,16.15,14.02,16.15,25.78,0,23.09-14.73,37.4-46.46,37.4h-32.86V12.47Zm33,45.89c8.92,0,14.31-2.83,14.31-10.62,0-8.5-5.24-11.19-14.31-11.19h-6.23v21.81h6.23Zm-.99,44.9c12.18,0,18.41-2.83,18.41-12.04s-6.23-12.46-17.42-12.46h-6.23v24.5h5.24Z"/>
                        <path d="M1030.61,114.73h-45.04l-4.82,14.45h-29.89l42.49-116.58h29.46l41.79,116.58h-29.18l-4.82-14.45Zm-7.37-22.24l-15.16-46.04-15.16,46.04h30.31Z"/>
                        <path d="M1072.12,12.32h64.02v27.05h-35.55v20.82h32.3v24.22h-32.3v44.76h-28.47V12.32Z"/>
                        <path d="M1150.16,12.75h66.57v26.77h-38.1v20.11h34.85v21.25h-34.85v21.25h38.1v27.05h-66.57V12.75Z"/>
                        <path d="M1231.75,12.32h27.34c44.62,0,63.6,26.35,63.6,58.07s-18.98,58.78-63.6,58.78h-27.34V12.32Zm30.88,88.1c21.96,0,31.45-13.6,31.45-30.03s-9.49-29.46-31.45-29.46h-2.41v59.49h2.41Z"/>
                        <path d="M1336,12.32h28.47V56.23h28.75V12.32h28.61v116.86h-28.61v-45.61h-28.75v45.61h-28.47V12.32Z"/>
                    </g>
                    <g>
                        <path d="M14.4,177.19h23.73c5.97,0,10.59,1.99,13.54,5.49,2.39,2.79,3.82,6.53,3.82,10.83,0,10.43-5.97,16.72-18.39,16.72h-15.53v23.89h-7.17v-56.93Zm7.17,27.23h14.97c8.04,0,11.86-4.06,11.86-10.59s-4.22-10.43-11.47-10.43h-15.37v21.02Z"/>
                        <path d="M62.41,177.19h7.17v24.21h30.42v-24.21h7.17v56.93h-7.17v-26.91h-30.42v26.91h-7.17v-56.93Z"/>
                        <path d="M115.68,205.61c0-17.04,10.67-29.7,27.87-29.7s27.87,12.66,27.87,29.7-10.67,29.7-27.87,29.7-27.87-12.66-27.87-29.7Zm48.41,0c0-13.38-7.17-23.49-20.54-23.49s-20.54,10.11-20.54,23.49,7.17,23.41,20.54,23.41,20.54-10.03,20.54-23.41Z"/>
                        <path d="M172.76,177.19h45.07v6.29h-18.95v50.64h-7.17v-50.64h-18.95v-6.29Z"/>
                        <path d="M219.18,205.61c0-17.04,10.67-29.7,27.87-29.7s27.87,12.66,27.87,29.7-10.67,29.7-27.87,29.7-27.87-12.66-27.87-29.7Zm48.41,0c0-13.38-7.17-23.49-20.54-23.49s-20.54,10.11-20.54,23.49,7.17,23.41,20.54,23.41,20.54-10.03,20.54-23.41Z"/>
                        <path d="M325.95,226.63h-.16c-4.14,5.81-10.27,8.68-17.76,8.68-16,0-26.75-12.18-26.75-29.46s9.47-29.86,27.39-29.86c13.22,0,21.34,7.17,23.17,18.31h-7.4c-1.59-7.56-6.93-12.1-15.92-12.1-13.69,0-19.91,10.27-19.91,23.65s8.12,23.25,19.67,23.25,17.2-7.96,17.2-17.52v-1.35h-17.12v-6.21h24.28v30.1h-4.62l-2.07-7.48Z"/>
                        <path d="M342.51,177.19h26.59c10.03,0,16.8,6.29,16.8,15.61,0,6.93-3.03,11.86-9.87,14.09v.24c5.81,2.07,7.64,6.05,8.2,14.49,.64,9.16,1.59,11.46,2.63,12.18v.32h-7.72c-1.19-1.04-1.43-3.18-2.07-12.74-.56-8.36-3.9-11.31-11.54-11.31h-15.84v24.04h-7.17v-56.93Zm7.17,27.07h16.88c7.96,0,11.94-3.98,11.94-10.43,0-6.93-3.18-10.43-11.54-10.43h-17.28v20.86Z"/>
                        <path d="M410.99,177.19h8.04l21.02,56.93h-7.8l-6.05-17.36h-22.69l-6.13,17.36h-7.32l20.94-56.93Zm-5.41,33.76h18.63l-6.53-19.11c-1.11-3.18-2.55-8.04-2.55-8.04h-.16s-1.51,4.78-2.63,8.04l-6.77,19.11Z"/>
                        <path d="M446.18,177.19h23.73c5.97,0,10.59,1.99,13.54,5.49,2.39,2.79,3.82,6.53,3.82,10.83,0,10.43-5.97,16.72-18.39,16.72h-15.53v23.89h-7.17v-56.93Zm7.17,27.23h14.97c8.04,0,11.86-4.06,11.86-10.59s-4.22-10.43-11.47-10.43h-15.37v21.02Z"/>
                        <path d="M494.19,177.19h7.17v24.21h30.42v-24.21h7.17v56.93h-7.17v-26.91h-30.42v26.91h-7.17v-56.93Z"/>
                        <path d="M549.6,177.19h40.21v6.29h-33.04v17.99h30.02v6.05h-30.02v19.98h34v6.61h-41.16v-56.93Z"/>
                    </g>
                    <line class="cls-1" x1="646.46" y1="204.79" x2="1421.84" y2="204.79"/>
                </g>
            </g>
        </svg>
    </a>

    <nav class="secondary-header-nav">
        <a href="/mon-compte">
            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30.1899 31.3479L30.1904 26.0332C30.1906 23.0975 27.7738 20.7175 24.7923 20.7175H10.3986C7.41763 20.7175 5.00094 23.0968 5.00061 26.0321L5 31.3479M22.9935 8.31524C22.9935 11.2508 20.5767 13.6305 17.5954 13.6305C14.6142 13.6305 12.1974 11.2508 12.1974 8.31524C12.1974 5.37971 14.6142 3 17.5954 3C20.5767 3 22.9935 5.37971 22.9935 8.31524Z"
                      stroke="black" stroke-width="2.99891" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Compte
        </a>

        <a href="/panier">
            <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 1.50054C2.17187 1.50054 1.50054 2.17187 1.50054 3C1.50054 3.82813 2.17187 4.49946 3 4.49946V1.50054ZM6.43756 3L7.88332 2.60234C7.70431 1.95153 7.11253 1.50054 6.43756 1.50054V3ZM12.0236 23.309L10.5778 23.7066C10.7751 24.4239 11.4684 24.8881 12.2068 24.7972L12.0236 23.309ZM29.2114 21.1935L29.3945 22.6817C30.0308 22.6034 30.547 22.1292 30.6788 21.5018L29.2114 21.1935ZM31.7895 8.92345L33.257 9.23178C33.3499 8.78966 33.2385 8.32922 32.9537 7.97846C32.669 7.62769 32.2413 7.424 31.7895 7.424V8.92345ZM8.06682 8.92345L6.62105 9.32111L6.62105 9.32111L8.06682 8.92345ZM3 4.49946H6.43756V1.50054H3V4.49946ZM12.2068 24.7972L29.3945 22.6817L29.0282 19.7052L11.8404 21.8208L12.2068 24.7972ZM30.6788 21.5018L33.257 9.23178L30.3221 8.61512L27.744 20.8851L30.6788 21.5018ZM4.99179 3.39766L6.62105 9.32111L9.51258 8.52579L7.88332 2.60234L4.99179 3.39766ZM6.62105 9.32111L10.5778 23.7066L13.4694 22.9113L9.51258 8.52579L6.62105 9.32111ZM31.7895 7.424H8.06682V10.4229H31.7895V7.424ZM15.8953 28.8487C15.8953 29.2219 15.5816 29.5639 15.1456 29.5639V32.5628C17.194 32.5628 18.8942 30.9217 18.8942 28.8487H15.8953ZM15.1456 29.5639C14.7096 29.5639 14.3959 29.2219 14.3959 28.8487H11.397C11.397 30.9217 13.0972 32.5628 15.1456 32.5628V29.5639ZM14.3959 28.8487C14.3959 28.4755 14.7096 28.1335 15.1456 28.1335V25.1346C13.0972 25.1346 11.397 26.7757 11.397 28.8487H14.3959ZM15.1456 28.1335C15.5816 28.1335 15.8953 28.4755 15.8953 28.8487H18.8942C18.8942 26.7757 17.194 25.1346 15.1456 25.1346V28.1335ZM27.891 28.8487C27.891 29.2219 27.5772 29.5639 27.1412 29.5639V32.5628C29.1896 32.5628 30.8899 30.9217 30.8899 28.8487H27.891ZM27.1412 29.5639C26.7052 29.5639 26.3915 29.2219 26.3915 28.8487H23.3926C23.3926 30.9217 25.0929 32.5628 27.1412 32.5628V29.5639ZM26.3915 28.8487C26.3915 28.4755 26.7052 28.1335 27.1412 28.1335V25.1346C25.0929 25.1346 23.3926 26.7757 23.3926 28.8487H26.3915ZM27.1412 28.1335C27.5772 28.1335 27.891 28.4755 27.891 28.8487H30.8899C30.8899 26.7757 29.1896 25.1346 27.1412 25.1346V28.1335Z"
                      fill="black"/>
            </svg>
            Panier
        </a>
    </nav>

    <nav class="main-navigation">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'header-menu',
                'container' => 'ul'
            )
        );
        ?>
    </nav>
</header>
