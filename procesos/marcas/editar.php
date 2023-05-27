<?php
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';

$nombre = $_POST['txtnom'];
$id = $_POST['id_marcaa'];
$datos = array($id,$nombre);
$obj = new Marca();
echo $obj->edit($datos);
?>