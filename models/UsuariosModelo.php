<?php
require_once "connectDBV.php";

class UsuariosModelo
{
	static public function mdlListarUsuarios($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT US.id_usuario,US.oficinaId,OF.descOficina,US.rolId,RO.dscRol,US.dni,US.nombres,US.aPaterno,US.aMaterno,US.correo,US.cuenta,US.clave,US.estado FROM $tabla AS US INNER JOIN rv_roles AS RO ON US.rolId = RO.idRol INNER JOIN rv_oficinas AS OF ON US.oficinaId = OF.idOficina WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("CALL LISTAR_USUARIOS()");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		//Cerramos la conexion por seguridad
		$stmt->close();
		$stmt = null;
	}
	static public function mdlCrearUsuario($datos)
	{
		$stmt = Conexion::conectar()->prepare("CALL CREAR_USUARIO(:oficinaId,:rolId,:dni,:nombres,:aPaterno,:aMaterno,:cuenta,:clave,:correo)");

		$stmt->bindParam(":oficinaId", $datos["oficinaId"], PDO::PARAM_INT);
		$stmt->bindParam(":rolId", $datos["rolId"], PDO::PARAM_INT);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":aPaterno", $datos["aPaterno"], PDO::PARAM_STR);
		$stmt->bindParam(":aMaterno", $datos["aMaterno"], PDO::PARAM_STR);
		$stmt->bindParam(":cuenta", $datos["cuenta"], PDO::PARAM_STR);
		$stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	static public function mdlEditarUsuario($datos)
	{
		$stmt = Conexion::conectar()->prepare("CALL ACTUALIZAR_USUARIO(:oficinaId,:rolId,:dni,:nombres,:aPaterno,:aMaterno,:cuenta,:clave,:correo,:id_usuario)");
		
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":oficinaId", $datos["oficinaId"], PDO::PARAM_INT);
		$stmt->bindParam(":rolId", $datos["rolId"], PDO::PARAM_INT);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":aPaterno", $datos["aPaterno"], PDO::PARAM_STR);
		$stmt->bindParam(":aMaterno", $datos["aMaterno"], PDO::PARAM_STR);
		$stmt->bindParam(":cuenta", $datos["cuenta"], PDO::PARAM_STR);
		$stmt->bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	static public function mdlEliminarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");
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
