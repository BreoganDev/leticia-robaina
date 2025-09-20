<?php
if (!defined('ABSPATH')) { exit; }

function leticia_scripts() {
    $ver = defined('LETICIA_VERSION') ? LETICIA_VERSION : '1.0.0';

    /* ---------------- CSS ---------------- */

    // 0) Icon fonts (los tienes locales)
    if ( file_exists(LETICIA_PATH.'/assets/css/themify-icons.css') ) {
        wp_enqueue_style('leticia-themify-icons', LETICIA_URI.'/assets/css/themify-icons.css', [], $ver);
    }
    if ( file_exists(LETICIA_PATH.'/assets/css/pticons3c11.css') ) {
        wp_enqueue_style('leticia-pticons', LETICIA_URI.'/assets/css/pticons3c11.css', [], $ver);
    }

    // 1) Bootstrap base
    if ( file_exists(LETICIA_PATH.'/assets/css/bootstrap.css') ) {
        wp_enqueue_style('leticia-bootstrap', LETICIA_URI.'/assets/css/bootstrap.css', [], $ver);
    }

    // 2) jQuery UI CSS (si lo usas)
    if ( file_exists(LETICIA_PATH.'/assets/css/jquery-ui.min.css') ) {
        wp_enqueue_style('leticia-jquery-ui', LETICIA_URI.'/assets/css/jquery-ui.min.css', ['leticia-bootstrap'], $ver);
    }

    // 3) AOS (tus plantillas usan data-aos)
    if ( file_exists(LETICIA_PATH.'/assets/css/aos.css') ) {
        wp_enqueue_style('leticia-aos', LETICIA_URI.'/assets/css/aos.css', [], $ver);
    }

    // 4) CSS del sitio (HTTrack)
    if ( file_exists(LETICIA_PATH.'/assets/css/site.css') ) {
        wp_enqueue_style('leticia-site', LETICIA_URI.'/assets/css/site.css', array_filter(['leticia-jquery-ui','leticia-bootstrap']), $ver);
    }

    // 5) Custom del sitio
    if ( file_exists(LETICIA_PATH.'/assets/css/custom.css') ) {
        wp_enqueue_style('leticia-custom', LETICIA_URI.'/assets/css/custom.css', ['leticia-site'], $ver);
    }

    // 6) Tiny Slider
    if ( file_exists(LETICIA_PATH.'/assets/css/tiny-slider.css') ) {
        wp_enqueue_style('leticia-tiny-slider', LETICIA_URI.'/assets/css/tiny-slider.css', ['leticia-custom'], $ver);
    }

    // 7) Fancybox (si la usas)
    if ( file_exists(LETICIA_PATH.'/assets/css/fancybox.css') ) {
        wp_enqueue_style('leticia-fancybox', LETICIA_URI.'/assets/css/fancybox.css', ['leticia-tiny-slider'], $ver);
    }

    // 8) Google Fonts
    wp_enqueue_style(
        'leticia-google-fonts',
        'https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,500;0,6..96,600;0,6..96,700;1,6..96,400&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    // 9) CSS principal del theme (debe ir el ÚLTIMO)
    wp_enqueue_style(
        'leticia-main',
        LETICIA_URI.'/assets/css/main.css',
        ['leticia-fancybox','leticia-tiny-slider','leticia-custom','leticia-google-fonts','leticia-themify-icons','leticia-pticons'],
        defined('LETICIA_THEME_VERSION') ? LETICIA_THEME_VERSION : $ver
    );

    /* ---------------- JS ---------------- */

    // jQuery del core
    wp_enqueue_script('jquery');

    // Bootstrap
    if ( file_exists(LETICIA_PATH.'/assets/js/bootstrap.min.js') ) {
        wp_enqueue_script('leticia-bootstrap-js', LETICIA_URI.'/assets/js/bootstrap.min.js', ['jquery'], $ver, true);
    }

    // AOS
    if ( file_exists(LETICIA_PATH.'/assets/js/aos.js') ) {
        wp_enqueue_script('leticia-aos-js', LETICIA_URI.'/assets/js/aos.js', [], $ver, true);
    }

    // Tiny Slider
    if ( file_exists(LETICIA_PATH.'/assets/js/tiny-slider.js') ) {
        wp_enqueue_script('leticia-tiny-slider-js', LETICIA_URI.'/assets/js/tiny-slider.js', ['jquery'], $ver, true);
    }

    // Fancybox
    if ( file_exists(LETICIA_PATH.'/assets/js/fancybox.js') ) {
        wp_enqueue_script('leticia-fancybox-js', LETICIA_URI.'/assets/js/fancybox.js', ['jquery'], $ver, true);
    }

    // Script principal del theme
    if ( file_exists(LETICIA_PATH.'/assets/js/main.js') ) {
        wp_enqueue_script('leticia-main-js', LETICIA_URI.'/assets/js/main.js', array_filter(['jquery','leticia-bootstrap-js']), $ver, true);

        // Variables globales para AJAX + textos
        wp_localize_script('leticia-main-js', 'leticia_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('leticia_nonce'),
            'strings'  => [
                'loading'    => __('Cargando...', 'leticia-robaina'),
                'error'      => __('Ha ocurrido un error', 'leticia-robaina'),
                'success'    => __('¡Éxito!', 'leticia-robaina'),
                'form_error' => __('Por favor, completa todos los campos', 'leticia-robaina'),
                'email_sent' => __('Mensaje enviado correctamente', 'leticia-robaina'),
            ],
        ]);

        // Inicialización de AOS (solo si existe)
        wp_add_inline_script('leticia-main-js', 'window.AOS && AOS.init({ once:true, duration:700, easing:"ease-out" });', 'after');
    }

    // Comentarios anidados
    if ( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'leticia_scripts');

/* Async/Defer selectivo */
add_filter('script_loader_tag', function ($tag, $handle) {
    $async = ['leticia-fancybox-js','leticia-tiny-slider-js'];
    $defer = ['leticia-main-js','leticia-aos-js'];
    if (in_array($handle, $async, true))  $tag = str_replace('<script ', '<script async ', $tag);
    if (in_array($handle, $defer, true))  $tag = str_replace('<script ', '<script defer ', $tag);
    return $tag;
}, 10, 2);

/* Resource hints para Google Fonts */
add_filter('wp_resource_hints', function ($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = ['href' => 'https://fonts.googleapis.com'];
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin'];
    }
    return $urls;
}, 10, 2);

