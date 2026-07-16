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
    <title>Borrar cliente</title>
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

    <!-- Borrar cliente -->
    <div class="container-fluid menu-inicio">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
          <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 align="center">Borrar un cliente</h2>
              </div>
              <div class="panel-body">
                <p align="center">Seleccione el cliente que desea eliminar del sistema</p>

                <!-- Código PHP que muestra los clientes con la opción de borrar -->
                <?php 
                  $conexion = conectarSocioBienes();
                  // No mostramos el ID 0 (disponible) ni el ID 1 (administrador)
                  $consulta = "select id, nombre, apellidos, nombre_usuario from clientes where id > 1";

                  $datos = mysqli_query($conexion,$consulta);

                  if (!$datos) {
                    echo "<div class='alert alert-danger text-center'>Error, no se han podido cargar los datos de los clientes</div>";
                  } else {
                    echo "<div class='col-xs-12 col-sm-8 col-sm-offset-2'>";

                    echo "<table class='table table-striped table-hover'>";
                    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Usuario</th><th>¿Eliminar?</th></tr></thead>";
                    echo "<tbody>";
                    while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                      $usuario_display = ($fila['nombre_usuario'] != "") ? $fila['nombre_usuario'] : "<em>(Sin usuario)</em>";
                      echo "<tr>
                              <td>$fila[id]</td>
                              <td>$fila[nombre] $fila[apellidos]</td>
                              <td>$usuario_display</td>
                              <td>
                                <form action='#' method='post' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este cliente? Se liberarán sus inmuebles y se borrarán sus citas.\");'>
                                  <input type='hidden' name='id' value='$fila[id]'>
                                  <input class='btn btn-md btn-danger' type='submit' name='borrar' value='Eliminar'>
                                </form>
                              </td>
                            </tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "<div class='text-center'>
                            <a href='./clientes.php' class='btn btn-default btn-lg'>Cancelar y Volver</a>
                          </div><br>";
                    echo "</div>";
                  }
                  mysqli_close($conexion);
                 ?>
                 
                 <!-- Código PHP que borra el cliente -->
                 <?php 
                    if (isset($_POST['borrar'])) {
                      $id = $_POST['id'];
                      $conexion = conectarSocioBienes();
                      
                      // 1. Liberar inmuebles comprados por este cliente
                      $liberar_inmuebles = "update inmuebles set id_cliente = 0 where id_cliente = '$id'";
                      mysqli_query($conexion, $liberar_inmuebles);
                      
                      // 2. Eliminar citas agendadas por este cliente
                      $borrar_citas = "delete from citas where id_cliente = '$id'";
                      mysqli_query($conexion, $borrar_citas);
                      
                      // 3. Eliminar el registro del cliente
                      $borrar_cliente = "delete from clientes where id = '$id'";
                      
                      if (mysqli_query($conexion, $borrar_cliente)) {
                        echo "<div class='alert alert-success col-sm-8 col-sm-offset-2' align='center'>
                                <strong>Cliente eliminado correctamente. Sus propiedades asociadas han sido liberadas.</strong> 
                              </div>";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=clientes.php'>";
                      } else {
                        echo "<div class='alert alert-danger col-sm-8 col-sm-offset-2' align='center'>
                                <strong>¡Error! No se ha podido borrar el cliente.</strong> 
                              </div>";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=clientes.php'>";
                      }
                      mysqli_close($conexion);
                    }
                  ?>
                  
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

