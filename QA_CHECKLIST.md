# ✅ CHECKLIST DE QA - LETICIA ROBAINA THEME

**Versión del Theme**: 1.0.0  
**Fecha de Testing**: ___________  
**Testeado por**: ___________  
**Entorno**: WordPress 6.6+ / PHP 8.1+

---

## 🔧 REQUISITOS TÉCNICOS

### ✅ Compatibilidad de Servidor
- [ ] **WordPress 6.6+** instalado y funcionando
- [ ] **PHP 8.1+** activo en el servidor
- [ ] **MySQL 5.7+** o **MariaDB 10.3+**
- [ ] **Memoria PHP**: Mínimo 256MB disponible
- [ ] **Extensiones PHP requeridas**: 
  - [ ] GD o ImageMagick
  - [ ] cURL
  - [ ] JSON
  - [ ] mbstring

### ✅ Plugins Obligatorios
- [ ] **ACF (Advanced Custom Fields)** versión gratuita instalado
- [ ] **ACF** activado correctamente
- [ ] **Contact Form 7** instalado (opcional pero recomendado)

---

## 🎯 ACTIVACIÓN DEL THEME

### ✅ Instalación Sin Errores
- [ ] Theme se instala sin errores desde ZIP
- [ ] Theme se activa sin "error crítico"
- [ ] No aparecen **PHP warnings** en `/wp-content/debug.log`
- [ ] No aparecen **PHP notices** en el log
- [ ] No aparecen **PHP fatals** en el log

### ✅ Configuración Automática
- [ ] Páginas principales se crean automáticamente:
  - [ ] Inicio
  - [ ] Sobre mí
  - [ ] Servicios
  - [ ] Test de Estilo
  - [ ] Contacto
  - [ ] Ajustes del Sitio (privada)
- [ ] Página "Inicio" se asigna como página principal
- [ ] Permalinks se configuran a `/%postname%/`

---

## 📄 PÁGINAS Y TEMPLATES

### ✅ Template de Inicio (template-home.php)
- [ ] Plantilla se asigna correctamente a la página "Inicio"
- [ ] Hero section carga sin errores
- [ ] Campos ACF del hero funcionan:
  - [ ] Título del hero
  - [ ] Subtítulo del hero
  - [ ] Texto del botón CTA
  - [ ] URL del botón CTA
  - [ ] Imagen de fondo
- [ ] Sección "Sobre mí" carga correctamente
- [ ] Servicios destacados aparecen (si existen)
- [ ] Testimonios destacados aparecen (si existen)
- [ ] CTA secundaria funciona
- [ ] Design responsive ✅ Mobile ✅ Tablet ✅ Desktop

### ✅ Template Sobre Mí (template-sobre-mi.php)
- [ ] Template se asigna correctamente
- [ ] Campos ACF funcionan:
  - [ ] Foto principal
  - [ ] Introducción
  - [ ] Punto destacado 1
  - [ ] Punto destacado 2
  - [ ] Punto destacado 3
  - [ ] Puntos adicionales (4-5)
- [ ] Contenido del editor de WordPress se muestra
- [ ] Design responsive ✅ Mobile ✅ Tablet ✅ Desktop

### ✅ Template Servicios (template-servicios.php)
- [ ] Template se asigna correctamente
- [ ] Campo ACF "Introducción de servicios" funciona
- [ ] Lista de servicios (CPT) aparece ordenada por `menu_order`
- [ ] Filtros de servicios funcionan (si implementados)
- [ ] Búsqueda de servicios funciona (si implementada)
- [ ] Paginación funciona correctamente
- [ ] Design responsive ✅ Mobile ✅ Tablet ✅ Desktop

### ✅ Template Test de Estilo (template-test-de-estilo.php)
- [ ] Template se asigna correctamente
- [ ] Campos ACF funcionan:
  - [ ] Título del test
  - [ ] Introducción del test
  - [ ] Shortcode del formulario
- [ ] Shortcode se renderiza sin romper el layout
- [ ] Formulario (CF7/Jotform) funciona correctamente
- [ ] Design responsive ✅ Mobile ✅ Tablet ✅ Desktop

