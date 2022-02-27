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
          <h4><strong>Administración:. Entidades</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Entidades</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-building"></i>
          Entidades
        </h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-entidad1"><i class="fas fa-plus-circle"></i> Registrar Entidad
        </button>
      </div>
      <div class="card-body">
        <table id="tablaEntidades" class="table table-bordered table-hover dt-responsive tablaEntidades">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 10px">N° RUC</th>
              <th>Razón Social</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modal-registrar-entidad1" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Registrar Nueva Entidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <!-- <div class="col-12">
              <label>¿La Entidad cuenta con RUC?</label>
              <i class="fas fa-info"></i> *
              <div class="form-group">
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio1" name="custom2" checked>
                  <label for="customRadio1" class="custom-control-label">SI</label>
                </div>
                <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="customRadio2" name="custom2">
                  <label for="customRadio2" class="custom-control-label">NO</label>
                </div>
                <input type="hidden" name="confRuc1" id="confRuc1">
              </div>
            </div> -->
            <div class="col-12" id="blockRuc1">
              <label for="newRUC">N° de RUC de entidad</label>
              <i class="fas fa-building"></i> *
              <input type="text" class="form-control" placeholder="Ingrese N° de RUC de Entidad" required autocomplete="off" id="newRUC" name="newRUC">
            </div>
            <div class="col-12">
              <label for="newRS">Razón Social de entidad</label>
              <i class="fas fa-id-card"></i> *
              <input type="text" class="form-control" placeholder="Ingrese Razón Social de Entidad" required autocomplete="off" id="newRS" name="newRS">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Entidad</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $regEntidad = new EntidadesControlador();
        $regEntidad->ctrRegistrarEntidad();
        ?>
      </form>
    </div>
  </div>
</div>
<div id="modal-editar-entidad" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Editar Entidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="edtRUC">N° de RUC de entidad</label>
              <i class="fas fa-building"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtRUC" name="edtRUC">
              <input type="hidden" name="idEntidad" id="idEntidad">
            </div>
            <div class="col-12">
              <label for="edtRS">Razón Social de entidad</label>
              <i class="fas fa-id-card"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtRS" name="edtRS">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $rptEditaEnt = new EntidadesControlador();
        $rptEditaEnt->ctrEditarEntidad();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- Eliminar entidad -->
<?php
$eliminaEntidad = new EntidadesControlador();
$eliminaEntidad->ctrEliminarEntidad();
?>