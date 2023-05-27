<?php
date_default_timezone_set("America/lima");
class Alquiler{
            public function save($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$cliente = $c->test_input($datos[0]);
            $vehiculo = $c->test_input($datos[1]);
            $fechap = $c->test_input($datos[2]);
            $fechad = $c->test_input($datos[3]);
            $precio = $c->test_input($datos[4]);
            $observacion = $c->test_input($datos[5]);
			$sql = "INSERT INTO alquiler(id_cliente,id_vehiculo,fecha_prestamo,fecha_devolucion,precio,observacion)
             values('$cliente','$vehiculo','$fechap','$fechad','$precio','$observacion')";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function edit($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
            $id = $datos[0];
			$nombre = $c->test_input($datos[1]);
            $placa = $c->test_input($datos[2]);
            $marca = $c->test_input($datos[3]);
            $tipo = $c->test_input($datos[4]);
            
			$sql = "update vehiculos set nombre = '$nombre', placa = '$placa',id_tipo = '$tipo',
            id_marca = '$marca' where id_vehiculo=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function delete($id,$estado)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
            $this->regresa_vehiculo($id);
			$sql = "update alquiler set estado = $estado where id_alquiler=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }

        public function regresa_vehiculo($id)
            {
            $c = new Conexion();
			$conexion = $c->conectar();
            $sql = "CALL regresa_vehiculo($id)";
            $result= mysqli_query($conexion,$sql);
            return $result;
            }

    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select a.id_alquiler,c.nombre as 'id_cliente',v.nombre as 'id_vehiculo',
            a.fecha_prestamo,a.fecha_devolucion,a.precio,a.estado from alquiler
             as a INNER JOIN vehiculos as v ON v.id_vehiculo = a.id_vehiculo 
             INNER JOIN clientes as c ON c.id_cliente=a.id_cliente;";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }

    public function contratosporvencer()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
            $fecha = date('y-m-d');
			$sql = "select a.id_alquiler,c.nombre as 'id_cliente',v.nombre as 'id_vehiculo',
            a.fecha_prestamo,a.fecha_devolucion,a.precio,a.estado from alquiler
             as a INNER JOIN vehiculos as v ON v.id_vehiculo = a.id_vehiculo 
             INNER JOIN clientes as c ON c.id_cliente=a.id_cliente WHERE a.fecha_devolucion='$fecha'";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }

    public function reporte($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select a.id_alquiler,c.nombre as 'cliente',c.direccion,v.nombre as 'vehiculo',v.placa,
            a.fecha_prestamo,a.fecha_devolucion,a.precio,a.observacion from alquiler
             as a INNER JOIN vehiculos as v ON v.id_vehiculo = a.id_vehiculo 
             INNER JOIN clientes as c ON c.id_cliente=a.id_cliente WHERE a.id_alquiler=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
    }
    


    
}