### ✅ Template Contacto (template-contacto.php)
- [ ] Template se asigna correctamente
- [ ] Campos ACF funcionan:
  - [ ] Introducción
  - [ ] Teléfono
  - [ ] Email
  - [ ] Dirección
  - [ ] Horario
  - [ ] Código iframe del mapa
- [ ] Información de contacto se muestra correctamente
- [ ] Mapa (iframe) se renderiza correctamente
- [ ] Formulario de contacto funciona
- [ ] Design responsive ✅ Mobile ✅ Tablet ✅ Desktop

---

## 🔧 CAMPOS ACF

### ✅ Configuración de ACF
- [ ] **ACF está activo** y sin errores
- [ ] Grupos de campos se registran automáticamente vía PHP
- [ ] **NO** hay dependencia de archivos JSON de ACF
- [ ] Campos aparecen en las páginas correctas

### ✅ Página Home - Campos ACF
- [ ] `home_hero_titulo` funciona
- [ ] `home_hero_subtitulo` funciona
- [ ] `home_hero_cta_texto` funciona
- [ ] `home_hero_cta_url` funciona
- [ ] `home_hero_imagen` funciona (upload y preview)
- [ ] `home_cta_secundaria_texto` funciona
- [ ] `home_cta_secundaria_url` funciona

### ✅ Página Sobre Mí - Campos ACF
- [ ] `sobre_foto_principal` funciona
- [ ] `sobre_intro` funciona
- [ ] `sobre_bullet_1` funciona
- [ ] `sobre_bullet_2` funciona
- [ ] `sobre_bullet_3` funciona
- [ ] `sobre_bullet_4` funciona (opcional)
- [ ] `sobre_bullet_5` funciona (opcional)

### ✅ Página Servicios - Campos ACF
- [ ] `servicios_intro` funciona

### ✅ Test de Estilo - Campos ACF
- [ ] `test_titulo` funciona
- [ ] `test_intro` funciona
- [ ] `test_shortcode` funciona

### ✅ Página Contacto - Campos ACF
- [ ] `contacto_intro` funciona
- [ ] `contacto_telefono` funciona
- [ ] `contacto_email` funciona
- [ ] `contacto_direccion` funciona
- [ ] `contacto_horario` funciona
- [ ] `contacto_mapa_iframe` funciona

### ✅ CPT Servicio - Campos ACF
- [ ] `servicio_cta_texto` funciona
- [ ] `servicio_cta_url` funciona
- [ ] `servicio_precio` funciona
- [ ] `servicio_duracion` funciona
- [ ] `servicio_modalidad` funciona
- [ ] `servicio_destacado` funciona
- [ ] `servicio_nuevo` funciona

### ✅ CPT Testimonio - Campos ACF
- [ ] `testimonio_rol` funciona
- [ ] `testimonio_texto` funciona
- [ ] `testimonio_puntuacion` funciona
- [ ] `testimonio_servicio` funciona
- [ ] `testimonio_destacado` funciona

### ✅ Ajustes del Sitio - Campos ACF
- [ ] `marca_claim` funciona
- [ ] `marca_facebook` funciona
- [ ] `marca_instagram` funciona
- [ ] `marca_tiktok` funciona
- [ ] `marca_whatsapp` funciona
- [ ] `footer_texto` funciona
- [ ] `google_analytics` funciona

---

## 🎨 MENÚS Y NAVEGACIÓN

### ✅ Configuración de Menús
- [ ] **Menú Principal** se puede crear y asignar
- [ ] **Menú Footer** se puede crear y asignar
- [ ] Walker personalizado funciona sin errores
- [ ] Submenús funcionan correctamente

### ✅ Elementos del Header
- [ ] **Logo personalizado** se muestra correctamente
- [ ] **Menú principal** aparece centrado
- [ ] **Redes sociales** aparecen y funcionan
- [ ] **Botón CTA** "Contacto" funciona
- [ ] **Botón menú móvil** aparece en móvil

