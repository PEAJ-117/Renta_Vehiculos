<?php
require_once '../../clases/Tipo.php';
require_once '../../clases/Conexion.php';
$nombre = $_POST['txtnombre'];
$obj = new Tipo();
echo $obj->save($nombre);
?>