<?php
include "conn.php";

$department = $_POST['department'];   // department id

$sql = "SELECT * FROM users WHERE department=".$department;

$result = mysqli_query($con,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $id = $row['id'];
    $fname = $row['fname'];

    $users_arr[] = array("id" => $id, "fname" => $fname);
}

// encoding array to json format
echo json_encode($users_arr);