### ✅ Menú Móvil (Slide Menu)
- [ ] Se abre al hacer clic en el botón hamburguesa
- [ ] Se cierra con el botón X
- [ ] Se cierra haciendo clic en el overlay
- [ ] Se cierra con la tecla Escape
- [ ] Submenús funcionan en móvil
- [ ] Información de contacto aparece en móvil
- [ ] Redes sociales aparecen en móvil
- [ ] Animaciones funcionan suavemente

### ✅ Funcionalidad del Header
- [ ] Header flotante funciona (se pega al scroll)
- [ ] Efecto de transparencia funciona
- [ ] Enlaces internos (#) hacen scroll suave
- [ ] Accesibilidad con teclado funciona

---

## 📊 CUSTOM POST TYPES

### ✅ CPT Servicios
- [ ] CPT se registra correctamente
- [ ] Aparece en el admin con menú propio
- [ ] Soporta: título, editor, imagen destacada, extracto, page-attributes
- [ ] Campo `menu_order` funciona para ordenar
- [ ] Taxonomía `servicio_categoria` funciona (opcional)
- [ ] Archivos single-servicio.php y archive-servicio.php funcionan

### ✅ CPT Testimonios
- [ ] CPT se registra correctamente
- [ ] Aparece en el admin con menú propio
- [ ] Soporta: título, imagen destacada, page-attributes
- [ ] Campo `menu_order` funciona para ordenar
- [ ] No usa editor (solo campos ACF)

### ✅ Gestión en Admin
- [ ] Columnas personalizadas aparecen:
  - [ ] Imagen (thumbnail)
  - [ ] Categoría (servicios)
  - [ ] Rol (testimonios)
  - [ ] Orden
- [ ] Columnas son ordenables
- [ ] Quick Edit funciona para el campo orden
- [ ] Meta boxes de orden aparecen y funcionan

### ✅ Queries y Loops
- [ ] `leticia_get_featured_services()` funciona
- [ ] `leticia_get_featured_testimonials()` funciona
- [ ] Orden por `menu_order` funciona correctamente
- [ ] Cache de queries funciona (si implementado)

---

## 🎯 ASSETS Y RENDIMIENTO

### ✅ CSS (Estilos)
- [ ] `assets/css/main.css` carga sin errores 404
- [ ] `assets/css/editor.css` carga en el editor
- [ ] Bootstrap CSS carga correctamente
- [ ] Themify Icons cargan correctamente
- [ ] Google Fonts cargan correctamente (Bodoni Moda + DM Sans)
- [ ] Font Awesome 4.7 carga desde CDN
- [ ] Orden de carga de CSS es correcto
- [ ] No hay conflictos de CSS

### ✅ JavaScript
- [ ] `assets/js/main.js` carga sin errores 404
- [ ] Bootstrap JS carga correctamente
- [ ] Tiny Slider JS carga (si se usa)
- [ ] jQuery está disponible
- [ ] JavaScript funciona sin errores en consola
- [ ] AJAX funciona para formularios

### ✅ Optimización
- [ ] CSS crítico inline funciona
- [ ] Scripts no críticos tienen `defer`
- [ ] Preconnect a Google Fonts funciona
- [ ] DNS Prefetch funciona
- [ ] Resource hints están configurados

### ✅ URLs y Paths
- [ ] **NO** hay URLs hardcodeadas del volcado HTTrack
- [ ] **NO** hay URLs absolutas a localhost/staging
- [ ] `get_template_directory_uri()` se usa correctamente
- [ ] `home_url()` se usa correctamente
- [ ] Todos los assets usan paths relativos

---

## 📱 RESPONSIVE DESIGN

### ✅ Mobile (320px - 767px)
- [ ] **Header móvil** funciona correctamente
- [ ] **Menú hamburguesa** funciona
- [ ] **Hero section** se ve bien en móvil
- [ ] **Servicios** se apilan correctamente
- [ ] **Testimonios** se apilan correctamente
- [ ] **Formularios** son usables en móvil
- [ ] **Botones** tienen tamaño táctil adecuado (44px min)
- [ ] **Texto** es legible sin zoom
- [ ] **Footer** se adapta correctamente

### ✅ Tablet (768px - 1024px)
- [ ] **Navegación** funciona correctamente
- [ ] **Grid de servicios** se adapta (2 columnas)
- [ ] **Grid de testimonios** se adapta
- [ ] **Imágenes** escalan correctamente
- [ ] **Espaciado** es apropiado
- [ ] **Menú** permanece horizontal

### ✅ Desktop (1025px+)
- [ ] **Header centrado** funciona
- [ ] **Grid de 3 columnas** para servicios/testimonios
- [ ] **Hover effects** funcionan
- [ ] **Transiciones** suaves
- [ ] **Espaciado** óptimo
- [ ] **Tipografía** escala correctamente

---

## ⚡ RENDIMIENTO (LIGHTHOUSE)

### ✅ Performance (Meta: ≥90)
- [ ] **First Contentful Paint** < 2s
- [ ] **Largest Contentful Paint** < 2.5s
- [ ] **Cumulative Layout Shift** < 0.1
- [ ] **Total Blocking Time** < 300ms
- [ ] **Speed Index** < 3s
- [ ] **CSS crítico** inline funciona
- [ ] **Imágenes** tienen `loading="lazy"`
- [ ] **Imágenes** tienen `srcset` y `sizes`

### ✅ Best Practices (Meta: ≥90)
- [ ] **HTTPS** está habilitado
- [ ] **Sin errores de consola** JavaScript
- [ ] **Sin errores de consola** CSS
- [ ] **Recursos externos** seguros
- [ ] **Sin librerías vulnerables**
- [ ] **Aspect ratios** correctos en imágenes

### ✅ SEO (Meta: ≥90)
- [ ] **Title tags** únicos y descriptivos
- [ ] **Meta descriptions** presentes
- [ ] **Headings** en orden jerárquico (H1, H2, H3...)
- [ ] **Alt text** en todas las imágenes
- [ ] **Schema.org** para organización
- [ ] **Schema.org** para breadcrumbs
- [ ] **Canonical URLs** correctas

---

## ♿ ACCESIBILIDAD (WCAG 2.1 AA)

### ✅ Contraste de Colores
- [ ] **Texto normal** vs fondo: ratio ≥ 4.5:1
- [ ] **Texto grande** vs fondo: ratio ≥ 3:1
- [ ] **Enlaces** tienen contraste suficiente
- [ ] **Botones** tienen contraste suficiente
- [ ] **Estados hover/focus** mantienen contraste

### ✅ Navegación por Teclado
- [ ] **Todos los enlaces** accesibles con Tab
- [ ] **Todos los botones** accesibles con Tab
- [ ] **Formularios** navegables con Tab
- [ ] **Focus visible** en todos los elementos
- [ ] **Menú móvil** funciona con teclado
- [ ] **Skip links** implementados

### ✅ Landmarks y Semántica
- [ ] **`<header>`** presente
- [ ] **`<main>`** presente
- [ ] **`<footer>`** presente
- [ ] **`<nav>`** presente con `role="navigation"`
- [ ] **Headings** jerárquicos (H1→H2→H3)
- [ ] **Labels** en campos de formulario
- [ ] **Alt text** descriptivo en imágenes

### ✅ ARIA y Screen Readers
- [ ] **`aria-label`** en botones sin texto
- [ ] **`aria-expanded`** en menú móvil
- [ ] **`aria-controls`** apropiados
- [ ] **`role`** attributes correctos
- [ ] **`sr-only`** class para texto de screen readers

---

## 📧 FORMULARIOS

### ✅ Contact Form 7 (si instalado)
- [ ] **Plugin instalado** y activado
- [ ] **Shortcode funciona** en Test de Estilo
- [ ] **Shortcode funciona** en Contacto
- [ ] **Formulario se renderiza** sin romper layout
- [ ] **Envío funciona** correctamente
- [ ] **Mensajes de éxito/error** aparecen
- [ ] **Validación** funciona
- [ ] **Responsive** en todos los dispositivos

### ✅ Formularios Personalizados
- [ ] **Formulario de contacto** funciona (si está)
- [ ] **AJAX** funciona correctamente
- [ ] **Validación en tiempo real** funciona
- [ ] **Mensajes de estado** son claros
- [ ] **Anti-spam** funciona (honeypot, etc.)
- [ ] **Accesibilidad** completa

### ✅ Campos y Validación
- [ ] **Campos requeridos** se validan
- [ ] **Email** se valida con regex
- [ ] **Teléfono** se valida correctamente
- [ ] **Mensajes de error** son claros
- [ ] **Focus** va al primer error
- [ ] **Submit deshabilitado** durante envío

---

## 🔍 SEO Y SCHEMA

### ✅ SEO Básico
- [ ] **Title tags** generados automáticamente
- [ ] **Meta descriptions** soportadas (compatibles con Yoast/RankMath)
- [ ] **Canonical URLs** correctas
- [ ] **Open Graph** básico (título, descripción, imagen)
- [ ] **Twitter Cards** soportadas
- [ ] **Robots.txt** no bloquea recursos importantes

### ✅ Schema.org Structured Data
- [ ] **Organization schema** en home
- [ ] **WebSite schema** en home
- [ ] **BreadcrumbList schema** en páginas internas
- [ ] **Service schema** en servicios individuales
- [ ] **Review schema** en testimonios (si implementado)
- [ ] **LocalBusiness schema** (si aplica)

### ✅ Breadcrumbs
- [ ] **Breadcrumbs visuales** funcionan
- [ ] **Schema breadcrumbs** generados
- [ ] **Navegación lógica** mantenida
- [ ] **Accessibility** con aria-label
- [ ] **No aparecen** en página de inicio

---

## 🔐 SEGURIDAD

### ✅ Código Seguro
- [ ] **`esc_html()`** usado en outputs
- [ ] **`esc_url()`** usado en URLs
- [ ] **`esc_attr()`** usado en atributos
- [ ] **`wp_kses_post()`** para contenido HTML
- [ ] **Nonces** en formularios AJAX
- [ ] **`current_user_can()`** para capacidades

### ✅ Información Sensible
- [ ] **Versión de WordPress** oculta
- [ ] **Información de PHP** no expuesta
- [ ] **Estructura de directorios** no expuesta
- [ ] **Archivos de configuración** protegidos
- [ ] **Debug info** no visible en producción

### ✅ Formularios y AJAX
- [ ] **Nonce verification** en AJAX
- [ ] **Sanitización** de inputs
- [ ] **Validación server-side**
- [ ] **Rate limiting** básico (si implementado)
- [ ] **Anti-spam** medidas

---

## 🧪 TESTING DE COMPATIBILIDAD

### ✅ Navegadores
- [ ] **Chrome** (última versión)
- [ ] **Firefox** (última versión)
- [ ] **Safari** (macOS/iOS)
- [ ] **Edge** (última versión)
- [ ] **Chrome Mobile** (Android)
- [ ] **Safari Mobile** (iOS)

### ✅ Dispositivos
- [ ] **iPhone** (varios tamaños)
- [ ] **Android** (varios tamaños)
- [ ] **iPad** (vertical y horizontal)
- [ ] **Laptop** (1366x768 y superior)
- [ ] **Desktop** (1920x1080 y superior)
- [ ] **Monitor 4K** (si disponible)

### ✅ Funcionalidades por Dispositivo
- [ ] **Menú móvil** en todos los móviles
- [ ] **Touch gestures** funcionan
- [ ] **Hover states** apropiados para touch
- [ ] **Form inputs** son táctiles
- [ ] **Botones** tienen tamaño mínimo 44px

---

## 🔄 GESTIÓN DE CONTENIDO

### ✅ Flujo de Trabajo del Cliente
- [ ] **Cliente puede** crear nuevos servicios
- [ ] **Cliente puede** ordenar servicios por menu_order
- [ ] **Cliente puede** marcar servicios como destacados
- [ ] **Cliente puede** crear nuevos testimonios
- [ ] **Cliente puede** ordenar testimonios
- [ ] **Cliente puede** editar toda la información de contacto
- [ ] **Cliente puede** cambiar toda la información de páginas
- [ ] **Cliente puede** configurar redes sociales

### ✅ Editor de WordPress
- [ ] **Gutenberg** funciona correctamente
- [ ] **Editor styles** cargan en el backend
- [ ] **Colores del theme** disponibles en editor
- [ ] **Tipografías** se reflejan en editor
- [ ] **Bloques por defecto** funcionan
- [ ] **Preview** funciona correctamente

### ✅ Media Library
- [ ] **Subida de imágenes** funciona
- [ ] **Tamaños personalizados** se generan:
  - [ ] hero-large (2500x1668)
  - [ ] service-thumb (400x300)
  - [ ] testimonial-thumb (150x150)
  - [ ] about-photo (600x800)
- [ ] **Alt text** editable
- [ ] **Crop** funciona en tamaños fixed

---

## 🚀 IMPLEMENTACIÓN EN PRODUCCIÓN

### ✅ Subida a Hostinger
- [ ] **Theme sube** sin errores de permisos
- [ ] **Archivos descomprimidos** correctamente
- [ ] **Estructura** de directorios intacta
- [ ] **Assets** accesibles vía web

### ✅ Configuración Post-Instalación
- [ ] **ACF instalado** en producción
- [ ] **Páginas creadas** automáticamente
- [ ] **Menús configurados**
- [ ] **Logo subido**
- [ ] **Información de contacto** configurada
- [ ] **Redes sociales** configuradas

### ✅ Contenido de Prueba
- [ ] **Al menos 1 servicio** destacado creado
- [ ] **Al menos 1 testimonio** destacado creado
- [ ] **Página Sobre mí** completada
- [ ] **Página de contacto** completada
- [ ] **Ajustes del sitio** configurados

### ✅ Testing Final en Producción
- [ ] **Velocidad** aceptable en servidor real
- [ ] **SSL** funcionando
- [ ] **Formularios** envían emails
- [ ] **Analytics** funcionando (si configurado)
- [ ] **Backups** configurados

---

## 📋 RESULTADOS DE QA

### 📊 Puntuaciones Lighthouse
- **Performance**: ___/100 (Meta: ≥90)
- **Accessibility**: ___/100 (Meta: ≥90)
- **Best Practices**: ___/100 (Meta: ≥90)
- **SEO**: ___/100 (Meta: ≥90)

### ⚠️ Problemas Encontrados
_Lista cualquier problema encontrado durante el testing:_

1. **Problema**: ________________________
   **Severidad**: Alta/Media/Baja
   **Estado**: Pendiente/Resuelto

2. **Problema**: ________________________
   **Severidad**: Alta/Media/Baja
   **Estado**: Pendiente/Resuelto

3. **Problema**: ________________________
   **Severidad**: Alta/Media/Baja
   **Estado**: Pendiente/Resuelto

### ✅ Resumen de Estado

- **Problemas Críticos**: _____ (deben ser 0)
- **Problemas Altos**: _____
- **Problemas Medios**: _____
- **Problemas Bajos**: _____

### 🏆 Aprobación Final

- [ ] **Todos los problemas críticos** resueltos
- [ ] **Lighthouse scores** ≥90 en todas las métricas
- [ ] **Responsive design** funciona en todos los dispositivos
- [ ] **ACF fields** funcionan correctamente
- [ ] **Cliente puede editar** todo el contenido
- [ ] **Formularios** funcionan
- [ ] **Performance** es aceptable
- [ ] **SEO básico** implementado
- [ ] **Accesibilidad** cumple WCAG 2.1 AA

---

## 📝 NOTAS ADICIONALES

_Espacio para notas del tester:_

```
Fecha de testing: ___________
Testeado por: ___________
Navegador principal: ___________
Resolución de pantalla: ___________

Notas:
_________________________________
_________________________________
_________________________________
```

---

## ✅ APROBACIÓN

**Theme aprobado para producción**: ☐ SÍ / ☐ NO

**Firma del QA**: ________________________

**Fecha**: ___________

---

**📄 Este checklist debe completarse al 100% antes de entregar el theme al cliente.**