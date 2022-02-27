<?php
class EstadoVisitaControlador
{
    static public function ctrListarEstados($item, $valor)
    {
        $tabla = "rv_estadovisita";
        $respuesta = EstadoVisitaModelo::mdListarEstados($tabla, $item, $valor);
        return $respuesta;
    }
}
