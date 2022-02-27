<?php
require_once "../controllers/UsuariosControlador.php";
require_once "../models/UsuariosModelo.php";

class TablaUsuarios
{
    public function mostrarTablaUsuarios()
    {
        $item = null;
        $valor = null;
        $usuarios = UsuariosControlador::ctrListarUsuarios($item, $valor);

        $datos_json = '{
            "data": [';

        for ($i = 0; $i < count($usuarios); $i++) {
            // Perfil con iconos
            if ($usuarios[$i]["rolId"] == 1) {
                $perfil = "<i class='fas fa-user-tie'></i>&nbsp" . $usuarios[$i]["dscRol"] . "";
            } else {
                $perfil = "<i class='fas fa-user-cog'></i>&nbsp" . $usuarios[$i]["dscRol"] . "";
            }
            //Botones de activado o desactivo
            if (($usuarios[$i]["estado"] != 0)) {
                $actdesact = "<button type='button' class='btn btn-block btn-success btnActivar' idUsuario='" . $usuarios[$i]["id_usuario"] . "' estadoUsuario='0'><i class='fas fa-user-check'></i>Activo</button>";
            } else {
                $actdesact = "<button type='button' class='btn btn-block btn-danger btnActivar' idUsuario='" . $usuarios[$i]["id_usuario"] . "' estadoUsuario='0'><i class='fas fa-user-minus'></i>Inactivo</button>";
            }

            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='" . $usuarios[$i]["id_usuario"] . "' data-toggle='modal' data-target='#modal-editar-usuario'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnEliminarUsuario' idUsuario='" . $usuarios[$i]["id_usuario"] . "'><i class='fas fa-trash-alt'></i></button></div>";
            // Convert fecha
            $datos_json .= '[
                "' . ($i + 1) . '",
                "' . $usuarios[$i]["dni"] . '",
                "' . $usuarios[$i]["nombres"] . '",
                "' . $usuarios[$i]["aPaterno"] . " " . $usuarios[$i]["aMaterno"] . '",
                "' . $perfil . '",
                "' . $usuarios[$i]["descOficina"] . '",
                "' . $usuarios[$i]["correo"] . '",
                "' . $usuarios[$i]["cuenta"] . '",
                "' . $actdesact . '",
                "' . $botones . '"
            ],';
        }
        $datos_json = substr($datos_json, 0, -1);
        $datos_json .= ']
        }';
        echo $datos_json;
    }
}

$tablaUsuarios = new TablaUsuarios();
$tablaUsuarios->mostrarTablaUsuarios();