/* CSS crítico (header transparente en home) */
add_action('wp_head', function () {
    if (is_front_page() || is_page_template('template-home.php')): ?>
        <style id="leticia-critical-css">
            .site-header{position:absolute;top:0;left:0;right:0;z-index:999;background:transparent;transition:background .3s ease;}
            .site-header.is-sticky{position:fixed;background:rgba(255,255,255,.95);backdrop-filter:blur(10px);}
        </style>
    <?php endif;
}, 1);

/* Mover jQuery al footer (evita hacerlo en login/admin) */
if ( ! function_exists('leticia_is_login_page') ) {
    function leticia_is_login_page() {
        return in_array($GLOBALS['pagenow'], ['wp-login.php','wp-register.php'], true);
    }
}
add_action('wp_enqueue_scripts', function () {
    if (!is_admin() && !leticia_is_login_page()) {
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-core', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
});

/* Versionado automático en dev */
$ver_fn = function ($src) {
    if (defined('WP_DEBUG') && WP_DEBUG && strpos($src, LETICIA_URI) !== false) {
        $path = str_replace(LETICIA_URI, LETICIA_PATH, $src);
        if (file_exists($path)) $src = add_query_arg('ver', filemtime($path), $src);
    }
    return $src;
};
add_filter('style_loader_src', $ver_fn, 10, 1);
add_filter('script_loader_src', $ver_fn, 10, 1);
