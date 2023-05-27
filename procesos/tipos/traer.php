<?php
require_once '../../clases/Tipo.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id_tipo'];
$obj = new Tipo();
echo json_encode($obj->traer($id));
?>