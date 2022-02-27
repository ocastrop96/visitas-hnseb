<?php
class EntidadesControlador
{
    static public function ctrListarEntidades($item, $valor)
    {
        $tabla = "rv_entidades";
        $respuesta = EntidadesModelo::mdlListarEntidades($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrRegistrarEntidad()
    {
        if (isset($_POST["newRUC"]) && isset($_POST["newRS"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ].+$/', $_POST["newRS"]) &&
                preg_match('/^[0-9]+$/', $_POST["newRUC"])
            ) {
                $tabla = "rv_entidades";
                $datos = array(
                    "docRuc" => $_POST["newRUC"],
                    "descEntidad" => $_POST["newRS"]
                );
                $rptRegEntidad = EntidadesModelo::mdlRegistrarEntidad($tabla, $datos);
                if ($rptRegEntidad == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "La entidad ha sido registrada con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "entidades";
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
                                window.location = "entidades";
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
                    window.location = "entidades";
                }});
            </script>';
            }
        }
    }
    static public function ctrEditarEntidad()
    {
        if (isset($_POST["edtRUC"]) && isset($_POST["edtRS"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ].+$/', $_POST["edtRS"]) &&
                preg_match('/^[0-9]+$/', $_POST["edtRUC"])
            ) {
                $tabla = "rv_entidades";
                $datos = array(
                    "docRuc" => $_POST["edtRUC"],
                    "descEntidad" => $_POST["edtRS"],
                    "idEntidad" => $_POST["idEntidad"]
                );
                $rptEditaEntidad = EntidadesModelo::mdlEditarEntidad($tabla, $datos);
                if ($rptEditaEntidad == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "La entidad ha sido editada con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "entidades";
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
                                window.location = "entidades";
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
                    window.location = "entidades";
                }});
            </script>';
            }
        }
    }
    static public function ctrEliminarEntidad()
    {
        if (isset($_GET["idEntidad"])) {
            $tabla = "rv_entidades";
            $datos = $_GET["idEntidad"];

            $respuesta = EntidadesModelo::mdlEliminarEntidad($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                        type: "success",
                        title: "¡La entidad ha sido eliminada con éxito!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "entidades";
                        }});
                    </script>';
            }
        }
    }
}
