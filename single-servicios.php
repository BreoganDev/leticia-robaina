<?php
/**
 * Template para servicios individuales
 * Muestra la jerarquía completa de servicios (padres, hijos, nietos)
 */

get_header(); 

// Guardar el ID del post original para comparaciones
$GLOBALS['original_post_id'] = get_the_ID();
?>

<div class="service-single-page">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero del servicio -->
        <section class="service-hero">
            <div class="container">
                <div class="service-hero-content" data-aos="fade-up">
                    
                    <div class="service-breadcrumb">
                        <?php 
                        $hierarchy = get_service_hierarchy();
                        if ($hierarchy) {
                            echo '<nav class="service-hierarchy">';
                            foreach ($hierarchy as $index => $service) {
                                if ($index > 0) echo ' <span class="separator">/</span> ';
                                if ($service->ID === get_the_ID()) {
                                    echo '<span class="current">' . esc_html($service->post_title) . '</span>';
                                } else {
                                    echo '<a href="' . get_permalink($service->ID) . '">' . esc_html($service->post_title) . '</a>';
                                }
                            }
                            echo '</nav>';
                        }
                        ?>
                    </div>
                    
                    <div class="service-hero-grid">
                        
                        <div class="service-info">
                            <div class="service-icon-large">
                                <?php 
                                $service_icon = get_field('service_icon');
                                if ($service_icon) : ?>
                                    <i class="<?php echo esc_attr($service_icon); ?>"></i>
                                <?php else : ?>
                                    <i class="fas fa-user-tie"></i>
                                <?php endif; ?>
                            </div>
                            
                            <h1 class="service-title"><?php the_title(); ?></h1>
                            
                            <div class="service-excerpt">
                                <?php 
                                if (has_excerpt()) {
                                    the_excerpt();
                                } else {
                                    echo '<p>' . wp_trim_words(get_the_content(), 25) . '</p>';
                                }
                                ?>
                            </div>
                            
                            <div class="service-meta-info">
                                <?php 
                                $service_price = get_field('service_price');
                                $service_duration = get_field('service_duration');
                                
                                if ($service_price || $service_duration) : ?>
                                    <div class="service-details">
                                        <?php if ($service_price) : ?>
                                            <div class="service-price">
                                                <span class="label">Precio:</span>
                                                <span class="value"><?php echo esc_html($service_price); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($service_duration) : ?>
                                            <div class="service-duration">
                                                <span class="label">Duración:</span>
                                                <span class="value"><?php echo esc_html($service_duration); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (get_field('service_featured')) : ?>
                                    <div class="service-badge">
                                        <span class="featured-badge">Servicio Destacado</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="service-cta">
                                <a href="<?php echo home_url('/contacto/'); ?>?service=<?php echo urlencode(get_the_title()); ?>" class="btn btn-primary btn-large">
                                    Reservar Consulta
                                    <i class="fas fa-calendar-check"></i>
                                </a>
                                <a href="tel:+34628123456" class="btn btn-outline btn-large">
                                    <i class="fas fa-phone"></i>
                                    Llamar Ahora
                                </a>
                            </div>
                        </div>
                        
                        <div class="service-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="service-thumbnail">
                                    <?php the_post_thumbnail('large', array('class' => 'service-img')); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!-- Contenido del servicio -->
        <section class="service-content-section">
            <div class="container">
                <div class="service-content-grid">
                    
                    <div class="service-main-content">
                        
                        <!-- Descripción detallada -->
                        <div class="service-description" data-aos="fade-up">
                            <h2>Descripción del Servicio</h2>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                        <!-- Qué incluye -->
                        <?php 
                        $service_includes = get_field('service_includes');
                        if ($service_includes) : ?>
                            <div class="service-includes" data-aos="fade-up" data-aos-delay="200">
                                <h3>¿Qué incluye este servicio?</h3>
                                <ul class="includes-list">
                                    <?php foreach ($service_includes as $include) : ?>
                                        <li>
                                            <i class="fas fa-check"></i>
                                            <?php echo esc_html($include['include_item']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Servicios hijos -->
                        <?php 
                        $child_services = get_service_children(get_the_ID());
                        if ($child_services) : ?>
                            <div class="child-services" data-aos="fade-up" data-aos-delay="300">
                                <h3>Servicios Relacionados</h3>
                                <div class="child-services-grid">
                                    <?php foreach ($child_services as $child_service) : ?>
                                        <div class="child-service-card">
                                            <div class="child-service-icon">
                                                <?php 
                                                $child_icon = get_field('service_icon', $child_service->ID);
                                                if ($child_icon) : ?>
                                                    <i class="<?php echo esc_attr($child_icon); ?>"></i>
                                                <?php else : ?>
                                                    <i class="fas fa-arrow-right"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="child-service-content">
                                                <h4>
                                                    <a href="<?php echo get_permalink($child_service->ID); ?>">
                                                        <?php echo esc_html($child_service->post_title); ?>
                                                    </a>
                                                </h4>
                                                <p><?php echo wp_trim_words($child_service->post_excerpt ?: $child_service->post_content, 15); ?></p>
                                                
                                                <?php 
                                                $child_price = get_field('service_price', $child_service->ID);
                                                if ($child_price) : ?>
                                                    <span class="child-service-price"><?php echo esc_html($child_price); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="service-sidebar">
                        
                        <!-- Formulario de contacto rápido -->
                        <div class="service-contact-form" data-aos="fade-left">
                            <h4>¿Interesada en este servicio?</h4>
                            <form class="quick-contact-form" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Tu nombre *" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Tu email *" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" placeholder="Tu teléfono">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Mensaje adicional" rows="4"></textarea>
                                </div>
                                <input type="hidden" name="service" value="<?php the_title(); ?>">
                                <button type="submit" class="btn btn-primary btn-full-width">
                                    Enviar Consulta
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <div class="form-result"></div>
                            </form>
                        </div>
                        
                        <!-- Otros servicios destacados -->
                        <div class="related-services" data-aos="fade-left" data-aos-delay="200">
                            <h4>Otros Servicios Destacados</h4>
                            <?php
                            $related_services = get_featured_services(3);
                            if ($related_services->have_posts()) : ?>
                                <div class="related-services-list">
                                    <?php while ($related_services->have_posts()) : $related_services->the_post(); ?>
                                        <?php if (get_the_ID() !== $GLOBALS['original_post_id']) : ?>
                                            <div class="related-service-item">
                                                <div class="related-service-icon">
                                                    <?php 
                                                    $related_icon = get_field('service_icon');
                                                    if ($related_icon) : ?>
                                                        <i class="<?php echo esc_attr($related_icon); ?>"></i>
                                                    <?php else : ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="related-service-content">
                                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                    <?php 
                                                    $related_price = get_field('service_price');
                                                    if ($related_price) : ?>
                                                        <span class="related-service-price"><?php echo esc_html($related_price); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Testimonio relacionado -->
                        <?php
                        $testimonial = get_random_testimonials(1);
                        if ($testimonial->have_posts()) : $testimonial->the_post(); ?>
                            <div class="service-testimonial" data-aos="fade-left" data-aos-delay="300">
                                <h4>Lo que dicen nuestras clientas</h4>
                                <div class="testimonial-content">
                                    <div class="testimonial-quote">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="testimonial-text">
                                        <?php echo wp_trim_words(get_the_content(), 20); ?>
                                    </div>
                                    <div class="testimonial-author">
                                        <strong><?php echo esc_html(get_field('client_name')); ?></strong>
                                        <?php 
                                        $client_position = get_field('client_position');
                                        if ($client_position) : ?>
                                            <span><?php echo esc_html($client_position); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial-rating">
                                        <?php 
                                        $rating = get_field('rating') ?: 5;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
    
    <!-- FAQ Section -->
    <section class="service-faq">
        <div class="container">
            <div class="faq-content" data-aos="fade-up">
                <h3>Preguntas Frecuentes</h3>
                <div class="faq-list">
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>¿Cuánto tiempo dura una sesión de asesoría?</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>La duración varía según el servicio, pero generalmente las sesiones duran entre 1.5 y 3 horas, permitiendo tiempo suficiente para un análisis completo y personalizado.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>¿Qué debo llevar a la consulta?</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Te enviaré una guía detallada antes de la cita, pero generalmente recomiendo traer algunas prendas que te gusten y otras con las que no te sientes cómoda, para analizar juntas qué funciona y qué no.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>¿Ofrecen servicios online?</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Sí, ofrezco consultas online adaptadas que incluyen análisis de colorimetría, asesoría de estilo y shopping virtual. Es una excelente opción si no puedes venir presencialmente.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>¿Qué incluye el seguimiento post-servicio?</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Todos mis servicios incluyen seguimiento vía WhatsApp durante 15 días para resolver dudas, enviar fotos de outfits y recibir feedback. Tu transformación no termina cuando sales de la consulta.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</div>

<style>
/* Estilos específicos para servicios */
.service-single-page {
    padding-top: 0;
}

.service-hero {
    background: linear-gradient(135deg, var(--light-bg) 0%, white 100%);
    padding: 3rem 0;
}

.service-hierarchy {
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.service-hierarchy a {
    color: var(--primary-color);
    text-decoration: none;
}

.service-hierarchy a:hover {
    text-decoration: underline;
}

.service-hierarchy .separator {
    margin: 0 0.5rem;
    color: #999;
}

.service-hierarchy .current {
    color: var(--secondary-color);
    font-weight: 600;
}

.service-hero-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    align-items: center;
}

.service-icon-large {
    width: 100px;
    height: 100px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    margin-bottom: 2rem;
}

.service-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--secondary-color);
}

