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
          <h4><strong>Administración:. Motivos</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Motivos</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-indent"></i>
          Motivos
        </h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-motivo"><i class="fas fa-plus-circle"></i> Registrar Motivo
        </button>
      </div>
      <div class="card-body">
        <table id="tablaMotivos" class="table table-bordered table-hover dt-responsive tablaMotivos">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Motivo de Visita</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
<div id="modal-registrar-motivo" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Registrar Motivo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="newMotivo">Descripción Motivo</label>
              <i class="fas fa-indent"></i> *
              <input type="text" class="form-control" placeholder="Ingrese descripción de motivo" required autocomplete="off" id="newMotivo" name="newMotivo">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Motivo</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $regMotivo = new MotivosControlador();
        $regMotivo->ctrRegistraMotivos();
        ?>
      </form>
    </div>
  </div>
</div>
<div id="modal-editar-motivo" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Editar Motivo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="edtMotivo">Descripción Motivo</label>
              <i class="fas fa-building"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtMotivo" name="edtMotivo">
              <input type="hidden" name="idMotivo" id="idMotivo">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $edtMotivo = new MotivosControlador();
        $edtMotivo->ctrEditarMotivos();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- Eliminar Motivo -->
<?php
$eliminarMot = new MotivosControlador();
$eliminarMot->ctrEliminarMotivos();
?>