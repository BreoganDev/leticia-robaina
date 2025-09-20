<?php
/**
 * Template Tags - Funciones auxiliares para templates
 *
 * @package Leticia_Robaina_Theme
 */

if ( ! defined('ABSPATH') ) { exit; }

/**
 * ===================================
 * AJUSTES DEL SITIO (Página "ajustes-del-sitio")
 * ===================================
 */

/**
 * Shim de compatibilidad:
 * Algunos templates llaman a leticia_get_settings_page_id().
 * Aquí lo definimos y lo unificamos con la lógica de ajustes.
 */
if ( ! function_exists('leticia_get_settings_page_id') ) {
    function leticia_get_settings_page_id(): int {
        $ajustes_id = (int) get_option('leticia_ajustes_page_id');
        if ( ! $ajustes_id ) {
            // Buscar por slug
            $page = get_page_by_path('ajustes-del-sitio', OBJECT, 'page');
            if ( $page && isset($page->ID) ) {
                $ajustes_id = (int) $page->ID;
                update_option('leticia_ajustes_page_id', $ajustes_id);
            }
        }
        return $ajustes_id ?: 0;
    }
}

/**
 * Obtener configuración de un campo en la página de ajustes
 */
if ( ! function_exists('leticia_get_site_setting') ) {
    function leticia_get_site_setting(string $field_name, $default = '') {
        $ajustes_id = leticia_get_settings_page_id();
        if ( $ajustes_id ) {
            // ACF disponible
            if ( function_exists('get_field') ) {
                $value = get_field($field_name, $ajustes_id);
                if ( $value !== null && $value !== '' ) {
                    return $value;
                }
            }
            // Fallback a post meta normal
            $meta = get_post_meta($ajustes_id, $field_name, true);
            if ( $meta !== '' ) {
                return $meta;
            }
        }
        return $default;
    }
}

/**
 * Alias de compatibilidad con código existente
 */
if ( ! function_exists('leticia_get_setting') ) {
    function leticia_get_setting(string $field_name, $default = '') {
        return leticia_get_site_setting($field_name, $default);
    }
}

/**
 * ===================================
 * INFORMACIÓN DE CONTACTO
 * ===================================
 */

if ( ! function_exists('leticia_get_contact_info') ) {
    function leticia_get_contact_info(string $field = '') {
        $defaults = [
            'phone'   => '+34 670 837 991',
            'email'   => 'info@leticiarobaina.com',
            'address' => 'Las Palmas de Gran Canaria',
            'horario' => 'L-V: 9:00-18:00h',
        ];

        $ajustes_id = leticia_get_settings_page_id();
        $contact_info = $defaults;

        if ( $ajustes_id ) {
            // ACF si existe
            if ( function_exists('get_field') ) {
                $phone   = get_field('contacto_telefono', $ajustes_id);
                $email   = get_field('contacto_email', $ajustes_id);
                $address = get_field('contacto_direccion_completa', $ajustes_id);
                $horario = get_field('contacto_horario', $ajustes_id);

                if ( $phone )   { $contact_info['phone']   = $phone; }
                if ( $email )   { $contact_info['email']   = $email; }
                if ( $address ) { $contact_info['address'] = $address; }
                if ( $horario ) { $contact_info['horario'] = $horario; }
            } else {
                // Fallback Customizer
                $contact_info['phone'] = get_theme_mod('contact_phone', $defaults['phone']);
                $contact_info['email'] = get_theme_mod('contact_email', $defaults['email']);
            }
        } else {
            // Sin página de ajustes, usa Customizer si existe
            $contact_info['phone'] = get_theme_mod('contact_phone', $defaults['phone']);
            $contact_info['email'] = get_theme_mod('contact_email', $defaults['email']);
        }

        if ( $field && isset($contact_info[$field]) ) {
            return $contact_info[$field];
        }
        return $contact_info;
    }
}

/**
 * ===================================
 * REDES SOCIALES
 * ===================================
 */

