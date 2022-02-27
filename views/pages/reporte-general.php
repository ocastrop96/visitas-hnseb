<?php
if ($_SESSION["perfil_reg"] == 2) {
  echo '<script>
    window.location = "registro";
  </script>';
  return;
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><strong>Administración:. Reportes General</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Reportes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-copy"></i>
          Reportes General (Selecciona un rango de fecha)
        </h3>
        <div class="card-tools">
          <div class="input-group mt-2">
            <button type="button" class="btn btn-default" id="calendario-reportes">
              <span>
                <i class="fa fa-calendar-alt"></i>
                <?php
                if (isset($_GET["fechaInicialRG"])) {
                  echo $_GET["fechaInicialRG"] . " - " . $_GET["fechaFinalRG"];
                } else {
                  echo 'Rango de fecha';
                }
                ?>
              </span>
              <i class="fa fa-caret-down"></i>
            </button>
            <button type="btn" class="ml-2 btn bg-info pull-right" id="desReport"><i class="fas fa-undo-alt"></i> Deshacer filtro
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        if (isset($_GET["fechaInicialRG"])) {
          echo '<a href="views/pages/descargar-reporteGxls.php?reporte=reporte&fechaInicialRG=' . $_GET["fechaInicialRG"] . '&fechaFinalRG=' . $_GET["fechaFinalRG"] . '">';
        } else {
          echo '<a href="views/pages/descargar-reporteGxls.php?reporte=reporte">';
        }
        ?>
        <button class="btn btn-success"><i class="fa fa-file-excel"></i> &nbsp;Reporte de Visitas en Excel</button>
        </a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-xs-12">
            <?php
            include "reportes/grafico-visitas.php";
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>