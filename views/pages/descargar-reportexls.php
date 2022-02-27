<?php
require_once "../../controllers/VisitasControlador.php";
require_once "../../models/VisitasModelo.php";

$reporte = new VisitasControlador();
$reporte -> ctrDescargarReporte();