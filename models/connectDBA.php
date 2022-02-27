<?php
$server = "localhost";
$user = "rvmanage";
$pass = "@pdSBNX5+lCa3i|r83u~";
$db = "rvisitas";
$conexion = mysqli_connect($server, $user, $pass, $db);
$conexion->set_charset("utf8");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
