<?php
/**
 * Configuración principal del theme
 * 
 * @package Leticia_Robaina_Theme
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ===================================
 * CONFIGURACIÓN PRINCIPAL DEL THEME
 * ===================================
 */
function leticia_setup() {
    // Soporte básico de WordPress
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style'
    ));
    
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    
    // Añadir soporte para estilos del editor
    add_editor_style('assets/css/editor.css');
    
    // Menús de navegación
    register_nav_menus(array(
        'primary' => 'Menú Principal',
        'footer'  => 'Menú Footer'
    ));
    
    // Tamaños de imagen personalizados
    add_image_size('hero-image', 2500, 1668, true);
    add_image_size('service-thumb', 400, 300, true);
    add_image_size('testimonial-thumb', 150, 150, true);
    add_image_size('gallery-thumb', 300, 300, true);
}
add_action('after_setup_theme', 'leticia_setup');

/**
 * ===================================
 * CUSTOM POST TYPES
 * ===================================
 */
function leticia_register_post_types() {
    
    // CPT SERVICIOS
    register_post_type('servicio', array(
        'labels' => array(
            'name'               => 'Servicios',
            'singular_name'      => 'Servicio',
            'menu_name'          => 'Servicios',
            'add_new'            => 'Añadir Servicio',
            'add_new_item'       => 'Añadir Nuevo Servicio',
            'edit_item'          => 'Editar Servicio',
            'new_item'           => 'Nuevo Servicio',
            'view_item'          => 'Ver Servicio',
            'search_items'       => 'Buscar Servicios',
            'not_found'          => 'No se encontraron servicios',
            'not_found_in_trash' => 'No se encontraron servicios en la papelera'
        ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'servicios'),
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'    => 'dashicons-portfolio',
        'show_in_rest' => true,
    ));
    
    // CPT TESTIMONIOS
    register_post_type('testimonio', array(
        'labels' => array(
            'name'               => 'Testimonios',
            'singular_name'      => 'Testimonio',
            'menu_name'          => 'Testimonios',
            'add_new'            => 'Añadir Testimonio',
            'add_new_item'       => 'Añadir Nuevo Testimonio',
            'edit_item'          => 'Editar Testimonio',
            'new_item'           => 'Nuevo Testimonio',
            'view_item'          => 'Ver Testimonio',
            'search_items'       => 'Buscar Testimonios',
            'not_found'          => 'No se encontraron testimonios',
            'not_found_in_trash' => 'No se encontraron testimonios en la papelera'
        ),
        'public'       => true,
        'has_archive'  => false,
        'rewrite'      => array('slug' => 'testimonios'),
        'supports'     => array('title', 'thumbnail', 'page-attributes'),
        'menu_icon'    => 'dashicons-format-quote',
        'show_in_rest' => true,
    ));
}
add_action('init', 'leticia_register_post_types');

/**
 * ===================================
 * TAXONOMÍAS PERSONALIZADAS
 * ===================================
 */
function leticia_register_taxonomies() {
    
    // Taxonomía para categorizar servicios
    register_taxonomy('servicio_categoria', array('servicio'), array(
        'labels' => array(
            'name'              => 'Categorías de Servicios',
            'singular_name'     => 'Categoría de Servicio',
            'search_items'      => 'Buscar Categorías',
            'all_items'         => 'Todas las Categorías',
            'parent_item'       => 'Categoría Padre',
            'parent_item_colon' => 'Categoría Padre:',
            'edit_item'         => 'Editar Categoría',
            'update_item'       => 'Actualizar Categoría',
            'add_new_item'      => 'Añadir Nueva Categoría',
            'new_item_name'     => 'Nombre de Nueva Categoría',
            'menu_name'         => 'Categorías',
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-servicio'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'leticia_register_taxonomies');

/**
 * ===================================
 * CONFIGURACIÓN DEL CUSTOMIZER
 * ===================================
 */
function leticia_customize_register($wp_customize) {
    
    // SECCIÓN: Información de contacto
    $wp_customize->add_section('leticia_contact', array(
        'title'    => 'Información de Contacto',
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+34 123 456 789',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'   => 'Teléfono',
        'section' => 'leticia_contact',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'contacto@leticiarobaina.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'   => 'Email',
        'section' => 'leticia_contact',
        'type'    => 'email',
    ));
    
    // SECCIÓN: Redes sociales
    $wp_customize->add_section('leticia_social', array(
        'title'    => 'Redes Sociales',
        'priority' => 35,
    ));
    
    $social_networks = array(
        'instagram' => 'Instagram',
        'facebook'  => 'Facebook',
        'linkedin'  => 'LinkedIn',
        'tiktok'    => 'TikTok'
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("social_$network", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("social_$network", array(
            'label'   => "URL de $label",
            'section' => 'leticia_social',
            'type'    => 'url',
        ));
    }
    
    // SECCIÓN: Colores del tema
    $wp_customize->add_section('leticia_colors', array(
        'title'    => 'Colores del Tema',
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#B8860B',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => 'Color Primario',
        'section'  => 'leticia_colors',
        'settings' => 'primary_color',
    )));
    
    $wp_customize->add_setting('secondary_color', array(
        'default'           => '#2C3E50',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label'    => 'Color Secundario',
        'section'  => 'leticia_colors',
        'settings' => 'secondary_color',
    )));
}
add_action('customize_register', 'leticia_customize_register');

/**
 * ===================================
 * CONFIGURAR PÁGINA DE AJUSTES
 * ===================================
 */
function leticia_setup_ajustes_page() {
    $page = get_page_by_path('ajustes-del-sitio');
    if ($page) {
        update_option('leticia_ajustes_page_id', $page->ID);
    }
}
add_action('init', 'leticia_setup_ajustes_page');