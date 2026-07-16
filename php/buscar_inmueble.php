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
    <title>Buscar inmuebles</title>
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
    
    <!-- Menú de navegación-->
    <?php renderizarNavegacion(); ?>
    
    <!-- Buscar inmueble -->
    <div class="container-fluid menu-inicio col-sm-8 col-sm-offset-2">
      <div class="row">
        <div class="col-xs-12">
        <div class="col-xs-12">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Buscar inmuebles</h2>
              </div>
              <div class="panel-body">
                <p align="center">Rellene el campo o campos por los que quiere realizar la búsqueda</p>
                <form class="form-horizontal" action="#" method="post">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Dirección:</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" name="direccion" placeholder="Ej: Samborondón, Urdesa..." autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Disponibilidad:</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="disp">
                          <option value="si">Disponible</option>
                          <option value="no">No disponible</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Precio Mín ($):</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="number" name="precio_min" min="0" placeholder="Ej: 50000">
                    </div>
                    <label class="col-sm-2 control-label">Precio Máx ($):</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="number" name="precio_max" min="0" placeholder="Ej: 300000">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input class="form-control btn btn-info" type="submit" name="buscar_inm" value="Buscar">
                    </div> 
                  </div>
                </form>

                <!-- Código PHP que busca inmuebles en la BD por filtros dinámicos -->
                <?php 

                  if (isset($_POST['buscar_inm'])) {
                    $con = conectarSocioBienes();
                    
                    $direccion = mysqli_real_escape_string($con, $_POST['direccion']);
                    $disponibilidad = $_POST['disp'];
                    $precio_min = $_POST['precio_min'];
                    $precio_max = $_POST['precio_max'];

                    // Filtro de disponibilidad obligatoria
                    if ($disponibilidad == "si") {
                      $condiciones = array("id_cliente = '0'");
                    } else {
                      $condiciones = array("id_cliente != '0'");
                    }

                    // Filtro de dirección
                    if ($direccion != "") {
                      $condiciones[] = "direccion LIKE '%$direccion%'";
                    }

                    // Filtro de precio mínimo
                    if ($precio_min != "" && is_numeric($precio_min)) {
                      $condiciones[] = "precio >= " . floatval($precio_min);
                    }

                    // Filtro de precio máximo
                    if ($precio_max != "" && is_numeric($precio_max)) {
                      $condiciones[] = "precio <= " . floatval($precio_max);
                    }

                    // Construcción dinámica de la consulta SQL
                    $sql = "SELECT * FROM inmuebles WHERE " . implode(" AND ", $condiciones) . " ORDER BY precio ASC";
                    $resultado = mysqli_query($con, $sql);

                    if (!$resultado) {
                      echo "<div class='alert alert-danger text-center'>Error al consultar la base de datos.</div>";
                    } else {
                      $num_filas = mysqli_num_rows($resultado);
                      if ($num_filas == 0) {
                        echo "<br><div class='alert alert-warning text-center'>No se encontraron inmuebles que coincidan con los criterios de búsqueda.</div>";
                      } else {
                        echo "<br><table class='table table-striped table-hover'>";
                        echo "<thead><tr><th>Dirección</th><th>Precio</th><th>Imagen</th><th>Ver</th></tr></thead>";
                        echo "<tbody>";
                        while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                          echo "<tr>
                                  <td>$fila[direccion]</td>
                                  <td>\$$fila[precio]</td>
                                  <td><img src='$fila[imagen]' width='150px' style='border-radius: 4px; object-fit: cover; height: 90px;'></td>
                                  <td>
                                    <form action='ver_inmueble.php' method='post'>
                                      <input type='hidden' name='id' value='$fila[id]'>
                                      <input class='form-control btn-primary' type='submit' name='ver' value='Ver'>
                                    </form>
                                  </td>
                                </tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                      }
                    }
                    mysqli_close($con);
                  }
                ?>
              </div>
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
