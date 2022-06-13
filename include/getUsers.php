<?php
include "config.php";

$department= $_POST['depart'];   // department id

$sql = "SELECT * FROM users WHERE department='$department' ORDER by lname ASC";


$result = mysqli_query($con,$sql);

$users_arr = array();


while( $row = mysqli_fetch_array($result) ){
    $userid = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];

    $users_arr[] = array("id" => $userid, "fname" => $fname, "lname" => $lname);
}

// encoding array to json format
echo json_encode($users_arr);