<?php
/**
 * Configuración COMPLETA de campos ACF para Leticia Robaina Theme
 * TODOS los custom fields necesarios para replicar https://leticiarobaina.com
 */

// Solo ejecutar si ACF está activo
if (function_exists('acf_add_local_field_group')) {

    /**
     * ===================================
     * CAMPOS PARA PÁGINA HOME - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_home_fields',
        'title' => 'Configuración de la Página de Inicio',
        'fields' => array(
            // HERO SECTION
            array(
                'key' => 'field_home_hero_titulo',
                'label' => 'Título del Hero',
                'name' => 'home_hero_titulo',
                'type' => 'text',
                'default_value' => '¿Te sientes insatisfecha con tu estilo?',
                'placeholder' => 'Título principal del hero',
            ),
            array(
                'key' => 'field_home_hero_subtitulo',
                'label' => 'Subtítulo del Hero',
                'name' => 'home_hero_subtitulo',
                'type' => 'text',
                'default_value' => 'Sé tu propia asesora de imagen',
                'placeholder' => 'Subtítulo del hero',
            ),
            array(
                'key' => 'field_home_hero_descripcion',
                'label' => 'Descripción del Hero',
                'name' => 'home_hero_descripcion',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Si te encuentras comparándote continuamente con otras personas que parecen tener un estilo que te gustaría tener es un claro síntoma de que te sientes insatisfecho con tu estilo.',
            ),
            array(
                'key' => 'field_home_hero_cta_texto',
                'label' => 'Texto del Botón Principal',
                'name' => 'home_hero_cta_texto',
                'type' => 'text',
                'default_value' => 'Reservar Consulta',
                'placeholder' => 'Texto del botón',
            ),
            array(
                'key' => 'field_home_hero_cta_url',
                'label' => 'URL del Botón Principal',
                'name' => 'home_hero_cta_url',
                'type' => 'url',
                'default_value' => '/contacto',
                'placeholder' => 'https://...',
            ),
            array(
                'key' => 'field_home_hero_imagen',
                'label' => 'Imagen de Fondo del Hero',
                'name' => 'home_hero_imagen',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            
            // SECCIÓN "EL PODER DE LLEVAR TU PROPIO ESTILO"
            array(
                'key' => 'field_home_poder_titulo',
                'label' => 'Título "El Poder de Llevar tu Propio Estilo"',
                'name' => 'home_poder_titulo',
                'type' => 'text',
                'default_value' => 'El poder de llevar tu propio estilo',
            ),
            array(
                'key' => 'field_home_poder_texto',
                'label' => 'Texto de la Sección "Poder"',
                'name' => 'home_poder_texto',
                'type' => 'textarea',
                'rows' => 6,
                'default_value' => 'Dicen que tengo un estilo muy claro, atrevido y cuidado pero no siempre fue así. Mi imagen ha ido evolucionando de la mano de un proceso de autoconocimiento y aceptación de mí misma.',
            ),
            array(
                'key' => 'field_home_poder_imagen',
                'label' => 'Imagen de la Sección "Poder"',
                'name' => 'home_poder_imagen',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_home_poder_cta_texto',
                'label' => 'Texto Botón "Sobre Mí"',
                'name' => 'home_poder_cta_texto',
                'type' => 'text',
                'default_value' => 'Sobre mí',
            ),
            
            // METODOLOGÍA LONDRES
            array(
                'key' => 'field_home_metodologia_titulo',
                'label' => 'Título Metodología',
                'name' => 'home_metodologia_titulo',
                'type' => 'text',
                'default_value' => 'Mi Metodología',
            ),
            array(
                'key' => 'field_home_metodologia_subtitulo',
                'label' => 'Subtítulo Metodología',
                'name' => 'home_metodologia_subtitulo',
                'type' => 'text',
                'default_value' => 'He desarrollado el MÉTODO LONDRES, una metodología única para que indagues en tu imagen y encuentres tu estilo personal coherente con tus valores e ideales.',
            ),
            
            // 3 PILARES DE LA METODOLOGÍA
            array(
                'key' => 'field_home_pilar1_icono',
                'label' => 'Icono Pilar 1 (Autoconocimiento)',
                'name' => 'home_pilar1_icono',
                'type' => 'text',
                'default_value' => 'ti-search',
                'instructions' => 'Clase del icono (ej: ti-search)',
            ),
            array(
                'key' => 'field_home_pilar1_titulo',
                'label' => 'Título Pilar 1',
                'name' => 'home_pilar1_titulo',
                'type' => 'text',
                'default_value' => 'Autoconocimiento',
            ),
            array(
                'key' => 'field_home_pilar1_texto',
                'label' => 'Texto Pilar 1',
                'name' => 'home_pilar1_texto',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Exploramos juntas quién eres realmente, tus valores, personalidad y estilo de vida.',
            ),
            array(
                'key' => 'field_home_pilar2_icono',
                'label' => 'Icono Pilar 2 (Análisis)',
                'name' => 'home_pilar2_icono',
                'type' => 'text',
                'default_value' => 'ti-target',
            ),
            array(
                'key' => 'field_home_pilar2_titulo',
                'label' => 'Título Pilar 2',
                'name' => 'home_pilar2_titulo',
                'type' => 'text',
                'default_value' => 'Análisis de Estilo',
            ),
            array(
                'key' => 'field_home_pilar2_texto',
                'label' => 'Texto Pilar 2',
                'name' => 'home_pilar2_texto',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Analizamos tu colorimetría, morfología y estilo personal para potenciar tu imagen.',
            ),
            array(
                'key' => 'field_home_pilar3_icono',
                'label' => 'Icono Pilar 3 (Transformación)',
                'name' => 'home_pilar3_icono',
                'type' => 'text',
                'default_value' => 'ti-heart',
            ),
            array(
                'key' => 'field_home_pilar3_titulo',
                'label' => 'Título Pilar 3',
                'name' => 'home_pilar3_titulo',
                'type' => 'text',
                'default_value' => 'Transformación',
            ),
            array(
                'key' => 'field_home_pilar3_texto',
                'label' => 'Texto Pilar 3',
                'name' => 'home_pilar3_texto',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Implementamos cambios coherentes que reflejen tu esencia y potencien tu autoestima.',
            ),
            
            // MI HISTORIA
            array(
                'key' => 'field_home_historia_titulo',
                'label' => 'Título Mi Historia',
                'name' => 'home_historia_titulo',
                'type' => 'text',
                'default_value' => 'Mi Historia',
            ),
            array(
                'key' => 'field_home_historia_texto',
                'label' => 'Texto Mi Historia',
                'name' => 'home_historia_texto',
                'type' => 'textarea',
                'rows' => 6,
                'default_value' => 'Dicen que tengo un estilo muy claro, atrevido y cuidado, pero no siempre fue así. Mi imagen ha ido evolucionando de la mano de un proceso de autoconocimiento y aceptación de mí misma.',
            ),
            
            // ESTADÍSTICAS
            array(
                'key' => 'field_home_stats_anos',
                'label' => 'Años de Experiencia',
                'name' => 'home_stats_anos',
                'type' => 'text',
                'default_value' => '0+',
            ),
            array(
                'key' => 'field_home_stats_clientas',
                'label' => 'Clientas Satisfechas',
                'name' => 'home_stats_clientas',
                'type' => 'text',
                'default_value' => '0+',
            ),
            array(
                'key' => 'field_home_stats_servicios',
                'label' => 'Servicios Especializados',
                'name' => 'home_stats_servicios',
                'type' => 'text',
                'default_value' => '0+',
            ),
            array(
                'key' => 'field_home_stats_transformaciones',
                'label' => 'Transformaciones Exitosas',
                'name' => 'home_stats_transformaciones',
                'type' => 'text',
                'default_value' => '%0',
            ),
            
            // CTA FINAL
            array(
                'key' => 'field_home_cta_titulo',
                'label' => 'Título CTA Final',
                'name' => 'home_cta_titulo',
                'type' => 'text',
                'default_value' => '¿Preparada para descubrir tu verdadero estilo?',
            ),
            array(
                'key' => 'field_home_cta_texto',
                'label' => 'Texto CTA Final',
                'name' => 'home_cta_texto',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Empecemos juntas este viaje hacia el descubrimiento de tu imagen auténtica.',
            ),
            array(
                'key' => 'field_home_cta_boton_primario_texto',
                'label' => 'Texto Botón Primario CTA',
                'name' => 'home_cta_boton_primario_texto',
                'type' => 'text',
                'default_value' => 'Reserva tu Consulta',
            ),
            array(
                'key' => 'field_home_cta_boton_primario_url',
                'label' => 'URL Botón Primario CTA',
                'name' => 'home_cta_boton_primario_url',
                'type' => 'url',
                'default_value' => '/contacto',
            ),
            array(
                'key' => 'field_home_cta_boton_secundario_texto',
                'label' => 'Texto Botón Secundario CTA',
                'name' => 'home_cta_boton_secundario_texto',
                'type' => 'text',
                'default_value' => 'Ver Servicios',
            ),
            array(
                'key' => 'field_home_cta_boton_secundario_url',
                'label' => 'URL Botón Secundario CTA',
                'name' => 'home_cta_boton_secundario_url',
                'type' => 'url',
                'default_value' => '/servicios',
            ),
            
            // NEWSLETTER
            array(
                'key' => 'field_home_newsletter_titulo',
                'label' => 'Título Newsletter',
                'name' => 'home_newsletter_titulo',
                'type' => 'text',
                'default_value' => 'Newsletter',
            ),
            array(
                'key' => 'field_home_newsletter_placeholder',
                'label' => 'Placeholder Newsletter',
                'name' => 'home_newsletter_placeholder',
                'type' => 'text',
                'default_value' => 'Tu email',
            ),
            array(
                'key' => 'field_home_newsletter_boton',
                'label' => 'Texto Botón Newsletter',
                'name' => 'home_newsletter_boton',
                'type' => 'text',
                'default_value' => 'Suscribirme',
            ),
            array(
                'key' => 'field_home_newsletter_legal',
                'label' => 'Texto Legal Newsletter',
                'name' => 'home_newsletter_legal',
                'type' => 'text',
                'default_value' => 'Acepto Aviso legal y política de privacidad',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home.php',
                ),
            ),
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_option('page_on_front'),
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA PÁGINA SOBRE MÍ - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_sobre_mi_fields',
        'title' => 'Configuración de Sobre Mí',
        'fields' => array(
            array(
                'key' => 'field_sobre_titulo_principal',
                'label' => 'Título Principal',
                'name' => 'sobre_titulo_principal',
                'type' => 'text',
                'default_value' => 'Sobre mí',
            ),
            array(
                'key' => 'field_sobre_foto_principal',
                'label' => 'Foto Principal',
                'name' => 'sobre_foto_principal',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_sobre_intro_titulo',
                'label' => 'Título de Introducción',
                'name' => 'sobre_intro_titulo',
                'type' => 'text',
                'default_value' => 'SOY LETICIA ROBAINA MI HISTORIA',
            ),
            array(
                'key' => 'field_sobre_intro_texto',
                'label' => 'Texto de Introducción',
                'name' => 'sobre_intro_texto',
                'type' => 'textarea',
                'rows' => 8,
                'default_value' => 'Fui el Patito Feo durante muchos años de mi vida ya que me sentía muy alejada de los cánones de belleza...',
            ),
            array(
                'key' => 'field_sobre_metodologia_titulo',
                'label' => 'Título Metodología',
                'name' => 'sobre_metodologia_titulo',
                'type' => 'text',
                'default_value' => 'Mi Metodología',
            ),
            array(
                'key' => 'field_sobre_metodologia_texto',
                'label' => 'Texto Metodología',
                'name' => 'sobre_metodologia_texto',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'He desarrollado el MÉTODO LONDRES, una metodología única para que indagues en tu imagen y así encuentres tu estilo personal coherente con tus valores e ideales.',
            ),
            array(
                'key' => 'field_sobre_historia_titulo',
                'label' => 'Título Mi Historia',
                'name' => 'sobre_historia_titulo',
                'type' => 'text',
                'default_value' => 'Mi Historia',
            ),
            array(
                'key' => 'field_sobre_historia_texto',
                'label' => 'Texto Mi Historia',
                'name' => 'sobre_historia_texto',
                'type' => 'textarea',
                'rows' => 6,
                'default_value' => 'Dicen que tengo un estilo muy claro, atrevido y cuidado, pero no siempre fue así. Mi imagen ha ido evolucionando de la mano de un proceso de autoconocimiento y aceptación de mí misma.',
            ),
            array(
                'key' => 'field_sobre_frase_destacada',
                'label' => 'Frase Destacada',
                'name' => 'sobre_frase_destacada',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => '"No se trata de cómo te ves, sino de cómo te sientes contigo misma y cómo te relacionas con el mundo."',
            ),
            array(
                'key' => 'field_sobre_objetivo_texto',
                'label' => 'Texto Objetivo',
                'name' => 'sobre_objetivo_texto',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Mi objetivo es acompañarte en un proceso de autoconocimiento que te permita encontrar tu estilo personal auténtico, ese que realmente te representa y te hace sentir segura de ti misma.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-sobre-mi.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA PÁGINA SERVICIOS - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_servicios_fields',
        'title' => 'Configuración de Servicios',
        'fields' => array(
            array(
                'key' => 'field_servicios_titulo_principal',
                'label' => 'Título Principal',
                'name' => 'servicios_titulo_principal',
                'type' => 'text',
                'default_value' => 'Servicios',
            ),
            array(
                'key' => 'field_servicios_intro',
                'label' => 'Introducción de Servicios',
                'name' => 'servicios_intro',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Descubre todos los servicios que te ofrezco para ayudarte a encontrar tu estilo personal y potenciar tu imagen.',
            ),
            array(
                'key' => 'field_servicios_imagen_hero',
                'label' => 'Imagen Hero de Servicios',
                'name' => 'servicios_imagen_hero',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-servicios.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA PÁGINA TALLERES - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_talleres_fields',
        'title' => 'Configuración de Talleres',
        'fields' => array(
            array(
                'key' => 'field_talleres_titulo_principal',
                'label' => 'Título Principal',
                'name' => 'talleres_titulo_principal',
                'type' => 'text',
                'default_value' => 'Talleres',
            ),
            array(
                'key' => 'field_talleres_intro',
                'label' => 'Introducción de Talleres',
                'name' => 'talleres_intro',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Participa en mis talleres grupales y aprende junto a otras mujeres a potenciar tu imagen personal.',
            ),
            array(
                'key' => 'field_talleres_imagen_hero',
                'label' => 'Imagen Hero de Talleres',
                'name' => 'talleres_imagen_hero',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-talleres.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA PÁGINA PSICOLOGÍA DEL ESTILO
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_psicologia_fields',
        'title' => 'Configuración de Psicología del Estilo',
        'fields' => array(
            array(
                'key' => 'field_psicologia_titulo_principal',
                'label' => 'Título Principal',
                'name' => 'psicologia_titulo_principal',
                'type' => 'text',
                'default_value' => 'Psicología del Estilo',
            ),
            array(
                'key' => 'field_psicologia_intro',
                'label' => 'Introducción',
                'name' => 'psicologia_intro',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Realiza nuestro test de estilo y descubre qué tipo de personalidad de imagen tienes.',
            ),
            array(
                'key' => 'field_psicologia_test_titulo',
                'label' => 'Título del Test',
                'name' => 'psicologia_test_titulo',
                'type' => 'text',
                'default_value' => 'Test de Estilo Personal',
            ),
            array(
                'key' => 'field_psicologia_test_intro',
                'label' => 'Introducción del Test',
                'name' => 'psicologia_test_intro',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'Responde a nuestras preguntas y descubre tu perfil de estilo personal.',
            ),
            array(
                'key' => 'field_psicologia_test_shortcode',
                'label' => 'Shortcode del Test',
                'name' => 'psicologia_test_shortcode',
                'type' => 'text',
                'placeholder' => '[contact-form-7 id="123" title="Test"]',
                'instructions' => 'Pega aquí el shortcode del formulario de Contact Form 7',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-psicologia-del-estilo.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA PÁGINA CONTACTO - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_contacto_fields',
        'title' => 'Configuración de Contacto',
        'fields' => array(
            array(
                'key' => 'field_contacto_titulo_principal',
                'label' => 'Título Principal',
                'name' => 'contacto_titulo_principal',
                'type' => 'text',
                'default_value' => 'Contacto',
            ),
            array(
                'key' => 'field_contacto_intro',
                'label' => 'Introducción',
                'name' => 'contacto_intro',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => '¿Tienes alguna pregunta? ¿Quieres reservar una consulta? Escríbeme y te responderé lo antes posible.',
            ),
            array(
                'key' => 'field_contacto_telefono',
                'label' => 'Teléfono',
                'name' => 'contacto_telefono',
                'type' => 'text',
                'default_value' => '+34 670 837 991',
                'placeholder' => '+34 XXX XXX XXX',
            ),
            array(
                'key' => 'field_contacto_email',
                'label' => 'Email',
                'name' => 'contacto_email',
                'type' => 'email',
                'default_value' => 'info@leticiarobaina.com',
                'placeholder' => 'tu@email.com',
            ),
            array(
                'key' => 'field_contacto_direccion',
                'label' => 'Dirección',
                'name' => 'contacto_direccion',
                'type' => 'text',
                'default_value' => 'Las Palmas de Gran Canaria',
                'placeholder' => 'Tu dirección...',
            ),
            array(
                'key' => 'field_contacto_horario',
                'label' => 'Horario de Atención',
                'name' => 'contacto_horario',
                'type' => 'text',
                'default_value' => 'Lunes a Viernes 9:00-18:00',
                'placeholder' => 'Lunes a Viernes 9:00-18:00',
            ),
            array(
                'key' => 'field_contacto_mapa_iframe',
                'label' => 'Código HTML del Mapa',
                'name' => 'contacto_mapa_iframe',
                'type' => 'textarea',
                'rows' => 4,
                'placeholder' => '<iframe src="..." width="100%" height="300"></iframe>',
                'instructions' => 'Código iframe de Google Maps',
            ),
            array(
                'key' => 'field_contacto_formulario_shortcode',
                'label' => 'Shortcode del Formulario',
                'name' => 'contacto_formulario_shortcode',
                'type' => 'text',
                'placeholder' => '[contact-form-7 id="123" title="Contacto"]',
                'instructions' => 'Shortcode del formulario de contacto',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-contacto.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA CPT SERVICIO - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_servicio_fields',
        'title' => 'Campos del Servicio',
        'fields' => array(
            array(
                'key' => 'field_servicio_precio',
                'label' => 'Precio',
                'name' => 'servicio_precio',
                'type' => 'text',
                'placeholder' => '150€, Consultar, etc.',
            ),
            array(
                'key' => 'field_servicio_duracion',
                'label' => 'Duración',
                'name' => 'servicio_duracion',
                'type' => 'text',
                'placeholder' => '2 horas, 1 día, etc.',
            ),
            array(
                'key' => 'field_servicio_modalidad',
                'label' => 'Modalidad',
                'name' => 'servicio_modalidad',
                'type' => 'select',
                'choices' => array(
                    'presencial' => 'Presencial',
                    'online' => 'Online',
                    'mixta' => 'Mixta',
                ),
                'default_value' => 'presencial',
            ),
            array(
                'key' => 'field_servicio_incluye',
                'label' => 'Qué Incluye',
                'name' => 'servicio_incluye',
                'type' => 'textarea',
                'rows' => 4,
                'placeholder' => 'Lista de lo que incluye el servicio...',
            ),
            array(
                'key' => 'field_servicio_cta_texto',
                'label' => 'Texto del Botón',
                'name' => 'servicio_cta_texto',
                'type' => 'text',
                'default_value' => 'Más información',
                'placeholder' => 'Reservar, Ver más, etc.',
            ),
            array(
                'key' => 'field_servicio_cta_url',
                'label' => 'URL del Botón',
                'name' => 'servicio_cta_url',
                'type' => 'url',
                'placeholder' => 'https://...',
            ),
            array(
                'key' => 'field_servicio_destacado',
                'label' => 'Servicio Destacado',
                'name' => 'servicio_destacado',
                'type' => 'true_false',
                'message' => 'Mostrar en la página de inicio',
                'ui' => 1,
            ),
            array(
                'key' => 'field_servicio_nuevo',
                'label' => 'Servicio Nuevo',
                'name' => 'servicio_nuevo',
                'type' => 'true_false',
                'message' => 'Mostrar badge "Nuevo"',
                'ui' => 1,
            ),
            array(
                'key' => 'field_servicio_icono',
                'label' => 'Icono del Servicio',
                'name' => 'servicio_icono',
                'type' => 'text',
                'placeholder' => 'ti-user, fa-star, etc.',
                'instructions' => 'Clase del icono a mostrar',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'servicio',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA CPT TALLER - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_taller_fields',
        'title' => 'Campos del Taller',
        'fields' => array(
            array(
                'key' => 'field_taller_fecha',
                'label' => 'Fecha del Taller',
                'name' => 'taller_fecha',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
            ),
            array(
                'key' => 'field_taller_hora',
                'label' => 'Hora del Taller',
                'name' => 'taller_hora',
                'type' => 'time_picker',
                'display_format' => 'H:i',
                'return_format' => 'H:i',
            ),
            array(
                'key' => 'field_taller_precio',
                'label' => 'Precio',
                'name' => 'taller_precio',
                'type' => 'text',
                'placeholder' => '75€, Gratuito, etc.',
            ),
            array(
                'key' => 'field_taller_duracion',
                'label' => 'Duración',
                'name' => 'taller_duracion',
                'type' => 'text',
                'placeholder' => '3 horas, Medio día, etc.',
            ),
            array(
                'key' => 'field_taller_ubicacion',
                'label' => 'Ubicación',
                'name' => 'taller_ubicacion',
                'type' => 'text',
                'placeholder' => 'Presencial u Online',
            ),
            array(
                'key' => 'field_taller_plazas',
                'label' => 'Número de Plazas',
                'name' => 'taller_plazas',
                'type' => 'number',
                'min' => 1,
                'max' => 50,
                'default_value' => 10,
            ),
            array(
                'key' => 'field_taller_incluye',
                'label' => 'Qué Incluye',
                'name' => 'taller_incluye',
                'type' => 'textarea',
                'rows' => 4,
                'placeholder' => 'Lista de lo que incluye el taller...',
            ),
            array(
                'key' => 'field_taller_requisitos',
                'label' => 'Requisitos',
                'name' => 'taller_requisitos',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => 'Requisitos para participar...',
            ),
            array(
                'key' => 'field_taller_destacado',
                'label' => 'Taller Destacado',
                'name' => 'taller_destacado',
                'type' => 'true_false',
                'message' => 'Mostrar en la página de inicio',
                'ui' => 1,
            ),
            array(
                'key' => 'field_taller_estado',
                'label' => 'Estado del Taller',
                'name' => 'taller_estado',
                'type' => 'select',
                'choices' => array(
                    'abierto' => 'Inscripciones abiertas',
                    'completo' => 'Completo',
                    'proximamente' => 'Próximamente',
                    'finalizado' => 'Finalizado',
                ),
                'default_value' => 'abierto',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'taller',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA CPT TESTIMONIO - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_testimonio_fields',
        'title' => 'Campos del Testimonio',
        'fields' => array(
            array(
                'key' => 'field_testimonio_rol',
                'label' => 'Rol/Profesión',
                'name' => 'testimonio_rol',
                'type' => 'text',
                'placeholder' => 'Directora de Marketing, etc.',
            ),
            array(
                'key' => 'field_testimonio_texto',
                'label' => 'Testimonio',
                'name' => 'testimonio_texto',
                'type' => 'textarea',
                'rows' => 4,
                'placeholder' => 'El testimonio completo...',
            ),
            array(
                'key' => 'field_testimonio_puntuacion',
                'label' => 'Puntuación',
                'name' => 'testimonio_puntuacion',
                'type' => 'select',
                'choices' => array(
                    '5' => '5 estrellas',
                    '4' => '4 estrellas',
                    '3' => '3 estrellas',
                ),
                'default_value' => '5',
            ),
            array(
                'key' => 'field_testimonio_servicio_relacionado',
                'label' => 'Servicio Relacionado',
                'name' => 'testimonio_servicio_relacionado',
                'type' => 'post_object',
                'post_type' => array('servicio'),
                'allow_null' => 1,
            ),
            array(
                'key' => 'field_testimonio_destacado',
                'label' => 'Testimonio Destacado',
                'name' => 'testimonio_destacado',
                'type' => 'true_false',
                'message' => 'Mostrar en la página de inicio',
                'ui' => 1,
            ),
            array(
                'key' => 'field_testimonio_ciudad',
                'label' => 'Ciudad',
                'name' => 'testimonio_ciudad',
                'type' => 'text',
                'placeholder' => 'Las Palmas, Madrid, etc.',
            ),
            array(
                'key' => 'field_testimonio_fecha',
                'label' => 'Fecha del Testimonio',
                'name' => 'testimonio_fecha',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonio',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

    /**
     * ===================================
     * CAMPOS PARA AJUSTES DEL SITIO - COMPLETOS
     * ===================================
     */
    acf_add_local_field_group(array(
        'key' => 'group_site_settings',
        'title' => 'Ajustes del Sitio',
        'fields' => array(
            // INFORMACIÓN GENERAL
            array(
                'key' => 'field_marca_claim',
                'label' => 'Claim de la Marca',
                'name' => 'marca_claim',
                'type' => 'text',
                'placeholder' => 'Tu frase que define la marca',
                'default_value' => 'Sé tu propia asesora de imagen',
            ),
            array(
                'key' => 'field_marca_descripcion',
                'label' => 'Descripción de la Marca',
                'name' => 'marca_descripcion',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Asesora y Coach de imagen personal en Las Palmas de Gran Canaria',
            ),
            
            // INFORMACIÓN DE CONTACTO
            array(
                'key' => 'field_contacto_telefono_general',
                'label' => 'Teléfono Principal',
                'name' => 'contacto_telefono_general',
                'type' => 'text',
                'default_value' => '+34 670 837 991',
            ),
            array(
                'key' => 'field_contacto_email_general',
                'label' => 'Email Principal',
                'name' => 'contacto_email_general',
                'type' => 'email',
                'default_value' => 'info@leticiarobaina.com',
            ),
            array(
                'key' => 'field_contacto_direccion_general',
                'label' => 'Dirección',
                'name' => 'contacto_direccion_general',
                'type' => 'text',
                'default_value' => 'Las Palmas de Gran Canaria',
            ),
            
            // REDES SOCIALES
            array(
                'key' => 'field_marca_facebook',
                'label' => 'Facebook URL',
                'name' => 'marca_facebook',
                'type' => 'url',
                'placeholder' => 'https://facebook.com/tu-pagina',
            ),
            array(
                'key' => 'field_marca_instagram',
                'label' => 'Instagram URL',
                'name' => 'marca_instagram',
                'type' => 'url',
                'placeholder' => 'https://instagram.com/tu-perfil',
            ),
            array(
                'key' => 'field_marca_tiktok',
                'label' => 'TikTok URL',
                'name' => 'marca_tiktok',
                'type' => 'url',
                'placeholder' => 'https://tiktok.com/@tu-perfil',
            ),
            array(
                'key' => 'field_marca_whatsapp',
                'label' => 'WhatsApp',
                'name' => 'marca_whatsapp',
                'type' => 'text',
                'placeholder' => '34670837991 (sin espacios)',
                'default_value' => '34670837991',
            ),
            array(
                'key' => 'field_marca_linkedin',
                'label' => 'LinkedIn URL',
                'name' => 'marca_linkedin',
                'type' => 'url',
                'placeholder' => 'https://linkedin.com/in/tu-perfil',
            ),
            
            // CONFIGURACIÓN DEL FOOTER
            array(
                'key' => 'field_footer_texto',
                'label' => 'Texto del Footer',
                'name' => 'footer_texto',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => 'Información adicional para el footer...',
            ),
            array(
                'key' => 'field_footer_copyright',
                'label' => 'Texto Copyright',
                'name' => 'footer_copyright',
                'type' => 'text',
                'default_value' => '© Copyright 2025 • Aviso legal y política de privacidad • Aceptación de cookies • Creado con pagetoday.com',
            ),
            
            // CONFIGURACIÓN TÉCNICA
            array(
                'key' => 'field_google_analytics',
                'label' => 'Google Analytics ID',
                'name' => 'google_analytics',
                'type' => 'text',
                'placeholder' => 'G-XXXXXXXXXX',
            ),
            array(
                'key' => 'field_pixel_facebook',
                'label' => 'Facebook Pixel ID',
                'name' => 'pixel_facebook',
                'type' => 'text',
                'placeholder' => 'XXXXXXXXXXXXXXXXX',
            ),
            array(
                'key' => 'field_google_maps_api',
                'label' => 'Google Maps API Key',
                'name' => 'google_maps_api',
                'type' => 'text',
                'placeholder' => 'AIzaSyApceEd5cY8NoVqIydUfI7PvC-StBDnYhE',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => 'ajustes-del-sitio',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));

} // Fin del check de ACF

/**
 * ===================================
 * CREAR PÁGINA DE AJUSTES AUTOMÁTICAMENTE
 * ===================================
 */
function leticia_create_settings_page() {
    $settings_page = get_page_by_path('ajustes-del-sitio');
    
    if (!$settings_page) {
        $page_id = wp_insert_post(array(
            'post_title'   => 'Ajustes del Sitio',
            'post_name'    => 'ajustes-del-sitio',
            'post_content' => 'Esta página contiene la configuración global del sitio. Es una página privada que no se muestra en el menú.',
            'post_status'  => 'private',
            'post_type'    => 'page'
        ));
        
        if ($page_id) {
            update_option('leticia_settings_page_id', $page_id);
        }
    }
}
add_action('init', 'leticia_create_settings_page');

/**
 * ===================================
 * FUNCIÓN PARA OBTENER AJUSTES DEL SITIO
 * ===================================
 */
function leticia_get_site_setting($key, $default = '') {
    $settings_page_id = get_option('leticia_settings_page_id');
    
    if (!$settings_page_id) {
        $settings_page = get_page_by_path('ajustes-del-sitio');
        if ($settings_page) {
            $settings_page_id = $settings_page->ID;
            update_option('leticia_settings_page_id', $settings_page_id);
        }
    }
    
    if ($settings_page_id && function_exists('get_field')) {
        $value = get_field($key, $settings_page_id);
        if ($value) {
            return $value;
        }
    }
    
    // Fallback a theme_mod
    return get_theme_mod($key, $default);
}

/**
 * ===================================
 * MENSAJE DE CONFIRMACIÓN
 * ===================================
 */
function leticia_acf_fields_admin_notice() {
    if (current_user_can('administrator')) {
        if (function_exists('acf_add_local_field_group')) {
            echo '<div class="notice notice-success is-dismissible">';
            echo '<p><strong>✅ Campos ACF restaurados correctamente.</strong> Todos los custom fields están disponibles de nuevo en todas las páginas y CPTs.</p>';
            echo '</div>';
        } else {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>⚠️ ACF no está activo.</strong> <a href="' . admin_url('plugins.php') . '">Activa Advanced Custom Fields</a> para ver los custom fields.</p>';
            echo '</div>';
        }
    }
}
add_action('admin_notices', 'leticia_acf_fields_admin_notice');
?>