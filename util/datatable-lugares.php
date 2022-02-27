<?php
require_once "../controllers/LugaresControlador.php";
require_once "../models/LugaresModelo.php";

class TablasLugares
{
    public function mostrarLugares()
    {
        $item = null;
        $valor = null;
        $lugares = LugaresControlador::ctrListarLugares($item, $valor);
        $datos_json = '{
            "data": [';
        for ($i = 0; $i < count($lugares); $i++) {
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarLugar' idLugar='" . $lugares[$i]["idLugar"] . "' data-toggle='modal' data-target='#modal-editar-lugar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarLugar' idLugar='" . $lugares[$i]["idLugar"] . "'><i class='fas fa-trash-alt'></i></button></div>";
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $lugares[$i]["descLugar"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaLugares = new TablasLugares();
$tablaLugares->mostrarLugares();

