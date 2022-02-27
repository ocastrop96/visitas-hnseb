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
                    <h4><strong>Visitas:. Registro</strong></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Visitas</a></li>
                        <li class="breadcrumb-item active">Registro</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-door-open"></i>&nbsp; Registro de Visitas
                </h3>
            </div>
            <div class="card-body">
                <button type="btn" class="btn btn-secondary pull-left" data-toggle="modal" data-target="#modal-registrar-visita"><i class="fas fa-plus-circle"></i> Registrar Visita
                </button>
                <button type="btn" class="ml-2 btn btn-info float-right" id="deshacer"><i class="fas fa-undo-alt"></i> Deshacer filtro
                </button>
                <button type="button" class="btn btn-default float-right" id="daterange-btn">
                    <span>
                        <i class="fa fa-calendar"></i>
                        <?php

                        if (isset($_GET["fechaInicial"])) {

                            echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                        } else {

                            echo 'Rango de fecha';
                        }

                        ?>
                    </span>
                    <i class="fas fa-caret-down"></i>
                </button>

            </div>
            <div class="card-body">
                <table id="tablaVisitas" class="table table-bordered table-hover dt-responsive tablaVisitas">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Fecha</th>
                            <th>H.Visita</th>
                            <th>Documento</th>
                            <th>Visitante</th>
                            <th>Entidad</th>
                            <th>Motivo</th>
                            <th>Empleado Público</th>
                            <th>Oficina/Cargo</th>
                            <th>Lugar</th>
                            <th>H.Salida</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET["fechaInicial"])) {
                            $fechaInicial = $_GET["fechaInicial"];
                            $fechaFinal = $_GET["fechaFinal"];
                        } else {
                            $fechaInicial = null;
                            $fechaFinal = null;
                        }

                        $Ofi = $_SESSION["oficina_reg"];
                        $visitas = VisitasControlador::ctrListarVisitasParam($Ofi, $fechaInicial, $fechaFinal);
                        foreach ($visitas as $key => $value) {
                            if ($value["estadoV"] == 1) {
                                $estadoVisita = '<button type="button" class="btn btn-block btn-secondary btn-sm"><i class="fas fa-clock"></i>&nbsp;' . $value["descEstado"] . '</button>';
                                $botones = '<button class="btn btn-block btn-info btnRegistrarSalida" idVisita=' . $value["idVisita"] . ' data-toggle="modal" data-target="#modal-registrar-salida"><i class="fas fa-clipboard-check"></i>Registrar Salida</button>';
                            } else if ($value["estadoV"] == 2) {
                                $estadoVisita = '<button type="button" class="btn btn-block btn-success btn-sm"><i class="fas fa-check-circle"></i>&nbsp;' . $value['descEstado'] . '</button>';
                                $botones = '<p class="font-weight-bold">FINALIZADA</p>';
                            } else if ($value["estadoV"] == 3) {
                                $estadoVisita = '<button type="button" class="btn btn-block btn-danger btn-sm"><i class="fas fa-times-circle"></i>&nbsp;' . $value['descEstado'] . '</button>';
                                $botones = '<p class="font-weight-bold">FINALIZADA</p>';
                            } else if ($value["estadoV"] == 4) {
                                $estadoVisita = '<button type="button" class="btn btn-block btn-warning btn-sm"><i class="fas fa-user-times"></i>&nbsp;' . $value['descEstado'] . '</button>';
                                $botones = '<p class="font-weight-bold">FINALIZADA</p>';
                            }
                            echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["fVisita"] . '</td>
                                <td>' . $value["hEntrada"] . '</td>
                                <td>' . $value["descTDoc"] . '-' . $value["vstNdoc"] . '</td>
                                <td>' . $value["vstNombre"] . '</td>
                                <td>' . $value["descEntidad"] . '</td>
                                <td>' . $value["descMotivo"] . '</td>
                                <td>' . $value["nombresEmp"] . '</td>
                                <td>' . $value["descOficina"] . '-' . $value["cargoVisitado"] . '</td>
                                <td>' . $value["descLugar"] . '</td>
                                <td>' . $value["hSalida"] . '</td>
                                <td>' . $estadoVisita . '</td>
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

<div id="modal-registrar-visita" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" method="post" id="frmRegVisita">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Registrar Visita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="vTDoc">Tipo de Documento &nbsp;</label>
                            <i class="fas fa-id-card"></i> *
                            <select class="form-control" style="width: 100%;" id="vTDoc" name="vTDoc">
                                <option value="0">Selecciona Tipo</option>
                                <?php
                                $itemTDoc = null;
                                $valorTDoc  = null;
                                $tdoc = TipoDocumentoControlador::ctrListarTipoDocumento($itemTDoc, $valorTDoc);
                                foreach ($tdoc as $key => $value) {
                                    echo '<option value="' . $value["idTdoc"] . '">' . $value["descTDoc"] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" name="usuarioReg" id="usuarioReg" value="<?php echo $_SESSION["idReg"]; ?>">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="vNDoc">N° Doc &nbsp;</label>
                            <i class="fas fa-hashtag"></i> *
                            <input type="text" class="form-control" placeholder="N° Documento" required autocomplete="off" id="vNDoc" name="vNDoc" maxlength="8">
                        </div>
                        <div class="col-12 col-md-5">
                            <label for="vNAVis">Nombres y Apellidos de Visitante &nbsp;</label>
                            <i class="fas fa-user"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese nombres y apellidos de visitante" required autocomplete="off" id="vNAVis" name="vNAVis">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-8">
                            <label for="vEntidad">Entidad o Empresa &nbsp;</label><i class="fas fa-building"></i> *
                            <select class="form-control" style="width: 100%;" id="vEntidad" name="vEntidad">
                                <option value="0">Buscar entidad</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mt-lg-3 pl-lg-5 pt-lg-3 mt-lg-3 mt-md-3 pl-md-5 pt-md-3 mt-md-3 pt-sm-3" id="btnDNIPJ">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-dark" id="btnAddEntidad" data-toggle="modal" data-target="#modal-registrar-entidad"><i class="fas fa-building"></i>&nbsp;Agregar Entidad</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12 col-md-5">
                            <label for="vMotivo">Motivo de Visita&nbsp;</label>
                            <i class="fas fa-bars"></i> *
                            <select class="form-control" style="width: 100%;" id="vMotivo" name="vMotivo">
                                <option value="0">Selecciona motivo de visita</option>
                                <?php
                                $itemMotivo = null;
                                $valorMotivo  = null;
                                $motivo = MotivosControlador::ctrListarMotivos($itemMotivo, $valorMotivo);
                                foreach ($motivo as $key => $value) {
                                    echo '<option value="' . $value["idMotivo"] . '">' . $value["descMotivo"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-7">
                            <label for="vPersonal">Personal Visitado &nbsp;</label>
                            <i class="fas fa-user-tie"></i> *
                            <select class="form-control" style="width: 100%;" id="vPersonal" name="vPersonal">
                                <option value="0">Selecciona personal de visitado</option>
                                <?php
                                $Oficina = $_SESSION["oficina_reg"];
                                $Empleados = EmpleadosControlador::ctrListarEmpleadosParam($Oficina);
                                foreach ($Empleados as $key => $value) {
                                    echo '<option value="' . $value["idEmpleado"] . '">' . $value["nombresEmp"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <label for="vOficina">Oficina/Dep&nbsp;</label>
                            <i class="fas fa-sitemap"></i> *
                            <select class="form-control" style="width: 100%;" name="vOficina">
                                <option value="0" id="vOficina">Seleccione Personal</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="vCargo">Cargo&nbsp;</label>
                            <i class="fas fa-user-cog"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese cargo" required autocomplete="off" id="vCargo" name="vCargo" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 col-md-12">
                            <label for="vLugar">Lugar de Visita &nbsp;</label>
                            <i class="fas fa-place-of-worship"></i> *
                            <select class="form-control" style="width: 100%;" id="vLugar" name="vLugar">
                                <option value="0">Selecciona lugar de visita</option>
                                <?php
                                $itemLugar = null;
                                $valorLugar  = null;
                                $Lugar = LugaresControlador::ctrListarLugares($itemLugar, $valorLugar);
                                foreach ($Lugar as $key => $value) {
                                    echo '<option value="' . $value["idLugar"] . '">' . $value["descLugar"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnRegVisita"><i class="fas fa-save"></i> Grabar Visita</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
                <?php
                $regVisita = new VisitasControlador();
                $regVisita->ctrRegistrarVisita();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modal-registrar-salida" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" role="form" method="post" id="formRegSalida">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Registra Salida de Visita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="vsEstadoF">Estado Final de Visita</label>
                            <i class="fas fa-map"></i> *
                            <select class="form-control" style="width: 100%;" id="vsEstadoF" name="vsEstadoF" required>
                                <option value="0">Selecciona Estado Final de Visita</option>
                                <?php
                                $itemEstado = null;
                                $valorEstado  = null;
                                $estado = EstadoVisitaControlador::ctrListarEstados($itemEstado, $valorEstado);
                                foreach ($estado as $key => $value) {
                                    echo '<option value="' . $value["idEstado"] . '">' . $value["descEstado"] . '</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" name="idVisita" id="idVisita" required>

                        </div>
                        <div class="col-5">
                            <label for="vsHSalidaF">Estado Final de Visita</label>
                            <i class="fas fa-map"></i> *
                            <input type="text" class="form-control" placeholder="hh:mm AM/PM" required autocomplete="off" id="vsHSalidaF" name="vsHSalidaF">
                            <input type="hidden" name="idRegSalida" id="idRegSalida" value="<?php echo $_SESSION["idReg"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnRegSalida"><i class="fas fa-save"></i> Guardar Salida</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>

                <?php
                $regSalida = new VisitasControlador();
                $regSalida->ctrRegistrarSalida();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modal-registrar-entidad" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" role="form" method="post" id="RegEntidad">
                <div class="modal-header text-center" style="background: #6c757d; color: white">
                    <h4 class="modal-title">Registrar Nueva Entidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="confRuc">¿La Entidad cuenta con RUC?</label>
                            <i class="fas fa-info"></i> *
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" checked>
                                    <label for="customRadio1" class="custom-control-label">SI</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                                    <label for="customRadio2" class="custom-control-label">NO</label>
                                </div>
                                <input type="hidden" name="confRuc" id="confRuc">
                            </div>
                        </div>
                        <div class="col-12" id="bloqueRUC">
                            <label for="nRucEnt">N° de RUC de entidad</label>
                            <i class="fas fa-building"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese N° de RUC de Entidad" required autocomplete="off" id="nRucEnt" name="nRucEnt">
                        </div>
                        <div class="col-12">
                            <label for="rSocialEnt">Razón Social o Nombre de Entidad</label>
                            <i class="fas fa-id-card"></i> *
                            <input type="text" class="form-control" placeholder="Ingrese Razón Social o nombre de Entidad" required autocomplete="off" id="rSocialEnt" name="rSocialEnt">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnGEntidad"><i class="fas fa-save"></i> Guardar Entidad</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>