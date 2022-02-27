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
          <h4><strong>Administración:. Empleados Públicos</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Administración</a></li>
            <li class="breadcrumb-item active">Empleados General</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-user-tie"></i>
          Empleados Públicos
        </h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-empG"><i class="fas fa-plus-circle"></i> Registrar Empleado
        </button>
      </div>
      <div class="card-body">
        <table id="tablaEmpleadosGeneral" class="table table-bordered table-hover dt-responsive tablaEmpleadosGeneral">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombres y Apellidos</th>
              <th>Oficina/Departamento</th>
              <th>Cargo</th>
              <th>Opciones</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
  </section>
</div>
<div id="modal-registrar-empG" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Registrar Empleado Público</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="newEmpP">Nombres y Apellidos</label>
              <i class="fas fa-user-tie"></i> *
              <input type="text" class="form-control" placeholder="Ingrese nombres y apellidos" required autocomplete="off" id="newEmpP" name="newEmpP">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="newOficinaEmp">Oficina/Departamento</label>
              <i class="fas fa-id-card-alt"></i> *
              <select class="form-control" style="width: 100%;" id="newOficinaEmp" name="newOficinaEmp" required>
                <option value="">Seleccione Oficina</option>
                <?php
                $itemOficina1 = null;
                $valorOficina1  = null;
                $oficina1 = OficinasControlador::ctrListarOficinas($itemOficina1, $valorOficina1);
                foreach ($oficina1 as $key => $value) {
                  echo '<option value="' . $value["idOficina"] . '">' . $value["descOficina"] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="newCargEmp">Cargo</label>
              <i class="fas fa-user-cog"></i> *
              <input type="text" class="form-control" placeholder="Ingrese cargo del empleado" required autocomplete="off" id="newCargEmp" name="newCargEmp">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Empleado</button>
          <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $regEmp = new EmpleadosControlador();
        $regEmp->ctrRegistraEmpleado();
        ?>
      </form>
    </div>
  </div>
</div>

<div id="modal-editar-empleado1" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Editar Empleado Público</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="edtEmpP">Nombres y Apellidos</label>
              <i class="fas fa-user-tie"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtEmpP" name="edtEmpP">
            <input type="hidden" name="idEmpleado" id="idEmpleado">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="edtOficinaEmp">Oficina/Departamento</label>
              <i class="fas fa-id-card-alt"></i> *
              <select class="form-control" style="width: 100%;" id="edtOficinaEmp" name="edtOficinaEmp" required>
                <option value="" id="edtOficinaEmp1"></option>
                <?php
                $itemOficina12 = null;
                $valorOficina12  = null;
                $oficina12 = OficinasControlador::ctrListarOficinas($itemOficina12, $valorOficina12);
                foreach ($oficina12 as $key => $value) {
                  echo '<option value="' . $value["idOficina"] . '">' . $value["descOficina"] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <label for="edtCargEmp">Cargo</label>
              <i class="fas fa-user-cog"></i> *
              <input type="text" class="form-control" required autocomplete="off" id="edtCargEmp" name="edtCargEmp">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar Empleado</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editEmp = new EmpleadosControlador();
        $editEmp->ctrEditarEmpleado();
        ?>
      </form>
    </div>
  </div>
</div>
<!-- Eliminar Empleado -->
<?php
$eliminarEmp = new EmpleadosControlador();
$eliminarEmp->ctrEliminarEmpleado();
?>