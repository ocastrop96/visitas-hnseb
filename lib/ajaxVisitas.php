<?php
require_once "../controllers/VisitasControlador.php";
require_once "../models/VisitasModelo.php";

class AjaxVisitas{
    public $idVisita;
    public function ajaxListarVisita()
    {
        $item = "idVisita";
        $valor = $this->idVisita;
        $respuesta = VisitasControlador::ctrListarVisitas($item, $valor);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["idVisita"])) {
    $listVisita = new AjaxVisitas();
    $listVisita->idVisita = $_POST["idVisita"];
    $listVisita->ajaxListarVisita();
}