<?php
include('conn.php');
require('fpdf/wrap.php');
if(isset($_POST['submit'])){
$date1=$_POST['date1'];
$date2=$_POST['date2'];
$tid =  $_GET['tid'];

$sqll = "SELECT COUNT(primary_id) FROM `tags` WHERE  tid='$tid' `tag` ='$tid' AND `track` = '1' AND DATE(date) BETWEEN '$date1' AND '$date2' ";  
				$rs_result = mysqli_query($conn, $sqll);  
				$row = mysqli_fetch_row($rs_result);  
				$total_records = $row[0]; 
 

$pdf = new FPDF();
$pdf= new wrap();
$pdf->SetFont('Arial','B',22);
$pdf->Cell(40,10,'MASTERLIST INCOMING FILES');
$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,'TAGGED FILES');
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
$nquery=mysqli_query($conn,"SELECT * FROM `tags` WHERE `tag` ='$tid' AND `track` = '1'");
			foreach ( $nquery as $get){
    			$id = $get['id'];
          $result = mysqli_query($conn,"SELECT * FROM `files` WHERE id = '$id'");
            while($rows = mysqli_fetch_assoc($result)) {
    

    


    $array = array();
    $pdf->RowJ(array($i++, $rows['docu_id'], $rows['category'], $rows['forw'],$rows['fromw'],$rows['subject'],$rows['date'],$rows['classification'],$rows['pages']));
}

}
ob_start();
$pdf->Output();
ob_end_flush();
	
	
}
?>