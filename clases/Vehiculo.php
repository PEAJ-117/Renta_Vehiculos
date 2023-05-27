<?php
class Vehiculo{
            public function edit($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$nombre = $c->test_input($datos[1]);
            $placa = $c->test_input($datos[2]);
            $tipo = $datos[4];
            $marca = $datos[3];
			$sql = "UPDATE vehiculos SET nombre = '$nombre', placa = '$placa', id_marca ='$marca', id_tipo = '$tipo'
            WHERE id_vehiculo = $datos[0]";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }

        public function save($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$nombre = $c->test_input($datos[0]);
            $placa = $c->test_input($datos[1]);
            $tipo = $c->test_input($datos[2]);
            $marca = $c->test_input($datos[3]);
			$sql = "INSERT INTO vehiculos(nombre,placa,id_tipo,id_marca,estado) values('$nombre','$placa','$tipo','$marca',1)";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }

                public function delete($id,$estado)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "UPDATE vehiculos SET estado = $estado WHERE id_vehiculo=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }


    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select v.id_vehiculo,v.nombre,v.placa,m.nombre as 'id_marca',t.nombre as 'id_tipo' from vehiculos
             as v INNER JOIN marcas as m on m.id_marca = v.id_marca INNER JOIN tipos as t
              on t.id_tipo=v.id_tipo where v.estado=1 or v.estado=2";
			$result = mysqli_query($conexion,$sql);
            return $result;
    }



    public function mostrarselect()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select v.id_vehiculo,v.nombre,v.placa,m.nombre as 'id_marca',t.nombre as 'id_tipo' from vehiculos
             as v INNER JOIN marcas as m on m.id_marca = v.id_marca INNER JOIN tipos as t
              on t.id_tipo=v.id_tipo where v.estado=1 ";
			$result = mysqli_query($conexion,$sql);
            return $result;
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from vehiculos where id_vehiculo=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id_vehiculo" =>html_entity_decode($ver[0]),
               "nombre" =>html_entity_decode($ver[1]),
               "placa" =>html_entity_decode($ver[2]),
               "id_marca" =>html_entity_decode($ver[4]),
               "id_tipo" =>html_entity_decode($ver[3])

             );
            return $datos;
    }



}
