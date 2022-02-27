<?php
class MotivosControlador
{
    static public function ctrListarMotivos($item, $valor)
    {
        $tabla = "rv_motivos";
        $respuesta = MotivosModelo::mdlListarMotivos($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrRegistraMotivos()
    {
        if (isset($_POST["newMotivo"])) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ].+$/', $_POST["newMotivo"])
            ) {
                $tabla = "rv_motivos";
                $datos = $_POST["newMotivo"];

                $rptRegMotivo = MotivosModelo::mdlRegistrarMotivo($tabla, $datos);
                if ($rptRegMotivo == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El motivo ha sido registrado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "motivos";
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
                                window.location = "motivos";
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
                    window.location = "motivos";
                }});
            </script>';
            }
        }
    }
    static public function ctrEditarMotivos()
    {
        if (isset($_POST["edtMotivo"])) {
            if (
                preg_match('/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ].+$/', $_POST["edtMotivo"])
            ) {
                $tabla = "rv_motivos";

                $datos = array(
                    "descMotivo" => $_POST["edtMotivo"],
                    "id" => $_POST["idMotivo"]
                );
                $rptEditMotivo = MotivosModelo::mdlEditarMotivo($tabla, $datos);
                if ($rptEditMotivo == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "El motivo ha sido editado con éxito",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                          }).then((result)=>{
                            if(result.value){
                                window.location = "motivos";
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
                                window.location = "motivos";
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
                    window.location = "motivos";
                }});
            </script>';
            }
        }
    }

    static public function ctrEliminarMotivos()
    {
        if (isset($_GET["idMotivo"])) {
            $tabla = "rv_motivos";
            $datos = $_GET["idMotivo"];

            $respuesta = MotivosModelo::mdlEliminarMotivo($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                        type: "success",
                        title: "¡El motivo ha sido eliminado con éxito!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "motivos";
                        }});
                    </script>';
            }
        }
    }
}
