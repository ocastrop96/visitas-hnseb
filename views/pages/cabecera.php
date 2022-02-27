<nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-users-cog"></i> Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Opciones del Usuario</span>
                <!-- <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-actualizar-clave">
                    <i class="fas fa-pen-square mr-3"></i> Actualizar Contraseña
                </a> -->
                <div class="dropdown-divider"></div>
                <a href="logout" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-3"></i> Cerrar Sesión
                </a>
            </div>
        </li>
    </ul>
</nav>

<div id="modal-actualizar-clave" class="modal fade" role="dialog" aria-modal="true" style="padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" role="form" method="post">
                <div class="modal-header text-center" style="background: #6c757d; color: white">
                    <h4 class="modal-title">Actualizar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="newContra">Nueva contraseña</label>
                            <i class="fas fa-key"></i> *
                            <input type="password" class="form-control" placeholder="Ingrese nueva contraseña" required autocomplete="off" id="newContra" name="newContra">
                        </div>
                        <div class="col-12">
                            <label for="reContra">Valida nueva contraseña</label>
                            <i class="fas fa-key"></i> *
                            <input type="password" class="form-control" placeholder="Reescribre tu nueva contraseña" required autocomplete="off" id="reContra" name="reContra">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-secondary"><i class="fas fa-save"></i> Guardar cambios</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>