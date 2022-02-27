<?php
include "../models/config.php";
mysqli_set_charset($con, 'utf8');
if (!isset($_POST["searchTerm"])) {
  $fetchData = mysqli_query($con, "SELECT * FROM rv_entidades ORDER BY descEntidad ASC");
} else {
  $search = $_POST["searchTerm"];
  $fetchData = mysqli_query($con, "SELECT * FROM rv_entidades  WHERE descEntidad like '%" . $search . "%' ORDER BY descEntidad ASC");
}

$data = array();
while ($row = mysqli_fetch_array($fetchData)) {
  $data[] = array("id" => $row['idEntidad'], "text" => $row['descEntidad']);
}
echo json_encode($data);
