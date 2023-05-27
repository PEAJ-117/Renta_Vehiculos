<?php
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$obj = new Marca();
echo $obj->save($nombre);
?>