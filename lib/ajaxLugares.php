<?php
require_once "../controllers/LugaresControlador.php";
require_once "../models/LugaresModelo.php";

class LugaresAjax
{
    public $idLugar;
    public function ajaxListarLugar()
    {
        $item = "idLugar";
        $valor = $this->idLugar;
        $respuesta = LugaresControlador::ctrListarLugares($item, $valor);
        echo json_encode($respuesta);
    }

    public $validaLugar;
    public function ajaxValidarDobleLugar()
    {
        $item = "descLugar";
        $valor = $this->validaLugar;
        $respuesta = LugaresControlador::ctrListarLugares($item, $valor);

        echo json_encode($respuesta);
    }


    public $validaLugar2;
    public function ajaxValidarDobleLugar2()
    {
        $item = "descLugar";
        $valor = $this->validaLugar2;
        $respuesta = LugaresControlador::ctrListarLugaresAct($item, $valor);

        echo json_encode($respuesta);
    }
}
if (isset($_POST["idLugar"])) {
    $list1 = new LugaresAjax();
    $list1->idLugar = $_POST["idLugar"];
    $list1->ajaxListarLugar();
}
if (isset($_POST["validaLugar"])) {
    $validar = new LugaresAjax();
    $validar->validaLugar = $_POST["validaLugar"];
    $validar->ajaxValidarDobleLugar();
}

if (isset($_POST["validaLugar2"])) {
    $validar2 = new LugaresAjax();
    $validar2->validaLugar2 = $_POST["validaLugar2"];
    $validar2->ajaxValidarDobleLugar2();
}
