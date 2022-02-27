<?php
require_once "connectDBV.php";
class LugaresModelo
{

    static public function mdlListarLugares($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY descLugar ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlListarLugaresAct($item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT idLugar,descLugar FROM rv_lugaresact WHERE $item = :$item ORDER BY descLugar ASC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("CALL LISTAR_LUGARES_ACT()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlRegistrarLugar($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descLugar) VALUES (:descLugar)");
        $stmt->bindParam(":descLugar", $datos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEditarLugar($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descLugar = :descLugar WHERE idLugar = :id");
        $stmt->bindParam(":descLugar", $datos["descLugar"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    static public function mdlEliminarLugar($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idLugar = :id");
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
