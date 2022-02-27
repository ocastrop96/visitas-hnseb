<?php
require_once "../controllers/EmpleadosControlador.php";
require_once "../models/EmpleadosModelo.php";

class EmpleadosAjax
{
    public $idEmpleado;
    public function ajaxValidarEmpleado()
    {
        $valor = $this->idEmpleado;
        $respuesta = EmpleadosModelo::mdlListarEmpParametro($valor);
        echo json_encode($respuesta);
    }


    public $validaEmpleado;
    public function ajaxValidarDobleEmpleado()
    {
        $item = "nombresEmp";
        $valor = $this->validaEmpleado;
        $respuesta = EmpleadosControlador::ctrListarEmpleadosAdmin($item, $valor);

        echo json_encode($respuesta);
    }
}
if (isset($_POST["idEmpleado"])) {
    $list1 = new EmpleadosAjax();
    $list1->idEmpleado = $_POST["idEmpleado"];
    $list1->ajaxValidarEmpleado();
}

// Validar usuario existente
if (isset($_POST["validaEmpleado"])) {
    $validar = new EmpleadosAjax();
    $validar->validaEmpleado = $_POST["validaEmpleado"];
    $validar->ajaxValidarDobleEmpleado();
}
