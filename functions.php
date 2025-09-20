<?php
/**
 * Theme Name: Leticia Robaina
 * Description: Theme que replica fielmente leticiarobaina.com
 * Version: 1.0.0
 * Author: Equipo Senior WordPress
 * Text Domain: leticia-robaina
 * Requires at least: 6.0
 * Tested up to: 6.4
 * Requires PHP: 8.0
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// === Constantes del theme ===
define('LETICIA_VERSION', '1.0.0');
define('LETICIA_URI', get_template_directory_uri());
define('LETICIA_PATH', get_template_directory());

/**
 * ===================================
 * CONFIGURACIÓN BÁSICA DEL THEME
 * ===================================
 */
function leticia_theme_setup() {
    // Soporte para título del sitio
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Menús de navegación
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer'  => 'Menú Footer',
    ));
    
    // Tamaños de imagen personalizados
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('service-thumb', 400, 300, true);
    add_image_size('testimonial-thumb', 150, 150, true);
}
add_action('after_setup_theme', 'leticia_theme_setup');

/**
 * ===================================
 * ENQUEUE ESTILOS Y SCRIPTS
 * ===================================
 */
function leticia_scripts() {
    $version = LETICIA_VERSION;
    $theme_uri = get_template_directory_uri();
    
    // CSS - Cargar solo los que existen
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');
    
    // CSS del sitio original (si existen)
    $css_files = array(
        'site' => '/assets/css/site.css',
        'custom' => '/assets/css/custom.css'
    );
    
    foreach ($css_files as $handle => $file_path) {
        $full_path = get_template_directory() . $file_path;
        if (file_exists($full_path)) {
            wp_enqueue_style($handle, $theme_uri . $file_path, array('bootstrap'), $version);
        }
    }
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,500;0,6..96,600;0,6..96,700;1,6..96,400&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
    
    // CSS del theme (último)
    wp_enqueue_style('leticia-theme-style', get_stylesheet_uri(), array(), $version);
    
    // JavaScript
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', false);
    wp_enqueue_script('jquery');
    
    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);
    
    // Main JS personalizado (si existe)
    $main_js = get_template_directory() . '/assets/js/main.js';
    if (file_exists($main_js)) {
        wp_enqueue_script('leticia-main', $theme_uri . '/assets/js/main.js', array('jquery'), $version, true);
    }
    
    // Localizar script para AJAX
    wp_localize_script('jquery', 'leticia_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('leticia_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'leticia_scripts');

/**
 * ===================================
 * CUSTOM POST TYPES
 * ===================================
 */
function leticia_register_post_types() {
    // CPT Servicios
    register_post_type('servicio', array(
        'label'                 => 'Servicios',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'servicios'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-star-filled',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'labels'                => array(
            'name'               => 'Servicios',
            'singular_name'      => 'Servicio',
            'add_new'            => 'Añadir Nuevo',
            'add_new_item'       => 'Añadir Nuevo Servicio',
            'edit_item'          => 'Editar Servicio',
            'new_item'           => 'Nuevo Servicio',
            'view_item'          => 'Ver Servicio',
            'search_items'       => 'Buscar Servicios',
            'not_found'          => 'No se encontraron servicios',
            'not_found_in_trash' => 'No se encontraron servicios en la papelera',
        ),
    ));

    // CPT Testimonios
    register_post_type('testimonio', array(
        'label'                 => 'Testimonios',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'testimonios'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-format-quote',
        'supports'              => array('title', 'thumbnail', 'page-attributes'),
        'labels'                => array(
            'name'               => 'Testimonios',
            'singular_name'      => 'Testimonio',
            'add_new'            => 'Añadir Nuevo',
            'add_new_item'       => 'Añadir Nuevo Testimonio',
            'edit_item'          => 'Editar Testimonio',
            'new_item'           => 'Nuevo Testimonio',
            'view_item'          => 'Ver Testimonio',
            'search_items'       => 'Buscar Testimonios',
            'not_found'          => 'No se encontraron testimonios',
            'not_found_in_trash' => 'No se encontraron testimonios en la papelera',
        ),
    ));

    // CPT Talleres
    register_post_type('taller', array(
        'label'                 => 'Talleres',
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'talleres'),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-groups',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'labels'                => array(
            'name'               => 'Talleres',
            'singular_name'      => 'Taller',
            'add_new'            => 'Añadir Nuevo',
            'add_new_item'       => 'Añadir Nuevo Taller',
            'edit_item'          => 'Editar Taller',
            'new_item'           => 'Nuevo Taller',
            'view_item'          => 'Ver Taller',
            'search_items'       => 'Buscar Talleres',
            'not_found'          => 'No se encontraron talleres',
            'not_found_in_trash' => 'No se encontraron talleres en la papelera',
        ),
    ));
}
add_action('init', 'leticia_register_post_types');