if ( ! function_exists('leticia_get_social_links') ) {
    function leticia_get_social_links(): array {
        $social_links = [];
        $networks = [ 'instagram', 'facebook', 'tiktok', 'linkedin' ];

        $ajustes_id = leticia_get_settings_page_id();
        if ( $ajustes_id && function_exists('get_field') ) {
            foreach ( $networks as $network ) {
                $url = get_field('marca_' . $network, $ajustes_id);
                if ( $url ) { $social_links[$network] = $url; }
            }
        } else {
            foreach ( $networks as $network ) {
                $url = get_theme_mod('social_' . $network);
                if ( $url ) { $social_links[$network] = $url; }
            }
        }

        return $social_links;
    }
}

if ( ! function_exists('leticia_social_links') ) {
    function leticia_social_links($args = []) {
        // Opciones por defecto compatibles con tu header.php
        $args = wp_parse_args($args, [
            'before'      => '<div class="social-links">', // wrapper abierto
            'after'       => '</div>',                     // wrapper cerrado
            'show_labels' => false,                        // etiquetas visibles (además del sr-only)
            'target'      => '_blank',                     // destino de enlaces
            'rel'         => 'noopener'                    // seguridad
        ]);

        $social_links = leticia_get_social_links();
        if ( empty($social_links) ) { return; }

        echo $args['before'];

        foreach ( $social_links as $network => $url ) {
            // Iconos (Themify no tiene TikTok)
            switch ($network) {
                case 'instagram': $icon_class = 'ti-instagram'; break;
                case 'facebook':  $icon_class = 'ti-facebook';  break;
                case 'tiktok':    $icon_class = 'ti-music';     break;
                case 'linkedin':  $icon_class = 'ti-linkedin';  break;
                default:          $icon_class = 'ti-' . $network; break;
            }

            echo '<a href="' . esc_url($url) . '" target="' . esc_attr($args['target']) . '" rel="' . esc_attr($args['rel']) . '" class="social-link social-' . esc_attr($network) . '">';
            echo '<i class="' . esc_attr($icon_class) . '"></i>';

            // Accesibilidad: siempre sr-only; opcionalmente etiqueta visible
            $label = esc_html(ucfirst($network));
            echo '<span class="sr-only">' . $label . '</span>';
            if ( $args['show_labels'] ) {
                echo '<span class="social-label" aria-hidden="true">' . $label . '</span>';
            }

            echo '</a>';
        }

        echo $args['after'];
    }
}


/**
 * ===================================
 * SERVICIOS
 * ===================================
 */

if ( ! function_exists('leticia_get_featured_services') ) {
    function leticia_get_featured_services(int $limit = 3): WP_Query {
        $args = [
            'post_type'      => 'servicio',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'     => 'servicio_destacado',
                    'value'   => '1',
                    'compare' => '=',
                ],
            ],
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ];
        return new WP_Query($args);
    }
}

