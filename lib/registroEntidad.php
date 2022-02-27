<?php
require_once "../models/connectDBA.php";

$cuentaRuc = $_POST["confRuc"];
$docRuc = $_POST["nRucEnt"];
$descEntidad = $_POST["rSocialEnt"];


if ($cuentaRuc == "1" && isset($descEntidad) && $docRuc != "" && $descEntidad != "") {
    $sql = "INSERT INTO rv_entidades(tieneRuc,docRuc,descEntidad) VALUES('$cuentaRuc','$docRuc','$descEntidad')";
    echo mysqli_query($conexion, $sql);
}

if ($cuentaRuc == "2" && isset($descEntidad) && $descEntidad != "") {

    $nRucAleatorio = "1000000" . mt_rand(1000, 9999);
    $sql = "INSERT INTO rv_entidades(tieneRuc,docRuc,descEntidad) VALUES('$cuentaRuc','$nRucAleatorio','$descEntidad')";
    echo mysqli_query($conexion, $sql);
}
