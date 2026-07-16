<?php 
  session_start();
  include "../php/funciones.php";

  $mensaje_exito = "";
  $mensaje_error = "";

  if (isset($_POST['guardar'])) {
      $nombre = $_POST['nombre'];
      $email = $_POST['email'];
      $telefono = $_POST['telefono'];
      $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : 'Sin asunto';
      $mensaje = $_POST['descripcion'];

      if ($nombre != "" && $email != "" && $mensaje != "") {
          $con = conectarSocioBienes();
          
          $nombre = mysqli_real_escape_string($con, $nombre);
          $email = mysqli_real_escape_string($con, $email);
          $telefono = mysqli_real_escape_string($con, $telefono);
          $asunto = mysqli_real_escape_string($con, $asunto);
          $mensaje = mysqli_real_escape_string($con, $mensaje);

          $sql = "INSERT INTO mensajes (nombre, email, telefono, asunto, mensaje) VALUES ('$nombre', '$email', '$telefono', '$asunto', '$mensaje')";
          if (mysqli_query($con, $sql)) {
              $mensaje_exito = "¡Gracias por contactarnos! Tu mensaje ha sido recibido con éxito.";
          } else {
              $mensaje_error = "Error al enviar el mensaje. Por favor, inténtelo más tarde.";
          }
          mysqli_close($con);
      } else {
          $mensaje_error = "Por favor, rellene todos los campos obligatorios (*).";
      }
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto</title>
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
    
    <!-- Formulario de contacto -->
    <div class="container-fluid menu-inicio">
      <div class="row">
          <h2 align="center">Si quieres ponerte en contacto con nosotros puedes rellenar el siguiente formulario</h2>
          <h2 align="center" style="margin-bottom: 30px;">Trataremos de responderte lo antes posible</h2>
          
          <?php if ($mensaje_exito != ""): ?>
              <div class="col-md-6 col-md-offset-3">
                  <div class="alert alert-success text-center">
                      <strong><?php echo $mensaje_exito; ?></strong>
                  </div>
              </div>
          <?php endif; ?>
          <?php if ($mensaje_error != ""): ?>
              <div class="col-md-6 col-md-offset-3">
                  <div class="alert alert-danger text-center">
                      <strong><?php echo $mensaje_error; ?></strong>
                  </div>
              </div>
          <?php endif; ?>
          
          <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <form action="#" method="post" accept-charset="utf-8">
                  <div class="form-group">
                    <label class="col-sm-2" for="nombre">* Nombre</label>
                    <div class="col-sm-10 ">
                      <input class="form-control" type="text" name="nombre" placeholder="escribe aquí tu nombre" required autofocus>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <label class="col-sm-2" for="email"> * Email</label>
                    <div class="col-sm-10 ">
                      <input class="form-control" type="email" name="email" placeholder="escribe aquí tu email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2" for="telefono"> Teléfono</label>
                    <div class="col-sm-10 ">
                      <input class="form-control" type="text" name="telefono" placeholder="escribe aquí tu teléfono">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2"> Asunto</label>
                    <div class="col-sm-10 ">
                      <label class="radio-inline">
                        <input type="radio" name="asunto" value="Pedir información" checked>Pedir información
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="asunto" value="Consulta">Consulta
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="asunto" value="Sugerencia">Sugerencia
                      </label>
                    </div>
                  </div>
                  . <br>
                  <div class="form-group">
                    <label class=" col-sm-2">* Mensaje</label>
                    <div class="col-sm-10">
                      <textarea id="des" class="form-control" name="descripcion" rows="5" required placeholder="Escriba aquí su consulta o mensaje..."></textarea>
                    </div>
                  </div>
                  . <br>
                  <div class="form-group">
                    <div class="col-sm-12 col-sm-offset-5">
                      <div class="col-sm-2">
                        <input class="form-control btn-primary" type="submit" name="guardar" value="Guardar">
                      </div>
                    </div>
                  </div>
                </form>
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
