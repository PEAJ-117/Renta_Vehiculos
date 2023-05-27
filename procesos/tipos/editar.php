<?php
require_once '../../clases/Tipo.php';
require_once '../../clases/Conexion.php';

$nombre = $_POST['txtnom'];
$id = $_POST['id_tipoo'];
$datos = array($id,$nombre);
$obj = new Tipo();
echo $obj->edit($datos);
?>