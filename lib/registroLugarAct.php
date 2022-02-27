<?php
require_once "../models/connectDBA.php";

$descLugarAct = $_POST["descLugarAct"];

if (isset($descLugarAct) && $descLugarAct != "") {
    $sql = "CALL REGISTRO_NUEVO_LUGAR_ACT('$descLugarAct')";
    echo mysqli_query($conexion, $sql);
}
