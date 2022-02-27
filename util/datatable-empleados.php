<?php
require_once "../controllers/EmpleadosControlador.php";
require_once "../models/EmpleadosModelo.php";

class TablaEmpleados
{
    public function mostrarEmpleados()
    {
        $item = null;
        $valor = null;
        $empleados = EmpleadosControlador::ctrListarEmpleadosAdmin($item, $valor);
        $datos_json = '{
            "data": [';
        for ($i = 0; $i < count($empleados); $i++) {
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado='" . $empleados[$i]["idEmpleado"] . "' data-toggle='modal' data-target='#modal-editar-empleado1'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarEmpleado' idEmpleado='" . $empleados[$i]["idEmpleado"] . "'><i class='fas fa-trash-alt'></i></button></div>";
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $empleados[$i]["nombresEmp"] . '",
                "' . $empleados[$i]["descOficina"] . '",
                "' . $empleados[$i]["cargoEmp"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaEmpleados = new TablaEmpleados();
$tablaEmpleados->mostrarEmpleados();
