<?php
try{


if(isset($_GET['id_alquiler'])){


require('../assets/fpdf/fpdf.php');

require_once '../clases/Alquiler.php';
require_once '../clases/Conexion.php';
$id = $_GET['id_alquiler'];
$obj = new Alquiler();
$consulta = $obj->reporte($id);
$result = $consulta->fetch_object();

$cliente =  $result->cliente;
$domicilio = $result->direccion;
$vehiculo = $result->vehiculo;
$placa = $result->placa;
$fechap= $result->fecha_prestamo;
$fechad= $result->fecha_devolucion;
$observacion = $result->observacion;
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
// Logo
$pdf->Image('../assets/images/logo.png',25,10,30);

$pdf->Cell(0, 7, 'CONTRATO DE ALQUILER', 0, 0, 'C');
$pdf->SetFont('Arial','',10);

$pdf->Ln(20);
$texto = "Conste por el presente documento el contrato de por parte de la empresa RENTO, identificado con RUC N° 1075122674 , y con domicilio en Instituto Tecnologicco de Tuxtepec, a quien en lo sucesivo se denominara EL ARRENDADOR; y de otra parte don Cliente $cliente ,con domicilio en  $domicilio , a quien en lo sucesivo se denominará EL ARRENDATARIO, en los términos siguientes:";
$pdf->MultiCell(0, 6, utf8_decode($texto));

$pdf->Cell(40,10,'PRIMERO');
$pdf->Ln(10);
$clausula1 = "EL ARRENDADOR es propietario del vehículo usado, modelo $vehiculo, y con placa de rodaje Nº $placa.";
$pdf->MultiCell(0, 6, utf8_decode($clausula1));
$pdf->Cell(40,10,'SEGUNDO');
$pdf->Ln(10);
$clausula2 = "EL ARRENDADOR deja constancia que el vehículo a que se refiere la cláusula anterior se encuentra en buen estado de funcionamiento mecánico y conservación de carrocería, pintura y accesorios, sin mayor desgaste que el producido por el uso normal y ordinario.";
$pdf->MultiCell(0, 6, utf8_decode($clausula2));
$pdf->Cell(40,10,'TERCERO');
$pdf->Ln(10);
$clausula3 = "EL ARRENDADOR se obliga a entregar el bien objeto de la prestación a su cargo en la fecha de suscripción de este documento, sin más constancia que las firmas de las partes puestas en él. Esta obligación se verificará con la entrega física del vehículo, las llaves y la tarjeta de propiedad del mismo.";
$pdf->MultiCell(0, 6, utf8_decode($clausula3));

$pdf->Cell(40,10,"FECHA PRESTAMO: $fechap");
$pdf->Ln(10);
$pdf->Cell(40,10,"FECHA ENTREGA: $fechad");
$pdf->Ln(10);

$pdf->Cell(40,10,'OBSERVACIONES');
$pdf->Ln(10);
$pdf->MultiCell(0, 6, utf8_decode($observacion));

$pdf->Ln(10);
$pdf->Cell(0, 7,   '        ____________________                            ____________________', 0, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 7,'FIRMA DE LA EMPRESA RENTO                      FIRMA DEL CLIENTE', 0, 0, 'C');


$pdf->Output();
}
else{
    echo"...";
}
}catch (Exception $e){
    echo "...";
}


?>