/**
 * ===================================
 * FUNCIONES HELPER - TODAS LAS FALTANTES
 * ===================================
 */

// Logo del sitio
function leticia_site_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="site-logo">';
    } else {
        echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
    }
}

// Enlaces sociales - FUNCIÓN COMPLETA
function leticia_get_social_links($args = array()) {
    $defaults = array(
        'before' => '<div class="social-links">',
        'after' => '</div>',
        'show_labels' => false,
        'show_icons' => true,
        'target' => '_blank'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    // Obtener URLs de redes sociales
    $social_networks = array(
        'facebook' => array(
            'url' => leticia_get_site_setting('marca_facebook', ''),
            'icon' => 'fa-facebook',
            'label' => 'Facebook'
        ),
        'instagram' => array(
            'url' => leticia_get_site_setting('marca_instagram', ''),
            'icon' => 'fa-instagram',
            'label' => 'Instagram'
        ),
        'tiktok' => array(
            'url' => leticia_get_site_setting('marca_tiktok', ''),
            'icon' => 'fa-music',
            'label' => 'TikTok'
        ),
        'whatsapp' => array(
            'url' => leticia_get_site_setting('marca_whatsapp', ''),
            'icon' => 'fa-whatsapp',
            'label' => 'WhatsApp'
        ),
        'twitter' => array(
            'url' => get_theme_mod('twitter_url', ''),
            'icon' => 'fa-twitter',
            'label' => 'Twitter'
        ),
        'linkedin' => array(
            'url' => get_theme_mod('linkedin_url', ''),
            'icon' => 'fa-linkedin',
            'label' => 'LinkedIn'
        ),
    );
    
    $has_social = false;
    foreach ($social_networks as $network => $data) {
        if (!empty($data['url'])) {
            $has_social = true;
            break;
        }
    }
    
    if ($has_social) {
        echo $args['before'];
        foreach ($social_networks as $network => $data) {
            if (!empty($data['url'])) {
                $url = $data['url'];
                
                // Formatear WhatsApp
                if ($network === 'whatsapp' && !str_contains($url, 'wa.me')) {
                    $phone = preg_replace('/[^0-9]/', '', $url);
                    $url = 'https://wa.me/' . $phone;
                }
                
                echo '<a href="' . esc_url($url) . '" target="' . esc_attr($args['target']) . '" rel="noopener" class="social-link social-' . $network . '">';
                
                if ($args['show_icons']) {
                    echo '<i class="fa ' . $data['icon'] . '"></i>';
                }
                
                if ($args['show_labels']) {
                    echo '<span class="social-label">' . $data['label'] . '</span>';
                }
                
                echo '</a>';
            }
        }
        echo $args['after'];
    }
}


// Función para obtener servicios destacados
function leticia_get_featured_services($limit = 3) {
    $args = array(
        'post_type' => 'servicio',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'servicio_destacado',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    $services = get_posts($args);
    
    // Si no hay servicios destacados, obtener los primeros
    if (empty($services)) {
        $args = array(
            'post_type' => 'servicio',
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $services = get_posts($args);
    }
    
    return $services;
}

// Función para obtener testimonios destacados
function leticia_get_featured_testimonials($limit = 3) {
    $args = array(
        'post_type' => 'testimonio',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'testimonio_destacado',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    $testimonials = get_posts($args);
    
    // Si no hay testimonios destacados, obtener los primeros
    if (empty($testimonials)) {
        $args = array(
            'post_type' => 'testimonio',
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $testimonials = get_posts($args);
    }
    
    return $testimonials;
}

// Función para obtener talleres destacados
function leticia_get_featured_talleres($limit = 3) {
    $args = array(
        'post_type' => 'taller',
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'taller_destacado',
                'value' => '1',
                'compare' => '='
            )
        ),
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    $talleres = get_posts($args);
    
    // Si no hay talleres destacados, obtener los primeros
    if (empty($talleres)) {
        $args = array(
            'post_type' => 'taller',
            'posts_per_page' => $limit,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        );
        $talleres = get_posts($args);
    }
    
    return $talleres;
}

// Función segura para obtener campos ACF
function leticia_get_field($field_name, $post_id = null, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        return $value ? $value : $default;
    }
    return $default;
}

// Función para validar arrays de forma segura
function leticia_safe_array_access($array, $key, $default = '') {
    if (is_array($array) && isset($array[$key])) {
        return $array[$key];
    }
    return $default;
}

// Función para obtener imagen de forma segura
function leticia_get_image_field($field_name, $post_id = null, $size = 'medium') {
    $image = leticia_get_field($field_name, $post_id);
    
    if ($image) {
        if (is_array($image)) {
            return $image;
        } elseif (is_numeric($image)) {
            return wp_get_attachment_image_src($image, $size);
        }
    }
    
    return false;
}




/**
 * ===================================
 * ACTIVACIÓN DEL THEME
 * ===================================
 */
function leticia_theme_activation() {
    // Crear páginas necesarias si no existen
    $pages = array(
        'inicio' => 'Inicio',
        'sobre-mi' => 'Sobre Mí',
        'servicios' => 'Servicios',
        'talleres' => 'Talleres',
        'psicologia-del-estilo' => 'Psicología del Estilo',
        'contacto' => 'Contacto'
    );
    
    foreach ($pages as $slug => $title) {
        $page = get_page_by_path($slug);
        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'page'
            ));
            
            // Si es la página de inicio, configurarla como tal
            if ($slug === 'inicio' && $page_id) {
                update_option('page_on_front', $page_id);
                update_option('show_on_front', 'page');
            }
        }
    }
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'leticia_theme_activation');

