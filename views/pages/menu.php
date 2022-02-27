<aside class="main-sidebar elevation-4 sidebar-light-info">
    <a href="inicio" class="brand-link">
        <img src="views/dist/img/oficial.png" alt="Soporte HNSEB Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
        <span class="brand-text font-weight-bold">Registro de Visitas</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="views/dist/img/logo-visitas.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="inicio" class="d-block">¡ Hola,<strong><?php echo $_SESSION["cuenta_reg"]; ?></strong>!</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                if ($_SESSION["perfil_reg"] == 1) {
                    echo '<li class="nav-item">
                    <a href="inicio" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li><li class="nav-header">Administración</li>
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link">
                            <i class="nav-icon fas fa-users-cog nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="entidades" class="nav-link">
                            <i class="nav-icon fas fa-building nav-icon"></i>
                            <p>Entidades</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="motivos" class="nav-link">
                            <i class="nav-icon fas fa-indent nav-icon"></i>
                            <p>Motivos de Visita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="lugares" class="nav-link">
                            <i class="nav-icon fas fa-landmark nav-icon"></i>
                            <p>Lugares de Visita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="empleados-publicos" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Empleados Públicos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte-general" class="nav-link">
                            <i class="nav-icon fas fa-file-csv"></i>
                            <p>Reporte General</p>
                        </a>
                    </li>';
                }
                ?>
                <?php
                if ($_SESSION["perfil_reg"] == 2) {
                    echo '
                    <li class="nav-header">Visitas</li>
                    <li class="nav-item">
                        <a href="registro" class="nav-link">
                            <i class="nav-icon fas fa-file-signature"></i>
                            <p>Registro</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="empleados" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Empleados</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte-visitas" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Reportes</p>
                        </a>
                    </li>
                    <li class="nav-header">Actividades Oficiales</li>
                    <li class="nav-item">
                        <a href="registro-agenda" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Agenda</p>
                        </a>
                    </li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</aside>