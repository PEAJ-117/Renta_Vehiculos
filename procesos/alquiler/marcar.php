<?php
require_once '../../clases/Alquiler.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$estado = 2;
$obj = new Alquiler();
echo $obj->delete($id,$estado);
?>