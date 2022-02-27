<?php
require_once "../controllers/MotivosControlador.php";
require_once "../models/MotivosModelo.php";

class TablasMotivo
{
    public function mostrarMotivos()
    {
        $item = null;
        $valor = null;
        $motivos = MotivosControlador::ctrListarMotivos($item, $valor);
        $datos_json = '{
            "data": [';
        for ($i = 0; $i < count($motivos); $i++) {
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarMotivo' idMotivo='" . $motivos[$i]["idMotivo"] . "' data-toggle='modal' data-target='#modal-editar-motivo'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarMotivo' idMotivo='" . $motivos[$i]["idMotivo"] . "'><i class='fas fa-trash-alt'></i></button></div>";
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $motivos[$i]["descMotivo"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaMotivos = new TablasMotivo();
$tablaMotivos->mostrarMotivos();

