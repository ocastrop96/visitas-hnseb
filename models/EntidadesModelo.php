<?php
require_once "connectDBV.php";
class EntidadesModelo
{

    static public function mdlListarEntidades($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY descEntidad asc");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descEntidad asc");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarEntidad($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(docRuc, descEntidad) VALUES(:docRuc, :descEntidad)");
		$stmt->bindParam(":docRuc", $datos["docRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":descEntidad", $datos["descEntidad"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }
    static public function mdlEditarEntidad($tabla, $datos)
	{
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET docRuc= :docRuc, descEntidad= :descEntidad WHERE idEntidad = :idEntidad");
        
        $stmt->bindParam(":idEntidad", $datos["idEntidad"], PDO::PARAM_INT);
		$stmt->bindParam(":docRuc", $datos["docRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":descEntidad", $datos["descEntidad"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }
    static public function mdlEliminarEntidad($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idEntidad = :id");
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
