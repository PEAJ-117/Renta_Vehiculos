<?php
require_once '../../clases/Vehiculo.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$nombre = $_POST['txtnom'];
$placa = $_POST['txtpla'];
$marca = $_POST['txtmar'];
$tipo = $_POST['txttip'];
$datos = array($id,$nombre,$placa,$marca,$tipo);
var_dump($datos);
$obj = new Vehiculo();
echo $obj->edit($datos);
?>