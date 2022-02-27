<?php
require_once "connectDBV.php";
class MotivosModelo
{

    static public function mdlListarMotivos($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarMotivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descMotivo) VALUES (:descMotivo)");
		$stmt->bindParam(":descMotivo", $datos, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }
    static public function mdlEditarMotivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descMotivo = :descMotivo WHERE idMotivo = :id");
		$stmt -> bindParam(":descMotivo", $datos["descMotivo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;

    }
    static public function mdlEliminarMotivo($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idMotivo = :id");
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
