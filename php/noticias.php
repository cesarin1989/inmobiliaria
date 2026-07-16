<?php 

    include "../php/funciones.php";
    session_start(); 
    validarAccesoAdmin();

  ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noticias</title>
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
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php renderizarNavegacion(); ?>
      
    <!-- Botones de funciones añadir, borrar, buscar -->
    <div class="container-fluid submenu-admin">
      <div class="row">
        <div class="col-xs-12">
          <a class="btn btn-success btn-lg" href="nueva_noticia.php"><span class="glyphicon glyphicon-plus"></span> Añadir noticia</a>
          <a class="btn btn-danger btn-lg" href="borrar_noticia.php"><span class="glyphicon glyphicon-trash"></span> Borrar noticia</a>
          <a class="btn btn-info btn-lg" href="buscar_noticia.php"><span class="glyphicon glyphicon-search"></span> Buscar noticia</a>
        </div>
      </div>
    </div>


    <!-- Código PHP que carga las noticias -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 ultimas-noticias ">
          <h2 class="seccion-titulo" align="center">Aquí tienes toda la actualidad inmobiliaria</h2>
          <?php 

              // Cargar noticias de forma paginada
              $conexion = conectarSocioBienes();
              $consulta = "select * from noticias";

              $noticias = mysqli_query($conexion,$consulta);

              if (!$noticias) {
                echo "Error al cargar las noticias desde la BD";
              } else {

                $num_filas = mysqli_num_rows($noticias);
                if ($num_filas > 0) {
                  $num_noticas = 5; //limite de noticias a mostrar
                  $pagina = false;
                }

                if (isset($_GET['pagina'])) {
                  $pagina = $_GET['pagina'];
                }

                if (!$pagina) {
                  $inicio = 0;
                  $pagina = 1;
                } else {
                  $inicio = ($pagina - 1) * $num_noticas;
                }

                $consulta_mostrar = "select * from noticias order by fecha desc limit $inicio,$num_noticas";

                $mostrar = mysqli_query($conexion,$consulta_mostrar);

                if (!$mostrar) {
                  echo "Error al cargar las noticias desde la BD";
                } else {
                  while ($fila = mysqli_fetch_array($mostrar,MYSQLI_ASSOC)) {
                    $marca_cita = strtotime($fila['fecha']);
                    $f_formateada = date("d-m-Y",$marca_cita);
                    
                    echo "<div class='col-sm-8 col-sm-offset-2'>";
                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel-body tnoticias'>";
                    //muestro info de noticia
                    echo "<img align'center' class='img-responsive' src='$fila[imagen]'>
                          <h4 align='center'><b>$fila[titular]</b></h4>
                          <h5 align='center'>Fecha de publicación: $f_formateada</h5>
                          <form action='ver_noticia.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn btn-info' type='submit' name='ver' value='Ver más'></form>"; 

                    echo "</div></div></div>"; //cierre de col-sm, panel,panel-body
                  }
                }

                  
                }
                mysqli_close($conexion);
          ?>
        </div>
      </div>
    </div>

    <!-- botones de paginado -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 footer-noticias">
          <?php 
            echo "<ul class='pager'>
                    <li><a href='noticias.php?pagina=".($pagina - 1)."'>Atrás</a></li>
                    <li><a href='noticias.php?pagina=".($pagina + 1)."'>Siguiente</a></li>
                  </ul>";
           ?>
        </div>
      </div>
    </div>

    <!-- footer -->
    <footer class="navbar-nav navbar-inverse">
      <?php include "footer.php"; ?>
    </footer>
  </body>
</html>
