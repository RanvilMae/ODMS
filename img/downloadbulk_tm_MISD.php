<?php
include('conn.php');
	 $department= $_GET['department'];
     $sql = "SELECT * FROM files WHERE department = '$department'";
    $result = mysqli_query($conn, $sql);

if (!$result) die('Couldn\'t fetch records');
$num_fields = $conn->query('$result');
$headers = array();
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysql_field_name($result , $i);
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="MISD FILES.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
	 fputcsv($fp, array('RECORD ID','FILE NAME','FOR','FROM', 'SUBJECT','DATE', 'EXTENSION', 'RESTRICTION', 'DEPARTMENT', 'CLASSIFICATION'));
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>