<?php

if($_SESSION["perfil_reg"] == 2){
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
                    <h4><strong>Administración:. Usuarios</strong></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Administración</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users-cog"></i>
                    Usuarios del Sistema
                </h3>
            </div>
            <div class="card-body">
                <button type="btn" class="btn btn-secondary" data-toggle="modal" data-target="#modal-registrar-usuario"><i class="fas fa-user-plus"></i> Registrar Usuario
                </button>
            </div>
            <div class="card-body">
                <table id="tablaUsuarios" class="table table-bordered table-hover dt-responsive tablaUsuarios">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>DNI N°</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Rol</th>
                            <th>Oficina/Departamento</th>
                            <th>Correo</th>
                            <th>Cuenta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<div id="modal-registrar-usuario" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" method="post" id="frmUsuario">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Registrar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Bloque de DNI -->
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label for="newDNI">DNI</label>
                            <i class="fas fa-address-card"></i> *
                            <input type="text" name="newDNI" id="newDNI" class="form-control" placeholder="Ingrese DNI" required autocomplete="off" autofocus="autofocus" maxlength="8">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="newNombres">Nombres</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="newNombres" id="newNombres" class="form-control" required autocomplete="off" placeholder="Ingresa nombres">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="newAPaterno">Apellido Paterno</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="newAPaterno" id="newAPaterno" class="form-control" required autocomplete="off" placeholder="Ingrese A. Paterno">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="newAMaterno">Apellido Materno</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="newAMaterno" id="newAMaterno" class="form-control" required autocomplete="off" placeholder="Ingrese A. Materno">
                        </div>
                    </div>
                    <!-- Bloque de Apellidos -->

                    <!-- Bloque de Perfil -->
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="newRol">Rol</label>
                            <i class="fas fa-id-card-alt"></i> *
                            <select class="form-control" style="width: 100%;" id="newRol" name="newRol" required>
                                <option value="">Seleccione el rol</option>
                                <?php
                                $itemRol = null;
                                $valorRol  = null;
                                $rol = RolesControlador::ctrListarRoles($itemRol, $valorRol);
                                foreach ($rol as $key => $value) {
                                    echo '<option value="' . $value["idRol"] . '">' . $value["dscRol"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="newOficina">Oficina/Departamento</label>
                            <i class="fas fa-id-card-alt"></i> *
                            <select class="form-control" style="width: 100%;" id="newOficina" name="newOficina" required>
                                <option value="">Seleccione Oficina</option>
                                <?php
                                $itemOficina = null;
                                $valorOficina  = null;
                                $oficina = OficinasControlador::ctrListarOficinas($itemOficina, $valorOficina);
                                foreach ($oficina as $key => $value) {
                                    echo '<option value="' . $value["idOficina"] . '">' . $value["descOficina"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="newCorreo">Correo Institucional</label>
                            <i class="fas fa-at"></i> *
                            <input type="text" name="newCorreo" id="newCorreo" class="form-control" placeholder="Ingrese correo" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="newUsuario">Usuario</label>
                            <i class="fas fa-user-cog"></i> *
                            <input type="text" name="newUsuario" id="newUsuario" class="form-control" placeholder="Ingrese usuario" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="newPasswd">Contraseña</label>
                            <i class="fas fa-key"></i> *
                            <input type="password" name="newPasswd" id="newPasswd" class="form-control" placeholder="Ingrese contraseña" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary" id="btnfrmUsuario"><i class="fas fa-save"></i> Guardar</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-eraser"></i> Limpiar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
                <?php
                $createUser = new UsuariosControlador();
                $createUser->ctrRegistrarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>

<div id="modal-editar-usuario" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" role="form" method="post">
                <div class="modal-header text-center" style="background: #17a2b8; color: white">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Bloque de DNI -->
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label for="edtDNI">DNI</label>
                            <i class="fas fa-address-card"></i> *
                            <input type="text" name="edtDNI" id="edtDNI" class="form-control"required autocomplete="off" autofocus="autofocus" maxlength="8">
                            <input type="hidden" name="idUsuario" id="idUsuario">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="edtNombres">Nombres</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="edtNombres" id="edtNombres" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="edtAPaterno">Apellido Paterno</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="edtAPaterno" id="edtAPaterno" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="edtAMaterno">Apellido Materno</label>
                            <i class="fas fa-user-tag"></i> *
                            <input type="text" name="edtAMaterno" id="edtAMaterno" class="form-control" required autocomplete="off">
                        </div>
                    </div>
                    <!-- Bloque de Apellidos -->

                    <!-- Bloque de Perfil -->
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="edtRol">Rol</label>
                            <i class="fas fa-id-card-alt"></i> *
                            <select class="form-control" style="width: 100%;" id="edtRol" name="edtRol" required>
                                <option value="" id="edtRol1"></option>
                                <?php
                                $itemRol2 = null;
                                $valorRol2  = null;
                                $rol2 = RolesControlador::ctrListarRoles($itemRol2, $valorRol2);
                                foreach ($rol2 as $key => $value) {
                                    echo '<option value="' . $value["idRol"] . '">' . $value["dscRol"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="edtOficina">Oficina/Departamento</label>
                            <i class="fas fa-id-card-alt"></i> *
                            <select class="form-control" style="width: 100%;" id="edtOficina" name="edtOficina" required>
                                <option value="" id="edtOficina1"></option>
                                <?php
                                $itemOficina2 = null;
                                $valorOficina2  = null;
                                $oficina2 = OficinasControlador::ctrListarOficinas($itemOficina2, $valorOficina2);
                                foreach ($oficina2 as $key => $value) {
                                    echo '<option value="' . $value["idOficina"] . '">' . $value["descOficina"] . '</option>';
                                }
                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-4">
                            <label for="edtCorreo">Correo Institucional</label>
                            <i class="fas fa-at"></i> *
                            <input type="text" name="edtCorreo" id="edtCorreo" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="edtUsuario">Usuario</label>
                            <i class="fas fa-user-cog"></i> *
                            <input type="text" name="edtUsuario" id="edtUsuario" class="form-control" required autocomplete="off" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="edtPasswd">Contraseña</label>
                            <i class="fas fa-key"></i> *
                            <input type="password" name="edtPasswd" id="edtPasswd" class="form-control" placeholder="Ingrese nueva contraseña" autocomplete="off">
                            <input type="hidden" name="passActual" id="passActual">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar cambios</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
                <?php
                $edtUser = new UsuariosControlador();
                $edtUser ->ctrEditarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- Llamar metodo de eliminar Usuario -->
<?php
 $eliminaUser = new UsuariosControlador();
 $eliminaUser->ctrEliminarUsuario();
?>