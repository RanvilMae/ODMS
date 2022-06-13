<?php
include('conn.php');
require('fpdf/wrap.php');
if(isset($_POST['submit'])){
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$department =  $_GET['department'];
$sql = "SELECT docu_id,category, forw, fromw, subject, date, restriction, classification, pages FROM files where department='$department' AND DATE(date) BETWEEN '$date1' AND '$date2'  ";

$header = '';
$result ='';
$resultset =mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

$sqll = "SELECT COUNT(id) FROM files WHERE  department='$department' AND DATE(date) BETWEEN '$date1' AND '$date2' ";  
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
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'#',1,0,'C');
$pdf->Cell(30,10,'Record ID',1,0,'C');
$pdf->Cell(27,10,'Category',1,0,'C');
$pdf->Cell(40,10,'For',1,0,'C');
$pdf->Cell(30,10,'From',1,0,'C');
$pdf->Cell(75,10,'Subject',1,0,'C');
$pdf->Cell(20,10,'Date',1,0,'C');
$pdf->Cell(25,10,'Classification',1,0,'C');
$pdf->Cell(18,10,'# of Pages',1,0,'C');
$pdf->Ln('fill');
$pdf->Ln();
$pdf->SetWidths(array(10,30,27,40,30,75,20,25,18));
srand(microtime()*1000000);
for($i=1;$i<$total_records;$i++){
while($rows = mysqli_fetch_assoc($resultset)) {
    


    $array = array();
    $pdf->RowJ(array($i++, $rows['docu_id'], $rows['category'], $rows['forw'],$rows['fromw'],$rows['subject'],$rows['date'],$rows['classification'],$rows['pages']));
}

}
ob_start();
$pdf->Output();
ob_end_flush();
	
	
}
?>