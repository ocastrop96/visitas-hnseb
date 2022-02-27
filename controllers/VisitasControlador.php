<?php
class VisitasControlador
{
    static public function ctrListarVisitas($item, $valor)
    {
        $tabla = "rv_visitas";
        $repuesta = VisitasModelo::mdlListarVisitas($tabla, $item, $valor);
        return $repuesta;
    }

    static public function ctrListarVisitasParam($Ofi, $fechaInicial, $fechaFinal)
    {
        $repuesta = VisitasModelo::mdlListarVisitasParam($Ofi, $fechaInicial, $fechaFinal);
        return $repuesta;
    }

    static public function ctrListarVisitasGeneral($fechaInicialRG, $fechaFinalRG)
    {
        $repuesta = VisitasModelo::mdlReporteGeneralF($fechaInicialRG, $fechaFinalRG);
        return $repuesta;
    }
    static public function ctrListarVisitasGrafico($fechaInicialRG, $fechaFinalRG)
    {
        $repuesta = VisitasModelo::mdlReporteGrafico($fechaInicialRG, $fechaFinalRG);
        return $repuesta;
    }

    static public function ctrRegistrarVisita()
    {
        if (
            isset($_POST["usuarioReg"]) &&
            isset($_POST["vTDoc"]) &&
            isset($_POST["vNDoc"]) &&
            isset($_POST["vNAVis"]) &&
            isset($_POST["vEntidad"]) &&
            isset($_POST["vMotivo"]) &&
            isset($_POST["vPersonal"]) &&
            isset($_POST["vOficina"]) &&
            isset($_POST["vCargo"]) &&
            isset($_POST["vLugar"])
        ) {
            if (
                preg_match('/^[0-9]+$/', $_POST["vTDoc"]) &&
                preg_match('/^[0-9]+$/', $_POST["vNDoc"]) &&
                preg_match('/^[A-ZÑÁÉÍÓÚ ]+$/', $_POST["vNAVis"]) &&
                preg_match('/^[0-9]+$/', $_POST["vEntidad"])
            ) {
                // Bloque de seteo de hora y fecha local
                date_default_timezone_set('America/Lima');
                $horaIngreso = date("H:i") . ":00";
                $fechaVisita = date("Y-m-d");

                $datos = array(
                    "fechaVisita" => $fechaVisita,
                    "horaIngreso" => $horaIngreso,
                    "vstNombre" => $_POST["vNAVis"],
                    "vstNdoc" => $_POST["vNDoc"],
                    "cargoVisitado" => $_POST["vCargo"],
                    "vstDoc" => $_POST["vTDoc"],
                    "vstEntidad" => $_POST["vEntidad"],
                    "vstMotivo" => $_POST["vMotivo"],
                    "empVisitado" => $_POST["vPersonal"],
                    "ofidepVisitado" => $_POST["vOficina"],
                    "lugarVst" => $_POST["vLugar"],
                    "registraIngreso" => $_POST["usuarioReg"]
                );

                $rptRegistroVisita = VisitasModelo::mdlRegistrarVisita($datos);

                if ($rptRegistroVisita == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "¡La visita ha sido registrada con éxito!",
                            showConfirmButton: false,
                            timer: 10000
                          });
                            window.location = "registro";
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
                                window.location = "registro";
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
                    window.location = "registro";
                }});
            </script>';
            }
        }
    }

    static public function ctrRegistrarSalida()
    {
        if (isset($_POST["vsEstadoF"]) && isset($_POST["vsHSalidaF"])) {
            if (preg_match('/^[0-9]+$/', $_POST["vsEstadoF"])) {

                date_default_timezone_set('America/Lima');
                $fechaRSalida = date("Y-m-d");
                // $hSalida = $_POST["vsHSalidaF"];

                // Conversión de Hora
                $sec = strtotime($_POST["vsHSalidaF"]);
                $hsalidaOut1 = date("H:i", $sec);
                $hsalidaOut1 = $hsalidaOut1 . ":00";

                $datos = array(
                    "fechaHRegSalida" => $fechaRSalida,
                    "horaSalida" => $hsalidaOut1,
                    "estadoV" => $_POST["vsEstadoF"],
                    "registraSalida" => $_POST["idRegSalida"],
                    "idVisita" => $_POST["idVisita"],
                );

                $rptRegSalida = VisitasModelo::mdlRegistrarSalida($datos);
                if ($rptRegSalida == "ok") {
                    echo '<script>
                          Swal.fire({
                            type: "success",
                            title: "¡Se ha registrado con éxito el fin de la visita!",
                            showConfirmButton: false,
                            timer: 1800
                          });
                        window.location = "registro";
                      </script>';
                } else {
                    echo '<script>
                            Swal.fire({
                            type: "error",
                            title: "Hubo un error al registrar los datos",
                            showConfirmButton: false,
                            timer: 1500
                            });
                        window.location = "registro";
                        </script>';
                }
            } else {
                echo '<script>
                Swal.fire({
                type: "error",
                title: "Ingrese correctamente sus datos",
                showConfirmButton: false,
                timer: 1500
                });
                window.location = "registro";
            </script>';
            }
        }
    }

    static public function ctrDescargarReporte()
    {
        if (isset($_GET["reporte"])) {
            if (isset($_GET["fechaInicialR"]) && isset($_GET["fechaFinalR"])) {
                $Ofi = $_GET["Oficina"];
                $visitasReport = VisitasModelo::mdlListarVisitasParam($Ofi, $_GET["fechaInicialR"], $_GET["fechaFinalR"]);
                $Name = 'REPORTE_VISITAS_DE_' . $_GET["fechaInicialR"] . '_A_' . $_GET["fechaFinalR"] . '.xls';
            } else {
                $visitasReport = VisitasModelo::mdlListarVisitasOficina($_GET["Oficina"]);
                $Name = $_GET["reporte"] . '-' . date('d-m-Y H:i:s') . '.xls';
            }
            // Creación de archivo excel

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>N°</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA VISITA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>HORA VISITA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TIPO N° DOC</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VISITANTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ENTIDAD O EMPRESA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>EMPLEADO VISITADO</td>		
                    <td style='font-weight:bold; border:1px solid #eee;'>OFICINA O DEPT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>CARGO</td>	
                    <td style='font-weight:bold; border:1px solid #eee;'>LUGAR DE VISITA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>HORA SALIDA</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>ESTADO FINAL</td>		
                    </tr>");
            foreach ($visitasReport as $row => $item) {
                echo utf8_decode("<tr>
                <td style='border:1px solid #eee;'>" . ($row + 1) . "</td>
                <td style='border:1px solid #eee;'>" . $item["fechaVisita"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["hEntrada"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descTDoc"] . "-" . $item["vstNdoc"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["vstNombre"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descEntidad"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descMotivo"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["nombresEmp"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descOficina"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["cargoVisitado"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descLugar"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["hSalida"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descEstado"] . "</td>
                </tr>");
            }
            echo "</table>";
        }
    }

    static public function ctrDescargarReporteGeneral()
    {
        if (isset($_GET["reporte"])) {
            if (isset($_GET["fechaInicialRG"]) && isset($_GET["fechaFinalRG"])) {
                $visitasReport1 = VisitasModelo::mdlReporteGeneralF($_GET["fechaInicialRG"], $_GET["fechaFinalRG"]);
                $Name = 'REPORTE_GENERAL_VISITAS_DE_' . $_GET["fechaInicialRG"] . '_A_' . $_GET["fechaFinalRG"] . '.xls';
            } else {
                $visitasReport1 = VisitasModelo::mdlReporteGeneral();
                $Name = $_GET["reporte"] . '-' . date('d-m-Y H:i:s') . '.xls';
            }
            // Creación de archivo excel

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>N°</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA VISITA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>HORA VISITA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TIPO N° DOC</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VISITANTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ENTIDAD O EMPRESA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MOTIVO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>EMPLEADO VISITADO</td>		
                    <td style='font-weight:bold; border:1px solid #eee;'>OFICINA O DEPT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>CARGO</td>	
                    <td style='font-weight:bold; border:1px solid #eee;'>LUGAR DE VISITA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>HORA SALIDA</td>		
                    <td style='font-weight:bold; border:1px solid #eee;'>ESTADO FINAL</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>FECHA_REG_ENT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>USUARIO_REG_ENT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>FECHA_REG_SAL</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>USUARIO_REG_SAL</td>			
                    </tr>");
            foreach ($visitasReport1 as $row => $item) {
                echo utf8_decode("<tr>
                <td style='border:1px solid #eee;'>" . ($row + 1) . "</td>
                <td style='border:1px solid #eee;'>" . $item["fechaVisita"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["hEntrada"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descTDoc"] . "-" . $item["vstNdoc"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["vstNombre"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descEntidad"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descMotivo"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["nombresEmp"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descOficina"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["cargoVisitado"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descLugar"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["hSalida"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["descEstado"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["fechaVisita"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["UsuarioRegistro"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["fRegSalida"] . "</td>
                <td style='border:1px solid #eee;'>" . $item["UsuarioSalida"] . "</td>
                </tr>");
            }
            echo "</table>";
        }
    }
}
