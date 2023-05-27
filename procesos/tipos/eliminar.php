<?php
require_once '../../clases/Tipo.php';
require_once '../../clases/Conexion.php';
$id = $_POST['id'];
$obj = new Tipo();
echo $obj->delete($id);
?>