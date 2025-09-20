</main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- Información de contacto -->
                    <div class="col-md-4">
                        <h5>Contacto</h5>
                        <div class="footer-contact">
                            <?php
                            // Usar función segura que no causa errores
                            $email = function_exists('leticia_get_site_setting') ? leticia_get_site_setting('contacto_email', 'info@leticiarobaina.com') : 'info@leticiarobaina.com';
                            $telefono = function_exists('leticia_get_site_setting') ? leticia_get_site_setting('contacto_telefono', '+34 670 837 991') : '+34 670 837 991';
                            ?>
                            <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                            <p><strong>Teléfono:</strong> <a href="tel:<?php echo esc_attr(str_replace(' ', '', $telefono)); ?>"><?php echo esc_html($telefono); ?></a></p>
                        </div>
                    </div>

                    <!-- Menú del footer -->
                    <div class="col-md-4">
                        <h5>Navegación</h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => false,
                            'fallback_cb'    => 'leticia_footer_menu_fallback',
                        ));
                        ?>
                    </div>

                    <!-- Redes sociales -->
                    <div class="col-md-4">
                        <h5>Sígueme</h5>
                        <div class="footer-social">
                            <?php
                            // Redes sociales básicas
                            $facebook = get_theme_mod('facebook_url', '');
                            $instagram = get_theme_mod('instagram_url', '');
                            
                            if ($facebook) {
                                echo '<a href="' . esc_url($facebook) . '" target="_blank" rel="noopener" class="social-link"><i class="fa fa-facebook"></i> Facebook</a>';
                            }
                            if ($instagram) {
                                echo '<a href="' . esc_url($instagram) . '" target="_blank" rel="noopener" class="social-link"><i class="fa fa-instagram"></i> Instagram</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<style>
/* CSS básico para el footer */
.site-footer {
    background-color: #2c3e50;
    color: white;
    padding: 40px 0 20px;
    margin-top: 60px;
}

.footer-content h5 {
    color: #d4af37;
    margin-bottom: 20px;
    font-size: 18px;
}

.footer-contact p,
.footer-menu li,
.footer-social a {
    margin-bottom: 10px;
}

.footer-contact a,
.footer-menu a,
.footer-social a {
    color: #ecf0f1;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-contact a:hover,
.footer-menu a:hover,
.footer-social a:hover {
    color: #d4af37;
}

.footer-menu {
    list-style: none;
    padding: 0;
}

.footer-menu li {
    margin-bottom: 8px;
}

.footer-social a {
    display: block;
    margin-bottom: 8px;
}

.footer-social i {
    margin-right: 8px;
    width: 20px;
}

.footer-bottom {
    border-top: 1px solid #34495e;
    margin-top: 30px;
    padding-top: 20px;
}

.footer-bottom p {
    margin: 0;
    font-size: 14px;
    opacity: 0.8;
}

/* Grid responsivo básico */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.col-md-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
    padding: 0 15px;
}

.col-12 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 0 15px;
}

.text-center {
    text-align: center;
}

@media (max-width: 768px) {
    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 30px;
    }
}
</style>

<script>
// JavaScript básico para el footer
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para enlaces del footer
    const footerLinks = document.querySelectorAll('.footer-menu a[href^="#"]');
    footerLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

</body>
</html>

<?php
// Menú fallback para el footer
function leticia_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    echo '<li><a href="' . esc_url(home_url('/sobre-mi')) . '">Sobre mí</a></li>';
    echo '<li><a href="' . esc_url(home_url('/servicios')) . '">Servicios</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contacto')) . '">Contacto</a></li>';
    echo '</ul>';
}
?>