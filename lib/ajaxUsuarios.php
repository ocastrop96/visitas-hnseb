<?php
require_once "../controllers/UsuariosControlador.php";
require_once "../models/UsuariosModelo.php";

class UsuariosAjax
{   
    public $idUsuario;
    public function ajaxListarUsuario()
    {
        $item = "id_usuario";
        $valor = $this->idUsuario;
        $respuesta = UsuariosControlador::ctrListarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }
    public $activarId;
    public $activarUsuario;

    public function CambiarEstado()
    {
        $tabla = "rv_usuarios";
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $item2 = "id_usuario";
        $valor2 = $this->activarId;
        $respuesta = UsuariosModelo::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }

    public $validaDNI;
    public function ajaxValidarDNI()
    {
        $item = "dni";
        $valor = $this->validaDNI;
        $respuesta = UsuariosControlador::ctrListarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }
    public $validaUsuario;
    public function ajaxValidarUsuario()
    {
        $item = "cuenta";
        $valor = $this->validaUsuario;
        $respuesta = UsuariosControlador::ctrListarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }
}
if (isset($_POST["idUsuario"])) {
    $list1 = new UsuariosAjax();
    $list1->idUsuario = $_POST["idUsuario"];
    $list1->ajaxListarUsuario();
}
// Activar Estado
if (isset($_POST["activarUsuario"])) {
    $activarEst = new UsuariosAjax();
    $activarEst->activarUsuario = $_POST["activarUsuario"];
    $activarEst->activarId = $_POST["activarId"];
    $activarEst->CambiarEstado();
}
if (isset($_POST["validaDNI"])) {
    $validarDNI = new UsuariosAjax();
    $validarDNI->validaDNI = $_POST["validaDNI"];
    $validarDNI->ajaxValidarDNI();
}

if (isset($_POST["validaUsuario"])) {
    $validarUsuario = new UsuariosAjax();
    $validarUsuario->validaUsuario = $_POST["validaUsuario"];
    $validarUsuario->ajaxValidarUsuario();
}
