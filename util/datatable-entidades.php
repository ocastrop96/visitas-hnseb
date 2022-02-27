<?php
require_once "../controllers/EntidadesControlador.php";
require_once "../models/EntidadesModelo.php";

class TablaEntidades
{
    public function mostrarEntidades()
    {
        $item = null;
        $valor = null;
        $entidades = EntidadesControlador::ctrListarEntidades($item, $valor);
        $datos_json = '{
            "data": [';
        for ($i = 0; $i < count($entidades); $i++) {
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarEntidad' idEntidad='" . $entidades[$i]["idEntidad"] . "' data-toggle='modal' data-target='#modal-editar-entidad'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarEntidad' idEntidad='" . $entidades[$i]["idEntidad"] . "'><i class='fas fa-trash-alt'></i></button></div>";
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $entidades[$i]["docRuc"] . '",
                "' . $entidades[$i]["descEntidad"] . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}
$tablaEntidades = new TablaEntidades();
$tablaEntidades->mostrarEntidades();
