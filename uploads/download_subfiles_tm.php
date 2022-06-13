<?php
include_once("conn.php");
require('fpdf/wrap.php');
$id= $_GET['id'];
$sql = "SELECT date, action , name, id, pages, department FROM subfiles WHERE id=$id ORDER BY date DESC";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$sqll = "SELECT docu_id, subject FROM files WHERE id=$id";
$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'");

while($fetch = mysqli_fetch_array($nquery)){
$docu_id = $fetch['docu_id'];
$subject = $fetch['subject'];
$department = $fetch['department'];
$pdf = new FPDF();
$pdf= new wrap();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'STATUS HISTORY');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Document ID:');
$pdf->SetFont('Arial','U',10, 1);
$pdf->Cell(40,10,$docu_id);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Document Name:');
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(150,10,$subject);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Department:');
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(150,10,$department);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,10,'DATE',1,0,'C');
$pdf->Cell(45,10,'EMPLOYEE / OFFICER',1,0,'C');
$pdf->Cell(45,10,'SUBJECT',1,0,'C');
$pdf->Cell(65,10,'FILE NAME',1,0,'C');
$pdf->Cell(15,10,'PAGE/S',1,0,'C');
$pdf->Ln('fill');
$pdf->Ln();
$pdf->SetWidths(array(25,45,45,65,15));
srand(microtime()*1000000);
while($rows = mysqli_fetch_assoc($resultset)) {
for($i=0;$i<$i;$i++)
    $array = array();
    $pdf->RowJ(array($rows['date'],$rows['action'],$rows['sub_docu'],$rows['name'],$rows['pages']));

ob_start();
}
$pdf->Output();
} 
?>