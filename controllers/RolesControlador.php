<?php
class RolesControlador{
    static public function ctrListarRoles($item,$valor){
        $tablas = "rv_roles";
        $respuesta = RolesModelo::mdlListarRoles($tablas,$item,$valor);
        return $respuesta;
    }
}