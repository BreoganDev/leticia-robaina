<?php
/**
 * Template Name: Servicios
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
                    $servicios_intro = get_field('servicios_intro');
                    $servicios_subtitulo = get_field('servicios_subtitulo');
                    
                    if ($servicios_subtitulo) :
                    ?>
                        <p class="page-subtitle" data-aos="fade-up" data-aos-delay="100">
                            <?php echo esc_html($servicios_subtitulo); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($servicios_intro) : ?>
                        <div class="page-intro" data-aos="fade-up" data-aos-delay="200">
                            <p><?php echo esc_html($servicios_intro); ?></p>
                        </div>
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
                        <div class="content-wrapper" data-aos="fade-up">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php endwhile; ?>

<!-- FILTROS DE SERVICIOS -->
<?php 
// Obtener categorías de servicios
$categories = get_terms(array(
    'taxonomy' => 'servicio_categoria',
    'hide_empty' => true,
));
?>

<?php if (!empty($categories) && !is_wp_error($categories)) : ?>
    <section class="services-filters pt50 pb25">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filters-wrapper text-center" data-aos="fade-up">
                        <button class="filter-btn active" data-filter="*">Todos los servicios</button>
                        <?php foreach ($categories as $category) : ?>
                            <button class="filter-btn" data-filter=".cat-<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- GRID DE SERVICIOS -->
<section class="services-grid pt25 pb100">
    <div class="container">
        
        <?php
        $all_services = leticia_get_all_services();
        
        if ($all_services->have_posts()) :
        ?>
            <div class="row services-container" data-isotope='{"itemSelector": ".service-item", "layoutMode": "fitRows"}'>
                
                <?php while ($all_services->have_posts()) : $all_services->the_post(); ?>
                    
                    <?php
                    // Obtener categorías del servicio para filtros
                    $service_categories = get_the_terms(get_the_ID(), 'servicio_categoria');
                    $category_classes = '';
                    
                    if ($service_categories && !is_wp_error($service_categories)) {
                        foreach ($service_categories as $cat) {
                            $category_classes .= ' cat-' . $cat->slug;
                        }
                    }
                    ?>
                    
                    <div class="col-lg-4 col-md-6 mb-4 service-item<?php echo esc_attr($category_classes); ?>" data-aos="fade-up">
                        <?php leticia_render_service_card(get_the_ID(), 'service-grid-item'); ?>
                    </div>
                    
                <?php endwhile; ?>
                
            </div>
            
            <?php wp_reset_postdata(); ?>
            
        <?php else : ?>
            
            <div class="row">
                <div class="col-12 text-center">
                    <div class="no-services-message" data-aos="fade-up">
                        <i class="ti-info-alt" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                        <h3>No hay servicios disponibles</h3>
                        <p>Actualmente no hay servicios publicados. Vuelve pronto para ver nuestras novedades.</p>
                        
                        <?php if (current_user_can('manage_options')) : ?>
                            <a href="<?php echo admin_url('post-new.php?post_type=servicio'); ?>" class="btn btn-primary">
                                Crear primer servicio
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</section>

<!-- ¿CÓMO TRABAJO? -->
<section class="como-trabajo-section pt100 pb100 background-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                <h2>¿Cómo trabajo?</h2>
                <p class="section-subtitle">
                    Mi proceso está diseñado para acompañarte paso a paso hacia el descubrimiento 
                    de tu estilo personal auténtico.
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="proceso-step">
                    <div class="step-number">01</div>
                    <div class="step-icon">
                        <i class="ti-comment-alt"></i>
                    </div>
                    <h4>Consulta inicial</h4>
                    <p>Conversamos sobre tus objetivos, estilo de vida y necesidades específicas.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="proceso-step">
                    <div class="step-number">02</div>
                    <div class="step-icon">
                        <i class="ti-search"></i>
                    </div>
                    <h4>Análisis personalizado</h4>
                    <p>Realizamos un análisis completo de tu colorimetría, morfología y personalidad.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="proceso-step">
                    <div class="step-number">03</div>
                    <div class="step-icon">
                        <i class="ti-palette"></i>
                    </div>
                    <h4>Plan personalizado</h4>
                    <p>Creamos juntas un plan de imagen que refleje tu esencia y potencie tu autoestima.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="proceso-step">
                    <div class="step-number">04</div>
                    <div class="step-icon">
                        <i class="ti-heart"></i>
                    </div>
                    <h4>Seguimiento</h4>
                    <p>Te acompaño en la implementación y resolución de cualquier duda que surja.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SERVICIOS -->
<section class="faq-section pt100 pb100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center mb-5" data-aos="fade-up">
                    <h2>Preguntas frecuentes</h2>
                    <p class="section-subtitle">Resuelve tus dudas sobre mis servicios</p>
                </div>
                
                <div class="accordion" id="faqAccordion" data-aos="fade-up">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                ¿Cuánto tiempo dura una sesión de asesoría?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                La duración depende del servicio elegido. Las consultas individuales suelen durar entre 1.5 y 2 horas, 
                                mientras que los talleres grupales pueden extenderse de 3 a 4 horas.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                ¿Ofrecen servicios online?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, ofrezco sesiones tanto presenciales en Las Palmas de Gran Canaria como online 
                                para que puedas acceder a mis servicios desde cualquier lugar.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                ¿Qué incluye el análisis de colorimetría?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                El análisis incluye la determinación de tu paleta de colores personalizada, 
                                cómo aplicarla en tu vestuario y maquillaje, y consejos específicos para potenciar tu belleza natural.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                ¿Necesito comprar ropa nueva después de la asesoría?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No necesariamente. Mi enfoque se centra en optimizar tu armario actual y hacer compras inteligentes 
                                que realmente aporten valor a tu estilo personal.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="cta-section pt100 pb100 background-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2>¿Preparada para encontrar tu estilo?</h2>
                <p class="lead mb-4">
                    Elige el servicio que mejor se adapte a tus necesidades y empecemos 
                    juntas este viaje hacia tu transformación personal.
                </p>
                
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-light btn-lg">
                        Reserva tu consulta
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/test-de-estilo/')); ?>" class="btn btn-outline-light btn-lg">
                        Hacer test gratuito
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>