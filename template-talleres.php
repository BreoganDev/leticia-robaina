<?php
/**
 * Template Name: Talleres
 * Página de talleres de asesoramiento y coach
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section con Quote -->
        <section class="talleres-hero">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-content">
                            <div class="hero-quote">
                                <blockquote>
                                    <span class="quote-mark">&ldquo;</span>
                                    <p class="quote-text">
                                        <?php 
                                        $hero_quote = get_field('talleres_hero_quote');
                                        echo $hero_quote ? esc_html($hero_quote) : 'No te quedes en la mirada del espejo, ve más allá conmigo y descubre que te hace diferente.';
                                        ?>
                                    </p>
                                </blockquote>
                            </div>
                            
                            <div class="hero-description">
                                <?php 
                                $hero_description = get_field('talleres_hero_description');
                                if ($hero_description) {
                                    echo '<p>' . esc_html($hero_description) . '</p>';
                                } else {
                                    echo '<p>La imagen no es solo lo que te pones y lo que ves; también es lo que expresas y como lo expresas, lo que opinas, donde vives, con quien vas, cuales son tus hobbies, que comes, cuales son tus amigos, tu trabajo... En definitiva está presente en todo</p>
                                    <p>Hago talleres con diferentes temáticas para que veas como la imagen está en todo y para que veamos que la imagen dice mucho de nosotros y que no es lo mismo que nuestro estilo.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Intro de Talleres -->
        <section class="talleres-intro">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="talleres-intro-content">
                            <h2 class="section-title">
                                <?php 
                                $intro_title = get_field('talleres_intro_title');
                                echo $intro_title ? esc_html($intro_title) : 'Conoce mis talleres.';
                                ?>
                            </h2>
                            
                            <div class="intro-text">
                                <?php 
                                $intro_content = get_field('talleres_intro_content');
                                if ($intro_content) {
                                    echo wp_kses_post($intro_content);
                                } else {
                                    echo '<p>La base de todos mis talleres es indagar en ti y que consigas herramientas y tips que te ayudarán en tu día a día a ser mejor contigo, con tu entorno, con tu imagen, con tu estilo. Además de que entiendas que la Psicología del Estilo y del Color están en tu vida y te puede ayudar mucho con tus emociones y tus retos diarios.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="talleres-intro-images">
                            <!-- Las 3 imágenes de talleres -->
                            <?php 
                            $intro_image_1 = get_field('talleres_intro_image_1');
                            $intro_image_2 = get_field('talleres_intro_image_2'); 
                            $intro_image_3 = get_field('talleres_intro_image_3');
                            ?>
                            <div class="intro-images-grid">
                                <?php if ($intro_image_1) : ?>
                                    <div class="intro-image-item">
                                        <img src="<?php echo esc_url($intro_image_1['url']); ?>" alt="<?php echo esc_attr($intro_image_1['alt']); ?>">
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($intro_image_2) : ?>
                                    <div class="intro-image-item">
                                        <img src="<?php echo esc_url($intro_image_2['url']); ?>" alt="<?php echo esc_attr($intro_image_2['alt']); ?>">
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($intro_image_3) : ?>
                                    <div class="intro-image-item">
                                        <img src="<?php echo esc_url($intro_image_3['url']); ?>" alt="<?php echo esc_attr($intro_image_3['alt']); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Grid de Talleres -->
        <section class="talleres-grid">
            <div class="container">
                
                <?php
                // Query para obtener todos los talleres
                $talleres_query = new WP_Query(array(
                    'post_type' => 'taller',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'meta_key' => 'taller_order',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC'
                ));

                if ($talleres_query->have_posts()) : ?>
                    <div class="row talleres-row">
                        <?php 
                        $counter = 0;
                        while ($talleres_query->have_posts()) : $talleres_query->the_post(); 
                            $counter++;
                            
                            // Obtener campos ACF del taller
                            $taller_icon = get_field('taller_icon');
                            $taller_price = get_field('taller_price');
                            $taller_duration = get_field('taller_duration');
                            $taller_date = get_field('taller_date');
                            $taller_includes = get_field('taller_includes');
                            $taller_cta_url = get_field('taller_cta_url') ? get_field('taller_cta_url') : '#';
                        ?>
                            <div class="col-lg-4 col-md-6 mb-5">
                                <div class="taller-card">
                                    
                                    <!-- Imagen/Icono del taller -->
                                    <?php if ($taller_icon) : ?>
                                        <div class="taller-image">
                                            <img src="<?php echo esc_url($taller_icon['url']); ?>" alt="<?php echo esc_attr($taller_icon['alt']); ?>">
                                        </div>
                                    <?php elseif (has_post_thumbnail()) : ?>
                                        <div class="taller-image">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Contenido del taller -->
                                    <div class="taller-content">
                                        
                                        <h3 class="taller-title"><?php the_title(); ?></h3>
                                        
                                        <!-- Precio y duración -->
                                        <?php if ($taller_price || $taller_duration) : ?>
                                            <div class="taller-meta">
                                                <?php if ($taller_price) : ?>
                                                    <span class="taller-price"><?php echo esc_html($taller_price); ?></span>
                                                <?php endif; ?>
                                                
                                                <?php if ($taller_duration) : ?>
                                                    <span class="taller-duration"><?php echo esc_html($taller_duration); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Descripción -->
                                        <div class="taller-description">
                                            <?php 
                                            if (has_excerpt()) {
                                                the_excerpt();
                                            } else {
                                                echo '<p>' . wp_trim_words(get_the_content(), 20, '...') . '</p>';
                                            }
                                            ?>
                                        </div>
                                        
                                        <!-- Fechas próximas -->
                                        <?php if ($taller_date) : ?>
                                            <div class="taller-dates">
                                                <strong>Próximas fechas:</strong>
                                                <p><?php echo wp_kses_post(nl2br($taller_date)); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Qué incluye -->
                                        <?php if ($taller_includes) : ?>
                                            <div class="taller-includes">
                                                <strong>Qué incluye:</strong>
                                                <div class="includes-content">
                                                    <?php echo wp_kses_post($taller_includes); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Botón CTA -->
                                        <div class="taller-cta">
                                            <a href="<?php echo esc_url($taller_cta_url); ?>" class="btn btn-primary taller-btn">
                                                SABER MÁS
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        <?php endwhile; ?>
                    </div>
                    
                <?php else : ?>
                    <div class="row">
                        <div class="col-12">
                            <p class="no-talleres">Actualmente no hay talleres disponibles. ¡Vuelve pronto!</p>
                        </div>
                    </div>
                <?php endif; 
                
                wp_reset_postdata(); ?>
                
            </div>
        </section>

        <!-- Sección de imagen de fondo con texto -->
        <section class="talleres-background-section">
            <div class="container-fluid p-0">
                <div class="background-image-wrapper">
                    <?php 
                    $background_image = get_field('talleres_background_image');
                    if ($background_image) : ?>
                        <div class="background-image" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
                            <!-- Contenido superpuesto opcional -->
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Sección "Han confiado en mí" -->
        <section class="talleres-trust">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="section-title">
                            <?php 
                            $trust_title = get_field('talleres_trust_title');
                            echo $trust_title ? esc_html($trust_title) : 'HAN CONFIADO EN MÍ...';
                            ?>
                        </h2>
                        
                        <!-- Logos de empresas/medios -->
                        <div class="trust-logos">
                            <?php 
                            // Logos hardcodeados basados en las capturas
                            $logos = array(
                                array('name' => 'Radio Arucas', 'logo' => get_template_directory_uri() . '/assets/images/logos/radio-arucas.png'),
                                array('name' => 'A370K', 'logo' => get_template_directory_uri() . '/assets/images/logos/a370k.png'),
                                array('name' => 'Canal 4 TV', 'logo' => get_template_directory_uri() . '/assets/images/logos/canal4tv.png'),
                                array('name' => 'Carlos G Almonacid', 'logo' => get_template_directory_uri() . '/assets/images/logos/carlos-almonacid.png')
                            );
                            
                            foreach ($logos as $logo) : ?>
                                <div class="trust-logo-item">
                                    <img src="<?php echo esc_url($logo['logo']); ?>" alt="<?php echo esc_attr($logo['name']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Testimonios en Video -->
        <section class="talleres-testimonios">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="section-title">
                            <?php 
                            $testimonios_title = get_field('talleres_testimonios_title');
                            echo $testimonios_title ? esc_html($testimonios_title) : 'QUE DICEN DE MÍ Y DE MIS TALLERES...';
                            ?>
                        </h2>
                    </div>
                </div>
                
                <div class="row testimonios-videos">
                    <?php
                    // Query para testimonios en video
                    $testimonios_query = new WP_Query(array(
                        'post_type' => 'testimonio',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key' => 'testimonio_video_url',
                                'value' => '',
                                'compare' => '!='
                            )
                        )
                    ));

                    if ($testimonios_query->have_posts()) :
                        while ($testimonios_query->have_posts()) : $testimonios_query->the_post();
                            $video_url = get_field('testimonio_video_url');
                            $video_thumbnail = get_field('testimonio_video_thumbnail');
                            $cliente_nombre = get_field('testimonio_cliente_nombre') ? get_field('testimonio_cliente_nombre') : get_the_title();
                    ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="testimonio-video-card">
                                <div class="video-wrapper">
                                    <?php if ($video_url) : ?>
                                        <iframe src="<?php echo esc_url($video_url); ?>" frameborder="0" allowfullscreen></iframe>
                                    <?php elseif ($video_thumbnail) : ?>
                                        <img src="<?php echo esc_url($video_thumbnail['url']); ?>" alt="<?php echo esc_attr($video_thumbnail['alt']); ?>">
                                    <?php elseif (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium'); ?>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="testimonio-info">
                                    <h4 class="cliente-nombre"><?php echo esc_html($cliente_nombre); ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    endif; 
                    ?>
                </div>
            </div>
        </section>

        <!-- Formulario Lista de Espera -->
        <section class="talleres-lista-espera">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="lista-espera-form">
                            <h2 class="form-title text-center">
                                <?php 
                                $form_title = get_field('talleres_form_title');
                                echo $form_title ? esc_html($form_title) : 'APÚNTATE A LA LISTA DE ESPERA';
                                ?>
                            </h2>
                            
                            <?php 
                            $form_shortcode = get_field('talleres_form_shortcode');
                            if ($form_shortcode) {
                                echo do_shortcode($form_shortcode);
                            } else {
                                // Formulario HTML básico si no hay shortcode
                                ?>
                                <form class="lista-espera-form-html" method="post" action="">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" id="nombre" name="nombre" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="tel" id="telefono" name="telefono" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="taller_interes">Elige un taller</label>
                                        <select id="taller_interes" name="taller_interes" required>
                                            <option value="">Selecciona un taller</option>
                                            <option value="Imagen Consciente">Imagen Consciente</option>
                                            <option value="Armario Consciente">Armario Consciente</option>
                                            <option value="Color, Emociones y Piel">Color, Emociones y Piel</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="mensaje">Mensaje</label>
                                        <textarea id="mensaje" name="mensaje" rows="4"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="acepto_privacidad" required>
                                            Acepto Aviso legal y política de privacidad
                                        </label>
                                    </div>
                                    
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">ENVIAR</button>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>