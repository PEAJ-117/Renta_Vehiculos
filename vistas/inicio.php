<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{
date_default_timezone_set("America/Mexico");

?>



    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->

                    
                        <div class="row">
                               
                        </div>
                        <!-- end row -->


                        
                        <div class="row">
                        
                                <h5 >Contratos que vencen hoy</h5>
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
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                
                            </tbody>
                        </table>
                              
                        </div>
                        <p>Leyenda</p>  <hr>
                              <ul>
                                <li>Estado 1 = pendiente - activo</li>
                                <li>Estado 2 = ocupado - finalizado</li>
                                <li>Estado 0 = eliminado - cancelado</li>
                               </ul>

                        <!-- end row -->
 

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
?>

	
<!-- END Java Script for this page -->


<?php
}
else {
	header("location:../index.php");  
}

?>




<script>
$(document).ready(function(){


    var table = $('#myTable').DataTable({
        "dom": 'rtip',
        "ajax":{
            "url":"../procesos/alquiler/porvencer.php",
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
                sTitle: "Marcar",
                mDataProp: "id_alquiler",
                sWidth: '7%',
                orderable: false,
                render: function(data) {
                    acciones = `<button id="` + data + `" value="Marcar"  type="button" class="fa fa-check-square btn btn-success accionesTabla" >
                                    
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
        case "Marcar":
            
            alertify.confirm('Alquiler', '¿Esta seguro que desea terminar este alquiler?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/alquiler/marcar.php",
                                data : "id="+id
                            }).done(function(msg) {
                                alertify.success("Alquiler realizado Correctamente");
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
    
    

});
</script>