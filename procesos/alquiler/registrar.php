<?php

require_once '../../clases/Alquiler.php';
require_once '../../clases/Conexion.php';
$cliente = $_POST['txtcliente'];
$vehiculo = $_POST['txtvehiculo'];
$fechap = $_POST['txtfechap'];
$fechad = $_POST['txtfechad'];
$precio = $_POST['txtprecio'];
$observacion = $_POST['txtobservacion'];

//registramos el alquiler
$datos = array($cliente,$vehiculo,$fechap,$fechad,$precio,$observacion);
$obj = new Alquiler();
$r = $obj->save($datos);
if($r==1){
    require_once '../../clases/Vehiculo.php';
    $obj2 = new Vehiculo();
    $estado = 2;
    $obj2->delete($vehiculo,$estado);
}
echo $r;

?>

