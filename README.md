# Socio Bienes - Portal de Gestión Inmobiliaria

**Socio Bienes** es una aplicación web dinámica desarrollada para la gestión administrativa y comercial de una cartera de bienes raíces. Permite la interacción entre administradores (brokers/agentes) y clientes, optimizando procesos como la publicación de propiedades, agenda de citas para visitas y recepción de consultas.

Este proyecto ha sido desarrollado bajo especificaciones académicas utilizando **PHP** como lenguaje del lado del servidor y **MySQL** como sistema gestor de bases de datos.

---

## 🚀 Características del Proyecto

### 🔐 Control de Acceso y Roles
* **Panel de Administrador:**
  * **Clientes:** Registro, búsqueda, edición de datos y eliminación de clientes en cascada.
  * **Inmuebles:** CRUD completo (Ingreso con imágenes, listado general, modificación de características e imágenes, buscador avanzado por rango de precios y eliminación).
  * **Noticias:** Publicación de comunicados institucionales y novedades del mercado.
  * **Citas:** Agenda interactiva mediante calendario mensual con visualización y modificación de citas en tiempo real (incluyendo citas del mismo día).
  * **Bandeja de Mensajes (Nuevo):** Buzón de entrada de consultas de contacto recibidas desde el formulario público de la web con opción de eliminación.
* **Panel de Cliente:**
  * **Catálogo:** Visualización de propiedades en venta y alquiler disponibles.
  * **Mis Inmuebles:** Portafolio personal con las propiedades ya adquiridas por el cliente.
  * **Mis Citas:** Historial y visualización de las visitas agendadas con los agentes.
  * **Datos Personales:** Edición de perfil y contraseñas.

---

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP 7.x / 8.x (Arquitectura limpia con funciones centralizadas en `funciones.php`).
* **Base de Datos:** MySQL (Controlador MySQLi optimizado, codificación UTF-8).
* **Frontend:** HTML5 semántico, CSS3 personalizado (`mis-estilos.css`) y Framework Bootstrap 3.
* **Interactividad:** JavaScript nativo y jQuery (para popovers interactivos y validaciones del lado del cliente).

---

## 📂 Estructura del Directorio

* `/css/` - Hojas de estilos del diseño visual.
* `/js/` - Scripts JavaScript para validación dinámica en el navegador.
* `/php/` - Código de backend, vistas protegidas y lógica de negocio.
* `/img_inmuebles/` - Directorio de almacenamiento para las imágenes de propiedades.
* `/php/img_equipo/` - Directorio de imágenes del equipo profesional.
* `index.php` - Portal de bienvenida público.
* `inmobiliaria.sql` - Dump de la estructura y datos de la base de datos MySQL localizados a Ecuador.

---

## 💻 Guía de Instalación Local (XAMPP)

1. **Clonar o descargar** el proyecto dentro del directorio de tu servidor web:
   `C:\xampp\htdocs\inmobiliaria`
2. **Iniciar los servicios** de Apache y MySQL en el Panel de Control de XAMPP.
3. **Importar la Base de Datos:**
   * Entra a [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
   * Crea una base de datos llamada `inmobiliaria`.
   * Ve a la pestaña **Importar**, selecciona el archivo `inmobiliaria.sql` de la carpeta raíz y haz clic en **Importar**.
4. **Configurar Conexión:**
   * Las credenciales se encuentran en `php/funciones.php` bajo la función `conectarSocioBienes()`. De manera predeterminada está configurada para conectar en local con el usuario `root` sin contraseña.
5. **Acceder a la aplicación:**
   * Ingresa desde tu navegador a: [http://localhost/inmobiliaria/](http://localhost/inmobiliaria/)

---

## 🔑 Credenciales de Acceso de Pruebas

* **Administrador:**
  * **Usuario:** `admin` | **Contraseña:** `admin`
* **Cliente de Prueba:**
  * **Usuario:** `cesar` | **Contraseña:** `cesar`
