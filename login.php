<?php
require_once 'servicios/db.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Login</title>
</head>

<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div style="color: #fff;" class="mb-5">
      <h1>SISTEMA </h1>
    </div>
    <div class="login-box  container-register">
      <form class="login-form" method="POST" action="ingresar.php">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INGRESAR</h3>
        <div class="form-group">
          <label class="control-label">Usuario</label>
          <input class="form-control" type="text" id="usuario" name="usuario" placeholder="Usuario" required autofocus>
        </div>
        <div class="form-group">
          <label class="control-label">Contraseña</label>
          <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" required>

        </div>
        <div class="form-group">
          <div class="utility">
            <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Registrarse</a></p>
          </div>
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Ingresar</button>
        </div>
      </form>
      <!-- Registrarse -->

      <form class="forget-form" action="guardar_docente.php" method="POST">
        <div class="container-register">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Registrarse</h3>
          <div class="form-group">

            <div class="form-group">
              <label class="control-label">USUARIO</label>
              <input class="form-control" type="text" name="usuario" placeholder="Usuario">
            </div>
            <div class="form-group">
              <label class="control-label">CONTRASEÑA</label>
              <input class="form-control" type="password" name="contrasena" placeholder="Contraseña">
            </div>
            <div class="form-group">
              <label class="control-label">NOMBRES</label>
              <input class="form-control" type="text" name="nombres" placeholder="Nombre">
            </div>
            <div class="form-group">
              <label class="control-label">APELLIDOS</label>
              <input class="form-control" type="text" name="apellidos" placeholder="Apellido">
            </div>
            <div class="form-group">
              <label class="control-label">EMAIL</label>
              <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <?php
            $sql = "SELECT id_materia, nombre FROM materia";
            $result = $conn->query($sql);
            ?>
            <div class="form-group">
              <label class="control-label">MATERIAS</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Seleccionar materias
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php while ($row = $result->fetch_assoc()) : ?>
                    <div class="dropdown-item">
                      <input class="form-check-input" type="checkbox" name="materia[]" value="<?php echo $row['id_materia']; ?>">
                      <label class="form-check-label"><?php echo $row['nombre']; ?></label>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
            <div class="form-group btn-container">
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
            </div>
            <div class="form-group mt-3">
              <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
      $('.login-box').toggleClass('flipped');
      return false;
    });
  </script>
</body>

</html>