<?php
class TipoDocumentoControlador{
    static public function ctrListarTipoDocumento($item,$valor){
        $tabla = "rv_tdoc";
        $respuesta = TipoDocumentoModelo::mdListarTipoDocumento($tabla, $item, $valor);
        return $respuesta;
    }
}