<?php
//insert.php
if(isset($_POST["post"]))
{
 include("conn.php");
 $tag = mysqli_real_escape_string($con, $_POST["tag"]);
 $id = mysqli_real_escape_string($con, $_POST["id"]);
 $date = mysqli_real_escape_string($con, $_POST["date"]);
 $query = "
 INSERT INTO tags(tag, id, date)
 VALUES ('$tag', '$id', '$date')
 ";
 mysqli_query($conn, $query);
}
?>