<?php
require_once '../../clases/Vehiculo.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$placa = $_POST['txtplaca'];
$tipo = $_POST['txttipo'];
$marca = $_POST['txtmarca'];
$datos = array($nombre,$placa,$tipo,$marca);
$obj = new Vehiculo();
echo $obj->save($datos);
?>