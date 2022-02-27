<?php
require_once "connectDBV.php";
class VisitasModelo
{
    static public function mdlListarVisitas($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT vis.idVisita,vis.fechaVisita,date_format(vis.fechaVisita,'%d/%m/%Y') as fVisita,vis.vstNombre,tdoc.descTDoc,vis.vstNdoc,ent.descEntidad,vis.vstMotivo,mot.descMotivo,vis.empVisitado,emp.nombresEmp,vis.ofidepVisitado,of.descOficina,vis.cargoVisitado,vis.lugarVst,lug.descLugar,time_format(vis.horaIngreso,'%r') as hEntrada,time_format(vis.horaSalida,'%r') as hSalida,vis.estadoV,rest.descEstado FROM $tabla as vis inner join rv_tdoc as tdoc on vis.vstDoc = tdoc.idTdoc inner join rv_estadovisita as rest on vis.estadoV = rest.idEstado inner join rv_entidades as ent on vis.vstEntidad = ent.idEntidad inner join rv_motivos as mot on vis.vstMotivo = mot.idMotivo inner join rv_empleados as emp on vis.empVisitado = emp.idEmpleado inner join rv_oficinas as of on vis.ofidepVisitado = of.idOficina inner join rv_lugares as lug on vis.lugarVst = lug.idLugar WHERE $item = :$item order by idVisita desc");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL LIST_REGISTRADOR_VISITA()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarVisitasOficina($Oficina)
    {

        $stmt = Conexion::conectar()->prepare("CALL LISTAR_VISITAS_1(:Oficina)");
        $stmt->bindParam(":Oficina", $Oficina, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarVisitasParam($Ofi, $fechaInicial, $fechaFinal)
    {
        if ($fechaInicial == null) {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_VISITAS_1(:Ofi)");
            $stmt->bindParam(":Ofi", $Ofi, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicial == $fechaFinal) {

            $stmt = Conexion::conectar()->prepare("CALL LISTAR_VISITAS_2(:Ofi,:fechaFinal);");
            $stmt->bindParam(":Ofi", $Ofi, PDO::PARAM_INT);
            $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if ($fechaFinalMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("CALL LISTAR_VISITAS_3(:Ofi,:fechaInicial,:fechaFinalMasUno)");
                $stmt->bindParam(":Ofi", $Ofi, PDO::PARAM_INT);
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("CALL LISTAR_VISITAS_3(:Ofi,:fechaInicial,:fechaFinal)");
                $stmt->bindParam(":Ofi", $Ofi, PDO::PARAM_INT);
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarVisita($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL REGISTAR_VISITA_REG(:fechaVisita,:vstNombre,:vstDoc,:vstNdoc,:vstEntidad,:vstMotivo,:empVisitado,:ofidepVisitado,:cargoVisitado,:lugarVst,:horaIngreso,:registraIngreso)");

        $stmt->bindParam(":vstDoc", $datos["vstDoc"], PDO::PARAM_INT);
        $stmt->bindParam(":vstEntidad", $datos["vstEntidad"], PDO::PARAM_INT);
        $stmt->bindParam(":vstMotivo", $datos["vstMotivo"], PDO::PARAM_INT);
        $stmt->bindParam(":empVisitado", $datos["empVisitado"], PDO::PARAM_INT);
        $stmt->bindParam(":ofidepVisitado", $datos["ofidepVisitado"], PDO::PARAM_INT);
        $stmt->bindParam(":lugarVst", $datos["lugarVst"], PDO::PARAM_INT);
        $stmt->bindParam(":registraIngreso", $datos["registraIngreso"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaVisita", $datos["fechaVisita"], PDO::PARAM_STR);
        $stmt->bindParam(":vstNombre", $datos["vstNombre"], PDO::PARAM_STR);
        $stmt->bindParam(":vstNdoc", $datos["vstNdoc"], PDO::PARAM_STR);
        $stmt->bindParam(":cargoVisitado", $datos["cargoVisitado"], PDO::PARAM_STR);
        $stmt->bindParam(":horaIngreso", $datos["horaIngreso"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlRegistrarSalida($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL REGISTRAR_SALIDA_REG(:horaSalida,:fechaHRegSalida,:registraSalida,:estadoV,:idVisita)");
        $stmt->bindParam(":idVisita", $datos["idVisita"], PDO::PARAM_INT);
        $stmt->bindParam(":estadoV", $datos["estadoV"], PDO::PARAM_INT);
        $stmt->bindParam(":registraSalida", $datos["registraSalida"], PDO::PARAM_INT);
        $stmt->bindParam(":horaSalida", $datos["horaSalida"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaHRegSalida", $datos["fechaHRegSalida"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlReporteGeneral()
    {
        $stmt = Conexion::conectar()->prepare("CALL REPORTE_GENERAL()");
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }
    static public function mdlReporteGeneralF($fechaInicialRG, $fechaFinalRG)
    {
        if ($fechaInicialRG == null) {
            $stmt = Conexion::conectar()->prepare("CALL REPORTE_GENERAL()");
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicialRG == $fechaFinalRG) {

            $stmt = Conexion::conectar()->prepare("CALL REPORTE_GENERAL_1(:fechaFinal);");
            $stmt->bindParam(":fechaFinal", $fechaFinalRG, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinalRG);
            $fechaFinal2->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if ($fechaFinalMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("CALL REPORTE_GENERAL_2(:fechaInicial,:fechaFinalMasUno)");
                $stmt->bindParam(":fechaInicial", $fechaInicialRG, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("CALL REPORTE_GENERAL_2(:fechaInicial,:fechaFinal)");
                $stmt->bindParam(":fechaInicial", $fechaInicialRG, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinal", $fechaFinalRG, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlReporteGrafico($fechaInicialRG, $fechaFinalRG)
    {
        if ($fechaInicialRG == null) {
            $stmt = Conexion::conectar()->prepare("CALL GRAFICOS()");
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicialRG == $fechaFinalRG) {

            $stmt = Conexion::conectar()->prepare("CALL GRAFICOS_1(:fechaFinal);");
            $stmt->bindParam(":fechaFinal", $fechaFinalRG, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinalRG);
            $fechaFinal2->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if ($fechaFinalMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("CALL GRAFICOS_2(:fechaInicial,:fechaFinalMasUno)");
                $stmt->bindParam(":fechaInicial", $fechaInicialRG, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("CALL GRAFICOS_2(:fechaInicial,:fechaFinal)");
                $stmt->bindParam(":fechaInicial", $fechaInicialRG, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinal", $fechaFinalRG, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
}
