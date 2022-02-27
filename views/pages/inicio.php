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
          <h4><strong>Inicio:. Dashboard</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        include "inicio/box-superiores.php"
        ?>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Estadísticas</h3>
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