<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{


?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Tipo de Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>Nombre</label>
            <input type="text" class="form-control" id="txtnombre" name="txtnombre">
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <label>Nombre</label>
            <input type="text" class="form-control" id="txtnombree" name="txtnombree">
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
                                                <p class="main-title ">TIPOS DE VEHICULOS</p>
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
            "url":"../procesos/tipos/mostrar.php",
            "type":"GET"
        },
        "columns":[
            {
                "data":"id_tipo"
            },
            {
                
                "data":"nombre"
            },
            {
                sTitle: "Eliminar",
                mDataProp: "id_tipo",
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
                mDataProp: "id_tipo",
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
                        url : "../procesos/tipos/traer.php",
                        data:'id_tipo='+id
                    }).done(function(msg) {
                        var dato=JSON.parse(msg);
                        
				        $('#txtnombree').val(dato);
       
                        $('#btneditar').unbind().click(function(){
                            
                            noma = $("#txtnombree").val();
                            if(noma.length != 0)
                                {
                             oka = {
						                "txtnom" : noma , "id_tipoo" : id
                                };
                            $.ajax({
                                method : "POST",
                                url : "../procesos/tipos/editar.php",
                                data : oka
                                }).done(function(msg) {
                                    $('#exampleModal2').modal('hide');
                                alertify.success("Tipo Editada Correctamente!");
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
            
            alertify.confirm('Tipo', '¿Esta seguro que desea eliminar este tipo de vehiculo?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/tipos/eliminar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Tipo eliminado Correctamente");
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
            $.ajax({
               type:'post',
                url:'../procesos/tipos/registrar.php',
                data:'txtnombre='+nom,
                success:function(r)
                {
                    
                    if(r==1)
                        {
                            $('#exampleModal').modal('hide');
                            $('#txtnombre').val('');
                            alertify.success("Tipo Registrado Correctamente");
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


