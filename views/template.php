<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="views/dist/img/oficial.png" />
  <title>Registro de Visitas y Actividades Oficiales | HNSEB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--==============================================
  PLUGINS DE CSS
  ===============================================-->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="views/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="views/plugins/mdtime/mdtimepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JqueryUI -->
  <link rel="stylesheet" href="views/plugins/jquery-ui/jquery-ui.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="views/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="views/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="views/plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="views/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="views/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="views/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="views/plugins/morris/morris.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="views/dist/css/adminlte.css">
  <!--==============================================
  PLUGINS DE JS
  ===============================================-->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="views/plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="views/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="views/plugins/moment/moment.min.js"></script>
  <script src="views/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="views/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="views/plugins/mdtime/mdtimepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="views/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="views/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="views/plugins/datatables/jquery.dataTables.js"></script>
  <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="views/plugins/toastr/toastr.min.js"></script>
  <script src="views/plugins/select2/js/select2.full.min.js"></script>
  <script src="views/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- jquery-validation -->
  <script src="views/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="views/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="views/plugins/raphael/raphael.min.js"></script>
  <script src="views/plugins/morris/morris.min.js"></script>
  <script src="views/plugins/chart.js/Chart.min.js"></script>

  <script src="views/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Validación de Login -->
  <?php
  if (isset($_SESSION["loginRV1"]) && $_SESSION["loginRV1"] == "ok") {
    echo '<div class="wrapper">';
    // Cabecera Principal
    include('pages/cabecera.php');
    // Menú Principal
    include('pages/menu.php');
    if (isset($_GET["ruta"])) {
      // Rutas dinámicas
      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "entidades" ||
        $_GET["ruta"] == "motivos" ||
        $_GET["ruta"] == "lugares" ||
        $_GET["ruta"] == "empleados-publicos" ||
        $_GET["ruta"] == "reporte-general" ||
        $_GET["ruta"] == "registro" ||
        $_GET["ruta"] == "registro-agenda" ||
        $_GET["ruta"] == "empleados" ||
        $_GET["ruta"] == "reporte-visitas" ||
        $_GET["ruta"] == "logout"
      ) {
        include "pages/" . $_GET["ruta"] . ".php";
      } else {
        include "pages/404.php";
      }
    } else {
      include "pages/inicio.php";
    }
    // Pie de página
    include('pages/pie.php');
    echo '</div>';
  } else {
    include "pages/login.php";
  }

  ?>
  <!-- Scripts JS Propios -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script type="text/javascript" src="views/dist/js/main.js"></script>
  <script type="text/javascript" src="views/dist/js/usuarios.js"></script>
  <script type="text/javascript" src="views/dist/js/visitas.js"></script>
  <script type="text/javascript" src="views/dist/js/entidades.js"></script>
  <script type="text/javascript" src="views/dist/js/empleados.js"></script>
  <script type="text/javascript" src="views/dist/js/empleados-general.js"></script>
  <script type="text/javascript" src="views/dist/js/motivos.js"></script>
  <script type="text/javascript" src="views/dist/js/lugares.js"></script>
  <script type="text/javascript" src="views/dist/js/reporte-visitas.js"></script>
  <script type="text/javascript" src="views/dist/js/reportes-general.js"></script>
  <script type="text/javascript" src="views/dist/js/registro-agenda.js"></script>

</body>

</html>