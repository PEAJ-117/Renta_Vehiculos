<?php
class Marca{
            public function save($nombrer)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$nombre = $c->test_input($nombrer);
			$sql = "INSERT INTO marcas(nombre,estado) values('$nombre',1)";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function edit($datos)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$nombre = $c->test_input($datos[1]);
			$sql = "update marcas set nombre = '$nombre' where id_marca=$datos[0]";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
                public function delete($id)
        {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "update marcas set estado = 0 where id_marca=$id";
			$result = mysqli_query($conexion,$sql);
            return $result;
        }
    public function mostrar()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from marcas where estado = 1";
			$result = mysqli_query($conexion,$sql);
            return $result; 
    }
    public function traer($id)
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from marcas where id_marca=$id";
			$result = mysqli_query($conexion,$sql);
            $ver = mysqli_fetch_row($result);
            return html_entity_decode($ver[1]); 
    }
    
    public function mostrar_cb()
    {
            $c = new Conexion();
			$conexion = $c->conectar();
			$sql = "select * from marcas";
			$result = mysqli_query($conexion,$sql);
            return $result;         
    }
    
}


?>