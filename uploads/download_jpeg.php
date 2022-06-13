<?php
include_once("conn.php");
$id= $_GET['id'];
$sql = "SELECT * WHERE id=$id ORDER BY date DESC";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$sqll = "SELECT docu_id, subject FROM files WHERE id=$id";
$nquery=mysqli_query($conn,"select * from `files` WHERE id = '$id'");

while($fetch = mysqli_fetch_array($nquery)){
$docu_id = $fetch['docu_id'];
$subject = $fetch['subject'];


// Create a 100*30 image
$im = imagecreate(600, 500);

// White background and blacktext
$bg = imagecolorallocate($im, 255, 255, 255);
$textcolor = imagecolorallocate($im, 0, 0, 0);


// Write the string at the top left
imagestring($im, 10, 250, 10, "TRAVEL TAX", $textcolor);

imagestring($im, 10, 200, 25, "EXEMPTION CERTIFICATE", $textcolor);

// Output the image
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);


} 
?>