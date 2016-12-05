<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 27/11/2016
 * Time: 12:28 AM
 */
session_start();
require('fpdf181/fpdf.php');
date_default_timezone_set('America/Mexico_City');
$extra="";
if($_SESSION['instrumentos']!=0){
    $extra .= "Instrumento |";
}
if($_SESSION['maleta']!=0){
    $extra.=" Maleta |";
}
if($_SESSION['abordo']!=0){
    $extra.=" Prioridad de abordaje";
}


class PDF extends FPDF{
    function Header(){
        $this->Image('images/logo-avion.jpg',10,8,33);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Cell(30,10,'Aerolineas de Aguascalientes S.A. de C.V.',0,0,'C');
        $this->Ln(20);
    }


    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$fecha=date("d-M-Y");
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Ln(15);
$pdf->Cell(0,10,'RFC:ACM1PTABJ141096 ',0,1);
$pdf->Cell(0,10,'Fecha: '.$fecha,10,1);
$pdf->Cell(0,10,'Domicilio Fiscal: Calle del Terror #666 Barrio de la salud ',0,1);
$pdf->Cell(0,10,'-----------------------------------------------------------------------------------------------------------------------------------',0,1);
$pdf->Ln(5);
$pdf->Cell(0,10,"Informacion de Pago:",0,1);
$pdf->Cell(0,10,"Nombre del Titular: ".$_SESSION['clienteTitular'],0,1);

if($_SESSION['isRedondo']){
    $pdf->Cell(0,10,"ID Vuelo ida: ".$_SESSION['id_vuelo_ida']. "ID Vuelo Vuelta: ".$_SESSION['idVuelta'],0,1);
}else{
    $pdf->Cell(0,10,"ID Vuelo: ".$_SESSION['idIda'] ,0,1);
}
$pdf->Cell(0,10,"Boletos: ".$_SESSION['numPas'],0,1);
$pdf->Cell(0,10,"Extras:    ".$extra,0,1);
$pdf->Cell(0,10,"Total: ",0,1);
$pdf->Cell(0,10,"----------------------------------------------------------------------------------------------------------------------------------",0,1);
$pdf->Ln(25);
$pdf->Cell(0,10,"Banamecs: 041414190641651974165165165162312",0,1);
$pdf->Cell(0,10,"Banco Azthek: 4492162684491689198",0,1);
$pdf->Cell(0,10,"BanKhomer: 141096110496121099",0,1);

$pdf->Output();
?>