.service-excerpt {
    font-size: 1.25rem;
    color: #666;
    margin-bottom: 2rem;
}

.service-details {
    display: flex;
    gap: 2rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.service-details .label {
    font-weight: 600;
    color: var(--secondary-color);
}

.service-details .value {
    color: var(--primary-color);
    font-weight: 600;
}

.service-price,
.service-duration {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.featured-badge {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.service-cta {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.service-thumbnail {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.service-img {
    width: 100%;
    height: auto;
    display: block;
}

.service-content-section {
    padding: 4rem 0;
}

.service-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

.service-description h2 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.service-description .content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #666;
}

.service-description .content p {
    margin-bottom: 1.5rem;
}

.service-includes {
    margin-top: 3rem;
}

.service-includes h3 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.includes-list {
    list-style: none;
    padding: 0;
}

.includes-list li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    padding: 0.75rem;
    background: var(--light-bg);
    border-radius: 8px;
}

.includes-list i {
    color: var(--primary-color);
    width: 20px;
    flex-shrink: 0;
}

.child-services {
    margin-top: 3rem;
}

.child-services h3 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.child-services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.child-service-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.child-service-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-color: var(--primary-color);
}

.child-service-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.child-service-content h4 {
    margin-bottom: 0.75rem;
}

.child-service-content a {
    color: var(--secondary-color);
    text-decoration: none;
}

.child-service-content a:hover {
    color: var(--primary-color);
}

.child-service-content p {
    color: #666;
    margin-bottom: 0.75rem;
}

.child-service-price {
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.875rem;
    font-weight: 600;
}

.service-sidebar > div {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.service-contact-form h4 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.related-services h4 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.related-services-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.related-service-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.related-service-item:last-child {
    border-bottom: none;
}

.related-service-icon {
    width: 40px;
    height: 40px;
    background: var(--light-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    flex-shrink: 0;
}

.related-service-content h5 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
}

.related-service-content a {
    color: var(--secondary-color);
    text-decoration: none;
}

.related-service-content a:hover {
    color: var(--primary-color);
}

.related-service-price {
    font-size: 0.875rem;
    color: var(--primary-color);
    font-weight: 600;
}

.service-testimonial {
    text-align: center;
}

.service-testimonial h4 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.testimonial-quote i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.testimonial-text {
    font-style: italic;
    color: #666;
    margin-bottom: 1rem;
}

.testimonial-author strong {
    color: var(--secondary-color);
    display: block;
}

.testimonial-author span {
    display: block;
    font-size: 0.875rem;
    color: #666;
    margin-top: 0.25rem;
}

.testimonial-rating {
    color: var(--primary-color);
    margin-top: 0.5rem;
}

.service-faq {
    background: var(--light-bg);
    padding: 4rem 0;
}

.faq-content h3 {
    text-align: center;
    color: var(--secondary-color);
    margin-bottom: 2rem;
}

.faq-list {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: white;
    border-radius: 10px;
    margin-bottom: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.faq-question {
    padding: 1.5rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    transition: background-color 0.3s ease;
}

.faq-question:hover {
    background: var(--light-bg);
}

.faq-question h4 {
    margin: 0;
    color: var(--secondary-color);
}

.faq-question i {
    color: var(--primary-color);
    transition: transform 0.3s ease;
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    background: var(--light-bg);
}

.faq-answer p {
    padding: 0 1.5rem 1.5rem;
    margin: 0;
    color: #666;
}

/* Responsive */
@media (max-width: 768px) {
    .service-hero-grid,
    .service-content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .service-title {
        font-size: 2rem;
    }
    
    .service-cta {
        flex-direction: column;
    }
    
    .child-services-grid {
        grid-template-columns: 1fr;
    }
    
    .service-details {
        flex-direction: column;
        gap: 1rem;
    }
    
    .service-hero {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .service-hero {
        padding: 2rem 0;
    }
    
    .service-content-section {
        padding: 3rem 0;
    }
    
    .service-sidebar > div {
        padding: 1.5rem;
    }
}
</style>

<?php get_footer(); ?>