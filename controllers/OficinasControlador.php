<?php
class OficinasControlador{
    static public function ctrListarOficinas($item,$valor){
        $tabla = "rv_oficinas";
        $respuesta = OficinasModelo::mdlListarOficinas($tabla,$item,$valor);
        return $respuesta;
    }
}