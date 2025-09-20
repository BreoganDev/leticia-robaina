<?php
/**
 * Index principal del theme Leticia Robaina
 * Archivo principal que se usa cuando no hay template específico
 * 
 * @package Leticia_Robaina_Theme
 */

get_header(); ?>

<div class="site-content">
    <div class="container">
        
        <?php if (have_posts()) : ?>
            
            <div class="content-area">
                
                <?php if (is_home() && !is_front_page()) : ?>
                    <header class="page-header pt100 pb50">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1 class="page-title"><?php single_post_title(); ?></h1>
                            </div>
                        </div>
                    </header>
                <?php elseif (is_search()) : ?>
                    <header class="page-header pt100 pb50">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1 class="page-title">
                                    Resultados de búsqueda para: "<?php echo get_search_query(); ?>"
                                </h1>
                                <p class="search-results-count">
                                    <?php
                                    global $wp_query;
                                    $total = $wp_query->found_posts;
                                    if ($total == 1) {
                                        echo "Se encontró 1 resultado";
                                    } else {
                                        echo "Se encontraron {$total} resultados";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </header>
                <?php elseif (is_archive()) : ?>
                    <header class="page-header pt100 pb50">
                        <div class="row">
                            <div class="col-12 text-center">
                                <?php if (is_post_type_archive()) : ?>
                                    <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
                                <?php elseif (is_category()) : ?>
                                    <h1 class="page-title">Categoría: <?php single_cat_title(); ?></h1>
                                <?php elseif (is_tag()) : ?>
                                    <h1 class="page-title">Etiqueta: <?php single_tag_title(); ?></h1>
                                <?php elseif (is_author()) : ?>
                                    <h1 class="page-title">Autor: <?php echo get_the_author(); ?></h1>
                                <?php elseif (is_date()) : ?>
                                    <h1 class="page-title">Archivo: <?php echo get_the_date('F Y'); ?></h1>
                                <?php else : ?>
                                    <h1 class="page-title">Archivo</h1>
                                <?php endif; ?>
                                
                                <?php if (is_post_type_archive('servicio')) : ?>
                                    <p class="archive-description">
                                        Descubre todos nuestros servicios de asesoría de imagen personal
                                    </p>
                                <?php elseif (is_post_type_archive('testimonio')) : ?>
                                    <p class="archive-description">
                                        Lee lo que dicen nuestras clientas sobre su experiencia
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </header>
                <?php endif; ?>
                
                <div class="posts-section pt50 pb100">
                    
                    <?php if (is_post_type_archive('servicio')) : ?>
                        <!-- GRID DE SERVICIOS -->
                        <div class="row">
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                                    <?php leticia_render_service_card(get_the_ID(), 'archive-service'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        
                    <?php elseif (is_post_type_archive('testimonio')) : ?>
                        <!-- GRID DE TESTIMONIOS -->
                        <div class="row">
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                                    <?php leticia_render_testimonial_card(get_the_ID(), 'archive-testimonial'); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        
                    <?php else : ?>
                        <!-- LISTADO ESTÁNDAR DE POSTS -->
                        <div class="row">
                            <?php while (have_posts()) : the_post(); ?>
                                
                                <div class="col-12 mb-4" data-aos="fade-up">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                        
                                        <div class="row align-items-center">
                                            
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="col-md-4">
                                                    <div class="post-thumbnail">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('medium', array('class' => 'img-responsive rounded')); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                            <?php else : ?>
                                                <div class="col-12">
                                            <?php endif; ?>
                                            
                                                <div class="post-content">
                                                    
                                                    <header class="entry-header">
                                                        <h2 class="entry-title">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>
                                                        
                                                        <div class="entry-meta">
                                                            <span class="posted-on">
                                                                <i class="ti-calendar"></i>
                                                                <time datetime="<?php echo get_the_date('c'); ?>">
                                                                    <?php echo get_the_date(); ?>
                                                                </time>
                                                            </span>
                                                            
                                                            <?php if (get_post_type() == 'post') : ?>
                                                                <span class="posted-by">
                                                                    <i class="ti-user"></i>
                                                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                                                        <?php echo get_the_author(); ?>
                                                                    </a>
                                                                </span>
                                                                
                                                                <?php $categories = get_the_category(); ?>
                                                                <?php if ($categories) : ?>
                                                                    <span class="posted-in">
                                                                        <i class="ti-folder"></i>
                                                                        <?php foreach ($categories as $category) : ?>
                                                                            <a href="<?php echo get_category_link($category->term_id); ?>">
                                                                                <?php echo $category->name; ?>
                                                                            </a>
                                                                        <?php endforeach; ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </header>
                                                    
                                                    <div class="entry-summary">
                                                        <?php 
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo wp_trim_words(get_the_content(), 30, '...');
                                                        }
                                                        ?>
                                                    </div>
                                                    
                                                    <div class="entry-actions">
                                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">
                                                            Leer más <i class="ti-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </article>
                                </div>
                                
                            <?php endwhile; ?>
                        </div>
                        
                    <?php endif; ?>
                    
                </div>
                
                <!-- PAGINACIÓN -->
                <?php
if ( function_exists('leticia_pagination') ) {
    leticia_pagination();
} else {
    the_posts_pagination([
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
    ]);
}
?>

                
            </div>
            
        <?php else : ?>
            
            <div class="no-content pt100 pb100">
                <div class="row">
                    <div class="col-lg-6 mx-auto text-center">
                        <div class="no-content-message" data-aos="fade-up">
                            <i class="ti-search" style="font-size: 4rem; color: #ccc; margin-bottom: 2rem;"></i>
                            
                            <?php if (is_search()) : ?>
                                <h2>No se encontraron resultados</h2>
                                <p>Lo siento, no se encontraron resultados para "<strong><?php echo get_search_query(); ?></strong>". Intenta con otros términos de búsqueda.</p>
                                
                                <div class="search-suggestions">
                                    <h4>Sugerencias:</h4>
                                    <ul class="suggestions-list">
                                        <li>Verifica la ortografía de las palabras</li>
                                        <li>Usa términos más generales</li>
                                        <li>Prueba con sinónimos</li>
                                    </ul>
                                </div>
                                
                                <!-- Formulario de búsqueda alternativo -->
                                <div class="search-form-wrapper mt-4">
                                    <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="search-form">
                                        <div class="input-group">
                                            <input type="search" 
                                                   class="form-control" 
                                                   placeholder="Buscar..." 
                                                   value="<?php echo get_search_query(); ?>" 
                                                   name="s">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="ti-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                            <?php else : ?>
                                <h2>No hay contenido disponible</h2>
                                <p>Actualmente no hay contenido publicado en esta sección.</p>
                                
                                <?php if (current_user_can('edit_posts')) : ?>
                                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn btn-primary">
                                        Crear contenido
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <!-- Enlaces útiles -->
                            <div class="helpful-links mt-4">
                                <h4>Enlaces útiles:</h4>
                                <div class="links-grid">
                                    <a href="<?php echo home_url('/'); ?>" class="btn btn-outline-primary">
                                        <i class="ti-home"></i> Inicio
                                    </a>
                                    <a href="<?php echo home_url('/servicios/'); ?>" class="btn btn-outline-primary">
                                        <i class="ti-briefcase"></i> Servicios
                                    </a>
                                    <a href="<?php echo home_url('/sobre-mi/'); ?>" class="btn btn-outline-primary">
                                        <i class="ti-user"></i> Sobre mí
                                    </a>
                                    <a href="<?php echo home_url('/contacto/'); ?>" class="btn btn-outline-primary">
                                        <i class="ti-email"></i> Contacto
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endif; ?>
        
    </div>
</div>

<?php get_footer(); ?>