/**
 * ===================================
 * DESACTIVAR JQUERY MIGRATE
 * ===================================
 */
function leticia_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'leticia_remove_jquery_migrate');

/**
 * ===================================
 * CSS CRÍTICO INLINE
 * ===================================
 */
function leticia_critical_css() {
    ?>
    <style>
    body {
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        line-height: 1.6;
        color: #333;
        margin: 0;
        padding: 0;
        padding-top: 80px;
        background-color: #ffffff;
    }
    
    .navbar {
        background-color: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding: 10px 0;
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }
    
    .navbar-brand img {
        max-height: 50px;
        width: auto;
    }
    
    .navbar-nav .nav-link {
        font-weight: 500;
        color: #333 !important;
        padding: 8px 16px !important;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .navbar-nav .nav-link:hover {
        color: #d4af37 !important;
    }
    
    .btn-primary {
        background-color: #d4af37;
        border-color: #d4af37;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 25px;
    }
    
    .btn-primary:hover {
        background-color: #b8960c;
        border-color: #b8960c;
    }
    
    .container, .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .site-main {
        margin-top: 0;
        min-height: 60vh;
    }
    
    @media (max-width: 768px) {
        body {
            padding-top: 70px;
        }
    }
    </style>
    <?php
}
add_action('wp_head', 'leticia_critical_css');

/**
 * ===================================
 * INCLUIR CAMPOS ACF
 * ===================================
 */
$acf_fields_file = get_template_directory() . '/inc/acf-fields.php';
if (file_exists($acf_fields_file)) {
    require_once $acf_fields_file;
}

/**
 * ===================================
 * FUNCIÓN FALTANTE: leticia_get_site_stats
 * ===================================
 */
function leticia_get_site_stats() {
    // Estadísticas básicas del sitio
    return array(
        'anos_experiencia' => leticia_get_site_setting('stats_anos_experiencia', '0+'),
        'clientas_satisfechas' => leticia_get_site_setting('stats_clientas_satisfechas', '0+'),
        'servicios_especializados' => leticia_get_site_setting('stats_servicios_especializados', '0+'),
        'transformaciones_exitosas' => leticia_get_site_setting('stats_transformaciones_exitosas', '%0'),
    );
}

/**
 * ===================================
 * LIMPIAR FUNCIONES PROBLEMÁTICAS
 * ===================================
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');



?>