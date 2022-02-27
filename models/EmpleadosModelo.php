<?php
require_once "connectDBV.php";
class EmpleadosModelo
{
    // Funciones Administrador
    static public function mdlListarEmpleadosAd($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT EMP.idEmpleado,EMP.nombresEmp,EMP.ofiEmp,OFI.descOficina,EMP.cargoEmp FROM $tabla AS EMP INNER JOIN rv_oficinas AS OFI ON EMP.ofiEmp = OFI.idOficina WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_EMPLEADOS()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    // Funcionas Registrador
    static public function mdlListarEmpleadosParam($Oficina)
    {
        $stmt = Conexion::conectar()->prepare("CALL LISTAR_USUARIOS_OFICINA(:Oficina)");
        $stmt->bindParam(":Oficina", $Oficina, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarEmpleado($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ofiEmp,nombresEmp,cargoEmp) VALUES(:ofiEmp,:nombresEmp,:cargoEmp)");

        $stmt->bindParam(":ofiEmp", $datos["ofiEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarEmpleadoOf($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ofiEmp,nombresEmp,cargoEmp) VALUES(:ofiEmp,:nombresEmp,:cargoEmp)");

        $stmt->bindParam(":ofiEmp", $datos["ofiEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarEmpleado($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombresEmp= :nombresEmp,cargoEmp= :cargoEmp,ofiEmp= :ofiEmp WHERE idEmpleado= :idEmpleado");

        $stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
        $stmt->bindParam(":ofiEmp", $datos["ofiEmp"], PDO::PARAM_INT);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarEmpleadoOf($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombresEmp= :nombresEmp,cargoEmp= :cargoEmp WHERE idEmpleado= :idEmpleado");

        $stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
        $stmt->bindParam(":nombresEmp", $datos["nombresEmp"], PDO::PARAM_STR);
        $stmt->bindParam(":cargoEmp", $datos["cargoEmp"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }


    // Utilitarios
    static public function mdlListarEmpParametro($idEmpleado)
    {
        if ($idEmpleado != null) {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_EMPLEADO_DATOS(:id)");
            $stmt->bindParam(":id", $idEmpleado, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEliminarEmpleado($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idEmpleado = :id");
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
