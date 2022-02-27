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
                    <h4><strong>Actividades Oficiales:. Registro de Agenda</strong></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Actividades Oficiales</a></li>
                        <li class="breadcrumb-item active">Agenda</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-door-open"></i>&nbsp; Registro de Actividades Oficiales de los Directores
                </h3>
            </div>
            <div class="card-body">
                <button type="btn" class="btn btn-secondary pull-left" data-toggle="modal" data-target="#modal-registrar-agenda"><i class="fas fa-plus-circle"></i> Registrar Actividad
                </button>
                <button type="btn" class="ml-2 btn btn-info float-right" id="deshacer-filtro-acti"><i class="fas fa-undo-alt"></i> Deshacer filtro
                </button>
                <button type="button" class="btn btn-default float-right" id="rango-actividades">
                    <span>
                        <i class="fa fa-calendar"></i>
                        <?php

                        if (isset($_GET["fechaInicialAct"])) {

                            echo $_GET["fechaInicialAct"] . " - " . $_GET["fechaFinalAct"];
                        } else {

                            echo 'Seleccione Rango de fecha';
                        }

                        ?>
                    </span>
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
            <div class="card-body">
                <table id="tablaAgenda" class="table table-bordered table-hover dt-responsive tablaAgenda">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 10px">Fecha</th>
                            <th>Hora</th>
                            <th>Descripción</th>
                            <th>Lugar</th>
                            <th>Funcionario Público</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET["fechaInicialAct"])) {
                            $fechaInicialAct = $_GET["fechaInicialAct"];
                            $fechaFinalAct = $_GET["fechaFinalAct"];
                        } else {
                            $fechaInicialAct = null;
                            $fechaFinalAct = null;
                        }
                        $actividades = ActividadesControlador::ctrListarActividadesParam($fechaInicialAct, $fechaFinalAct);
                        foreach ($actividades as $key => $value) {
                            $botones = '<div class="btn-group"><button class="btn btn-warning btnEditarActividad" idActividad=' . $value["idActividad"] . ' data-toggle="modal" data-target="#modal-editar-actividad"><i class="fas fa-edit"></i></button><button class="btn btn-danger btnEliminarActividad" data-toggle="tooltip" data-placement="left" title="Eliminar Actividad" idActividad=' . $value["idActividad"] . '><i class="fas fa-trash-alt"></i></button></div>';

                            echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["fechaAct"] . '</td>
                                <td>' . $value["horaAct"] . '</td>
                                <td>' . $value["descAct"] . '</td>
                                <td>' . $value["descLugar"] . '</td>
                                <td>' . $value["nombresEmp"] . ' - ' . $value["cargoEmp"] . '</td>
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

<div id="modal-registrar-agenda" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" method="post" id="frmRegActividad">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Registrar Agenda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label for="fechaActi">Fecha de Actividad &nbsp;</label>
                            <i class="fas fa-calendar-alt"></i> *
                            <input type="text" class="form-control" id="fechaActi" name="fechaActi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask autocomplete="off" placeholder="dd-mm-yyyy" readonly>
                            <input type="hidden" name="usuarioRegAct" id="usuarioRegAct" value="<?php echo $_SESSION["idReg"]; ?>">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="horaActi">Hora de Actividad &nbsp;</label>
                            <i class="fas fa-clock"></i> *
                            <input type="text" class="form-control" required autocomplete="off" id="horaActi" name="horaActi" placeholder="hh:mm AM/PM">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="empActi">Funcionario Público &nbsp;</label>
                            <i class="fas fa-user-tie"></i> *
                            <select class="form-control" style="width: 100%;" id="empActi" name="empActi">
                                <option value="0">Seleccione empleado público</option>
                                <?php
                                $Oficina = 1;
                                $Empleados = EmpleadosControlador::ctrListarEmpleadosParam($Oficina);
                                foreach ($Empleados as $key => $value) {
                                    echo '<option value="' . $value["idEmpleado"] . '">' . $value["nombresEmp"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-8">
                            <label for="lugarAct">Lugar de Actividad &nbsp;</label><i class="fas fa-place-of-worship"></i> *
                            <select class="form-control" style="width: 100%;" id="lugarAct" name="lugarAct">
                                <option value="0">Buscar lugar</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mt-lg-3 pl-lg-5 pt-lg-3 mt-lg-3 mt-md-3 pl-md-5 pt-md-3 mt-md-3 pt-sm-3 mt-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-dark" id="btnAddLugar" data-toggle="modal" data-target="#modal-registrar-lugar"><i class="fas fa-place-of-worship"></i>&nbsp;Agregar Lugar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-12">
                            <label for="descActi">Descripción de Actividad a realizar &nbsp;</label>
                            <i class="fas fa-place-of-worship"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese descripción de la actividad" required autocomplete="off" id="descActi" name="descActi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnRegActividad"><i class="fas fa-save"></i> Grabar Actividad</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
                <?php
                $regAgenda = new ActividadesControlador();
                $regAgenda->ctrRegistrarActividad();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modal-editar-actividad" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" method="post" id="frmEdtActividad">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Editar Agenda</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label for="edtfechaActi">Fecha de Actividad &nbsp;</label>
                            <i class="fas fa-calendar-alt"></i> *
                            <input type="text" class="form-control" id="edtfechaActi" name="edtfechaActi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask autocomplete="off" placeholder="dd-mm-yyyy" readonly>
                            <input type="hidden" name="idActividad" id="idActividad">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="edthoraActi">Hora de Actividad &nbsp;</label>
                            <i class="fas fa-clock"></i> *
                            <input type="text" class="form-control" required autocomplete="off" id="edthoraActi" name="edthoraActi" placeholder="hh:mm AM/PM">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="edtempActi1">Funcionario Público &nbsp;</label>
                            <i class="fas fa-user-tie"></i> *
                            <select class="form-control" style="width: 100%;" id="edtempActi1" name="edtempActi">
                                <option value="0" id="edtempActi"></option>
                                <?php
                                $Oficina = 1;
                                $Empleados = EmpleadosControlador::ctrListarEmpleadosParam($Oficina);
                                foreach ($Empleados as $key => $value) {
                                    echo '<option value="' . $value["idEmpleado"] . '">' . $value["nombresEmp"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-8">
                            <label for="edtlugarAct1">Lugar de Actividad &nbsp;</label><i class="fas fa-place-of-worship"></i> *
                            <select class="form-control" style="width: 100%;" id="edtlugarAct1" name="edtlugarAct">
                                <option value="0" id="edtlugarAct">Buscar lugar</option>
                            </select>
                            <span class="font-weight-bold text-danger">Lugar Actual : &nbsp;</span><span class="font-weight-bolder" id="info-lugar"></span>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mt-lg-3 pl-lg-5 pt-lg-3 mt-lg-3 mt-md-3 pl-md-5 pt-md-3 mt-md-3 pt-sm-3 mt-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-dark" id="btnAddLugar2" data-toggle="modal" data-target="#modal-registrar-lugar"><i class="fas fa-place-of-worship"></i>&nbsp;Agregar Lugar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-12">
                            <label for="edtdescActi">Descripción de Actividad a realizar &nbsp;</label>
                            <i class="fas fa-place-of-worship"></i> *
                            <input type="text" class="form-control" required autocomplete="off" id="edtdescActi" name="edtdescActi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnEdtActividad"><i class="fas fa-save"></i> Guardar Cambios</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
                <?php
                $editarActividad = new ActividadesControlador();
                $editarActividad->ctrEditarActividad();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modal-registrar-lugar" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" role="form" method="post" id="RegLugarAct">
                <div class="modal-header text-center" style="background: #6c757d; color: white">
                    <h4 class="modal-title">Registrar Nuevo Lugar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="descLugarAct">Lugar de Actividad</label>
                            <i class="fas fa-sitemap"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese lugar de actividad" required autocomplete="off" id="descLugarAct" name="descLugarAct">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnGLugarAct"><i class="fas fa-save"></i> Guardar Lugar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$eliminarActividad = new ActividadesControlador();
$eliminarActividad->ctrEliminarActividad();
?>