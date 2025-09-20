<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3">
    <meta http-equiv="content-language" content="<?php echo get_locale(); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('page-blocks mode- os-windows'); ?>>
    <?php wp_body_open(); ?>
    
    <div id="wrapper" class="size-md">
        
        <!-- HEADER - ESTRUCTURA EXACTA DEL ORIGINAL -->
        <header class="block block-header block-77642 block-cabecera" data-block="header" data-id="77642">
            
            <div class="new-header">
                
                <!-- HEADER DESKTOP -->
                <div class="headerlg has-background-dark block-header-nav-item-colored" 
                     style="background: #29292900" 
                     data-bg="background-dark" 
                     data-fixed="0" 
                     data-floating="1" 
                     data-scroll-effect="0" 
                     data-bg-transparency="100" 
                     data-nav-style="1">
                    
                    <div class="header-main-section header-layout-menu-centered pt40 pb40">
                        
                        <!-- LOGO -->
                        <div class="logo-wrapper">
                            <a href="<?php echo home_url(); ?>">
                                <?php if (has_custom_logo()) : ?>
                                    <?php the_custom_logo(); ?>
                                <?php else : ?>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/logo.png" 
                                         style="height: 80px" 
                                         alt="<?php bloginfo('name'); ?>" 
                                         title="<?php bloginfo('name'); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <!-- NAVEGACIÓN PRINCIPAL -->
                        <div class="navigation-wrapper">
                            <nav class="menu">
                                
                                <!-- INICIO -->
                                <div class="menuitem <?php echo is_front_page() ? 'active' : ''; ?>">
                                    <a class="" style="font-size: 14px;" href="<?php echo home_url(); ?>">Inicio</a>
                                </div>
                                
                                <!-- SOBRE MÍ -->
                                <div class="menuitem <?php echo is_page('sobre-mi') ? 'active' : ''; ?>">
                                    <a class="" style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('sobre-mi')); ?>">Sobre mí</a>
                                </div>
                                
                                <!-- SERVICIOS CON SUBMENÚ -->
                                <div class="menuitem has-submenu <?php echo is_page('servicios') ? 'active' : ''; ?>">
                                    <a class="" style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('servicios')); ?>">
                                        Servicios<i class="ti-angle-down"></i>
                                    </a>
                                    <div class="submenu background-dark">
                                        
                                        <!-- Programa Express -->
                                        <div class="menuitem has-submenu">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('servicios')); ?>">
                                                Programa Express <i class="ti-angle-down"></i>
                                            </a>
                                            <div class="submenu background-dark">
                                                <div class="menuitem">
                                                    <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('color-y-emociones')); ?>">Color y Emociones</a>
                                                </div>
                                                <div class="menuitem">
                                                    <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('psicologia-del-estilo')); ?>">Psicología del Estilo</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Programas Premium -->
                                        <div class="menuitem has-submenu">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('servicios')); ?>">
                                                Programas Premium <i class="ti-angle-down"></i>
                                            </a>
                                            <div class="submenu background-dark">
                                                <div class="menuitem">
                                                    <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('armario-consciente')); ?>">Armario Consciente</a>
                                                </div>
                                                <div class="menuitem">
                                                    <a target="_blank" style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('marca-personal')); ?>">Impacta con tu imagen en tu marca personal</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Programa Platinum -->
                                        <div class="menuitem has-submenu">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('servicios')); ?>">
                                                Programa Platinum <i class="ti-angle-down"></i>
                                            </a>
                                            <div class="submenu background-dark">
                                                <div class="menuitem">
                                                    <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('imagen-real')); ?>">Descubre y desarrolla tu imagen real</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <!-- TALLERES CON SUBMENÚ -->
                                <div class="menuitem has-submenu <?php echo is_page('talleres') ? 'active' : ''; ?>">
                                    <a class="" style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('talleres')); ?>">
                                        Talleres<i class="ti-angle-down"></i>
                                    </a>
                                    <div class="submenu background-dark">
                                        <div class="menuitem">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('taller-armario-consciente')); ?>">Armario Consciente</a>
                                        </div>
                                        <div class="menuitem">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('color-emociones-piel')); ?>">Color, emociones y piel</a>
                                        </div>
                                        <div class="menuitem">
                                            <a style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('taller-imagen-consciente')); ?>">Imagen Consciente</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- CURSO ONLINE -->
                                <div class="menuitem">
                                    <a target="_blank" class="" style="font-size: 14px;" href="https://hotm.art/qfcnxZqp">Curso Online</a>
                                </div>
                                
                                <!-- CONTACTO -->
                                <div class="menuitem">
                                    <a class="btn btn-primary" style="font-size: 14px;" href="<?php echo get_permalink(get_page_by_path('contacto')); ?>">Contacto</a>
                                </div>
                                
                            </nav>
                        </div>
                        
                        <!-- ACCIONES (REDES + CTA) -->
                        <div class="actions-wrapper">
                            
                            <!-- REDES SOCIALES -->
                            <div class="menuitem social">
                                <?php 
                                $facebook = leticia_get_site_setting('marca_facebook');
                                $instagram = leticia_get_site_setting('marca_instagram');
                                
                                if ($facebook) : ?>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" aria-label="Facebook">
                                        <i class="fa fa-facebook-official"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($instagram) : ?>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" aria-label="Instagram">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <!-- CTA CONTACTO -->
                            <div class="menuitem cta">
                                <a class="btn btn-primary btn-cta" href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" style="font-size: 14px;">
                                    Contacto
                                </a>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
                <!-- HEADER MÓVIL -->
                <div class="headersm has-background-dark block-header-nav-item-colored" 
                     style="background: #29292900" 
                     data-fixed="0" 
                     data-bg="background-dark" 
                     data-floating="1" 
                     data-scroll-effect="0" 
                     data-bg-transparency="100">
                    
                    <div class="header-main-section header-layout-hamburger-standard pt40 pb40">
                        
                        <!-- NAVEGACIÓN MÓVIL -->
                        <div class="navigation-wrapper">
                            <div class="icon-wrapper">
                                <div class="slidemenu-icon-wrapper toggle-global-slidemenu burger2">
                                    <span class="automatic-background-color"></span>
                                    <span class="automatic-background-color"></span>
                                    <span class="automatic-background-color"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- LOGO MÓVIL -->
                        <div class="logo-wrapper">
                            <a href="<?php echo home_url(); ?>">
                                <?php if (has_custom_logo()) : ?>
                                    <?php the_custom_logo(); ?>
                                <?php else : ?>
                                    <img src="<?php echo LETICIA_URI; ?>/assets/img/logo-mobile.png" 
                                         style="height: 80px" 
                                         alt="<?php bloginfo('name'); ?>" 
                                         title="<?php bloginfo('name'); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <!-- ACCIONES MÓVIL -->
                        <div class="actions-wrapper">
                            <div class="menuitem social">
                                <?php if ($facebook) : ?>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" aria-label="Facebook">
                                        <i class="fa fa-facebook-official"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($instagram) : ?>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" aria-label="Instagram">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="menuitem cta">
                                <a class="btn btn-primary btn-cta" href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" style="font-size: 14px;">
                                    Contacto
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
            <!-- MENÚ SLIDE MÓVIL -->
            <div class="header-slidemenu background-white has-background-white slidemenu-slide slidemenu-icon-right-position block-header-nav-item-colored" data-nav-style="1">
                <button class="close-slidemenu toggle-global-slidemenu" title="Cerrar">
                    <i class="ti-close"></i>
                </button>
                
                <div class="content">
                    <div class="content-1">
                        <!-- MENÚ MÓVIL - MISMA ESTRUCTURA QUE DESKTOP -->
                        <nav class="menu">
                            <div class="menuitem <?php echo is_front_page() ? 'active' : ''; ?>">
                                <a style="font-size: 14px;" href="<?php echo home_url(); ?>">Inicio</a>
                            </div>
                            <!-- Resto de elementos del menú igual que desktop -->
                        </nav>
                    </div>
                    
                    <div class="content-2">
                        <div class="social-wrapper">
                            <ul class="social">
                                <?php if ($facebook) : ?>
                                    <li><a href="<?php echo esc_url($facebook); ?>" target="_blank" aria-label="Facebook"><i class="fa fa-facebook-official"></i></a></li>
                                <?php endif; ?>
                                <?php if ($instagram) : ?>
                                    <li><a href="<?php echo esc_url($instagram); ?>" target="_blank" aria-label="Instagram"><i class="fa fa-instagram"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header-slidermenu-overlay"></div>
            
            <!-- PLACEHOLDERS -->
            <div id="headerlg-placeholder"></div>
            <div id="headersm-placeholder"></div>
            
        </header>