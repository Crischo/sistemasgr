<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('coneccion.php');

$con= new coneccion();
$nect = $con->conectar();

$f1 = $_GET['inicio'];

$f2 = $_GET['fin'];

$texto = "SELECT SSD.fecha_presentacion, SSD.numero_tramite, SSD.zona, P.nombre_pais, SSD.codigo_clasificacion_niza, TD.nombre FROM
iepi_procesos.ppdi_solicitud_signo_distintivo SSD INNER JOIN iepi_procesos.ppdi_pais P
ON P.codigo_pais = SSD.codigo_pais INNER JOIN iepi_procesos.ppdi_tipo_derecho TD
ON TD.codigo_tipo_derecho = SSD.codigo_tipo_derecho WHERE fecha_presentacion between '$f1'  and  '$f2' ORDER BY fecha_presentacion;";


$resultado = $con->consultar($texto);


$salida = array();
while ($arr = pg_fetch_assoc($resultado)) {
    
    array_push($salida, $arr);
}

echo json_encode($salida);
?>

