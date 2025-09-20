<?php
/**
 * Template Name: Template Home
 * Replica EXACTA de leticiarobaina.com según HTML original
 */

get_header(); ?>

<main id="main" class="site-main home-page" role="main">
    
    <!-- HERO SECTION - ESTRUCTURA EXACTA DEL ORIGINAL -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="featured">
            <div class="block block-featured block-77681 block-destacado background-dark pt0 pb0 text-center block-background-image block-align-middle block-align-left" 
                 style="height: 100vh" data-scroll-icon="1">
                
                <div class="container">
                    <div class="block-featured-content" style="width: 50%; margin-left: 0;">
                        <div class="ptani-wrapper">
                            
                            <h1 class="block-title" style="">
                                <?php echo get_field('home_hero_titulo') ?: 'IMAGEN REAL'; ?>
                            </h1>
                            
                            <div class="text rtf-content" style="">
                                <p><?php echo get_field('home_hero_subtitulo') ?: 'Sé tu propia asesora de imagen.'; ?></p>
                            </div>
                            
                            <div class="actions">
                                <?php 
                                $cta_texto = get_field('home_hero_cta_texto');
                                $cta_url = get_field('home_hero_cta_url');
                                if ($cta_texto && $cta_url) : 
                                ?>
                                <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary">
                                    <?php echo esc_html($cta_texto); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- IMAGEN DE FONDO - ESTRUCTURA EXACTA -->
                <div class="block-background-image">
                    <?php 
                    $hero_img = get_field('home_hero_imagen');
                    if ($hero_img) : 
                    ?>
                        <picture class="lazy">
                            <source media="(max-width: 640px)" data-srcset="<?php echo esc_url($hero_img['sizes']['medium']); ?>" type="image/webp">
                            <source media="(max-width: 980px)" data-srcset="<?php echo esc_url($hero_img['sizes']['large']); ?>" type="image/webp">
                            <source media="(min-width: 981px)" data-srcset="<?php echo esc_url($hero_img['url']); ?>" type="image/webp">
                            <img data-src="<?php echo esc_url($hero_img['sizes']['medium']); ?>" class="block-picture" alt="<?php echo esc_attr($hero_img['alt']); ?>">
                        </picture>
                    <?php else : ?>
                        <picture class="lazy">
                            <img data-src="<?php echo LETICIA_URI; ?>/assets/img/hero-default.jpg" class="block-picture" alt="Leticia Robaina">
                        </picture>
                    <?php endif; ?>
                </div>
                
                <!-- SCROLL ICON -->
                <div class="com-scroll-icon">
                    <div class="com-scroll-icon-mouse"></div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- SECCIÓN 1: ¿TE SIENTES INSATISFECHA CON TU ESTILO? -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="textandcarousel">
            <div class="block block-textandcarousel block-77643 background-white pt100 pb100 block-align-right text-left">
                <div class="block-textandcarousel-wrapper container">
                    
                    <div class="block-textandcarousel-carousel">
                        <div class="items loading">
                            <div class="item">
                                <picture>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/seccion-1.png" class="block-picture" alt="Insatisfecha con tu estilo">
                                </picture>
                            </div>
                        </div>
                    </div>
                    
                    <div class="block-textandcarousel-text text-left">
                        <div class="ptani-wrapper">
                            
                            <h2 class="block-title">¿TE SIENTES INSATISFECHA CON TU ESTILO?</h2>
                            
                            <div class="block-textandcarousel-text-container rtf-content">
                                <p>Si te encuentras comparándote continuamente con otras personas que parecen tener un estilo que te gustaría tener es un claro síntoma de que te sientes insatisfecho con tu estilo.</p>
                                <p>La insatisfacción con tu estilo personal afecta a tu autoestima por lo que empiezas a dudar de ti mism@ y de tu valía como persona debido a cómo te percibes físicamente.</p>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 2: UN ESTILO QUE TE SIENTA BIEN -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="textandcarousel">
            <div class="block block-textandcarousel block-77645 background-light pt100 pb100 block-align-left text-left">
                <div class="block-textandcarousel-wrapper container">
                    
                    <div class="block-textandcarousel-carousel">
                        <div class="items loading">
                            <div class="item">
                                <picture>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/seccion-2.png" class="block-picture" alt="Un estilo que te sienta bien">
                                </picture>
                            </div>
                        </div>
                    </div>
                    
                    <div class="block-textandcarousel-text text-left">
                        <div class="ptani-wrapper">
                            
                            <h2 class="block-title">UN ESTILO QUE TE SIENTA BIEN…</h2>
                            
                            <div class="block-textandcarousel-text-container rtf-content">
                                <p style="text-align: justify;">No se trata de cómo te ves, sino de cómo te sientes contigo mism@ y cómo te relacionas con el mundo.</p>
                                <p style="text-align: justify;">Conseguir un estilo que te potencie tiene un impacto positivo en tu autoestima, autoconfianza, comodidad y la forma en que te perciben los demás.</p>
                                <p style="text-align: justify;">Tener un imagen personal acorde a tus valores te ayuda a tomar decisiones más conscientes en cuanto a tu estilo y a como expresar tu individualidad y tu creatividad.</p>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 3: EL PODER DE LLEVAR TU PROPIO ESTILO -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="textandcarousel">
            <div class="block block-textandcarousel block-77647 background-white pt100 pb100 block-align-right text-left">
                <div class="block-textandcarousel-wrapper container">
                    
                    <div class="block-textandcarousel-carousel">
                        <div class="items loading">
                            <div class="item">
                                <picture>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/seccion-3.png" class="block-picture" alt="El poder de llevar tu propio estilo">
                                </picture>
                            </div>
                        </div>
                    </div>
                    
                    <div class="block-textandcarousel-text text-left">
                        <div class="ptani-wrapper">
                            
                            <h2 class="block-title">EL PODER DE LLEVAR TU PROPIO ESTILO</h2>
                            
                            <div class="block-textandcarousel-text-container rtf-content">
                                <p style="text-align: justify;">Dicen que tengo un estilo muy claro, atrevido y cuidado pero no siempre fue así.</p>
                                <p style="text-align: justify;">Mi imagen ha ido evolucionando de la mano de un proceso de autoconocimiento y aceptación de mí misma.</p>
                                <p style="text-align: justify;">Ahora siento que tengo una imagen honesta, coherente con mis valores y libre de juicio.</p>
                            </div>
                            
                            <div class="btn-actions-container">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('sobre-mi'))); ?>" class="btn btn-primary">
                                    SOBRE MÍ
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 4: LA BELLEZA INTERIOR CAUTIVA -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="textandcarousel">
            <div class="block block-textandcarousel block-77649 background-light pt100 pb100 block-align-left text-left">
                <div class="block-textandcarousel-wrapper container">
                    
                    <div class="block-textandcarousel-carousel">
                        <div class="items loading">
                            <div class="item">
                                <picture>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/seccion-4.png" class="block-picture" alt="La belleza interior cautiva">
                                </picture>
                            </div>
                        </div>
                    </div>
                    
                    <div class="block-textandcarousel-text text-left">
                        <div class="ptani-wrapper">
                            
                            <h2 class="block-title">LA BELLEZA INTERIOR CAUTIVA</h2>
                            
                            <div class="block-textandcarousel-text-container rtf-content">
                                <p style="text-align: justify;">He desarrollado una metodología de trabajo, llamada <strong>MÉTODO LONDRES</strong>, para que indagues en tu imagen y así encuentres tu estilo personal que sea coherente con tus valores y tus ideales. Mi metodología incluye recursos y herramientas prácticas que te acompañarán en un proceso de autoconocimiento.</p>
                            </div>
                            
                            <div class="btn-actions-container">
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('servicios'))); ?>" class="btn btn-primary">
                                    SERVICIOS
                                </a>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('talleres'))); ?>" class="btn btn-default">
                                    TALLERES
                                </a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- IMAGEN SEPARADORA -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="image">
            <div class="block block-image background-white pt0 pb0">
                <div class="img-wrapper">
                    <picture class="lazy">
                        <img data-src="<?php echo LETICIA_URI; ?>/assets/img/degradado-separador.png" class="block-picture" alt="">
                    </picture>
                </div>
                <div class="block-background-image" data-bg-image="<?php echo LETICIA_URI; ?>/assets/img/background-pattern.png"></div>
            </div>
        </div>
    </div>

    <!-- NEWSLETTER -->
    <div class="layout-row">
        <div class="" data-layout-cell="100" data-block-cell="formbuilder">
            <div class="block block-formbuilder background-light pt75 pb50 block-formbuilder-form-only block-align-right block-formbuilder-image-inline">
                
                <div class="block-formbuilder-content">
                    <div class="container">
                        
                        <div class="block-formbuilder-form block-formbuilder-inline-form">
                            <h2 class="block-title">NEWSLETTER</h2>
                            
                            <div class="block-formbuilder-form-container">
                                
                                <!-- Aquí iría el formulario de newsletter -->
                                <?php if (shortcode_exists('contact-form-7')) : ?>
                                    <?php echo do_shortcode('[contact-form-7 id="newsletter"]'); ?>
                                <?php else : ?>
                                    <form class="newsletter-form">
                                        <div class="form-group">
                                            <label for="newsletter-email">TU EMAIL</label>
                                            <input type="email" class="form-control" id="newsletter-email" name="email" required>
                                        </div>
                                        
                                        <div class="mt40 tos form-group checkbox checkbox-style">
                                            <label for="newsletter-tos">
                                                <input type="checkbox" id="newsletter-tos" name="tos" required value="1">
                                                Acepto
                                            </label>
                                            <a href="<?php echo esc_url(get_permalink(get_page_by_path('aviso-legal'))); ?>">Aviso legal y política de privacidad</a>
                                        </div>
                                        
                                        <div class="mt10">
                                            <button type="submit" class="btn btn-primary btn-block">SUSCRIBIRME</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</main>

<?php get_footer(); ?>