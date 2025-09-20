<?php
/**
 * Template Name: Contacto
 * 
 * @package Leticia_Robaina_Theme
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <!-- PAGE HEADER -->
    <section class="page-header pt100 pb50">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title" data-aos="fade-up"><?php the_title(); ?></h1>
                    
                    <?php 
                    $contacto_intro = get_field('contacto_intro');
                    if ($contacto_intro) :
                    ?>
                        <p class="page-subtitle" data-aos="fade-up" data-aos-delay="100">
                            <?php echo esc_html($contacto_intro); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENIDO PRINCIPAL DE LA PÁGINA -->
    <?php if (get_the_content()) : ?>
        <section class="page-content pt50 pb50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="content-wrapper text-center" data-aos="fade-up">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php endwhile; ?>

<!-- CONTACTO SECTION -->
<section class="contacto-section pt50 pb100">
    <div class="container">
        <div class="row">
            
            <!-- INFORMACIÓN DE CONTACTO -->
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
                <div class="contact-info">
                    
                    <h3>Información de contacto</h3>
                    <p class="contact-intro">
                        Estoy aquí para ayudarte a descubrir tu estilo personal. 
                        Contacta conmigo y empecemos juntas esta transformación.
                    </p>
                    
                    <div class="contact-details">
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Ubicación</h5>
                                <p>
                                    <?php 
                                    $direccion = get_field('contacto_direccion');
                                    echo $direccion ? esc_html($direccion) : 'Las Palmas de Gran Canaria';
                                    ?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Teléfono</h5>
                                <p>
                                    <?php 
                                    $telefono = get_field('contacto_telefono');
                                    $tel_clean = str_replace(' ', '', $telefono);
                                    ?>
                                    <a href="tel:<?php echo esc_attr($tel_clean); ?>">
                                        <?php echo $telefono ? esc_html($telefono) : '+34 123 456 789'; ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Email</h5>
                                <p>
                                    <?php 
                                    $email = get_field('contacto_email');
                                    ?>
                                    <a href="mailto:<?php echo esc_attr($email); ?>">
                                        <?php echo $email ? esc_html($email) : 'contacto@leticiarobaina.com'; ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="ti-time"></i>
                            </div>
                            <div class="contact-content">
                                <h5>Horario</h5>
                                <p>
                                    <?php 
                                    $horario = get_field('contacto_horario');
                                    echo $horario ? esc_html($horario) : 'L-V: 9:00-18:00h';
                                    ?>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- REDES SOCIALES -->
                    <?php
                    $social_links = leticia_get_social_links();
                    if (!empty($social_links)) :
                    ?>
                        <div class="contact-social mt-4">
                            <h5>Sígueme en redes</h5>
                            <div class="social-icons">
                                <?php foreach ($social_links as $network => $url) :
                                    $icon_class = 'fa-' . $network;
                                    if ($network === 'tiktok') $icon_class = 'fa-music';
                                ?>
                                    <a href="<?php echo esc_url($url); ?>" 
                                       target="_blank" 
                                       rel="noopener" 
                                       class="social-link social-<?php echo $network; ?>"
                                       aria-label="Seguir en <?php echo ucfirst($network); ?>">
                                        <i class="fa <?php echo $icon_class; ?>"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <!-- FORMULARIO DE CONTACTO -->
            <div class="col-lg-8" data-aos="fade-left">
                <div class="contact-form-wrapper">
                    
                    <h3>Envíame un mensaje</h3>
                    <p class="form-intro">
                        Completa el formulario y te responderé lo antes posible. 
                        ¡Estoy deseando conocerte y ayudarte!
                    </p>
                    
                    <?php 
                    $formulario_shortcode = get_field('contacto_formulario_shortcode');
                    
                    if ($formulario_shortcode) :
                        // Si hay shortcode configurado (Contact Form 7, etc.)
                        echo do_shortcode($formulario_shortcode);
                    else :
                        // Formulario personalizado
                        leticia_contact_form();
                    endif;
                    ?>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- MAPA SECTION -->
<?php 
$mapa_iframe = get_field('contacto_mapa_iframe');
if ($mapa_iframe) :
?>
    <section class="mapa-section pb100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mapa-wrapper" data-aos="fade-up">
                        <h3 class="text-center mb-4">¿Dónde me encuentro?</h3>
                        <div class="mapa-container">
                            <?php echo $mapa_iframe; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- FAQ CONTACTO -->
<section class="faq-contacto pt100 pb100 background-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center mb-5" data-aos="fade-up">
                    <h2>Preguntas frecuentes sobre consultas</h2>
                    <p class="section-subtitle">Resuelve tus dudas antes de contactar</p>
                </div>
                
                <div class="accordion" id="contactoFaqAccordion" data-aos="fade-up">
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#contactoFaq1">
                                ¿Cuánto tiempo tardarás en responder?
                            </button>
                        </h3>
                        <div id="contactoFaq1" class="accordion-collapse collapse show" data-bs-parent="#contactoFaqAccordion">
                            <div class="accordion-body">
                                Normalmente respondo en un plazo de 24-48 horas. Si es urgente, 
                                puedes contactarme directamente por WhatsApp o teléfono.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactoFaq2">
                                ¿La primera consulta tiene algún costo?
                            </button>
                        </h3>
                        <div id="contactoFaq2" class="accordion-collapse collapse" data-bs-parent="#contactoFaqAccordion">
                            <div class="accordion-body">
                                La primera consulta inicial de 15 minutos es gratuita para conocernos 
                                y que pueda entender tus necesidades y objetivos.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactoFaq3">
                                ¿Ofreces servicios online?
                            </button>
                        </h3>
                        <div id="contactoFaq3" class="accordion-collapse collapse" data-bs-parent="#contactoFaqAccordion">
                            <div class="accordion-body">
                                Sí, ofrezco servicios tanto presenciales como online. Las sesiones virtuales 
                                son igual de efectivas y te permitirán acceder a mis servicios desde cualquier lugar.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactoFaq4">
                                ¿Qué información debo preparar para la consulta?
                            </button>
                        </h3>
                        <div id="contactoFaq4" class="accordion-collapse collapse" data-bs-parent="#contactoFaqAccordion">
                            <div class="accordion-body">
                                No necesitas preparar nada especial. Durante nuestra conversación inicial 
                                te guiaré sobre qué información será útil según el servicio que elijas.
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORMAS DE CONTACTO ALTERNATIVAS -->
<section class="contacto-alternativo pt100 pb100">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up">
                <h2>Otras formas de contactar</h2>
                <p class="section-subtitle">Elige la opción que más te convenga</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            
            <!-- WhatsApp -->
            <?php 
            $whatsapp = get_field('marca_whatsapp', get_option('leticia_ajustes_page_id'));
            if ($whatsapp) :
            ?>
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="contacto-metodo">
                        <div class="metodo-icon whatsapp">
                            <i class="fa fa-whatsapp"></i>
                        </div>
                        <h4>WhatsApp</h4>
                        <p>Respuesta rápida para consultas urgentes</p>
                        <a href="https://wa.me/<?php echo esc_attr(str_replace(array(' ', '+'), '', $whatsapp)); ?>?text=Hola,%20me%20interesa%20obtener%20más%20información%20sobre%20tus%20servicios" 
                           target="_blank" 
                           rel="noopener"
                           class="btn btn-success">
                            <i class="fa fa-whatsapp"></i> Enviar mensaje
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Email -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="contacto-metodo">
                    <div class="metodo-icon email">
                        <i class="ti-email"></i>
                    </div>
                    <h4>Email</h4>
                    <p>Para consultas detalladas y presupuestos</p>
                    <?php 
                    $email = get_field('contacto_email');
                    ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>?subject=Consulta%20sobre%20servicios%20de%20asesoría%20de%20imagen" 
                       class="btn btn-primary">
                        <i class="ti-email"></i> Enviar email
                    </a>
                </div>
            </div>
            
            <!-- Teléfono -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="contacto-metodo">
                    <div class="metodo-icon phone">
                        <i class="ti-mobile"></i>
                    </div>
                    <h4>Teléfono</h4>
                    <p>Conversación directa para resolver dudas</p>
                    <?php 
                    $telefono = get_field('contacto_telefono');
                    $tel_clean = str_replace(' ', '', $telefono);
                    ?>
                    <a href="tel:<?php echo esc_attr($tel_clean); ?>" class="btn btn-secondary">
                        <i class="ti-mobile"></i> Llamar ahora
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</section>

<?php get_footer(); ?>