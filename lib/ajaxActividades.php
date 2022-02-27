<?php
require_once "../controllers/ActividadesControlador.php";
require_once "../models/ActividadesModelo.php";

class AjaxActividades
{
    public $idActividad;
    public function ajaxListarActividad()
    {
        $item = "idActividad";
        $valor = $this->idActividad;
        $respuesta = ActividadesControlador::ctrListarActividades($item, $valor);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["idActividad"])) {
    $listActividad = new AjaxActividades();
    $listActividad->idActividad = $_POST["idActividad"];
    $listActividad->ajaxListarActividad();
}