if ( ! function_exists('leticia_display_services_grid') ) {
    function leticia_display_services_grid(int $limit = 6, bool $featured_only = false) {
        $args = [
            'post_type'      => 'servicio',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ];
        if ( $featured_only ) {
            $args['meta_query'] = [
                [
                    'key'     => 'servicio_destacado',
                    'value'   => '1',
                    'compare' => '=',
                ],
            ];
        }

        $services = new WP_Query($args);

        if ( $services->have_posts() ) :
            echo '<div class="services-grid row">';
            while ( $services->have_posts() ) : $services->the_post(); ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="service-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="service-image">
                                <?php the_post_thumbnail('service-thumb'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="service-content">
                            <h3><?php the_title(); ?></h3>

                            <?php if ( function_exists('get_field') ) : ?>
                                <?php if ( $icono = get_field('servicio_icono') ) : ?>
                                    <i class="<?php echo esc_attr($icono); ?>"></i>
                                <?php endif; ?>

                                <?php if ( $precio = get_field('servicio_precio') ) : ?>
                                    <div class="service-price"><?php echo esc_html($precio); ?></div>
                                <?php endif; ?>

                                <?php if ( $duracion = get_field('servicio_duracion') ) : ?>
                                    <div class="service-duration"><?php echo esc_html($duracion); ?></div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="service-excerpt"><?php the_excerpt(); ?></div>

                            <?php
                            $cta_texto = function_exists('get_field') ? ( get_field('servicio_cta_texto') ?: 'Más información' ) : 'Más información';
                            $cta_url   = function_exists('get_field') ? ( get_field('servicio_cta_url') ?: get_permalink() ) : get_permalink();
                            ?>
                            <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary"><?php echo esc_html($cta_texto); ?></a>
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        endif;
    }
}

/**
 * ===================================
 * TESTIMONIOS
 * ===================================
 */

if ( ! function_exists('leticia_get_featured_testimonials') ) {
    function leticia_get_featured_testimonials(int $limit = 3): WP_Query {
        $args = [
            'post_type'      => 'testimonio',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'meta_query'     => [
                [
                    'key'     => 'testimonio_destacado',
                    'value'   => '1',
                    'compare' => '=',
                ],
            ],
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ];
        return new WP_Query($args);
    }
}

if ( ! function_exists('leticia_display_testimonials_slider') ) {
    function leticia_display_testimonials_slider(int $limit = 5) {
        $q = new WP_Query([
            'post_type'      => 'testimonio',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        if ( $q->have_posts() ) : ?>
            <div class="testimonials-slider">
                <div class="testimonials-wrapper">
                    <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                        <div class="testimonial-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="testimonial-avatar">
                                    <?php the_post_thumbnail('testimonial-thumb'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="testimonial-content">
                                <?php if ( function_exists('get_field') && ( $texto = get_field('testimonio_texto') ) ) : ?>
                                    <blockquote><?php echo esc_html($texto); ?></blockquote>
                                <?php else : ?>
                                    <blockquote><?php the_content(); ?></blockquote>
                                <?php endif; ?>

                                <?php
                                $puntuacion = function_exists('get_field') ? (int) ( get_field('testimonio_puntuacion') ?: 5 ) : 5;
                                ?>
                                <div class="testimonial-rating" aria-label="<?php echo esc_attr($puntuacion); ?>/5">
                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                        <i class="<?php echo $i <= $puntuacion ? 'ti-star' : 'ti-star-o'; ?>"></i>
                                    <?php endfor; ?>
                                </div>

                                <div class="testimonial-author">
                                    <cite>
                                        <?php the_title(); ?>
                                        <?php if ( function_exists('get_field') && ( $rol = get_field('testimonio_rol') ) ) : ?>
                                            <span class="role"><?php echo esc_html($rol); ?></span>
                                        <?php endif; ?>
                                    </cite>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
}

/**
 * ===================================
 * UTILIDADES GENERALES
 * ===================================
 */

if ( ! function_exists('leticia_site_logo') ) {
    function leticia_site_logo() {
        if ( has_custom_logo() ) {
            the_custom_logo();
        } else {
            echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . esc_html(get_bloginfo('name')) . '</a>';
        }
    }
}

if ( ! function_exists('leticia_breadcrumbs') ) {
    function leticia_breadcrumbs() {
        if ( is_front_page() ) { return; }
        echo '<nav class="breadcrumbs" aria-label="breadcrumb">';
        echo '<a href="' . esc_url(home_url('/')) . '">Inicio</a>';
        if ( is_category() || is_single() ) {
            echo ' &raquo; ';
            the_category(' &raquo; ');
            if ( is_single() ) {
                echo ' &raquo; ';
                the_title();
            }
        } elseif ( is_page() ) {
            echo ' &raquo; ';
            the_title();
        }
        echo '</nav>';
    }
}

/**
 * Formatear fecha en español (simple)
 */
if ( ! function_exists('leticia_format_date') ) {
    function leticia_format_date($date, $format = 'd \d\e F \d\e Y') {
        $timestamp = is_numeric($date) ? (int) $date : strtotime($date);
        if ( ! $timestamp ) { return ''; }

        $formatted = date($format, $timestamp);
        $en = [ 'January','February','March','April','May','June','July','August','September','October','November','December' ];
        $es = [ 'enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre' ];
        return str_replace($en, $es, $formatted);
    }
}

/**
 * Truncar texto
 */
if ( ! function_exists('leticia_truncate_text') ) {
    function leticia_truncate_text(string $text, int $limit = 150, string $ending = '...') {
        if ( strlen($text) > $limit ) {
            return mb_substr($text, 0, $limit) . $ending;
        }
        return $text;
    }
}

/**
 * URL de WhatsApp
 */
if ( ! function_exists('leticia_get_whatsapp_url') ) {
    function leticia_get_whatsapp_url(string $message = '') {
        $phone = leticia_get_site_setting('marca_whatsapp');
        if ( ! $phone ) {
            $phone = leticia_get_contact_info('phone');
        }
        $clean_phone = preg_replace('/[^0-9+]/', '', (string) $phone);
        if ( ! $message ) {
            $message = 'Hola, me gustaría obtener más información sobre tus servicios.';
        }
        return 'https://wa.me/' . $clean_phone . '?text=' . rawurlencode($message);
    }
}

/**
 * ===================================
 * PAGINACIÓN (faltaba)
 * ===================================
 */
if ( ! function_exists('leticia_pagination') ) {
    function leticia_pagination(\WP_Query $query = null) {
        if ( ! $query ) { global $wp_query; $query = $wp_query; }
        if ( ! $query || (int) $query->max_num_pages <= 1 ) { return; }

        echo '<nav class="pagination" role="navigation" aria-label="Paginación">';
        echo paginate_links([
            'total'     => (int) $query->max_num_pages,
            'current'   => max(1, (int) get_query_var('paged')),
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
        ]);
        echo '</nav>';
    }
}

/**
 * ===================================
 * ESTADÍSTICAS (faltaba)
 * ===================================
 * Devuelve un array con métricas básicas mostradas en "Sobre mí".
 * Campos esperados en la página de ajustes (ACF o meta):
 *  - stat_clientes
 *  - stat_proyectos
 *  - stat_anios
 */
if ( ! function_exists('leticia_get_site_stats') ) {
    function leticia_get_site_stats(): array {
        // 1) Intentar leer desde la "Página de Ajustes" (con varios nombres posibles)
        $anios = 0;
        $clientes = 0;
        $proyectos = 0;

        // Años de experiencia
        $anios = (int) leticia_get_site_setting('stat_anios', 0);
        if ( ! $anios ) $anios = (int) leticia_get_site_setting('stat_anos_experiencia', 0);
        if ( ! $anios ) $anios = (int) leticia_get_site_setting('anos_experiencia', 0);

        // Clientes
        $clientes = (int) leticia_get_site_setting('stat_clientes', 0);
        if ( ! $clientes ) $clientes = (int) leticia_get_site_setting('stat_clientes_satisfechos', 0);
        if ( ! $clientes ) $clientes = (int) leticia_get_site_setting('clientes_satisfechos', 0);

        // Proyectos/Servicios
        $proyectos = (int) leticia_get_site_setting('stat_proyectos', 0);
        if ( ! $proyectos ) $proyectos = (int) leticia_get_site_setting('stat_servicios', 0);
        if ( ! $proyectos ) $proyectos = (int) leticia_get_site_setting('servicios', 0);

        // 2) Fallbacks si faltan datos (consultas ligeras)
        if ( ! $proyectos ) {
            $c = wp_count_posts('servicio');
            $proyectos = ($c && isset($c->publish)) ? (int) $c->publish : 0;
        }
        if ( ! $clientes ) {
            $c = wp_count_posts('testimonio');
            $clientes = ($c && isset($c->publish)) ? (int) $c->publish : 0;
        }
        if ( ! $anios ) {
            $first = get_posts([
                'post_type'      => 'any',
                'posts_per_page' => 1,
                'order'          => 'ASC',
                'orderby'        => 'date',
                'fields'         => 'ids',
            ]);
            if ( $first ) {
                $year_first = (int) get_the_date('Y', $first[0]);
                $anios = max(0, (int) date('Y') - $year_first);
            }
        }

        // 3) Devolver ambas nomenclaturas (nueva + legado)
        return [
            // Nueva
            'anios'     => (int) $anios,
            'clientes'  => (int) $clientes,
            'proyectos' => (int) $proyectos,

            // Legado (compatibilidad con tu plantilla)
            'anos_experiencia'     => (int) $anios,
            'clientes_satisfechos' => (int) $clientes,
            'servicios'            => (int) $proyectos,
        ];
    }
}


if ( ! function_exists('leticia_nav_menu_fallback') ) {
    function leticia_nav_menu_fallback( $args = [] ) {
        // Solo mostramos algo al admin para que configure menús.
        if ( current_user_can('edit_theme_options') ) {
            echo '<ul id="primary-menu" class="nav-menu">';
            echo '<li><a href="' . esc_url( admin_url('nav-menus.php') ) . '">'
                . esc_html__('Configura el menú de navegación', 'leticia-robaina')
                . '</a></li>';
            echo '</ul>';
        }
    }
}

