<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alquiler</title>
    <!-- Favicon -->
		<link rel="shortcut icon" href="../assets/images/logo.jpg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="../assets/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="../assets/login/login.css">
    
    
    <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../assets/alertifyjs/css/themes/default.css">
    <script type="text/javascript" src="../assets/alertifyjs/alertify.js"></script>
    
</head>
    
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"><br><br><br><br>
        <div class="card card-signin my-5">
          <div class="card-body">
          <?php
                    require_once '../clases/Usuario.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Usuario();
                    $r1 = $obj1->cantidad_usuarios();
                    //echo $r1;
                    if($r1 == 0)
                    {
                ?>
            <h5 class="card-title text-center"><strong>Crear usuario</strong></h5>

            

            <form class="form-signin" id="frmlogin">
              <div class="form-label-group">
                <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Contraseña</label>
              </div>

              
              <span class="btn btn-lg btn-success btn-block text-uppercase" id="btningresar" type="submit">Registrar</span><br>
              <p id="texto"></p>
              <a href="../index.php">Volver</a>
              <div class="custom-control custom-checkbox mb-3">
               
              </div>
            </form>
            <?php 
                    }else{
                        echo "<center><p style='font-weight: bold;'>ya existe un usuario</p></center>";
                        echo "<a href='../index.php'>Volver</a>";
                    }

            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


<script>
    
    $(document).ready(function(){
        $('#btningresar').click(function(){
            datos = $('#frmlogin').serialize();
            var usu = $('#inputEmail').val();
            var cla = $('#inputPassword').val();
            
            if(usu.length == 0 || cla.length ==0)
                {
                    alertify.error("Complete los campos");
                }
            else
            {
            $.ajax(
                {
               type:"POST",
               data:datos,
               url:"../procesos/usuarios/crear.php", 
                success:function(r)
                {
                    if(r==1)
                        {
                            $('#btningresar').attr("disabled", true);
                            alertify.success("Usuario creado correctamente");
                            
                            $('#texto').text("volviendo en 5 segundos")
                            let delay = 3000;
                            let url = "../index.php";
                            setTimeout(function(){
                                location = url;
                            },3000);
                        }
                    else if(r==0){
                            alertify.error("Error al registrar el usuario");
                        }
                    else
                        {
                            alert(r);
                        }
                }
            });                
            }

        });
    });


</script>