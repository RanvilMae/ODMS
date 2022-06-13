<?php
include('conn.php');
require('fpdf/wrap.php');
$department =  $_GET['department'];
$sql = "SELECT *  FROM board_resolution ";

$resultset =mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
 

$pdf = new FPDF();
$pdf= new wrap();
$pdf->AddPage('L');
$pdf->SetFont('Arial','B',22);
$pdf->Cell(40,10,'MASTERLIST');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27,10,'BR Number',1,0,'C');
$pdf->Cell(90,10,'Subject',1,0,'C');
$pdf->Cell(25,10,'Date',1,0,'C');
$pdf->Cell(20,10,'# of Pages',1,0,'C');
$pdf->Ln('fill');
$pdf->Ln();
$pdf->SetWidths(array(27,90,25,25,20));
srand(microtime()*1000000);
while($rows = mysqli_fetch_assoc($resultset)) {
for($i=0;$i<$i;$i++)
    $array = array();
    $pdf->RowJ(array($rows['br_no'],$rows['subject'],$rows['date'],$rows['page']));

}
ob_start();
$pdf->Output();
ob_end_flush();
	
	
		

?>