<?php

if ($_SESSION["perfil_reg"] == 1) {
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><strong>Visitas:. Reportes</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Visitas</a></li>
            <li class="breadcrumb-item active">Reportes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header with-border">
        <div class="input-group">
          <button type="button" class="btn btn-default" id="daterange-btn2">
            <span>
              <i class="fa fa-calendar-alt"></i>
              <?php
              if (isset($_GET["fechaInicialR"])) {
                echo $_GET["fechaInicialR"] . " - " . $_GET["fechaFinalR"];
              } else {
                echo 'Rango de fecha';
              }
              ?>
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
          <button type="btn" class="ml-2 btn bg-info pull-right" id="deshacer2"><i class="fas fa-undo-alt"></i> Deshacer filtro
          </button>
        </div>
      </div>
      <div class="card-body">
        <?php
        $Oficina = $_SESSION["oficina_reg"];
        if (isset($_GET["fechaInicialR"])) {
          echo '<a href="views/pages/descargar-reportexls.php?reporte=reporte&fechaInicialR=' . $_GET["fechaInicialR"] . '&fechaFinalR=' . $_GET["fechaFinalR"] . '&Oficina='.$Oficina.'">';
        } else {
          echo '<a href="views/pages/descargar-reportexls.php?reporte=reporte&Oficina='.$Oficina.'">';
        }
        ?>
        <button class="btn btn-success"><i class="fa fa-file-excel"></i> &nbsp;Descargar reporte en Excel</button>
        </a>
      </div>
    </div>
  </section>
</div>