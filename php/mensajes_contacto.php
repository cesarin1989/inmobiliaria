<?php 
    include "../php/funciones.php";
    session_start(); 
    validarAccesoAdmin();

    // Procesar eliminación de mensaje
    $alerta_borrado = "";
    if (isset($_POST['borrar'])) {
        $id_borrar = $_POST['id_mensaje'];
        $conexion = conectarSocioBienes();
        $id_borrar = mysqli_real_escape_string($conexion, $id_borrar);
        $sql_del = "DELETE FROM mensajes WHERE id = '$id_borrar'";
        if (mysqli_query($conexion, $sql_del)) {
            $alerta_borrado = "<div class='alert alert-success col-sm-6 col-sm-offset-3' align='center'>
                                  <b>Mensaje eliminado correctamente</b> 
                               </div>";
        } else {
            $alerta_borrado = "<div class='alert alert-danger col-sm-6 col-sm-offset-3' align='center'>
                                  <b>Error al intentar eliminar el mensaje</b> 
                               </div>";
        }
        mysqli_close($conexion);
    }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bandeja de Mensajes - Administrador</title>
    <!-- CSS de Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <!-- Mi CSS -->
    <link rel="stylesheet" href="../css/mis-estilos.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <!-- Menú de navegación -->
    <?php renderizarNavegacion(); ?>
    
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
          <h2 class="seccion-titulo text-center">Mensajes de Contacto Recibidos</h2>
          <p class="text-center text-muted">Aquí puedes visualizar y gestionar las consultas enviadas por los visitantes desde la web.</p>
          
          <!-- Mostrar alertas -->
          <?php echo $alerta_borrado; ?>

          <div style="margin-top: 30px;">
            <?php 
              $conexion = conectarSocioBienes();
              $consulta = "SELECT id, nombre, email, telefono, asunto, mensaje, fecha FROM mensajes ORDER BY fecha DESC";
              $resultado = mysqli_query($conexion, $consulta);
              
              if (!$resultado || mysqli_num_rows($resultado) == 0) {
                  echo "<div class='alert alert-info text-center' style='margin-top: 20px;'>
                          <strong>No hay mensajes registrados en este momento.</strong>
                        </div>";
              } else {
                  echo "<div class='table-responsive'>";
                  echo "<table class='table table-bordered table-striped table-hover'>";
                  echo "<thead class='bg-primary' style='background-color: #0b6675; color: white;'>";
                  echo "<tr>
                          <th>Fecha</th>
                          <th>Remitente</th>
                          <th>Contacto</th>
                          <th>Asunto</th>
                          <th>Mensaje</th>
                          <th class='text-center'>Acción</th>
                        </tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  
                  while ($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
                      $fecha_formateada = date("d/m/Y H:i", strtotime($fila['fecha']));
                      echo "<tr>";
                      echo "<td style='white-space: nowrap;'>" . $fecha_formateada . "</td>";
                      echo "<td><strong>" . htmlspecialchars($fila['nombre']) . "</strong></td>";
                      echo "<td>
                              <span class='glyphicon glyphicon-envelope'></span> " . htmlspecialchars($fila['email']) . "<br>
                              " . ($fila['telefono'] != '' ? "<span class='glyphicon glyphicon-phone'></span> " . htmlspecialchars($fila['telefono']) : "") . "
                            </td>";
                      echo "<td><span class='label label-info'>" . htmlspecialchars($fila['asunto']) . "</span></td>";
                      echo "<td>" . nl2br(htmlspecialchars($fila['mensaje'])) . "</td>";
                      echo "<td class='text-center' style='vertical-align: middle;'>
                              <form action='#' method='post' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este mensaje?\");'>
                                <input type='hidden' name='id_mensaje' value='" . $fila['id'] . "'>
                                <button type='submit' name='borrar' class='btn btn-danger btn-xs'>
                                  <span class='glyphicon glyphicon-trash'></span> Eliminar
                                </button>
                              </form>
                            </td>";
                      echo "</tr>";
                  }
                  
                  echo "</tbody>";
                  echo "</table>";
                  echo "</div>";
              }
              mysqli_close($conexion);
            ?>
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

