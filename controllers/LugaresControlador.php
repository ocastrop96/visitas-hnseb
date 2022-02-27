<?php
class LugaresControlador
{
    static public function ctrListarLugares($item, $valor)
    {
        $tabla = "rv_lugares";
        $respuesta = LugaresModelo::mdlListarLugares($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrListarLugaresAct($item, $valor)
    {
        $respuesta = LugaresModelo::mdlListarLugaresAct($item, $valor);
        return $respuesta;
    }
    static public function ctrRegistrarLugar()
    {
        if (isset($_POST["newLugar"])) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ].+$/', $_POST["newLugar"])
            ) {
                $tabla = "rv_lugares";
                $datos = $_POST["newLugar"];

                $rptRegLugar = LugaresModelo::mdlRegistrarLugar($tabla, $datos);
                if ($rptRegLugar == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El lugar ha sido registrado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "lugares";
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
                                window.location = "lugares";
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
                    window.location = "lugares";
                }});
            </script>';
            }
        }
    }
    static public function ctrEditarLugar()
    {
        if (isset($_POST["edtLugar"])) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ].+$/', $_POST["edtLugar"])
            ) {
                $tabla = "rv_lugares";

                $datos = array(
                    "descLugar" => $_POST["edtLugar"],
                    "id" => $_POST["idLugar"]
                );
                $rptEditLugar = LugaresModelo::mdlEditarLugar($tabla, $datos);
                if ($rptEditLugar == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El lugar ha sido editado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "lugares";
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
                                window.location = "lugares";
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
                    window.location = "lugares";
                }});
            </script>';
            }
        }
    }

    static public function ctrEliminarLugar()
    {
        if (isset($_GET["idLugar"])) {
            $tabla = "rv_lugares";
            $datos = $_GET["idLugar"];
            $respuesta = LugaresModelo::mdlEliminarLugar($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                        type: "success",
                        title: "¡El lugar ha sido eliminado con éxito!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "lugares";
                        }});
                    </script>';
            }
        }
    }
}
