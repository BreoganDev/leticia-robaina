<?php
/**
 * Template para talleres individuales
 * Muestra información detallada del taller
 */

get_header(); ?>

<div class="workshop-single-page">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero del taller -->
        <section class="workshop-hero">
            <div class="workshop-hero-bg">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('hero-image', array('class' => 'workshop-hero-image')); ?>
                                                                    <?php endif; ?>
                                                </div>
                                                <div class="upcoming-content">
                                                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                    <?php 
                                                    $upcoming_price = get_field('workshop_price');
                                                    if ($upcoming_price) : ?>
                                                        <span class="upcoming-price"><?php echo esc_html($upcoming_price); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
    
    <!-- Testimonios de talleres anteriores -->
    <section class="workshop-testimonials">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2>Lo que dicen las participantes</h2>
                <p>Testimonios reales de mujeres que han transformado su estilo</p>
            </div>
            
            <div class="testimonials-workshop-grid" data-aos="fade-up" data-aos-delay="200">
                
                <?php
                $workshop_testimonials = get_random_testimonials(3);
                if ($workshop_testimonials->have_posts()) :
                    while ($workshop_testimonials->have_posts()) : $workshop_testimonials->the_post();
                ?>
                
                <div class="testimonial-workshop-card">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="testimonial-text">
                            <?php echo wp_trim_words(get_the_content(), 25); ?>
                        </div>
                        <div class="testimonial-rating">
                            <?php 
                            $rating = get_field('rating') ?: 5;
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-photo">
                            <?php 
                            $client_photo = get_field('client_photo');
                            if ($client_photo) : ?>
                                <img src="<?php echo esc_url($client_photo); ?>" alt="<?php echo esc_attr(get_field('client_name')); ?>">
                            <?php else : ?>
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="author-info">
                            <h4><?php echo esc_html(get_field('client_name')); ?></h4>
                            <?php 
                            $client_position = get_field('client_position');
                            if ($client_position) : ?>
                                <p><?php echo esc_html($client_position); ?></p>
                            <?php endif; ?>
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
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Formulario de reserva
    const bookingForm = document.querySelector('.booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'leticia_workshop_booking');
            formData.append('nonce', window.leticiaTheme.nonce);
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const resultDiv = this.querySelector('.form-result');
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
            
            fetch(window.leticiaTheme.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.className = 'form-result success';
                    resultDiv.innerHTML = data.data;
                    resultDiv.style.display = 'block';
                    this.reset();
                } else {
                    resultDiv.className = 'form-result error';
                    resultDiv.innerHTML = data.data;
                    resultDiv.style.display = 'block';
                }
            })
            .catch(error => {
                resultDiv.className = 'form-result error';
                resultDiv.innerHTML = 'Error al procesar la reserva. Inténtalo de nuevo.';
                resultDiv.style.display = 'block';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Reservar Plaza <i class="fas fa-ticket-alt"></i>';
                
                setTimeout(() => {
                    resultDiv.style.display = 'none';
                }, 8000);
            });
        });
    }
    
    // Smooth scrolling para los enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Verificar si el taller ya pasó
    const workshopDateElement = document.querySelector('input[name="workshop_date"]');
    if (workshopDateElement) {
        const workshopDate = new Date(workshopDateElement.value);
        const today = new Date();
        
        if (workshopDate < today) {
            const bookingForm = document.querySelector('.workshop-booking');
            if (bookingForm) {
                bookingForm.innerHTML = `
                    <h4>Taller Finalizado</h4>
                    <div class="workshop-finished">
                        <i class="fas fa-calendar-times"></i>
                        <p>Este taller ya ha finalizado. ¡Mantente atenta a nuestros próximos talleres!</p>
                        <a href="/talleres/" class="btn btn-primary">Ver Próximos Talleres</a>
                    </div>
                `;
            }
        }
    }
});
</script>

<style>
/* Estilos específicos para talleres */
.workshop-single-page {
    padding-top: 0;
}

.workshop-hero {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    color: white;
    overflow: hidden;
}

.workshop-hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -2;
}

.workshop-hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.workshop-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(44, 62, 80, 0.8) 0%, rgba(184, 134, 11, 0.6) 100%);
    z-index: -1;
}

