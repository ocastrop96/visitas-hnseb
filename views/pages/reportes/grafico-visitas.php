<?php
error_reporting(0);

if (isset($_GET["fechaInicialRG"])) {

    $fechaInicialRG = $_GET["fechaInicialRG"];
    $fechaFinalRG = $_GET["fechaFinalRG"];
} else {

    $fechaInicialRG = null;
    $fechaFinalRG = null;
}

$respuesta = VisitasControlador::ctrListarVisitasGrafico($fechaInicialRG, $fechaFinalRG);

$arrayFechas = array();
$arrayVisitas = array();

foreach ($respuesta as $key => $value) {
    // Capturamos solo el año y el mes de la fecha
    $fecha = substr($value["fechaVisita"], 0, 7);
    #Introducir las fechas en arrayFechas
    array_push($arrayFechas, $fecha);

    $arrayVisitas = array($fecha => $value["idVisita"]);
    foreach ($arrayVisitas as $key => $value) {
        $conteoVisitas[$key] += count($value);
    }
}

$norepetirFechas = array_unique($arrayFechas);

?>
<div class="card bg-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-bar mr-1"></i>
            Gráfico de Visitas General
        </h3>
    </div>
    <div class="card-body border-0 nuevoGraficoVisitas">
        <div class="chart" id="line-chart-visitas" style="height: 250px;"></div>
    </div>
</div>
<script>
    var line = new Morris.Line({
        element: 'line-chart-visitas',
        data: [
            <?php

            if ($norepetirFechas != null) {
                foreach ($norepetirFechas as $key) {
                    echo "{ y: '" . $key . "', visitas: " . $conteoVisitas[$key] . " },";
                }
                echo "{ y: '" . $key . "', visitas: " . $conteoVisitas[$key] . " }";
            } else {
                echo "{ y: '0', visitas: '0' }";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['visitas'],
        labels: ['visitas'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: '#fff',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor: '#efefef',
        gridTextFamily: 'Open Sans',
        gridTextSize: 12
    });
</script>