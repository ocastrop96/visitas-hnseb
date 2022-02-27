<?php
$item = null;
$valor = null;

$visitas = VisitasControlador::ctrListarVisitas($item,$valor);
$totalVisitas = count($visitas);

$item1 = null;
$valor1 = null;
$usuarios = UsuariosControlador::ctrListarUsuarios($item1,$valor1);
$totalUsuarios = count($usuarios);

$item2 = null;
$valor2 = null;
$empleados = EmpleadosControlador::ctrListarEmpleadosAdmin($item2,$valor2);
$totalEmpleados = count($empleados);

$item3 = null;
$valor3 = null;
$entidades = EntidadesControlador::ctrListarEntidades($item3,$valor3);
$totalEntidades = count($entidades);



?>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo number_format($totalVisitas); ?></h3>

            <p>Visitas Registradas</p>
        </div>
        <div class="icon">
            <i class="fas fa-file-invoice"></i>
        </div>
        <a href="inicio" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo number_format($totalUsuarios); ?></h3>
            <p class="font-weight-bold">Usuarios Registrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="usuarios" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo number_format($totalEmpleados); ?></h3>

            <p class="font-weight-bold">Empleados Publicos</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-tie"></i>
        </div>
        <a href="empleados-publicos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalEntidades); ?></h3>

            <p class="font-weight-bold">Entidades Registradas</p>
        </div>
        <div class="icon">
            <i class="fas fa-building"></i>
        </div>
        <a href="entidades" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>