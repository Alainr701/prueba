<!DOCTYPE html>
<?php
require_once 'servicios/db.php';
// Verificar la cookie de inicio de sesión
if (!isset($_COOKIE['logged_in']) || !$_COOKIE['logged_in']) {
  header('Location: login.php');  // Redirigir al usuario a la página de inicio de sesión

  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <!-- Twitter meta-->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:site" content="@pratikborsadiya">
  <meta property="twitter:creator" content="@pratikborsadiya">
  <!-- Open Graph Meta-->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Vali Admin">
  <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
  <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
  <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
  <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Home</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">


  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="index.html">Sistema</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">
        <input class="app-search__input" type="search" placeholder="Search">
        <button class="app-search__button"><i class="fa fa-search"></i></button>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
          <li>
            <a class="dropdown-item" href="salir.php?accion=Salir">
              <i class="fa fa-sign-out fa-lg"></i> Salir

            </a>
          </li>
        </ul>
      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <div>
        <p class="app-sidebar__user-name">Nombre</p>
        <p class="app-sidebar__user-designation">Curso</p>
      </div>
    </div>

    <ul class="app-menu">

      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Asistencia</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <ul class="treeview-menu">

            <?php
            $idDocente = 14; // Supongamos que el ID del docente es 1, debes reemplazarlo con el ID correcto

            // Consultar las materias del docente
            $query = "SELECT m.id_materia, m.nombre FROM materia AS m INNER JOIN docente_materia AS dm ON m.id_materia = dm.id_materia WHERE dm.id_docente = $idDocente";
            $result = $conn->query($query);

            // Verificar si se encontraron materias
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $id_materia = $row["id_materia"];
                $materia = $row["nombre"];
                echo '<li><button type="submit" class="treeview-item bg-dark w-100" name="id_materia" value="' . $id_materia . '"><i class="icon fa fa-circle-o"></i>' . $materia . '</button></li>';
              }
            } else {
              echo '<li>No se encontraron materias para el docente seleccionado.</li>';
            }
            ?>

          </ul>
        </form>

      </li>


      <li><a class="app-menu__item" href="registros.php"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">Registros</span></a></li>

    </ul>
  </aside>

  <main class="app-content">

    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Sistema </h1>
        <p></p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Carreras</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Numero de Estudiantes</h4>
            <p><b>5</b></p>
          </div>
        </div>
      </div>
    </div>
    <form method="POST" action="guardar_asistencia.php">

      <div class="tile">
        <h3 class="tile-title">Lista de Estudiantes</h3>
        <!-- <materia-->
        <?php
        //materia seleccionada
        if (isset($_GET['id_materia'])) {
          $id_materia = $_GET['id_materia'];
        ?>

          <div class="col pl-5">
            <div class="ml-3">
              <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
              <input type="text" name="id_materia" value="<?= $id_materia ?>" hidden>
              <input type="text" name="id_docente" value="<?= $idDocente ?>" hidden>
            </div>
            <br>
          </div>

        <?php
        } else {
          echo "Seleccione una materia";
        }
        ?>
        <br>
        <?php
        if (isset($_GET['id_materia'])) {

          // Consultar las materias según la carrera
          $query = "SELECT * FROM estudiantes";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th>Nombres</th>';
            echo '<th>Apellidos</th>';
            echo '<th>Asistencia</th>';
            // echo '<th>Fecha</th>';
            // echo '<th>Tema</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $count = 1;
            // Recorrer cada fila de resultados
            while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . $count . '</td>';
              echo '<td>' . $row["nombres"] . '</td>';
              echo '<input type="text" name="id_estudiante[]" value="' . $row["id_estudiante"] . '" required hidden> ';
              echo '<td>' . $row["apellido_paterno"] . ' ' . $row["apellido_materno"] . '</td>';
              echo '<td> <input   type="text" name="asistencia[]" required></td>';
              echo '</tr>';
              $count++;
            }
            echo '</tbody>';
            echo '</table>';
          } else {
            echo "No se encontraron estudiantes.";
          }
        }
        ?>
        <?php
        //materia seleccionada
        if (isset($_GET['id_materia'])) {
        ?>
          <div class="ml-3">
            <input class="btn btn-primary" type="submit" value="Generar Asistencia" name="submit" />
          </div>
        <?php }; ?>
    </form>
    <?php
    // if (isset($_POST['asistencia'])) {
    //   // Consultar las materias según la carrera
    //   $query = "SELECT * FROM estudiantes ";
    //   $result = $conn->query($query);

    //   if ($result->num_rows > 0) {
    //     echo '<form method="POST" action="guardar_asistencia.php">';
    //     echo '<table class="table table-striped">';
    //     echo '<thead>';
    //     echo '<tr>';
    //     echo '<th>#</th>';
    //     echo '<th>Nombres</th>';
    //     echo '<th>Apellidos</th>';
    //     echo '<th>Asistencia</th>';
    //     echo '</tr>';
    //     echo '</thead>';
    //     echo '<tbody>';

    //     $count = 1;
    //     // Recorrer cada fila de resultados
    //     while ($row = $result->fetch_assoc()) {
    //       echo '<tr>';
    //       echo '<td>' . $count . '</td>';
    //       echo '<td>' . $row["nombres"] . '</td>';
    //       echo '<td>' . $row["apellido_paterno"] . ' ' . $row["apellido_materno"] . '</td>';
    //       echo '<td><input type="checkbox" name="asistencia[]" value="' . $row["id_estudiante"] . '"></td>';
    //       echo '</tr>';
    //       $count++;
    //     }
    //     echo '</tbody>';
    //     echo '</table>';
    //     echo '<button type="submit" name="submit" class="btn btn-primary">Guardar Asistencia</button>';
    //     echo '</form>';
    //   } else {
    //     echo "No se encontraron estudiantes para la carrera seleccionada.";
    //   }
    // }
    ?>

    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script type="text/javascript" src="js/plugins/chart.js"></script>
  <script type="text/javascript">
    var data = {
      labels: ["January", "February", "March", "April", "May"],
      datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56]
        },
        {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 86]
        }
      ]
    };
    var pdata = [{
        value: 300,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Complete"
      },
      {
        value: 50,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "In-Progress"
      }
    ]

    var ctxl = $("#lineChartDemo").get(0).getContext("2d");
    var lineChart = new Chart(ctxl).Line(data);

    var ctxp = $("#pieChartDemo").get(0).getContext("2d");
    var pieChart = new Chart(ctxp).Pie(pdata);
  </script>
  <!-- Google analytics script-->
  <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>

</html>