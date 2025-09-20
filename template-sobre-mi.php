<?php
/**
 * Template Name: Sobre Mí
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
                    <?php if (get_the_excerpt()) : ?>
                        <p class="page-subtitle" data-aos="fade-up" data-aos-delay="100">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- SOBRE MÍ CONTENT -->
    <section class="sobre-mi-content pt50 pb100">
        <div class="container">
            <div class="row align-items-center">
                
                <!-- FOTO PRINCIPAL -->
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <?php 
                    $foto_principal = get_field('sobre_foto_principal');
                    if ($foto_principal) :
                    ?>
                        <div class="sobre-imagen-wrapper">
                            <img src="<?php echo esc_url($foto_principal['url']); ?>" 
                                 alt="<?php echo esc_attr($foto_principal['alt']); ?>" 
                                 class="img-responsive rounded shadow-lg">
                        </div>
                    <?php else : ?>
                        <div class="sobre-imagen-placeholder">
                            <div class="placeholder-content">
                                <i class="ti-user" style="font-size: 4rem; color: #ccc;"></i>
                                <p>Añade tu foto desde el editor de la página</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- CONTENIDO PRINCIPAL -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="sobre-content">
                        
                        <!-- INTRODUCCIÓN -->
                        <?php 
                        $intro = get_field('sobre_intro');
                        if ($intro) :
                        ?>
                            <div class="intro-text">
                                <p class="lead"><?php echo esc_html($intro); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <!-- CONTENIDO PRINCIPAL DE LA PÁGINA -->
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- PUNTOS DESTACADOS -->
                        <?php 
                        $bullets = array();
                        for ($i = 1; $i <= 6; $i++) {
                            $bullet = get_field('sobre_bullet_' . $i);
                            if ($bullet) {
                                $bullets[] = $bullet;
                            }
                        }
                        
                        if (!empty($bullets)) :
                        ?>
                            <div class="puntos-destacados mt-4">
                                <h3>¿Qué me caracteriza?</h3>
                                <ul class="bullets-list">
                                    <?php foreach ($bullets as $bullet) : ?>
                                        <li>
                                            <i class="ti-check text-primary"></i>
                                            <?php echo esc_html($bullet); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- MI METODOLOGÍA -->
    <section class="metodologia-section pt100 pb100 background-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                    <h2>Mi Metodología</h2>
                    <p class="section-subtitle">
                        He desarrollado el <strong>MÉTODO LONDRES</strong>, una metodología única 
                        para que indagues en tu imagen y encuentres tu estilo personal coherente 
                        con tus valores e ideales.
                    </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="metodologia-step">
                        <div class="step-icon">
                            <i class="ti-search"></i>
                        </div>
                        <h4>Autoconocimiento</h4>
                        <p>Exploramos juntas quién eres realmente, tus valores, personalidad y estilo de vida.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="metodologia-step">
                        <div class="step-icon">
                            <i class="ti-palette"></i>
                        </div>
                        <h4>Análisis de Estilo</h4>
                        <p>Analizamos tu colorimetría, morfología y estilo personal para potenciar tu imagen.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="metodologia-step">
                        <div class="step-icon">
                            <i class="ti-heart"></i>
                        </div>
                        <h4>Transformación</h4>
                        <p>Implementamos cambios coherentes que reflejen tu esencia y potencien tu autoestima.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MI HISTORIA -->
    <section class="historia-section pt100 pb100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="historia-content" data-aos="fade-up">
                        <h2 class="text-center mb-4">Mi Historia</h2>
                        
                        <div class="historia-text">
                            <p>
                                Dicen que tengo un estilo muy claro, atrevido y cuidado, pero no siempre fue así. 
                                Mi imagen ha ido evolucionando de la mano de un proceso de autoconocimiento y 
                                aceptación de mí misma.
                            </p>
                            
                            <p>
                                Ahora siento que tengo una imagen honesta, coherente con mis valores y libre de juicio. 
                                Este proceso personal me llevó a desarrollar una metodología de trabajo que quiero 
                                compartir contigo.
                            </p>
                            
                            <blockquote class="blockquote text-center mt-4 mb-4">
                                <p class="mb-0">
                                    "No se trata de cómo te ves, sino de cómo te sientes contigo misma 
                                    y cómo te relacionas con el mundo."
                                </p>
                            </blockquote>
                            
                            <p>
                                Mi objetivo es acompañarte en un proceso de autoconocimiento que te permita 
                                encontrar tu estilo personal auténtico, ese que realmente te representa y 
                                te hace sentir segura de ti misma.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ESTADÍSTICAS -->
    <section class="stats-section pt100 pb100 background-primary text-white">
        <div class="container">
            <div class="row text-center">
                <?php 
                $stats = leticia_get_site_stats();
                ?>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $stats['anos_experiencia']; ?>+</div>
                        <div class="stat-label">Años de experiencia</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $stats['clientes_satisfechos']; ?>+</div>
                        <div class="stat-label">Clientas satisfechas</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $stats['servicios']; ?>+</div>
                        <div class="stat-label">Servicios especializados</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Transformaciones exitosas</div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="cta-final pt100 pb100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <h2>¿Preparada para descubrir tu verdadero estilo?</h2>
                    <p class="lead mb-4">
                        Empecemos juntas este viaje hacia el descubrimiento de tu imagen auténtica.
                    </p>
                    
                    <div class="cta-actions">
                        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-primary btn-lg">
                            Reserva tu consulta
                        </a>
                        
                        <a href="<?php echo esc_url(home_url('/servicios/')); ?>" class="btn btn-outline-primary btn-lg">
                            Ver servicios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>