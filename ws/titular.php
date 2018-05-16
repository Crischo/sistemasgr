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
$result = pg_query($conn, 'SELECT SSD.codigo_solicitud_signo, SSD.numero_tramite, SSD.fecha_presentacion, P.nombre_persona, SSD.denominacion_signo, TD.nombre, SSD.codigo_clasificacion_niza, TSD.numero_titulo, 
TSD.fecha_emision_documento 
FROM iepi_procesos.ppdi_persona P
INNER JOIN iepi_procesos.ppdi_persona_solicitud_signo_distintivo PSSD
ON P.codigo_persona = PSSD.codigo_persona
INNER JOIN iepi_procesos.ppdi_solicitud_signo_distintivo SSD
ON PSSD.codigo_solicitud_signo = SSD.codigo_solicitud_signo
LEFT JOIN iepi_procesos.ppdi_titulo_signo_distintivo TSD
ON TSD.codigo_solicitud_signo = SSD.codigo_solicitud_signo
INNER JOIN iepi_procesos.ppdi_tipo_derecho TD
ON TD.codigo_tipo_derecho = SSD.codigo_tipo_derecho
WHERE P.nombre_persona IN (\'OTECEL S.A.\',\'OTECEL S.A.\',\'OTECEL S.A.\',\'OTECEL S.A.\',\'OTECEL SA.A.\',\'OTECEL, S.A.\',\'OTECEL S.A.\',\'CIA. OTECEL S.A.\',\'OTECEL S.A.\',\'OTECEL S.A.\')
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
