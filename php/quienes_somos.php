<?php 
    include "../php/funciones.php";
    session_start();

    // Crear el directorio de imágenes del equipo si no existe
    $dir_equipo = 'img_equipo';
    if (!file_exists($dir_equipo)) {
        mkdir($dir_equipo, 0777, true);
    }

    // Configuración de las fotos con fallback de iniciales en formato SVG
    $foto_cesar = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%230b6675'/><text x='50' y='58' font-family='Montserrat, Arial' font-size='28' font-weight='bold' fill='white' text-anchor='middle'>CM</text></svg>";
    if (file_exists('img_equipo/cesar.png')) {
        $foto_cesar = 'img_equipo/cesar.png';
    } elseif (file_exists('img_equipo/cesar.jpg')) {
        $foto_cesar = 'img_equipo/cesar.jpg';
    }

    $foto_angelo = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='50' fill='%238cc63f'/><text x='50' y='58' font-family='Montserrat, Arial' font-size='28' font-weight='bold' fill='white' text-anchor='middle'>AV</text></svg>";
    if (file_exists('img_equipo/angelo.png')) {
        $foto_angelo = 'img_equipo/angelo.png';
    } elseif (file_exists('img_equipo/angelo.jpg')) {
        $foto_angelo = 'img_equipo/angelo.jpg';
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiénes Somos - Socio Bienes</title>
    <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Mi CSS -->
    <link rel="stylesheet" href="../css/mis-estilos.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap -->
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php renderizarNavegacion(); ?>

    <!-- Contenido Principal -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          
          <!-- Título Principal -->
          <h2 class="seccion-titulo-top text-center">Nuestra Inmobiliaria</h2>
          
          <!-- Descripción de la Empresa -->
          <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
              <p class="quienes-texto">
                <strong>Socio Bienes</strong> es una empresa líder en gestión y asesoría inmobiliaria con más de 10 años de sólida trayectoria en el mercado ecuatoriano. Fundada en la ciudad de Guayaquil, nos hemos dedicado a ofrecer soluciones integrales de inicio a fin para la compra, venta, alquiler y avalúo de bienes raíces en las zonas de mayor plusvalía, tales como Samborondón, Puerto Santa Ana, Vía a la Costa y Urdesa. 
                <br><br>
                Nuestra filosofía se basa en brindar un acompañamiento personalizado y transparente a cada uno de nuestros clientes, garantizando transacciones seguras y optimizando los tiempos del proceso mediante un equipo calificado y el uso de tecnologías de vanguardia para la promoción de inmuebles.
              </p>
            </div>
          </div>

          <!-- Sección de Equipo -->
          <h3 class="text-center" style="color: #0b6675; font-weight: 700; margin-top: 20px; margin-bottom: 40px;">Nuestro Equipo Profesional</h3>
          
          <div class="row">
            <!-- César Mora (Broker) -->
            <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-2">
              <div class="tarjeta-miembro">
                <img src="<?php echo $foto_cesar; ?>" alt="César Mora">
                <h4>César Mora</h4>
                <div class="miembro-rol">Broker Inmobiliario</div>
                <p class="text-muted" style="font-size: 14px;">
                  Especialista en estructuración de inversiones de bienes raíces y negociación de alto nivel con más de una década de experiencia.
                </p>
              </div>
            </div>

            <!-- Angelo de la Vera (Agente) -->
            <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="tarjeta-miembro">
                <img src="<?php echo $foto_angelo; ?>" alt="Angelo de la Vera">
                <h4>Angelo de la Vera</h4>
                <div class="miembro-rol">Agente Inmobiliario</div>
                <p class="text-muted" style="font-size: 14px;">
                  Asesor comercial enfocado en captación de propiedades exclusivas y acompañamiento personalizado al cliente de inicio a fin.
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <?php include "footer.php"; ?>
    </footer>
  </body>
</html>

