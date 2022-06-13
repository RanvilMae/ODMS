<?php
include('conn.php');


if (isset($_POST['delete'])){

$id=$_POST['selector'];

$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query("DELETE FROM files where id='$id[$i]'");
}
header("location: ss.php");

}
?>
