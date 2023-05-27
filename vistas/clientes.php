<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>



<!-- Modal registrar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmregistrar">
            <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombre" name="txtnombre">
            <label>Direccion</label>
            <input type="text" class="form-control" id="txtdireccion" name="txtdireccion">
            <label>Telefono</label>
            <input type="text" class="form-control" id="txttelefono" name="txttelefono">
            <label>Email</label>
            <input type="text" class="form-control" id="txtemail" name="txtemail">
             </form>
            </div>
           
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
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           
           <div class="col-lg-12">
           <form id="frmeditar">
            <label>Nombre (*)</label>
            <input type="text" class="form-control" id="txtnombree" name="txtnombree">
            <label>Direccion</label>
            <input type="text" class="form-control" id="txtdireccione" name="txtdireccione">
            <label>Telefono</label>
            <input type="text" class="form-control" id="txttelefonoe" name="txttelefonoe">
            <label>Email</label>
            <input type="text" class="form-control" id="txtemaile" name="txtemaile">
            </form>
            </div>
           
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
                                                <p class="main-title ">CLIENTES</p>
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
                                    <td>Direccion</td>
                                    <td>Telefono</td>
                                    <td>Email</td>
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
            "url":"../procesos/clientes/mostrar.php",
            "type":"GET"
            //"crossDomain": "true",
            //"dataType": "json",
            //"dataSrc":""
        },
        "columns":[
            {
                "data":"id_cliente"
            },
            {
                
                "data":"nombre"
            },
            {
                
                "data":"direccion"
            },
            {
                "data":"telefono"
            },
            {
                
                "data":"email"
            },
            {
                sTitle: "Eliminar",
                mDataProp: "id_cliente",
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
                mDataProp: "id_cliente",
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
                        url : "../procesos/clientes/traer.php",
                        data:'id_cliente='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
				        $('#txtnombree').val(dato['nombre']);
                        $('#txtdireccione').val(dato['direccion']);
                        $('#txttelefonoe').val(dato['telefono']);
                        $('#txtemaile').val(dato['email']);

                        $('#btneditar').unbind().click(function(){
                            
                            noma = $("#txtnombree").val();
                            dire = $("#txtdireccione").val();
                            tele = $("#txttelefonoe").val();
                            ema = $("#txtemaile").val();
                            if(noma.length != 0)
                                {
                             oka = {
						                "txtnombree" : noma , "id_cliente" : id,
                                        "txtdireccione" : dire , "txttelefonoe" : tele,
                                        "txtemaile" : ema
                                };
                            $.ajax({
                                method : "POST",
                                url : "../procesos/clientes/editar.php",
                                data : oka
                                }).done(function(msg) {
                                    $('#exampleModal2').modal('hide');
                                alertify.success("cliente editado correctamente!");
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
            
            alertify.confirm('Eliminar cliente', '¿Esta seguro que desea eliminar este cliente?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/clientes/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Cliente eliminado correctamente");
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
       nom = $('#txtnombre').val();
        if(nom.length != 0 )
            {
            datos = $('#frmregistrar').serialize();
            $.ajax({
               type:'post',
                url:'../procesos/clientes/registrar.php',
                data:datos,
                success:function(r)
                {
                    
                    if(r==1)
                        {
                            $('#exampleModal').modal('hide');
                            $('#frmregistrar')[0].reset();

                            alertify.success("Cliente registrado Correctamente");
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


