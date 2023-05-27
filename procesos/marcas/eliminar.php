<?php
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new Marca();
echo $obj->delete($id);
?>