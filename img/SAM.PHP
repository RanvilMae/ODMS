

<?php
include_once("conn.php");
   $id= $_GET['id'];
$sql = "SELECT date, action , remarks, status FROM remarks WHERE id=$id";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$sqll = "SELECT docu_id, subject FROM files WHERE id=$id";
$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'");
			while($fetch = mysqli_fetch_array($nquery)){
				$docu_id = $fetch['docu_id'];
				$subject = $fetch['subject'];
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',22);
$pdf->Cell(40,10,'STATUS HISTORY');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Document ID:');
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,$docu_id);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,10,'Document Name:');
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,10,$subject);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(47,12,'Date',1);
$pdf->Cell(47,12,'Employee / Officer',1);
$pdf->Cell(47,12,'Remarks',1);
$pdf->Cell(47,12,'Status',1);
$pdf->Ln();
while($rows = mysqli_fetch_assoc($resultset)) {
	
$start_x=$pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$cell_width = 47;  //define cell width
$cell_height=12;
$current_x=$start_x;                       //set x to start_x (beginning of line)
$current_y+=$cell_height;                  //increase y by cell_height to print on next line

$pdf->SetXY($current_x, $current_y);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell($cell_width,$cell_height,$rows['date'],1);
		$current_x+=$cell_width;                        
		$pdf->SetXY($current_x, $current_y); 
		
	$pdf->MultiCell($cell_width,$cell_height,$rows['action'],1);
		$current_x+=$cell_width;                        
		$pdf->SetXY($current_x, $current_y); 
		
	$pdf->MultiCell($cell_width,$cell_height,$rows['remarks'],1);
		$current_x+=$cell_width;                        
		$pdf->SetXY($current_x, $current_y); 
		
	$pdf->MultiCell($cell_width,$cell_height,$rows['status'],1);
		$current_x+=$cell_width;                        
		$pdf->SetXY($current_x, $current_y); 
$pdf->Ln();	
}
		}
$pdf->Output();
?>