.workshop-meta-top {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.workshop-date-badge,
.workshop-location-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.workshop-time {
    margin-left: 0.5rem;
    opacity: 0.9;
}

.workshop-title {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.workshop-excerpt {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0.95;
    max-width: 600px;
}

.workshop-details-top {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.workshop-price,
.workshop-capacity {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

.price-label,
.capacity-label {
    display: block;
    font-size: 0.875rem;
    opacity: 0.8;
    margin-bottom: 0.25rem;
}

.price-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.capacity-value {
    font-size: 1.125rem;
    font-weight: 600;
}

.workshop-cta-top {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.workshop-content-section {
    padding: 4rem 0;
}

.workshop-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

.workshop-description h2 {
    color: var(--secondary-color);
    margin-bottom: 1.5rem;
}

.learning-points {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.learning-point {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--light-bg);
    border-radius: 10px;
}

.point-icon {
    width: 50px;
    height: 50px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.point-content h4 {
    margin-bottom: 0.5rem;
    color: var(--secondary-color);
}

.point-content p {
    color: #666;
    margin: 0;
}

.program-timeline {
    position: relative;
    padding-left: 2rem;
}

.program-timeline::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--primary-color);
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
    padding-left: 2rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -0.5rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    background: var(--primary-color);
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 0 0 3px var(--primary-color);
}

.timeline-time {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.timeline-content h4 {
    margin-bottom: 0.5rem;
    color: var(--secondary-color);
}

.timeline-content p {
    color: #666;
    margin: 0;
}

.includes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.include-item {
    text-align: center;
    padding: 2rem 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
}

.include-item:hover {
    transform: translateY(-5px);
}

.include-icon {
    width: 60px;
    height: 60px;
    background: var(--gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.include-content h4 {
    margin-bottom: 0.75rem;
    color: var(--secondary-color);
}

.include-content p {
    color: #666;
    margin: 0;
    font-size: 0.875rem;
}

.workshop-sidebar > div {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.booking-info {
    background: var(--light-bg);
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.booking-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.booking-detail:last-child {
    margin-bottom: 0;
}

.booking-detail .label {
    font-weight: 600;
    color: var(--secondary-color);
}

.booking-detail .value {
    color: #666;
}

.booking-detail .value.price {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.125rem;
}

.booking-note {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e0e0e0;
    color: #666;
    text-align: center;
}

.info-list {
    space-y: 1rem;
}

.info-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-icon {
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

.info-content h5 {
    margin: 0 0 0.25rem 0;
    color: var(--secondary-color);
}

.info-content p {
    margin: 0;
    color: #666;
    font-size: 0.875rem;
}

.upcoming-list {
    space-y: 1rem;
}

.upcoming-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.upcoming-item:last-child {
    border-bottom: none;
}

.upcoming-date {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    font-size: 0.875rem;
    min-width: 60px;
    height: fit-content;
}

.upcoming-content h5 {
    margin: 0 0 0.25rem 0;
    font-size: 0.875rem;
}

.upcoming-content a {
    color: var(--secondary-color);
    text-decoration: none;
}

.upcoming-content a:hover {
    color: var(--primary-color);
}

.upcoming-price {
    font-size: 0.75rem;
    color: var(--primary-color);
    font-weight: 600;
}

.workshop-testimonials {
    background: var(--light-bg);
    padding: 4rem 0;
}

.testimonials-workshop-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial-workshop-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.workshop-finished {
    text-align: center;
    padding: 2rem;
    color: #666;
}

.workshop-finished i {
    font-size: 3rem;
    color: #ccc;
    margin-bottom: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .workshop-content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .workshop-title {
        font-size: 2.5rem;
    }
    
    .workshop-details-top {
        flex-direction: column;
        gap: 1rem;
    }
    
    .workshop-cta-top {
        flex-direction: column;
    }
    
    .learning-points,
    .includes-grid {
        grid-template-columns: 1fr;
    }
    
    .program-timeline {
        padding-left: 1rem;
    }
    
    .timeline-item {
        padding-left: 1.5rem;
    }
}
</style>

<?php get_footer(); ?>
                <div class="workshop-hero-overlay"></div>
            </div>
            
            <div class="container">
                <div class="workshop-hero-content" data-aos="fade-up">
                    
                    <div class="workshop-meta-top">
                        <?php 
                        $workshop_date = get_field('workshop_date');
                        $workshop_time = get_field('workshop_time');
                        if ($workshop_date) : ?>
                            <div class="workshop-date-badge">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo date('d \d\e M Y', strtotime($workshop_date)); ?>
                                <?php if ($workshop_time) : ?>
                                    <span class="workshop-time"><?php echo esc_html($workshop_time); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $workshop_location = get_field('workshop_location');
                        if ($workshop_location) : ?>
                            <div class="workshop-location-badge">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo esc_html($workshop_location); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="workshop-title"><?php the_title(); ?></h1>
                    
                    <div class="workshop-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <div class="workshop-details-top">
                        <?php 
                        $workshop_price = get_field('workshop_price');
                        if ($workshop_price) : ?>
                            <div class="workshop-price">
                                <span class="price-label">Precio:</span>
                                <span class="price-value"><?php echo esc_html($workshop_price); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $workshop_capacity = get_field('workshop_capacity');
                        if ($workshop_capacity) : ?>
                            <div class="workshop-capacity">
                                <span class="capacity-label">Plazas limitadas:</span>
                                <span class="capacity-value"><?php echo esc_html($workshop_capacity); ?> personas</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="workshop-cta-top">
                        <a href="#reservar" class="btn btn-primary btn-large">
                            Reservar Plaza
                            <i class="fas fa-ticket-alt"></i>
                        </a>
                        <a href="#detalles" class="btn btn-outline btn-large">
                            Ver Detalles
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!-- Contenido del taller -->
        <section class="workshop-content-section" id="detalles">
            <div class="container">
                <div class="workshop-content-grid">
                    
                    <div class="workshop-main-content">
                        
                        <!-- Descripción del taller -->
                        <div class="workshop-description" data-aos="fade-up">
                            <h2>Sobre este Taller</h2>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                        <!-- Qué aprenderás -->
                        <div class="workshop-learning" data-aos="fade-up" data-aos-delay="200">
                            <h3>¿Qué aprenderás?</h3>
                            <div class="learning-points">
                                <div class="learning-point">
                                    <div class="point-icon">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div class="point-content">
                                        <h4>Fundamentos del Estilo Personal</h4>
                                        <p>Descubre los principios básicos para desarrollar un estilo auténtico y coherente.</p>
                                    </div>
                                </div>
                                
                                <div class="learning-point">
                                    <div class="point-icon">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <div class="point-content">
                                        <h4>Análisis de Color Personal</h4>
                                        <p>Aprende qué colores te favorecen y cómo incorporarlos en tu guardarropa.</p>
                                    </div>
                                </div>
                                
                                <div class="learning-point">
                                    <div class="point-icon">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                    <div class="point-content">
                                        <h4>Construcción de Outfits</h4>
                                        <p>Técnicas prácticas para combinar prendas y crear looks impactantes.</p>
                                    </div>
                                </div>
                                
                                <div class="learning-point">
                                    <div class="point-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div class="point-content">
                                        <h4>Compras Inteligentes</h4>
                                        <p>Estrategias para hacer compras conscientes y construir un armario cápsula.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Programa del taller -->
                        <div class="workshop-program" data-aos="fade-up" data-aos-delay="300">
                            <h3>Programa del Taller</h3>
                            <div class="program-timeline">
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">9:00 - 9:30</div>
                                    <div class="timeline-content">
                                        <h4>Bienvenida y Presentaciones</h4>
                                        <p>Introducción al taller y presentación de participantes. Café de bienvenida.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">9:30 - 11:00</div>
                                    <div class="timeline-content">
                                        <h4>Fundamentos del Estilo Personal</h4>
                                        <p>Teoría sobre imagen personal, autoconocimiento y desarrollo del estilo auténtico.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">11:00 - 11:15</div>
                                    <div class="timeline-content">
                                        <h4>Pausa</h4>
                                        <p>Descanso con café y networking entre participantes.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">11:15 - 12:30</div>
                                    <div class="timeline-content">
                                        <h4>Análisis de Color Personal</h4>
                                        <p>Práctica de colorimetría y descubrimiento de tu paleta personal.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">12:30 - 13:30</div>
                                    <div class="timeline-content">
                                        <h4>Construcción de Outfits</h4>
                                        <p>Ejercicios prácticos de combinación de prendas y creación de looks.</p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-time">13:30 - 14:00</div>
                                    <div class="timeline-content">
                                        <h4>Cierre y Entrega de Materiales</h4>
                                        <p>Resumen del taller, entrega de guías personalizadas y sesión de preguntas.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Incluye el taller -->
                        <div class="workshop-includes" data-aos="fade-up" data-aos-delay="400">
                            <h3>El Taller Incluye</h3>
                            <div class="includes-grid">
                                
                                <div class="include-item">
                                    <div class="include-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="include-content">
                                        <h4>Material Didáctico</h4>
                                        <p>Guía completa del taller con ejercicios y recursos para llevar a casa.</p>
                                    </div>
                                </div>
                                
                                <div class="include-item">
                                    <div class="include-icon">
                                        <i class="fas fa-coffee"></i>
                                    </div>
                                    <div class="include-content">
                                        <h4>Coffee Break</h4>
                                        <p>Café, té y snacks saludables durante los descansos.</p>
                                    </div>
                                </div>
                                
                                <div class="include-item">
                                    <div class="include-icon">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    <div class="include-content">
                                        <h4>Certificado</h4>
                                        <p>Certificado de participación en el taller de imagen personal.</p>
                                    </div>
                                </div>
                                
                                <div class="include-item">
                                    <div class="include-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="include-content">
                                        <h4>Grupo Privado</h4>
                                        <p>Acceso a grupo de WhatsApp para seguimiento y apoyo post-taller.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Sidebar del taller -->
                    <div class="workshop-sidebar">
                        
                        <!-- Formulario de reserva -->
                        <div class="workshop-booking" id="reservar" data-aos="fade-left">
                            <h4>Reserva tu Plaza</h4>
                            <div class="booking-info">
                                <div class="booking-detail">
                                    <span class="label">Fecha:</span>
                                    <span class="value">
                                        <?php if ($workshop_date) : ?>
                                            <?php echo date('d \d\e M Y', strtotime($workshop_date)); ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                
                                <div class="booking-detail">
                                    <span class="label">Hora:</span>
                                    <span class="value">
                                        <?php echo $workshop_time ? esc_html($workshop_time) : '9:00 - 14:00'; ?>
                                    </span>
                                </div>
                                
                                <div class="booking-detail">
                                    <span class="label">Lugar:</span>
                                    <span class="value">
                                        <?php echo $workshop_location ? esc_html($workshop_location) : 'Las Palmas de Gran Canaria'; ?>
                                    </span>
                                </div>
                                
                                <div class="booking-detail">
                                    <span class="label">Precio:</span>
                                    <span class="value price">
                                        <?php echo $workshop_price ? esc_html($workshop_price) : 'Consultar'; ?>
                                    </span>
                                </div>
                            </div>
                            
                            <form class="booking-form" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Nombre completo *" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email *" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" placeholder="Teléfono *" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="¿Alguna pregunta o comentario?" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="workshop" value="<?php the_title(); ?>">
                                <input type="hidden" name="workshop_date" value="<?php echo $workshop_date; ?>">
                                
                                <button type="submit" class="btn btn-primary btn-full-width">
                                    Reservar Plaza
                                    <i class="fas fa-ticket-alt"></i>
                                </button>
                                
                                <div class="booking-note">
                                    <small>* Te contactaremos para confirmar tu reserva y enviarte los detalles de pago.</small>
                                </div>
                                
                                <div class="form-result"></div>
                            </form>
                        </div>
                        
                        <!-- Información adicional -->
                        <div class="workshop-extra-info" data-aos="fade-left" data-aos-delay="200">
                            <h4>Información Importante</h4>
                            <div class="info-list">
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>Puntualidad</h5>
                                        <p>Por favor, llega 15 minutos antes del inicio para el registro.</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>Qué Traer</h5>
                                        <p>Ropa cómoda y 2-3 prendas tuyas para análisis práctico.</p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-undo"></i>
                                    </div>
                                    <div class="info-content">
                                        <h5>Cancelaciones</h5>
                                        <p>Cancelación gratuita hasta 48h antes del taller.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!-- Próximos talleres -->
                        <div class="upcoming-workshops" data-aos="fade-left" data-aos-delay="300">
                            <h4>Próximos Talleres</h4>
                            <?php
                            $upcoming = get_upcoming_workshops(3);
                            if ($upcoming->have_posts()) : ?>
                                <div class="upcoming-list">
                                    <?php while ($upcoming->have_posts()) : $upcoming->the_post(); ?>
                                        <?php if (get_the_ID() !== $GLOBALS['original_post_id']) : ?>
                                            <div class="upcoming-item">
                                                <div class="upcoming-date">
                                                    <?php 
                                                    $upcoming_date = get_field('workshop_date');
                                                    if ($upcoming_date) : ?>
                                                        <?php echo date('d M', strtotime($upcoming_date)); ?>
                                                    <?php endif;