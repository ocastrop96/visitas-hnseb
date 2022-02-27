<?php
require_once "../controllers/EntidadesControlador.php";
require_once "../models/EntidadesModelo.php";

class EntidadesAjax{
    public $idEntidad;
    public function ajaxListarEntidad()
    {
        $item = "idEntidad";
        $valor = $this->idEntidad;
        $respuesta = EntidadesControlador::ctrListarEntidades($item, $valor);
        echo json_encode($respuesta);
    }

    public $validaEntidad;
    public function ajaxValidarDobleEntidad()
    {
        $item = "docRuc";
        $valor = $this->validaEntidad;
        $respuesta = EntidadesControlador::ctrListarEntidades($item, $valor);

        echo json_encode($respuesta);
    }

    public $validaRS;
    public function ajaxValidarDobleRazon()
    {
        $item = "descEntidad";
        $valor = $this->validaRS;
        $respuesta = EntidadesControlador::ctrListarEntidades($item, $valor);

        echo json_encode($respuesta);
    }
}
if (isset($_POST["idEntidad"])) {
    $list1 = new EntidadesAjax();
    $list1->idEntidad = $_POST["idEntidad"];
    $list1->ajaxListarEntidad();
}
if (isset($_POST["validaEntidad"])) {
    $validar = new EntidadesAjax();
    $validar->validaEntidad = $_POST["validaEntidad"];
    $validar->ajaxValidarDobleEntidad();
}

if (isset($_POST["validaRS"])) {
    $validar1 = new EntidadesAjax();
    $validar1->validaRS = $_POST["validaRS"];
    $validar1->ajaxValidarDobleRazon();
}
