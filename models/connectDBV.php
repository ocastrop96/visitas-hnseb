<?php
class Conexion{
	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=rvisitas",
			            "rvmanage",
			            "@pdSBNX5+lCa3i|r83u~");
		$link->exec("set names utf8");
		return $link;
	}
}