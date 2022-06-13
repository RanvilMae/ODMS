<?php

$host = "96.44.174.18"; /* Host name */
$user = "tiezagov_tieza_portal"; /* User */
$password = ")SCCZqTZ3M,b"; /* Password */
$dbname = "tiezagov_tieza_portal"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}