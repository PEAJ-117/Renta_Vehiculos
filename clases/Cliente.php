<?php
class Cliente{
            public function save($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$nombre = $c->test_input($datos[0]);
            $direccion = $c->test_input($datos[1]);
            $telefono = $c->test_input($datos[2]);
            $email = $c->test_input($datos[3]);
			$sql = "INSERT INTO clientes(nombre,direccion,telefono,email,estado) values('$nombre','$direccion','$telefono','$email',1)";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function edit($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
            $id = $datos[0];
			$nombre = $c->test_input($datos[1]);
            $direccion = $c->test_input($datos[2]);
            $telefono = $c->test_input($datos[3]);
            $email = $c->test_input($datos[4]);
			$sql = "update clientes set nombre = '$nombre', direccion = '$direccion',telefono = '$telefono',
            email = '$email' where id_cliente=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function delete($id)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update clientes set estado = 0 where id_cliente=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from clientes where estado = 1";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from clientes where id_cliente=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            $datos = array(
               "id_cliente" =>html_entity_decode($ver[0]),
               "nombre" =>html_entity_decode($ver[1]),
               "direccion" =>html_entity_decode($ver[2]),
               "telefono" =>html_entity_decode($ver[3]),
               "email" =>html_entity_decode($ver[4])
             );
            return $datos;
    }
}
