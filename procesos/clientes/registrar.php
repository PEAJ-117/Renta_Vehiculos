<?php
require_once '../../clases/Cliente.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$direccion = $_POST['txtdireccion'];
$telefono = $_POST['txttelefono'];
$email = $_POST['txtemail'];
$datos = array($nombre,$direccion,$telefono,$email);
$obj = new Cliente();
echo $obj->save($datos);
?>