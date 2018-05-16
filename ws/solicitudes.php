<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('coneccion.php');

$con= new coneccion();
$nect = $con->conectar();

$f1 = $_GET['inicio'];

$f2 = $_GET['fin'];


$texto = "SELECT codigo_clasificacion_niza as codigo, count(codigo_clasificacion_niza) as conteo FROM
iepi_procesos.ppdi_solicitud_signo_distintivo WHERE fecha_presentacion between '$f1'  and  '$f2'  group by codigo;";



$resultado = $con->consultar($texto);


$salida = array();
while ($arr = pg_fetch_assoc($resultado)) {
    
    array_push($salida, $arr);
}

echo json_encode($salida);
?>

