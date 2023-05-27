<?php
require_once '../../clases/Vehiculo.php';
require_once '../../clases/Conexion.php';
$id = $_GET['id_vehiculo'];
$obj = new Vehiculo();
echo json_encode($obj->traer($id));
?>