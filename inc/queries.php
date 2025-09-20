<?php
/**
 * Queries personalizadas para CPTs
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Obtener todos los talleres ordenados
 */
function leticia_get_talleres($args = array()) {
    $defaults = array(
        'post_type' => 'taller',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => 'taller_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * Obtener talleres destacados para homepage
 */
function leticia_get_featured_talleres($limit = 3) {
    return leticia_get_talleres(array(
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'taller_destacado',
                'value' => '1',
                'compare' => '='
            )
        )
    ));
}

/**
 * Obtener servicios ordenados
 */
function leticia_get_servicios($args = array()) {
    $defaults = array(
        'post_type' => 'servicio',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * Obtener servicios por categoría
 */
function leticia_get_servicios_by_category($category_slug, $args = array()) {
    $defaults = array(
        'post_type' => 'servicio',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'servicio_categoria',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        ),
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * Obtener testimonios
 */
function leticia_get_testimonios($args = array()) {
    $defaults = array(
        'post_type' => 'testimonio',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * Obtener testimonios con video
 */
function leticia_get_video_testimonios($limit = 3) {
    return leticia_get_testimonios(array(
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'testimonio_video_url',
                'value' => '',
                'compare' => '!='
            )
        )
    ));
}

/**
 * Obtener testimonios de texto para sliders
 */
function leticia_get_text_testimonios($limit = 5) {
    return leticia_get_testimonios(array(
        'posts_per_page' => $limit,
        'meta_query' => array(
            array(
                'key' => 'testimonio_texto',
                'value' => '',
                'compare' => '!='
            )
        )
    ));
}

/**
 * Obtener posts relacionados
 */
function leticia_get_related_posts($post_id = null, $limit = 3) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    $post_type = get_post_type($post_id);
    
    // Obtener taxonomías del post actual
    $taxonomies = get_object_taxonomies($post_type);
    $tax_query = array('relation' => 'OR');
    
    foreach ($taxonomies as $taxonomy) {
        $terms = get_the_terms($post_id, $taxonomy);
        if ($terms && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_ids,
            );
        }
    }
    
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'post__not_in' => array($post_id),
        'orderby' => 'rand'
    );
    
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }
    
    return new WP_Query($args);
}

/**
 * Buscar contenido en múltiples CPTs
 */
function leticia_search_content($search_term, $post_types = array('page', 'post', 'servicio', 'taller'), $limit = 10) {
    $args = array(
        'post_type' => $post_types,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        's' => sanitize_text_field($search_term),
        'orderby' => 'relevance'
    );
    
    return new WP_Query($args);
}

/**
 * Obtener contenido reciente de todos los CPTs
 */
function leticia_get_recent_content($limit = 5, $post_types = array('servicio', 'taller')) {
    $args = array(
        'post_type' => $post_types,
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    return new WP_Query($args);
}

/**
 * Obtener estadísticas de contenido
 */
function leticia_get_content_stats() {
    $stats = array();
    
    $post_types = array('servicio', 'taller', 'testimonio');
    
    foreach ($post_types as $post_type) {
        $count = wp_count_posts($post_type);
        $stats[$post_type] = $count->publish;
    }
    
    return $stats;
}

/**
 * Query para breadcrumbs de CPTs
 */
function leticia_get_cpt_breadcrumb_parent($post_type) {
    $parents = array(
        'servicio' => array(
            'title' => 'Servicios',
            'url' => get_page_link(get_page_by_path('servicios'))
        ),
        'taller' => array(
            'title' => 'Talleres',
            'url' => get_page_link(get_page_by_path('talleres'))
        ),
        'testimonio' => array(
            'title' => 'Testimonios',
            'url' => home_url('/#testimonios')
        )
    );
    
    return isset($parents[$post_type]) ? $parents[$post_type] : null;
}

/**
 * Modificar query principal para archives de CPTs
 */
function leticia_modify_main_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        
        // Archive de talleres
        if (is_post_type_archive('taller')) {
            $query->set('meta_key', 'taller_order');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', 9);
        }
        
        // Archive de servicios
        if (is_post_type_archive('servicio')) {
            $query->set('orderby', 'menu_order');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', 12);
        }
        
        // Búsquedas - incluir CPTs
        if (is_search()) {
            $query->set('post_type', array('page', 'post', 'servicio', 'taller'));
        }
    }
}
add_action('pre_get_posts', 'leticia_modify_main_query');

/**
 * Añadir CPTs al sitemap de WordPress
 */
function leticia_add_cpts_to_sitemap($post_types) {
    $post_types[] = 'servicio';
    $post_types[] = 'taller';
    return $post_types;
}
add_filter('wp_sitemaps_post_types', 'leticia_add_cpts_to_sitemap');

/**
 * Helper para obtener el siguiente/anterior post del mismo tipo
 */
function leticia_get_adjacent_cpt_post($post_type, $direction = 'next') {
    global $post;
    
    $current_post = $post;
    
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    );
    
    $all_posts = get_posts($args);
    $current_index = array_search($current_post->ID, $all_posts);
    
    if ($current_index === false) {
        return null;
    }
    
    if ($direction === 'next') {
        $next_index = $current_index + 1;
        return isset($all_posts[$next_index]) ? get_post($all_posts[$next_index]) : null;
    } else {
        $prev_index = $current_index - 1;
        return isset($all_posts[$prev_index]) ? get_post($all_posts[$prev_index]) : null;
    }
}

/**
 * Cache para queries pesadas
 */
function leticia_get_cached_query($cache_key, $query_function, $args = array(), $expiration = HOUR_IN_SECONDS) {
    $cached_result = get_transient($cache_key);
    
    if ($cached_result === false) {
        $result = call_user_func_array($query_function, $args);
        set_transient($cache_key, $result, $expiration);
        return $result;
    }
    
    return $cached_result;
}

/**
 * Limpiar cache al actualizar posts
 */
function leticia_clear_query_cache($post_id) {
    $post_type = get_post_type($post_id);
    
    // Limpiar caches relacionados con el tipo de post
    $cache_keys = array(
        'leticia_talleres_' . $post_type,
        'leticia_servicios_' . $post_type,
        'leticia_testimonios_' . $post_type,
        'leticia_recent_content',
        'leticia_featured_content'
    );
    
    foreach ($cache_keys as $key) {
        delete_transient($key);
    }
}
add_action('save_post', 'leticia_clear_query_cache');
add_action('delete_post', 'leticia_clear_query_cache');

/**
 * Query para obtener contenido destacado de la homepage
 */
function leticia_get_homepage_content() {
    $cache_key = 'leticia_homepage_content';
    
    return leticia_get_cached_query($cache_key, function() {
        $content = array();
        
        // Servicios destacados
        $content['servicios'] = leticia_get_servicios(array(
            'posts_per_page' => 3,
            'meta_query' => array(
                array(
                    'key' => 'servicio_destacado_home',
                    'value' => '1',
                    'compare' => '='
                )
            )
        ));
        
        // Si no hay servicios destacados, tomar los primeros 3
        if (!$content['servicios']->have_posts()) {
            $content['servicios'] = leticia_get_servicios(array('posts_per_page' => 3));
        }
        
        // Talleres destacados
        $content['talleres'] = leticia_get_talleres(array('posts_per_page' => 3));
        
        // Testimonios para slider
        $content['testimonios'] = leticia_get_text_testimonios(5);
        
        return $content;
    });
}