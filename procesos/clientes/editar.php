<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id_cliente'];
$nombre = $_POST['txtnombree'];
$direccion = $_POST['txtdireccione'];
$telefono = $_POST['txttelefonoe'];
$email = $_POST['txtemaile'];
$datos = array($id,$nombre,$direccion,$telefono,$email);
$obj = new Cliente();
echo $obj->edit($datos);
?>