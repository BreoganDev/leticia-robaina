# Leticia Robaina WordPress Theme

Theme personalizado que replica fielmente el diseño de [leticiarobaina.com](https://leticiarobaina.com) construido para ser completamente editable por la clienta sin depender de desarrolladores.

## 📋 Tabla de Contenidos

- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Configuración Inicial](#-configuración-inicial)
- [Estructura del Contenido](#-estructura-del-contenido)
- [Personalización](#-personalización)
- [Mantenimiento](#-mantenimiento)
- [Troubleshooting](#-troubleshooting)

## 🔧 Requisitos

### Servidor
- **WordPress**: 6.6 o superior
- **PHP**: 8.1 o superior
- **MySQL**: 5.7 o superior / MariaDB 10.3 o superior
- **Memoria PHP**: Mínimo 256MB (recomendado 512MB)

### Plugins Obligatorios
- **Advanced Custom Fields (ACF)** - Versión gratuita
- **Contact Form 7** (opcional, para formularios)

### Plugins Recomendados
- **Yoast SEO** o **RankMath** (para SEO avanzado)
- **Wordfence** (para seguridad)
- **UpdraftPlus** (para backups)

## 📦 Instalación

### Paso 1: Descargar el Theme
1. Descarga el archivo `leticia-robaina-theme.zip`
2. **NO** descomprimas el archivo

### Paso 2: Instalar en WordPress
1. Ve a **Apariencia > Temas** en tu WordPress
2. Haz clic en **Añadir nuevo**
3. Selecciona **Subir tema**
4. Elige el archivo `leticia-robaina-theme.zip`
5. Haz clic en **Instalar ahora**
6. Una vez instalado, haz clic en **Activar**

### Paso 3: Instalar ACF
1. Ve a **Plugins > Añadir nuevo**
2. Busca "Advanced Custom Fields"
3. Instala y activa la versión **gratuita** de Elliot Condon

## ⚙️ Configuración Inicial

### 1. Configuración Básica

#### Permalinks
1. Ve a **Ajustes > Enlaces permanentes**
2. Selecciona **Nombre de la entrada**
3. Guarda los cambios

#### Lectura
1. Ve a **Ajustes > Lectura**
2. En "La página principal muestra" selecciona **Una página estática**
3. Selecciona la página "Inicio" como **Página principal**
4. Guarda los cambios

### 2. Configurar Menús
1. Ve a **Apariencia > Menús**
2. Crea un menú llamado "Menú Principal"
3. Añade las páginas en este orden:
   - Inicio
   - Sobre mí
   - Servicios
   - Test de Estilo
   - Contacto
4. Asigna el menú a **Menú Principal**
5. Guarda el menú

### 3. Subir Logo
1. Ve a **Apariencia > Personalizar**
2. Selecciona **Identidad del sitio**
3. Sube tu logo (recomendado: 300x100px, formato PNG con fondo transparente)
4. Ajusta el texto alternativo
5. Publica los cambios

### 4. Configurar Información de Contacto
1. Ve a **Apariencia > Personalizar**
2. Selecciona **Información de Contacto**
3. Completa:
   - Teléfono: `+34 670 837 991`
   - Email: `info@leticiarobaina.com`
4. Publica los cambios

### 5. Configurar Redes Sociales
1. En el mismo Personalizar, ve a **Redes Sociales**
2. Añade las URLs completas:
   - Facebook: `https://www.facebook.com/people/Leticia-Robaina/100063470564190/`
   - Instagram: `https://www.instagram.com/leticiarobainacoachdeimagen/`
   - TikTok: (si aplica)
   - WhatsApp: Solo el número sin espacios: `34670837991`

## 📝 Estructura del Contenido

### Páginas Principales

El theme crea automáticamente estas páginas. Para editarlas:

#### 1. Página de Inicio
- **Plantilla**: `template-home.php`
- **Campos editables**:
  - Título del Hero
  - Subtítulo del Hero
  - Texto del botón principal
  - URL del botón principal
  - Imagen de fondo del hero
  - Texto CTA secundaria
  - URL CTA secundaria

**Cómo editar**:
1. Ve a **Páginas > Inicio**
2. Scroll hacia abajo hasta "Configuración de la Página de Inicio"
3. Completa los campos
4. **Actualizar** la página

#### 2. Página Sobre Mí
- **Plantilla**: `template-sobre-mi.php`
- **Campos editables**:
  - Foto principal
  - Introducción personal
  - 5 puntos destacados

**Cómo editar**:
1. Ve a **Páginas > Sobre Mí**
2. Edita el contenido principal en el editor
3. Completa los campos adicionales abajo
4. **Actualizar**

#### 3. Página de Servicios
- **Plantilla**: `template-servicios.php`
- **Campo editable**:
  - Introducción de servicios

**Contenido**: Se llena automáticamente con los servicios creados en el CPT.

#### 4. Test de Estilo
- **Plantilla**: `template-test-de-estilo.php`
- **Campos editables**:
  - Título del test
  - Introducción
  - Shortcode del formulario

**Para el formulario**:
1. Instala Contact Form 7
2. Crea tu formulario de test
3. Copia el shortcode (ej: `[contact-form-7 id="123" title="Test"]`)
4. Pégalo en el campo correspondiente

#### 5. Página de Contacto
- **Plantilla**: `template-contacto.php`
- **Campos editables**:
  - Introducción
  - Teléfono
  - Email
  - Dirección
  - Horario de atención
  - Código iframe del mapa

### Custom Post Types

#### Servicios
1. Ve a **Servicios > Añadir nuevo**
2. Completa:
   - **Título**: Nombre del servicio
   - **Contenido**: Descripción completa
   - **Extracto**: Resumen breve
   - **Imagen destacada**: Foto del servicio (400x300px)
   - **Orden**: Número para ordenar (menor = aparece primero)

3. En "Campos del Servicio":
   - **Texto del botón**: "Más información", "Reservar", etc.
   - **URL del botón**: Enlace hacia donde va el botón
   - **Precio**: Opcional
   - **Duración**: "2 horas", "1 día", etc.
   - **Modalidad**: Presencial, Online o Mixta
   - **Servicio destacado**: ✅ para mostrar en la página de inicio
   - **Servicio nuevo**: ✅ para mostrar badge "Nuevo"

#### Testimonios
1. Ve a **Testimonios > Añadir nuevo**
2. Completa:
   - **Título**: Nombre de la persona
   - **Imagen destacada**: Foto de la persona (150x150px, cuadrada)
   - **Orden**: Para ordenar aparición

3. En "Campos del Testimonio":
   - **Rol/Profesión**: "Directora de Marketing", etc.
   - **Testimonio**: Texto completo de la reseña
   - **Puntuación**: 3, 4 o 5 estrellas
   - **Servicio relacionado**: Opcional, para vincular con un servicio
   - **Testimonio destacado**: ✅ para mostrar en página de inicio

### Ajustes del Sitio

Una página especial para configuración global:

1. Ve a **Páginas > Ajustes del Sitio** (página privada)
2. Configura:
   - **Claim de la marca**: Frase que define tu marca
   - **Redes sociales**: URLs completas
   - **Texto del footer**: Información adicional
   - **Google Analytics ID**: Opcional

## 🎨 Personalización

### Cambiar Colores

Edita el archivo `theme.json` en las siguientes secciones:

```json
"palette": [
  {
    "color": "#b8860b",
    "name": "Dorado Principal",
    "slug": "primary"
  },
  {
    "color": "#2c3e50", 
    "name": "Azul Oscuro",
    "slug": "secondary"
  }
]
```

### Cambiar Tipografías

En `theme.json`, sección `fontFamilies`:

```json
"fontFamilies": [
  {
    "fontFamily": "'Bodoni Moda', Georgia, serif",
    "name": "Bodoni Moda", 
    "slug": "bodoni-moda"
  },
  {
    "fontFamily": "'DM Sans', sans-serif",
    "name": "DM Sans",
    "slug": "dm-sans"
  }
]
```

### Añadir CSS Personalizado

1. Ve a **Apariencia > Personalizar**
2. Selecciona **CSS Adicional**
3. Añade tu CSS personalizado
4. **Publicar** cambios

## 🔄 Mantenimiento

### Actualizaciones
- **WordPress**: Mantén siempre actualizado
- **Plugins**: Actualiza regularmente
- **Theme**: Las actualizaciones se harán manualmente

### Backups
Configura backups automáticos con UpdraftPlus:
1. Instala UpdraftPlus
2. Configura backup diario de archivos
3. Backup semanal de base de datos
4. Guarda en Google Drive o Dropbox

### Optimización
1. **Imágenes**: Usa formatos WebP cuando sea posible
2. **Cache**: Instala un plugin de cache como WP Super Cache
3. **CDN**: Considera usar Cloudflare (gratuito)

### Seguridad
1. **Wordfence**: Configura firewall y escaneos
2. **Usuarios**: Usa contraseñas seguras
3. **Actualizaciones**: Mantén todo actualizado

## 🐛 Troubleshooting

### Problemas Comunes

#### "Error crítico" al activar el theme
**Causa**: Falta ACF o versión de PHP/WordPress muy antigua
**Solución**:
1. Verifica que ACF esté instalado y activado
2. Comprueba versión de PHP (mínimo 8.1)
3. Comprueba versión de WordPress (mínimo 6.6)

#### Los campos ACF no aparecen
**Causa**: ACF no está activado o hay conflicto de plugins
**Solución**:
1. Desactiva todos los plugins excepto ACF
2. Prueba si aparecen los campos
3. Reactiva plugins de uno en uno para identificar conflictos

#### Las imágenes no cargan o se ven rotas
**Causa**: URLs hardcodeadas o problemas de permisos
**Solución**:
1. Ve a **Ajustes > Enlaces permanentes** y guarda
2. Verifica permisos de la carpeta `/wp-content/uploads/`
3. Regenera miniaturas con un plugin como "Regenerate Thumbnails"

#### El menú móvil no funciona
**Causa**: JavaScript no carga correctamente
**Solución**:
1. Verifica en la consola del navegador si hay errores
2. Desactiva plugins de optimización temporalmente
3. Comprueba que jQuery esté cargando

#### Los servicios/testimonios no aparecen
**Causa**: No están marcados como destacados o problema de orden
**Solución**:
1. Ve a **Servicios** y marca algunos como "Destacados"
2. Verifica el campo "Orden" (números menores aparecen primero)
3. Ve a **Páginas > Inicio** y actualiza la página

### Logs de Error

Para activar logs de error en WordPress:

1. Añade a `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

2. Los logs aparecerán en `/wp-content/debug.log`

### Contacto de Soporte

- **Documentación**: Este README
- **Logs**: Revisa `/wp-content/debug.log`
- **Compatibilidad**: Tema probado en WordPress 6.6+ y PHP 8.1+

## 📊 Checklist de QA

### ✅ Activación del Theme
- [ ] Theme se activa sin errores en WP 6.6+ / PHP 8.1+
- [ ] No aparecen notices/warnings en el log
- [ ] ACF está instalado y funcionando

### ✅ Páginas y Templates
- [ ] Página de Inicio asignada correctamente
- [ ] Template Home carga sin errores
- [ ] Template Sobre mí carga sin errores
- [ ] Template Servicios carga sin errores
- [ ] Template Test de Estilo carga sin errores
- [ ] Template Contacto carga sin errores

### ✅ Campos ACF
- [ ] Campos de Home funcionan correctamente
- [ ] Campos de Sobre mí funcionan correctamente
- [ ] Campos de Servicios funcionan correctamente
- [ ] Campos de Test de Estilo funcionan correctamente
- [ ] Campos de Contacto funcionan correctamente
- [ ] Campos de CPT Servicio funcionan correctamente
- [ ] Campos de CPT Testimonio funcionan correctamente
- [ ] Campos de Ajustes del Sitio funcionan correctamente

### ✅ Menús y Navegación
- [ ] Menú principal se muestra correctamente
- [ ] Menú móvil funciona correctamente
- [ ] Logo se muestra correctamente
- [ ] Redes sociales funcionan correctamente

### ✅ Custom Post Types
- [ ] CPT Servicios creado correctamente
- [ ] CPT Testimonios creado correctamente
- [ ] Orden por menu_order funciona
- [ ] Campos destacados funcionan
- [ ] Loops de servicios/testimonios funcionan

### ✅ Assets y Rendimiento
- [ ] CSS principal carga sin errores 404
- [ ] JavaScript principal carga sin errores 404
- [ ] Google Fonts cargan correctamente
- [ ] Font Awesome carga correctamente
- [ ] No hay URLs absolutas hardcodeadas

### ✅ Rendimiento
- [ ] Lighthouse Performance ≥90
- [ ] Lighthouse Best Practices ≥90
- [ ] Lighthouse SEO ≥90
- [ ] Imágenes con srcset/sizes
- [ ] Scripts críticos deferridos

### ✅ Accesibilidad
- [ ] Contraste de colores AA compliant
- [ ] Focus visible en elementos interactivos
- [ ] Landmarks semánticos (header, main, footer)
- [ ] Alt text en imágenes
- [ ] Labels en formularios

### ✅ Formularios
- [ ] Contact Form 7 funciona correctamente
- [ ] Shortcodes se renderizan sin romper layout
- [ ] Formularios son responsive
- [ ] Validación funciona correctamente

### ✅ SEO y Schema
- [ ] Title tags generados correctamente
- [ ] Meta descriptions funcionan
- [ ] Schema.org para organización
- [ ] Schema.org para servicios
- [ ] Breadcrumbs funcionan
- [ ] Sitemap XML disponible

## 🚀 Instrucciones para Subir a Producción

### Preparación Local
1. **Comprimir el theme**:
   ```bash
   cd wp-content/themes/
   zip -r leticia-robaina-theme.zip leticia-robaina-theme/ -x "*.git*" "node_modules/*" "*.DS_Store"
   ```

2. **Verificar archivos críticos**:
   - ✅ `style.css` (con cabecera del theme)
   - ✅ `functions.php`
   - ✅ `theme.json`
   - ✅ Carpeta `/inc/` completa
   - ✅ Carpeta `/assets/` completa
   - ✅ Todos los templates `template-*.php`
   - ✅ `index.php`, `header.php`, `footer.php`

### Subida a Hostinger

#### Método 1: Panel WordPress
1. Accede al WordPress admin en Hostinger
2. Ve a **Apariencia > Temas**
3. **Añadir nuevo > Subir tema**
4. Selecciona `leticia-robaina-theme.zip`
5. **Instalar ahora**
6. **Activar**

#### Método 2: cPanel File Manager
1. Accede a cPanel en Hostinger
2. Abre **File Manager**
3. Ve a `public_html/wp-content/themes/`
4. Sube y descomprime `leticia-robaina-theme.zip`
5. Activa desde WordPress admin

#### Método 3: FTP/SFTP
1. Conecta vía FTP a tu hosting
2. Ve a `/public_html/wp-content/themes/`
3. Sube la carpeta `leticia-robaina-theme/`
4. Activa desde WordPress admin

### Post-Instalación
1. **Verificar PHP/WordPress**:
   - PHP 8.1+ ✅
   - WordPress 6.6+ ✅

2. **Instalar ACF**:
   - Ve a **Plugins > Añadir nuevo**
   - Busca "Advanced Custom Fields"
   - Instala versión gratuita

3. **Configuración inicial**:
   - Asignar página de inicio
   - Configurar menús
   - Subir logo
   - Configurar información de contacto

4. **Crear contenido**:
   - Crear servicios destacados
   - Crear testimonios destacados
   - Configurar página "Ajustes del Sitio"

### Verificación Final
- [ ] Theme activo sin errores
- [ ] ACF funcionando
- [ ] Páginas principales accesibles
- [ ] Servicios y testimonios visibles
- [ ] Formularios funcionando
- [ ] Menús funcionando
- [ ] Responsive design OK
- [ ] Performance aceptable

## 📈 Plan de Mantenimiento

### Inmediato (Primeras 2 semanas)
- [ ] Monitorear errores en logs
- [ ] Verificar funcionamiento de formularios
- [ ] Testear en diferentes dispositivos
- [ ] Configurar backups automáticos
- [ ] Instalar plugin de seguridad

### Mensual
- [ ] Actualizar WordPress core
- [ ] Actualizar plugins
- [ ] Revisar rendimiento con GTmetrix/PageSpeed
- [ ] Verificar backups
- [ ] Revisar logs de errores

### Trimestral
- [ ] Audit de seguridad completo
- [ ] Optimización de base de datos
- [ ] Revisión de contenido desactualizado
- [ ] Testing cross-browser
- [ ] Análisis de velocidad detallado

### Anual
- [ ] Revisión completa del theme
- [ ] Actualización de dependencias
- [ ] Evaluación de nuevas funcionalidades
- [ ] Audit de accesibilidad
- [ ] Planificación de mejoras

## 📞 Soporte y Contacto

### Documentación Técnica
- **Theme Version**: 1.0.0
- **WordPress Mínimo**: 6.6
- **PHP Mínimo**: 8.1
- **Dependencias**: ACF (gratuito)

### Estructura de Archivos Críticos
```
leticia-robaina-theme/
├── style.css              (CRÍTICO - Cabecera del theme)
├── functions.php          (CRÍTICO - Funciones principales)
├── theme.json            (CRÍTICO - Configuración editor)
├── inc/
│   ├── setup.php         (CPTs y taxonomías)
│   ├── assets.php        (CSS/JS)
│   ├── acf-fields.php    (Campos ACF)
│   ├── template-tags.php (Funciones helper)
│   └── queries.php       (WP_Query optimizadas)
├── assets/
│   ├── css/main.css      (CRÍTICO - Estilos principales)
│   └── js/main.js        (CRÍTICO - JavaScript)
├── template-*.php        (CRÍTICOS - Templates páginas)
├── index.php             (CRÍTICO - Fallback)
├── header.php            (CRÍTICO - Cabecera)
├── footer.php            (CRÍTICO - Pie)
└── README.md             (Esta documentación)
```

### Troubleshooting Rápido
1. **Error 500**: Revisar logs en `/wp-content/debug.log`
2. **Campos ACF no aparecen**: Verificar que ACF esté activo
3. **Contenido no aparece**: Verificar que esté marcado como "destacado"
4. **CSS roto**: Limpiar cache y verificar que `main.css` carga

---

**🎯 ¡Theme listo para producción!** 

Sigue este README paso a paso y tendrás una réplica fiel de leticiarobaina.com totalmente editable por la clienta.