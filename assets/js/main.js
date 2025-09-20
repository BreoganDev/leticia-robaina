/**
 * Main JavaScript para Leticia Robaina Theme
 * Compatible con jQuery 3.6+ y Bootstrap 5
 */

(function($) {
    'use strict';

    // Esperar a que el DOM esté listo
    $(document).ready(function() {
        console.log('Leticia Robaina Theme: JavaScript inicializado correctamente');
        
        // Inicializar funciones
        initNavbar();
        initSmoothScroll();
        initAnimations();
        initForms();
        initMobileMenu();
    });

    /**
     * Inicializar navbar
     */
    function initNavbar() {
        const navbar = $('.navbar');
        if (navbar.length === 0) return;

        // Scroll effect para navbar
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                navbar.addClass('navbar-scrolled');
            } else {
                navbar.removeClass('navbar-scrolled');
            }
        });

        // Cerrar menú móvil al hacer click en un enlace
        $('.navbar-nav .nav-link').on('click', function() {
            const navbarCollapse = $('.navbar-collapse');
            if (navbarCollapse.hasClass('show')) {
                navbarCollapse.collapse('hide');
            }
        });
    }

    /**
     * Inicializar scroll suave
     */
    function initSmoothScroll() {
        // Scroll suave para enlaces internos
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'swing');
            }
        });
    }

    /**
     * Inicializar animaciones (sin hover deprecado)
     */
    function initAnimations() {
        // Animaciones al hacer scroll
        if (typeof $.fn.waypoint !== 'undefined') {
            $('.service-card, .testimonial-card').waypoint(function() {
                $(this.element).addClass('animate-fadeInUp');
            }, {
                offset: '75%'
            });
        }

        // Hover effects usando mouseenter/mouseleave en lugar de hover()
        $('.service-card, .testimonial-card, .btn')
            .on('mouseenter', function() {
                $(this).addClass('hover-effect');
            })
            .on('mouseleave', function() {
                $(this).removeClass('hover-effect');
            });

        // Parallax suave para hero
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();
            const rate = scrolled * -0.5;
            
            $('.hero-section').css('transform', 'translateY(' + rate + 'px)');
        });
    }

    /**
     * Inicializar formularios
     */
    function initForms() {
        // Validación básica de formularios
        $('form').on('submit', function(e) {
            let isValid = true;
            
            // Validar campos requeridos
            $(this).find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Validar email
            $(this).find('input[type="email"]').each(function() {
                const email = $(this).val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email && !emailRegex.test(email)) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showNotification('Por favor, completa todos los campos requeridos.', 'error');
            }
        });

        // Limpiar errores al escribir
        $('input, textarea, select').on('input change', function() {
            $(this).removeClass('is-invalid');
        });
    }

    /**
     * Menú móvil mejorado
     */
    function initMobileMenu() {
        const $mobileToggle = $('.navbar-toggler');
        const $mobileMenu = $('.navbar-collapse');

        if ($mobileToggle.length === 0) return;

        // Toggle personalizado si Bootstrap no está disponible
        $mobileToggle.on('click', function(e) {
            e.preventDefault();
            
            // Si Bootstrap está disponible, usar su toggle
            if (typeof bootstrap !== 'undefined') {
                return; // Dejar que Bootstrap maneje esto
            }
            
            // Fallback manual
            $mobileMenu.toggleClass('show');
            $(this).attr('aria-expanded', $mobileMenu.hasClass('show'));
        });

        // Cerrar menú al hacer click fuera
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.navbar').length && $mobileMenu.hasClass('show')) {
                $mobileMenu.removeClass('show');
                $mobileToggle.attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * Sistema de notificaciones
     */
    function showNotification(message, type = 'info') {
        const $notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        $('body').append($notification);
        
        // Animar entrada
        setTimeout(function() {
            $notification.addClass('show');
        }, 100);
        
        // Auto-ocultar después de 3 segundos
        setTimeout(function() {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }

    /**
     * Lazy loading de imágenes
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove('lazy');
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        }
    }

    /**
     * Optimización de performance
     */
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            
            if (callNow) func.apply(context, args);
        };
    }

    // Optimizar eventos de scroll
    $(window).on('scroll', debounce(function() {
        // Los eventos de scroll ya están optimizados arriba
    }, 10));

    // Optimizar eventos de resize
    $(window).on('resize', debounce(function() {
        // Recalcular layouts si es necesario
        initMobileMenu();
    }, 250));

    /**
     * Accesibilidad mejorada
     */
    function initAccessibility() {
        // Focus visible para navegación por teclado
        $('a, button, input, textarea, select').on('focus', function() {
            $(this).addClass('focus-visible');
        }).on('blur', function() {
            $(this).removeClass('focus-visible');
        });

        // Skip links
        $('.skip-link').on('click', function(e) {
            e.preventDefault();
            const target = $($(this).attr('href'));
            if (target.length) {
                target.focus();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 300);
            }
        });
    }

    // Inicializar funciones adicionales
    $(window).on('load', function() {
        initLazyLoading();
        initAccessibility();
    });

    // Exponer funciones útiles globalmente
    window.LeticiaTheme = {
        showNotification: showNotification,
        debounce: debounce
    };

})(jQuery);

/**
 * CSS adicional para JavaScript
 */
const additionalCSS = `
<style>
.navbar-scrolled {
    background-color: rgba(255, 255, 255, 0.98) !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.hover-effect {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.animate-fadeInUp {
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    color: white;
    z-index: 9999;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    max-width: 300px;
}

.notification.show {
    transform: translateX(0);
}

.notification-error {
    background-color: #e74c3c;
}

.notification-success {
    background-color: #27ae60;
}

.notification-info {
    background-color: #3498db;
}

.is-invalid {
    border-color: #e74c3c !important;
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25) !important;
}

.focus-visible {
    outline: 2px solid #d4af37 !important;
    outline-offset: 2px !important;
}

.lazy {
    opacity: 0;
    transition: opacity 0.3s;
}

.lazy.loaded {
    opacity: 1;
}

/* Mejoras responsive */
@media (max-width: 768px) {
    .notification {
        right: 10px;
        left: 10px;
        max-width: none;
        transform: translateY(-100px);
    }
    
    .notification.show {
        transform: translateY(0);
    }
}
</style>
`;

// Inyectar CSS adicional
if (document.head) {
    document.head.insertAdjacentHTML('beforeend', additionalCSS);
}