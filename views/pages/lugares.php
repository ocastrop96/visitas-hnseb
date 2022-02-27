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
          <h4><strong>Administración:. Lugares de Visita</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Lugares</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-landmark"></i>
          Lugares de Visita
        </h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-lugar"><i class="fas fa-plus-circle"></i> Registrar Lugar
        </button>
      </div>
      <div class="card-body">
        <table id="tablaLugares" class="table table-bordered table-hover dt-responsive tablaLugares">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Lugar de Visita</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
<div id="modal-registrar-lugar" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Registrar Lugar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="newLugar">Descripción Lugar de Visita</label>
              <i class="fas fa-landmark"></i> *
              <input type="text" class="form-control" placeholder="Ingrese descripción de Lugar" required autocomplete="off" id="newLugar" name="newLugar">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Lugar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $regLugar = new LugaresControlador();
        $regLugar->ctrRegistrarLugar();
        ?>
      </form>
    </div>
  </div>
</div>
<div id="modal-editar-lugar" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Editar Lugar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="edtLugar">Descripción Lugar de Visita</label>
              <i class="fas fa-landmark"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtLugar" name="edtLugar">
              <input type="hidden" name="idLugar" id="idLugar">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Lugar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editLugar = new LugaresControlador();
        $editLugar->ctrEditarLugar();
        ?>
      </form>
    </div>
  </div>
</div>
<?php
$eliminarLugar = new LugaresControlador();
$eliminarLugar->ctrEliminarLugar();
?>