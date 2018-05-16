<?php 
   header('Content-type:application/json;charset=utf-8');
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
   include_once('./AdministradorBaseDatos.php');
$conn = pg_connect("host=localhost dbname=iepi2 user=postgres password=12345");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}
$result = pg_query($conn, 'SELECT SSD.numero_tramite, SSD.denominacion_signo, SSD.fecha_presentacion, R.fecha_resolucion
FROM iepi_procesos.ppdi_solicitud_signo_distintivo SSD INNER JOIN iepi_procesos.ppdi_resolucion R ON 
SSD.codigo_solicitud_signo = R.codigo_solicitud WHERE SSD.fecha_presentacion >= \'2015-06-01\'
AND SSD.fecha_presentacion <= \'2015-12-31\' AND SSD.fecha_presentacion IS NOT NULL AND R.fecha_resolucion IS NOT NULL
ORDER BY SSD.fecha_presentacion;');
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
$salida = array();
while ($arr = pg_fetch_assoc($result)) {
    
    array_push($salida, $arr);
}
pg_close($conn);
echo json_encode($salida);
?>
