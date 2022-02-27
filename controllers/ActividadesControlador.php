<?php
class ActividadesControlador
{
    static public function ctrListarActividades($item, $valor)
    {
        $respuesta = ActividadesModelo::mdlListarActividades($item, $valor);
        return $respuesta;
    }
    static public function ctrListarActividadesParam($fechaInicialAct, $fechaFinalAct)
    {
        $repuesta = ActividadesModelo::mdlListarVisitasParam($fechaInicialAct, $fechaFinalAct);
        return $repuesta;
    }
    static public function ctrRegistrarActividad()
    {
        if (isset($_POST["fechaActi"]) && isset($_POST["horaActi"]) && isset($_POST["empActi"]) && isset($_POST["lugarAct"]) && isset($_POST["descActi"]) && isset($_POST["usuarioRegAct"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["empActi"]) &&
                preg_match('/^[0-9]+$/', $_POST["lugarAct"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ\-.,° ]+$/', $_POST["descActi"])
            ) {
                date_default_timezone_set('America/Lima');
                if ($_POST["empActi"] > 0 && $_POST["lugarAct"] > 0) {

                    // Seteo de Fecha
                    $fRV = $_POST["fechaActi"];
                    $dateFRA = str_replace('/', '-', $fRV);
                    $feActi = date('Y-m-d', strtotime($dateFRA));
                    // Seteo de Fecha
                    // Seteo de Hora
                    $sec = strtotime($_POST["horaActi"]);
                    $hActi = date("H:i", $sec);
                    $hActi = $hActi . ":00";
                    // Seteo de Hora

                    // Agrupamiento en datos
                    $datos = array(
                        "fechaAct" => $feActi,
                        "horaAct" => $hActi,
                        "descAct" => $_POST["descActi"],
                        "lugarAct" => $_POST["lugarAct"],
                        "empAct" => $_POST["empActi"],
                        "usuregAct" => $_POST["usuarioRegAct"]
                    );

                    $rptRegEC = ActividadesModelo::mdlRegistrarActividad($datos);
                    if ($rptRegEC == "ok") {
                        echo '<script>
                            Swal.fire({
                                type: "success",
                                title: "Se ha registrado con éxito",
                                showConfirmButton: false,
                                timer: 1200
                            });
                            function redirect() {
                                window.location = "registro-agenda";
                            }
                            setTimeout(redirect, 1200);
                            </script>';
                    } else {
                        echo '<script>
                        Swal.fire({
                        type: "error",
                        title: "Ha ocurrido un error al registrar los datos. Ingrese correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "registro-agenda";
                        }});
                    </script>';
                    }
                    // Agrupamiento en datos
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
                                window.location = "registro-agenda";
                            }});
                        </script>';
                }
            }
        }
    }
    static public function ctrEditarActividad()
    {
        if (isset($_POST["edtfechaActi"]) && isset($_POST["edthoraActi"]) && isset($_POST["edtempActi"]) && isset($_POST["edtlugarAct"]) && isset($_POST["edtdescActi"]) && isset($_POST["idActividad"])) {
            if (
                preg_match('/^[0-9]+$/', $_POST["edtempActi"]) &&
                preg_match('/^[0-9]+$/', $_POST["edtlugarAct"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ\-.,° ]+$/', $_POST["edtdescActi"])
            ) {
                date_default_timezone_set('America/Lima');
                if ($_POST["edtempActi"] > 0 && $_POST["edtlugarAct"] > 0) {
                    // Seteo de Fecha
                    $fRV = $_POST["edtfechaActi"];
                    $dateFRA = str_replace('/', '-', $fRV);
                    $feActi = date('Y-m-d', strtotime($dateFRA));
                    // Seteo de Fecha
                    // Seteo de Hora
                    $sec = strtotime($_POST["edthoraActi"]);
                    $hActi = date("H:i", $sec);
                    $hActi = $hActi . ":00";
                    // Seteo de Hora

                    // Agrupamiento en datos
                    $datos = array(
                        "fechaAct" => $feActi,
                        "horaAct" => $hActi,
                        "descAct" => $_POST["edtdescActi"],
                        "lugarAct" => $_POST["edtlugarAct"],
                        "empAct" => $_POST["edtempActi"],
                        "idActividad" => $_POST["idActividad"]
                    );

                    $rptRegEC2 = ActividadesModelo::mdlEditarActividad($datos);
                    if ($rptRegEC2 == "ok") {
                        echo '<script>
                            Swal.fire({
                                type: "success",
                                title: "Se ha editado con éxito",
                                showConfirmButton: false,
                                timer: 1200
                            });
                            function redirect() {
                                window.location = "registro-agenda";
                            }
                            setTimeout(redirect, 1200);
                            </script>';
                    } else {
                        echo '<script>
                        Swal.fire({
                        type: "error",
                        title: "Ha ocurrido un error al registrar los datos. Ingrese correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                            window.location = "registro-agenda";
                        }});
                    </script>';
                    }
                    // Agrupamiento en datos
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
                                window.location = "registro-agenda";
                            }});
                        </script>';
                }
            }
        }
    }
    static public function ctrEliminarActividad()
    {
        if (isset($_GET["idActividad"])) {
            $datos = $_GET["idActividad"];

            $respuesta = ActividadesModelo::mdlEliminarActividad($datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                            type: "success",
                            title: "¡La actividad ha sido eliminada con éxito!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        function redirect() {
                            window.location = "registro-agenda";
                        }
                        setTimeout(redirect, 1500);
                    </script>';
            }
        }
    }
}
