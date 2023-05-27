<?php
date_default_timezone_set("America/Mexico");
require 'header.php';

if(isset($_SESSION['usuario']))
{
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Alquiler</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="frmalquiler">
        <div class="row">
           
            <div class="col-lg-6">
            <label>Cliente</label><br>
            <select id="txtcliente" name="txtcliente" class="form-control ">
            <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Cliente.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Cliente();
                    $cliente = $obj1->mostrar();
                    while($pro=mysqli_fetch_row($cliente))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>
            </select><br>
            </div>
            <div class="col-lg-6">
            <label>Vehiculo</label><br>
            <select id="txtvehiculo" name="txtvehiculo" class="form-control ">
               <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Vehiculo.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Vehiculo();
                    $vehiculo = $obj1->mostrarselect();
                    while($pro=mysqli_fetch_row($vehiculo))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>
            </select><br>
            </div></div>
            <div class="row">
                    <div class="col-lg-6">
                    <label>Fecha prestamo</label>
            <input type="date" class="form-control" id="txtfechap" name="txtfechap">
                    </div>
                    <div class="col-lg-6">
                    <label>Feha Devolucion </label>
            <input type="date" class="form-control" id="txtfechad" name="txtfechad">
                    </div>
            </div>
            
            
            <label>Precio</label>
            <input type="number" class="form-control" id="txtprecio" name="txtprecio">
            <label>Observacion</label>
            <textarea class="form-control" id="txtobservacion" name="txtobservacion"></textarea>

        </form>
      </div>
      <div class="modal-footer">
        
      <button type="button" class="btn btn-primary" id="btnregistrar">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    
   



      

    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                            <center>
                                                <p class="main-title ">Alquiler</p>
                                                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                 +
                                                </button> 
                                                <hr>
                                                </center> 
                                                 
                                                
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                       <!-- Button trigger modal -->
                       
                        <div class="col-lg-12">
                        <table  id="myTable" class="table">
                            <thead class=" bg-primary text-white">
                                <tr>
                                    <td>#</td>
                                    <td>Cliente</td>
                                    <td>Vehiculo</td>
                                    <td>F. prestamo</td>
                                    <td>F. Devolucion</td>
                                    <td>Precio</td>
                                    <td>estado</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                
                            </tbody>
                        </table>
                        </div>
                        
                    </div>



        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
}
else {
	header("location:../index.php");  
}

?>


<script>
$(document).ready(function(){



    var table = $('#myTable').DataTable({
        "ajax":{
            "url":"../procesos/alquiler/mostrar.php",
            "type":"GET"
        },
        "columns":[
            {
                "data":"id_alquiler"
            },
            {
                "data":"id_cliente"
            },
            {
                "data":"id_vehiculo"
            },
            {
                "data":"fecha_prestamo"
            },
            {
                
                "data":"fecha_devolucion"
            },  
            {
                
                "data":"precio"
            },
            
            {
                
                "data":"estado",
                render: function(data) {
                    if(data == 1){
                        acciones = `<span class="badge badge-pill badge-success">Pendiente</span>`;
                    }
                    else if(data == 2){
                        acciones = `<span class="badge badge-pill badge-primary">Finalizado</span>`;
                    }
                    else if(data == 0){
                        acciones = `<span class="badge badge-pill badge-danger">Cancelado</span>`;
                    }
                    
                    return acciones
                }
            },
            {
                sTitle: "Eliminar",
                mDataProp: "id_alquiler",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Eliminar"  type="button" class="fa fa-times btn btn-danger accionesTabla" >
                                    
                                </button>`;
                    return acciones
                }
            },
            {
                sTitle: "Contrato",
                mDataProp: "id_alquiler",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<a target="_blank" href="contrato.php?id_alquiler=` + data + `" class="fa fa-file-pdf-o btn btn-success">   
                                </a>`;
                    return acciones
                }
            }
        ],
        responsive:true,
                "ordering": false


    });
    
$(document).on('click', '.accionesTabla', function() {
    var id = this.id;
    var val = this.value;

    switch (val) {
        case "Eliminar":
            
            alertify.confirm('Alquiler', '¿Esta seguro que desea eliminar este alquiler?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/alquiler/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Alquiler Eliminado Correctamente");
                                table.ajax.reload();
                                setTimeout(function() {
                                    location.reload();
                                }, 1500); // actualizar después de 5 segundos (5000 milisegundos)
                            });
                }
                , function(){
                
                });



        
                    break;
        
        default:
            alert("No existe el valor");
            break;
    }
    });    
    
    
    
    $('#btnregistrar').click(function(){
        vacios = validarFormVacio('frmalquiler');
        if(vacios <= 0 )
            {
            datos=$('#frmalquiler').serialize();
            $.ajax({
               type:'post',
                url:'../procesos/alquiler/registrar.php',
                data:datos,
                success:function(r)
                {
                    
                    if(r==1)
                        {
                            $('#exampleModal').modal('hide');
                            $('#frmalquiler')[0].reset();
                            alertify.success("Alquiler Registrado Correcamente");
                            table.ajax.reload();
                            setTimeout(function() {
                                    location.reload();
                                }, 1500); // actualizar después de 5 segundos (5000 milisegundos)
                        }
                    else if(r==0)
                        {
                            alertify.error("No se pudo registrar");
                        }
                    else
                        {
                            alert(r);
                        }
                }
            });
            }
        else{
            alertify.error("Complete los datos");
        }
    });
});
</script>


