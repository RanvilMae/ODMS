<?php
include 'conn.php';
require "vendor/autoload.php";
use Endroid\QrCode\QrCode;
if(isset($_POST['qr']))  
{ 
$id=$_GET['id'];
$qrcode     = $_POST['qrcode'];
$tag=$_POST['tag'];

$query = $conn->query ("SELECT * FROM `files` WHERE `id` = '$id' ") or die (mysqli_error());
$gett = $query->fetch_array ();
								
$docu_id= $gett['docu_id'];
$name= $gett['name'];
$department= $gett['department'];
date_default_timezone_set("Asia/Manila"); 
$dateviewed = date("Y-m-d H:i:s");
$track = "1";

if($qrcode == $docu_id)
	{
		mysqli_query($conn, "UPDATE `files` SET `qr` = '1' WHERE `id` = '$id'") ;		
		mysqli_query($conn, "UPDATE `tags` SET `track` = '1' , `dateviewed` = '$dateviewed' WHERE `id` = '$id' AND `tag` = '$tag'") ;
		$message = "QR SUCCESSFULLY MATCHED!! ";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script type='text/javascript'>window.open('uploads/$department/$name')</script>";
		echo "<script>window.location = 'remarks.php?id=$id'</script>";
	}			
					
			
			else
				{
				
				$message = "FILE UNABLE TO OPEN!";	
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo "<script type='text/javascript'>window.location = 'incoming_a.php'</script>";	
		
				}

}
echo "<script type='text/javascript'>window.location = 'incoming_a.php'</script>";
?>


<?php
		include ("conn.php");
		$id= $_GET['id'];
			if(ISSET($_POST['tag']));
			{
				 $id = $_GET["id"];
				 
		date_default_timezone_set("Asia/Manila");
		$receive_date= date('Y-m-d H:i:s');
		mysqli_query($conn, "UPDATE files SET receive = 1,  `receive_date` = '$receive_date' WHERE receive = 0 AND id = '$id'") ;
			}
	
		 
		?>

