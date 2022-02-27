<?php
include "../models/config.php";
mysqli_set_charset($con, 'utf8');
if (!isset($_POST["searchTerm"])) {
    $fetchData = mysqli_query($con, "CALL LISTA_LUGARACTI_FORM()");
} else {
    $search = $_POST["searchTerm"];
    $fetchData = mysqli_query($con, "CALL LISTA_LUGARACTI_FORM_DESC('$search')");
}
$data = array();
while ($row = mysqli_fetch_array($fetchData)) {
    $data[] = array("id" => $row['idLugar'], "text" => $row['descLugar']);
}
echo json_encode($data);
