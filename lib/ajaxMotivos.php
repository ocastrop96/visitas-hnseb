<?php
require_once "../controllers/MotivosControlador.php";
require_once "../models/MotivosModelo.php";

class MotivosAjax{
    public $idMotivo;
    public function ajaxListarMotivo(){
        $item = "idMotivo";
        $valor = $this->idMotivo;
        $respuesta = MotivosControlador::ctrListarMotivos($item, $valor);
        echo json_encode($respuesta);
    }
    public $validaMotivo;
    public function ajaxValidarDobleMotivo()
    {
        $item = "descMotivo";
        $valor = $this->validaMotivo;
        $respuesta = MotivosControlador::ctrListarMotivos($item, $valor);

        echo json_encode($respuesta);
    }
}
if (isset($_POST["idMotivo"])) {
    $list1 = new MotivosAjax();
    $list1->idMotivo = $_POST["idMotivo"];
    $list1->ajaxListarMotivo();
}
if (isset($_POST["validaMotivo"])) {
    $validar = new MotivosAjax();
    $validar->validaMotivo = $_POST["validaMotivo"];
    $validar->ajaxValidarDobleMotivo();
}
