<?php
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id_marca'];
$obj = new Marca();
echo json_encode($obj->traer($id));
?>