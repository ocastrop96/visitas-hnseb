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
          <h4><strong>Visitas:. Empleados</strong></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Visitas</a></li>
            <li class="breadcrumb-item active">Empleados</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users"></i> &nbsp;Empleados de Oficina o Departamento</h3>
      </div>
      <div class="card-body">
        <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-empleado"><i class="fas fa-user-plus"></i> Registrar Empleado Público
        </button>
      </div>
      <div class="card-body">
        <table id="tablaEmpleadosOf" class="table table-bordered table-hover dt-responsive tablaEmpleadosOf">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombres y Apellidos</th>
              <th>Oficina/Departamento</th>
              <th>Cargo</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $Oficina = $_SESSION["oficina_reg"];
            $empleadosOficina = EmpleadosControlador::ctrListarEmpleadosParam($Oficina);
            foreach ($empleadosOficina as $key => $value) {
              $botones = '<div class="btn-group"><button class="btn btn-warning btnEditarEmpleado" idEmpleado=' . $value["idEmpleado"] . ' data-toggle="modal" data-target="#modal-editar-empleado"><i class="fas fa-edit"></i></div>';

              echo '<tr>
                      <td>' . ($key + 1) . '</td>
                      <td>' . $value["nombresEmp"] . '</td>
                      <td>' . $value["descOficina"] . '</td>
                      <td>' . $value["cargoEmp"] . '</td>
                      <td>' . $botones . '</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<div id="modal-registrar-empleado" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post" id="frmRegEmp">
        <div class="modal-header text-center" style="background: #17a2b8; color: white">
          <h4 class="modal-title">Registrar Empleado de Oficina</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="">Nombres y Apellidos del Empleado</label>
              <i class="fas fa-user-tie"></i> *
              <input type="text" class="form-control" required autocomplete="off" placeholder="Ingrese Nombres y Apellidos del Empleado" name="nEmpNA" id="nEmpNA">
              <input type="hidden" value="<?php echo $_SESSION["oficina_reg"]; ?>" id="idOfiEmp" name="idOfiEmp">
            </div>
            <div class="col-12">
              <label for="">Cargo del Empleado</label>
              <i class="fas fa-id-badge"></i> *
              <input type="text" class="form-control" required autocomplete="off" placeholder="Ingrese cargo del Empleados" name="nEmpCar" id="nEmpCar">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary" id="btnRegEmp"><i class="fas fa-save"></i> Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $regEmpOficina = new EmpleadosControlador();
        $regEmpOficina ->ctrRegistrarEmpleadoOficina();
        ?>
      </form>
    </div>
  </div>
</div>
<div id="modal-editar-empleado" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header text-center" style="background: #6c757d; color: white">
          <h4 class="modal-title">Editar Empleado de Oficina</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <label for="">Nombres y Apellidos del Empleado</label>
              <i class="fas fa-user-tie"></i> *
              <input type="text" class="form-control" required autocomplete="off" name="edtNEmp" id="edtNEmp">
              <input type="hidden" id="idEmpleado" name="idEmpleado">
            </div>
            <div class="col-12">
              <label for="">Cargo del Empleado</label>
              <i class="fas fa-id-badge"></i> *
              <input type="text" class="form-control" required autocomplete="off" name="edtCEmp" id="edtCEmp">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar cambios</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
        </div>
        <?php
        $editarEmpleado = new EmpleadosControlador();
        $editarEmpleado->ctrEditarEmpleadoOficina();
        ?>
      </form>
    </div>
  </div>
</div>