<?php 
include_once("conn.php");
require('fpdf/wrap.php');
$id= $_GET['id'];

	
$sqll = "SELECT docu_id, subject FROM files WHERE id=$id";
$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'");

while($fetch = mysqli_fetch_array($nquery)){
$docu_id = $fetch['docu_id'];
$subject = $fetch['subject'];
$pdf = new FPDF();
$pdf= new wrap();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'AUDIT TRAIL');
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
$pdf->Ln();

$sql = "SELECT * FROM tags WHERE id=$id ORDER BY date DESC";
$result= mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

$pdf->SetFont('Arial','B',9);
$pdf->Cell(25,10,'DATE TAGGED',1,0,'C');
$pdf->Cell(58,10,'TAGGED BY',1,0,'C');
$pdf->Cell(58,10,'TAGGED TO',1,0,'C');
$pdf->Cell(25,10,'DATE VIEWED',1,0,'C');
$pdf->Cell(25,10,'STATUS',1,0,'C');
$pdf->Ln('fill');
$pdf->Ln();
$pdf->SetWidths(array(25,58,58,25,25));
srand(microtime()*1000000);
while($rows = mysqli_fetch_assoc($result)) 
	{
	$tag = $rows['tag'];
	
		$query = $conn->query("SELECT * FROM `remarks` WHERE `id` = '$id' AND tid='$tag'  ");
				$roww=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 )
					{
						$status= $roww['status'];
					}
					else
					{
						$status = "N/A";
					}
			
				$query = $conn->query("SELECT * FROM users WHERE tid = '$tag' ORDER by lname DESC ");
				$row=$query->fetch_array  ();
				$run_num_rows = $query->num_rows;
					if ($run_num_rows > 0 )
						{
							$sql = "SELECT fname, lname FROM users WHERE tid = '$tag' ORDER BY date DESC";
							$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
							while($row = mysqli_fetch_assoc($resultset)) 
							{
								$lname = $row['lname'];
								$fname = $row['fname'];
								$action = "$lname, $fname";
								
										for($i=0;$i<$i;$i++)
										$array = array();
										$pdf->SetFont('Arial','B',9);
										$pdf->RowJ(array($rows['date'],$rows['action'],$action,$rows['dateviewed'], $status));
							}
						}
					else
						{
							$sql = "SELECT fname, lname FROM admin WHERE tid = '$tag' ORDER BY date DESC";
							$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
							while($row = mysqli_fetch_assoc($resultset)) 
							{
								$lname = $row['lname'];
								$fname = $row['fname'];
								$action = "$lname, $fname";
								
										for($i=0;$i<$i;$i++)
										$array = array();
										$pdf->SetFont('Arial','B',9);
										$pdf->RowJ(array($rows['date'],$rows['action'],$action,$rows['dateviewed'], $status));
							}
						}	
	}		

ob_start();

$pdf->Output();
} 
?>