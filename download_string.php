<?php
include('conn.php');
require('fpdf/wrap.php');
if(isset($_POST['submit'])){
$string=$_POST['string'];
$department =  $_GET['department'];
$sql = "SELECT * FROM files WHERE
										id ='$string' OR
										docu_id ='$string' OR
										name ='$string' OR
										forw ='$string' OR
										fromw ='$string' OR
										subject ='$string' OR
										Date(date) ='$string' OR
										restriction ='$string' OR
										department ='$string' OR
										classification ='$string' OR
										category ='$string' OR
										pages ='$string'
										";

$header = '';
$result ='';
$resultset =mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));


$sqll = "SELECT COUNT(id) FROM files WHERE
										id ='$string' OR
										docu_id ='$string' OR
										name ='$string' OR
										forw ='$string' OR
										fromw ='$string' OR
										subject ='$string' OR
										Date(date) ='$string' OR
										restriction ='$string' OR
										department ='$string' OR
										classification ='$string' OR
										category ='$string' OR
										pages ='$string'
										";

				$rs_result = mysqli_query($conn, $sqll);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0]; 
 
 


$pdf = new FPDF();
$pdf= new wrap();
$pdf->AddPage('L');
$pdf->SetFont('Arial','B',22);
$pdf->Cell(40,10,'MASTERLIST');
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','',11);
$pdf->Cell(40,10,'TOTAL RECORD/S = '.$total_records);
$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,10,'#',1,0,'C');
$pdf->Cell(27,10,'Record ID',1,0,'C');
$pdf->Cell(50,10,'For',1,0,'C');
$pdf->Cell(30,10,'From',1,0,'C');
$pdf->Cell(93,10,'Subject',1,0,'C');
$pdf->Cell(25,10,'Date',1,0,'C');
$pdf->Cell(25,10,'Classification',1,0,'C');
$pdf->Ln('fill');
$pdf->Ln();
$pdf->SetWidths(array(15,27,50,30,93,25,25));
srand(microtime()*1000000);
for($i=1;$i<$total_records;$i++){
while($rows = mysqli_fetch_assoc($resultset)) {
    $array = array();
    $pdf->RowJ(array($i++,$rows['docu_id'],$rows['forw'],$rows['fromw'],$rows['subject'],$rows['date'],$rows['classification']));
}
}
ob_start();
$pdf->Output();
ob_end_flush();
	
	
}
?>