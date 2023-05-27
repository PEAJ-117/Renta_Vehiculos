<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>



<!-- Modal -->
<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form id="frmvehiculo">
        <div class="row">
           
            <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombre" name="txtnombre">
            <label>Placa</label>
            <input type="text" class="form-control" id="txtplaca" name="txtplaca">
            <label>Tipo de vehiculo (*)</label><br>

            <select id="txttipo" name="txttipo" class="form-control ">
               <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Tipo.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Tipo();
                    $proveedor = $obj1->mostrar();
                    while($pro=mysqli_fetch_row($proveedor))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>
            </select><br>
            <label>Marca</label>
            <select id="txtmarca" name="txtmarca" class="form-control ">
                <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Marca.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Marca();
                    $proveedor = $obj1->mostrar();
                    while($pro=mysqli_fetch_row($proveedor))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>               
            </select>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        
      <button type="button" class="btn btn-primary" id="btnregistrar">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    
   



<!-- Modal -->
<div class="modal fade" id="exampleModal2"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
       <form id="frmvehiculoe">
        <div class="row">
           
        <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombree" name="txtnombree">
            <label>Placa</label>
            <input type="text" class="form-control" id="txtplacae" name="txtplacae">
            <label>Tipo de vehiculo (*)</label><br>

            <select id="txttipoe" name="txttipoe" class="form-control ">
               <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Tipo.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Tipo();
                    $proveedor = $obj1->mostrar();
                    while($pro=mysqli_fetch_row($proveedor))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>
            </select><br>
            <label>Marca</label>
            <select id="txtmarcae" name="txtmarcae" class="form-control ">
                <option value="A">Seleccione</option>
                <?php
                    require_once '../clases/Marca.php';
                    require_once '../clases/Conexion.php';
                    $obj1 = new Marca();
                    $proveedor = $obj1->mostrar();
                    while($pro=mysqli_fetch_row($proveedor))
                    {
                ?>
                <option value="<?php echo $pro[0] ?>" ><?php echo $pro[1] ?></option>
                <?php
                    }
                        
                ?>               
            </select>
            </form>
        </div>
        </div>
      <div class="modal-footer">
        
      <button type="button" id="btneditar" class="btn btn-primary">Guardar</button>
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
                                                <p class="main-title ">VEHICULOS</p>
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
                                    <td>Nombre</td>
                                    <td>Placa</td>
                                    <td>Marca</td>
                                    <td>Tipo</td>
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
            "url":"../procesos/vehiculos/mostrar.php",
            "type":"GET"
            //"crossDomain": "true",
            //"dataType": "json",
            //"dataSrc":""
        },
        "columns":[
            {
                "data":"id_vehiculo"
            },
            {
                "data":"nombre"
            },
            {
                
                "data":"placa"
            },
            {
                
                "data":"id_marca"
            },  
            {
                
                "data":"id_tipo"
            },
            {
                sTitle: "Eliminar",
                mDataProp: "id_vehiculo",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Eliminar"  type="button" class="fa fa-times btn btn-danger accionesTabla" >
                                    
                                </button>`;
                    return acciones
                }
            },
            {
                sTitle: "Editar",
                mDataProp: "id_vehiculo",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Traer" class="fa fa-pencil-square-o btn btn-primary accionesTabla" data-toggle="modal" data-target="#exampleModal2" type="button"  >
                                    
                                </button>`;
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
        case "Traer":
                    $.ajax({
                        method : "GET",
                        url : "../procesos/vehiculos/traer.php",
                        data:'id_vehiculo='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
                        
				        $('#txtnombree').val(dato['nombre']);
                        $('#txtplacae').val(dato['placa']);
                        $('#txtmarcae').val(dato['id_marca']);
                        $('#txttipoe').val(dato['id_tipo']);
                        
                        $('#btneditar').unbind().click(function(){
                            vacios = validarFormVacio('frmvehiculoe');
                            
                            
                            if(vacios <= 0)
                                {
                            noma = $("#txtnombree").val();
                            pla = $("#txtplacae").val();
                            mar = $("#txtmarcae").val();
                            tip = $("#txttipoe").val();
                             oka = {
                                        "id" : id,
						                "txtnom" : noma , 
                                        "txtpla" : pla,
                                        "txtmar" : mar,
                                        "txttip" : tip,
                                };
                                console.log(oka);
                            $.ajax({
                                method : "POST",
                                url : "../procesos/vehiculos/editar.php",
                                data : oka
                                }).done(function(msg) {
                                    $('#exampleModal2').modal('hide');
                                    console.log(msg);
                                alertify.success("Vehiculo editado correctamente!");
                                table.ajax.reload();
                                });                               
                                    
                                }
                            else{
                                alertify.error("Complete los datos");
                            }

                        });
                    });
            break;
        case "Eliminar":
            
            alertify.confirm('Vehiculo', '¿Esta seguro que desea eliminar este vehiculo?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/vehiculos/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Vehiculo Eliminado Correctamente");
                                table.ajax.reload();
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
        vacios = validarFormVacio('frmvehiculo');
        if(vacios <= 0 )
            {
            datos=$('#frmvehiculo').serialize();
            $.ajax({
               type:'post',
                url:'../procesos/vehiculos/registrar.php',
                data:datos,
                success:function(r)
                {
                    
                    if(r==1)
                        {
                            $('#exampleModal').modal('hide');
                            $('#frmvehiculo')[0].reset();
                            alertify.success("Vehiculo registrado correctamente");
                            table.ajax.reload();
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


