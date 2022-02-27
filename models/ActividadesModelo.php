<?php
require_once "connectDBV.php";

class ActividadesModelo
{
    static public function mdlListarActividades($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT
            rv_actividades.idActividad, 
            date_format(rv_actividades.fechaAct,'%d/%m/%Y') as fechaAct,
            time_format(rv_actividades.horaAct,'%h:%i %p') as horaAct,
            rv_actividades.descAct, 
            rv_actividades.lugarAct, 
            rv_lugaresact.descLugar, 
            rv_actividades.empAct, 
            rv_empleados.nombresEmp, 
            rv_empleados.cargoEmp
            FROM
            rv_actividades
            INNER JOIN
            rv_empleados
            ON 
                rv_actividades.empAct = rv_empleados.idEmpleado
            INNER JOIN
            rv_lugaresact
            ON 
                rv_actividades.lugarAct = rv_lugaresact.idLugar
            WHERE $item = :$item
            ORDER BY fechaAct DESC,horaAct DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_ACTIVIDADES_EDIT()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarActividad($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL REGISTRAR_ACTIVIDAD(:fechaAct,:horaAct,:descAct,:lugarAct,:empAct,:usuregAct)");
        $stmt->bindParam(":lugarAct", $datos["lugarAct"], PDO::PARAM_INT);
        $stmt->bindParam(":empAct", $datos["empAct"], PDO::PARAM_INT);
        $stmt->bindParam(":usuregAct", $datos["usuregAct"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaAct", $datos["fechaAct"], PDO::PARAM_STR);
        $stmt->bindParam(":horaAct", $datos["horaAct"], PDO::PARAM_STR);
        $stmt->bindParam(":descAct", $datos["descAct"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEditarActividad($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL ACTUALIZAR_ACTIVIDAD(:fechaAct,:horaAct,:descAct,:lugarAct,:empAct,:idActividad)");
        $stmt->bindParam(":lugarAct", $datos["lugarAct"], PDO::PARAM_INT);
        $stmt->bindParam(":empAct", $datos["empAct"], PDO::PARAM_INT);
        $stmt->bindParam(":idActividad", $datos["idActividad"], PDO::PARAM_INT);
        $stmt->bindParam(":fechaAct", $datos["fechaAct"], PDO::PARAM_STR);
        $stmt->bindParam(":horaAct", $datos["horaAct"], PDO::PARAM_STR);
        $stmt->bindParam(":descAct", $datos["descAct"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlListarVisitasParam($fechaInicialAct, $fechaFinalAct)
    {
        if ($fechaInicialAct == null) {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_ACTIVIDADES()");
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicialAct == $fechaFinalAct) {

            $stmt = Conexion::conectar()->prepare("CALL LISTAR_ACTIVIDADES_2(:fechaFinalAct);");
            $stmt->bindParam(":fechaFinalAct", $fechaFinalAct, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinalAct2 = new DateTime($fechaFinalAct);
            $fechaFinalAct2->add(new DateInterval("P1D"));
            $fechaFinalActMasUno = $fechaFinalAct2->format("Y-m-d");

            if ($fechaFinalActMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("CALL LISTAR_ACTIVIDADES_3(:fechaInicialAct,:fechaFinalActMasUno)");
                $stmt->bindParam(":fechaInicialAct", $fechaInicialAct, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalActMasUno", $fechaFinalActMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("CALL LISTAR_ACTIVIDADES_3(:fechaInicialAct,:fechaFinalAct)");
                $stmt->bindParam(":fechaInicialAct", $fechaInicialAct, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalAct", $fechaFinalAct, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //Cerramos la conexion por seguridad
        $stmt->close();
        $stmt = null;
    }

    static public function mdlEliminarActividad($datos)
    {
        $stmt = Conexion::conectar()->prepare("CALL ELIMINAR_ACTIVIDAD(:id)");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
