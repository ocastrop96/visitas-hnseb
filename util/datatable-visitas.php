<?php
require_once "../controllers/VisitasControlador.php";
require_once "../models/VisitasModelo.php";

class TablaVisitas
{
    public function mostrarVisitasTable()
    {
        $ofiOcu= $_GET["oficinaOculta"];
        $item = null;
        $valor = null;
        $visitas = VisitasControlador::ctrListarVisitas($item, $valor);
        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($visitas); $i++) {
            // $botones = "<div class='btn-group'><button class='btn btn-info btnRegistrarSalida' idVisita='" . $visitas[$i]["idVisita"] . "' data-toggle='modal' data-target='#modal-registrar-salida'><i class='fas fa-clipboard-check'></i></button><div class='btn-group'><button class='btn btn-warning btnEditarVisita' idVisita='" . $visitas[$i]["idVisita"] . "' data-toggle='modal' data-target='#modal-editar-visita'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarVisita' idVisita='" . $visitas[$i]["idVisita"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            // Bloque de estado
            if ($visitas[$i]["estadoV"] == 1) {
                $estadoVisita = "<button type='button' class='btn btn-block btn-secondary btn-sm'><i class='fas fa-clock'></i>&nbsp;" . $visitas[$i]["descEstado"] . "</button>";
                $botones = "<button class='btn btn-block btn-info btnRegistrarSalida' idVisita='" . $visitas[$i]["idVisita"] . "' data-toggle='modal' data-target='#modal-registrar-salida'><i class='fas fa-clipboard-check'></i>Registrar Salida</button>";
            } elseif ($visitas[$i]["estadoV"] == 2) {
                $estadoVisita = "<button type='button' class='btn btn-block btn-success btn-sm'><i class='fas fa-check-circle'></i>&nbsp;" . $visitas[$i]["descEstado"] . "</button>";
                $botones="<button type='button' class='btn btn-block btn-secondary btn-sm'><i class='fas fa-save'></i>&nbsp; FINALIZADA</button>";
            } elseif ($visitas[$i]["estadoV"] == 3) {
                $estadoVisita = "<button type='button' class='btn btn-block btn-danger btn-sm'><i class='fas fa-times-circle'></i>&nbsp;" . $visitas[$i]["descEstado"] . "</button>";
                $botones="<button type='button' class='btn btn-block btn-secondary btn-sm'><i class='fas fa-save'></i>&nbsp; FINALIZADA</button>";
            } elseif ($visitas[$i]["estadoV"] == 4) {
                $estadoVisita = "<button type='button' class='btn btn-block btn-warning btn-sm'><i class='fas fa-user-times'></i>&nbsp;" . $visitas[$i]["descEstado"] . "</button>";
                $botones="<button type='button' class='btn btn-block btn-secondary btn-sm'><i class='fas fa-save'></i>&nbsp; FINALIZADA</button>";
            }
            // Bloque de estado
            $datos_json .= '[
                "' . $ofiOcu . '",
                "' . $visitas[$i]["fVisita"] . '",
                "' . $visitas[$i]["hEntrada"] . '",
                "' . $visitas[$i]["descTDoc"] . "-" . $visitas[$i]["vstNdoc"] . '",
                "' . $visitas[$i]["vstNombre"] . '",
                "' . $visitas[$i]["vstEntidad"] . '",
                "' . $visitas[$i]["vstMotivo"] . '",
                "' . $visitas[$i]["empVisitado"] . '",
                "' . $visitas[$i]["ofidepVisitado"] . "/<br>" . $visitas[$i]["cargoVisitado"] . '",
                "' . $visitas[$i]["lugarVst"] . '",
                "' . $visitas[$i]["hSalida"] . '",
                "' . $estadoVisita . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}

$tablaVisitas = new TablaVisitas();
$tablaVisitas->mostrarVisitasTable();
