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
    <title>Clientes</title>
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
    
    <!-- Botones para las funcionalidades -->

    <div class="container-fluid submenu-admin">
      <div class="row">
        <div class="col-xs-12">
          <a class="btn btn-success btn-lg" href="nuevo_cliente.php"><span class="glyphicon glyphicon-plus"></span> Añadir cliente</a>
          <a class="btn btn-danger btn-lg" href="borrar_cliente.php"><span class="glyphicon glyphicon-trash"></span> Borrar cliente</a>
          <a class="btn btn-info btn-lg" href="buscar_cliente.php"><span class="glyphicon glyphicon-search"></span> Buscar cliente</a>
        </div>
      </div>
    </div>

     <!-- Muestra una tabla con los usuarios registrados -->
     <div class="container-fluid">
       <div class="row">
         <div class="col-xs-12 lista-clientes">
          <h2 class="seccion-titulo" align="center">Listado de clientes</h2>
           <div class="panel panel-default">
              <div class="panel-body">
                <div class="table-responsive">
                <div class="table table-striped">
                  <!-- Código PHP que muestra el listado de usuarios -->
                  <?php 
                      $conexion = conectarSocioBienes();
                      $consulta = "select id,nombre,apellidos,direccion,telefono1,telefono2 
                                  from clientes
                                  order by id";
                      $datos = mysqli_query($conexion,$consulta);
                      
                      if (!$datos) {
                        echo "No hay datos que mostrar";
                      } else {
                        $num_filas = mysqli_num_rows($datos);

                        if ($num_filas == 0) {
                          echo "No hay ningún usuario registrado";
                        } else {
                          $clientes_registrados = $num_filas - 2;
                          echo "<p><strong>Número de usuarios registrados:</strong> $clientes_registrados</p>";
                          echo "<table class='table table-hover'";
                          echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Telefono 1</th><th>Telefono 2</th><th>Modificar</th></tr></thead>";
                          while ($fila = mysqli_fetch_array($datos,MYSQLI_ASSOC)) {
                            if($fila['id'] > 1) {
                              if ($fila['telefono2'] == '') {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>Sin información</td>
                                <td><form action='modificar_cliente.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='modificar' value='Modificar'></form></td></tr></tbody>";
                              } else {
                                echo "<tbody><tr><td>$fila[id]</td><td>$fila[nombre]</td><td>$fila[apellidos]</td><td>$fila[direccion]</td><td>$fila[telefono1]</td><td>$fila[telefono2]</td>
                                <td><form action='modificar_cliente.php' method='post'><input type='hidden' name='id' value='$fila[id]'><input class='form-control btn-primary' type='submit' name='modificar' value='Modificar'></form></td></tr></tbody>";
                              } 
                            }
                          }
                        }
                      }
                      mysqli_close($conexion); 
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
