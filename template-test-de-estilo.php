<?php
/**
 * Template Name: Test de Estilo
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
                    <h1 class="page-title" data-aos="fade-up">
                        <?php 
                        $test_titulo = get_field('test_titulo');
                        echo $test_titulo ? esc_html($test_titulo) : get_the_title();
                        ?>
                    </h1>
                    
                    <?php 
                    $test_intro = get_field('test_intro');
                    if ($test_intro) :
                    ?>
                        <div class="page-intro" data-aos="fade-up" data-aos-delay="100">
                            <p class="lead"><?php echo esc_html($test_intro); ?></p>
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

<!-- TEST SECTION -->
<section class="test-section pt50 pb100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                
                <!-- FORMULARIO CON SHORTCODE O PERSONALIZADO -->
                <div class="test-form-wrapper" data-aos="fade-up">
                    <?php 
                    $test_shortcode = get_field('test_shortcode');
                    
                    if ($test_shortcode) :
                        // Si hay shortcode configurado, usarlo
                        echo do_shortcode($test_shortcode);
                    else :
                        // Si no hay shortcode, mostrar formulario personalizado
                    ?>
                        <div class="test-personalizado">
                            <div class="test-intro mb-4">
                                <h3>Descubre tu perfil de estilo</h3>
                                <p>Responde estas preguntas para conocer mejor tu estilo personal y recibir recomendaciones personalizadas.</p>
                            </div>
                            
                            <form id="test-estilo-form" class="test-form">
                                <?php wp_nonce_field('leticia_test_nonce', 'test_nonce'); ?>
                                
                                <!-- PREGUNTA 1 -->
                                <div class="question-group mb-4">
                                    <h4>1. ¿Cómo describirías tu personalidad?</h4>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="personalidad" value="creativa" required>
                                            <span class="radio-custom"></span>
                                            Creativa y expresiva
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="personalidad" value="clasica">
                                            <span class="radio-custom"></span>
                                            Clásica y elegante
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="personalidad" value="aventurera">
                                            <span class="radio-custom"></span>
                                            Aventurera y espontánea
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="personalidad" value="sofisticada">
                                            <span class="radio-custom"></span>
                                            Sofisticada y refinada
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- PREGUNTA 2 -->
                                <div class="question-group mb-4">
                                    <h4>2. ¿Cuál es tu prenda favorita?</h4>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="prenda_favorita" value="vestido" required>
                                            <span class="radio-custom"></span>
                                            Vestidos fluidos
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="prenda_favorita" value="blazer">
                                            <span class="radio-custom"></span>
                                            Blazers estructurados
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="prenda_favorita" value="jeans">
                                            <span class="radio-custom"></span>
                                            Jeans cómodos
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="prenda_favorita" value="abrigo">
                                            <span class="radio-custom"></span>
                                            Abrigos de calidad
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- PREGUNTA 3 -->
                                <div class="question-group mb-4">
                                    <h4>3. ¿Qué colores te atraen más?</h4>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="colores" value="vibrantes" required>
                                            <span class="radio-custom"></span>
                                            Colores vibrantes y llamativos
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="colores" value="neutros">
                                            <span class="radio-custom"></span>
                                            Neutros y tonos tierra
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="colores" value="pasteles">
                                            <span class="radio-custom"></span>
                                            Pasteles suaves
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="colores" value="monocromaticos">
                                            <span class="radio-custom"></span>
                                            Esquemas monocromáticos
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- PREGUNTA 4 -->
                                <div class="question-group mb-4">
                                    <h4>4. ¿Cómo te vistes para el trabajo?</h4>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="trabajo" value="formal" required>
                                            <span class="radio-custom"></span>
                                            Formal y profesional
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="trabajo" value="casual">
                                            <span class="radio-custom"></span>
                                            Casual pero cuidado
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="trabajo" value="creativo">
                                            <span class="radio-custom"></span>
                                            Creativo y original
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="trabajo" value="comodo">
                                            <span class="radio-custom"></span>
                                            Cómodo ante todo
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- PREGUNTA 5 -->
                                <div class="question-group mb-4">
                                    <h4>5. ¿Qué te inspira más en la moda?</h4>
                                    <div class="radio-group">
                                        <label class="radio-option">
                                            <input type="radio" name="inspiracion" value="tendencias" required>
                                            <span class="radio-custom"></span>
                                            Las últimas tendencias
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="inspiracion" value="clasicos">
                                            <span class="radio-custom"></span>
                                            Los clásicos atemporales
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="inspiracion" value="iconos">
                                            <span class="radio-custom"></span>
                                            Iconos de estilo vintage
                                        </label>
                                        <label class="radio-option">
                                            <input type="radio" name="inspiracion" value="originalidad">
                                            <span class="radio-custom"></span>
                                            Mi propia originalidad
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- INFORMACIÓN PERSONAL -->
                                <div class="personal-info mt-5 mb-4">
                                    <h4>Para enviarte los resultados:</h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="test_nombre">Nombre *</label>
                                            <input type="text" id="test_nombre" name="nombre" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="test_email">Email *</label>
                                            <input type="email" id="test_email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="checkbox-option">
                                            <input type="checkbox" name="newsletter" value="si">
                                            <span class="checkbox-custom"></span>
                                            Quiero recibir consejos de estilo por email
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- BOTÓN ENVIAR -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <span class="btn-text">Descubrir mi estilo</span>
                                        <span class="btn-loading" style="display: none;">
                                            <i class="fa fa-spinner fa-spin"></i> Procesando...
                                        </span>
                                    </button>
                                </div>
                                
                                <div class="form-messages mt-3"></div>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- RESULTADOS SECTION (Oculta inicialmente) -->
<section id="test-resultados" class="resultados-section pt100 pb100 background-light" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="resultados-content">
                    <h2>¡Conoce tu perfil de estilo!</h2>
                    <div id="resultado-contenido">
                        <!-- Los resultados se cargarán aquí via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BENEFICIOS DEL TEST -->
<section class="beneficios-section pt100 pb100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                <h2>¿Por qué hacer este test?</h2>
                <p class="section-subtitle">
                    Descubrir tu perfil de estilo te ayudará a tomar mejores decisiones 
                    sobre tu imagen personal.
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="beneficio-item text-center">
                    <div class="beneficio-icon">
                        <i class="ti-search"></i>
                    </div>
                    <h4>Autoconocimiento</h4>
                    <p>Comprende mejor tu personalidad y cómo se refleja en tu estilo.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="beneficio-item text-center">
                    <div class="beneficio-icon">
                        <i class="ti-shopping-cart"></i>
                    </div>
                    <h4>Compras inteligentes</h4>
                    <p>Evita comprar prendas que no usarás y optimiza tu presupuesto.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="beneficio-item text-center">
                    <div class="beneficio-icon">
                        <i class="ti-heart"></i>
                    </div>
                    <h4>Confianza</h4>
                    <p>Desarrolla un estilo que te haga sentir segura y auténtica.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SERVICIOS -->
<section class="cta-servicios pt100 pb100 background-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2>¿Quieres ir más allá?</h2>
                <p class="lead mb-4">
                    El test es solo el comienzo. Descubre todos mis servicios para una 
                    transformación completa de tu imagen personal.
                </p>
                
                <div class="cta-actions">
                    <a href="<?php echo esc_url(home_url('/servicios/')); ?>" class="btn btn-light btn-lg">
                        Ver servicios
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-outline-light btn-lg">
                        Consulta personalizada
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>