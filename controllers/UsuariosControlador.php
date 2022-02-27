<?php
class UsuariosControlador
{
    static public function ctrLogUsuario()
    {
        if (isset($_POST["rvCuenta"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["rvCuenta"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ].+$/', $_POST["rvClave"])
            ) {
                $tabla = "rv_usuarios";
                $item = "cuenta";
                $valor = $_POST["rvCuenta"];
                $encriptacion = crypt($_POST["rvClave"], '$2a$07$usesomesillystringforsalt$');
                $respuesta = UsuariosModelo::mdlListarUsuarios($tabla, $item, $valor);
                if ($respuesta["cuenta"] == $_POST["rvCuenta"] && $respuesta["clave"] == $encriptacion) {

                    if ($respuesta["estado"] == 1) {
                        // Datos a usar en sesiones
                        $_SESSION["loginRV1"] = "ok";
                        $_SESSION["idReg"] = $respuesta["id_usuario"];
                        $_SESSION["cuenta_reg"] = $respuesta["cuenta"];
                        $_SESSION["nombres_reg"] = $respuesta["nombres"];
                        $_SESSION["paterno_reg"] = $respuesta["aPaterno"];
                        $_SESSION["perfil_reg"] = $respuesta["rolId"];
                        $_SESSION["oficina_reg"] = $respuesta["oficinaId"];
                        echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "Acceso concedido...¡Bienvenido!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "registro";
                            }});
                      </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                type: "warning",
                                title: "El usuario se encuentra desactivado, comuníquese con el administrador del sistema"
                                }).then((result)=>{
                                if(result.value){
                                    window.location = "login";
                                }});
                            </script>';
                    }
                } else {
                    echo '<script>
                    Swal.fire({
                      type: "error",
                      title: "El usuario y/o contraseña ingresados no son correctos"
                    }).then((result)=>{
                      if(result.value){
                          window.location = "login";
                      }});
                </script>';
                }
            }
        }
    }

    static public function ctrListarUsuarios($item, $valor)
    {
        $tabla = "rv_usuarios";
        $respuesta = UsuariosModelo::mdlListarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrRegistrarUsuario()
    {
        if (isset($_POST["newDNI"]) && isset($_POST["newUsuario"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["newUsuario"]) &&
                preg_match('/^[a-zA-Z0-9].+$/', $_POST["newPasswd"])
            ) {
                $encriptacion1 = crypt($_POST["newPasswd"], '$2a$07$usesomesillystringforsalt$');

                $datos = array(
                    "dni" => $_POST["newDNI"],
                    "nombres" => $_POST["newNombres"],
                    "aPaterno" => $_POST["newAPaterno"],
                    "aMaterno" => $_POST["newAMaterno"],
                    "cuenta" => $_POST["newUsuario"],
                    "clave" => $encriptacion1,
                    "correo" => $_POST["newCorreo"],
                    "oficinaId" => $_POST["newOficina"],
                    "rolId" => $_POST["newRol"],
                );
                $regUsuario = UsuariosModelo::mdlCrearUsuario($datos);
                if ($regUsuario == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "¡El usuario ha sido registrado con éxito!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }});
                      </script>';
                } else {
                    echo '<script>
                            Swal.fire({
                            type: "error",
                            title: "Hubo un error al registrar los datos, ingrese correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }});
                        </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                type: "error",
                title: "Ingrese correctamente sus datos",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
                }).then((result)=>{
                if(result.value){
                    window.location = "usuarios";
                }});
            </script>';
            }
        }
    }

    static public function ctrEditarUsuario()
    {
        if (isset($_POST["edtDNI"]) && isset($_POST["edtUsuario"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["edtDNI"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $_POST["edtUsuario"])
            ) {

                if ($_POST["edtPasswd"] != "") {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ].+$/', $_POST["edtPasswd"])) {
                        $encriptacion2 = crypt($_POST["edtPasswd"], '$2a$07$usesomesillystringforsalt$');
                    } else {
                        echo '<script>
                            Swal.fire({
                                type: "error",
                                title: "La contraseña no debe contener caracteres, se admiten mayusculas, minusculas y puntos",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result)=>{
                                if(result.value){
                                    window.location = "usuarios";
                                }});
                            </script>';
                    }
                } else {
                    $encriptacion2 = $_POST["passActual"];
                }


                $datos = array(
                    "dni" => $_POST["edtDNI"],
                    "nombres" => $_POST["edtNombres"],
                    "aPaterno" => $_POST["edtAPaterno"],
                    "aMaterno" => $_POST["edtAMaterno"],
                    "cuenta" => $_POST["edtUsuario"],
                    "clave" => $encriptacion2,
                    "correo" => $_POST["edtCorreo"],
                    "oficinaId" => $_POST["edtOficina"],
                    "rolId" => $_POST["edtRol"],
                    "id_usuario" => $_POST["idUsuario"]
                );
                $rpEditaUsuario = UsuariosModelo::mdlEditarUsuario($datos);
                if ($rpEditaUsuario == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "¡El usuario ha sido editado con éxito!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }});
                      </script>';
                } else {
                    echo '<script>
                            Swal.fire({
                            type: "error",
                            title: "Hubo un error al editar los datos, ingrese correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }});
                        </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                type: "error",
                title: "Ingrese correctamente sus datos",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
                }).then((result)=>{
                if(result.value){
                    window.location = "usuarios";
                }});
            </script>';
            }
        }
    }

    static public function ctrEliminarUsuario()
    {if (isset($_GET["idUsuario"])) {
        $tabla = "rv_usuarios";
        $datos = $_GET["idUsuario"];

        $respuesta =UsuariosModelo::mdlEliminarUsuario($tabla, $datos);

        if ($respuesta == "ok") {
            echo '<script>
                    Swal.fire({
                    type: "success",
                    title: "¡El usuario ha sido eliminado con éxito!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }});
                </script>';
        }
    }
    }
}
