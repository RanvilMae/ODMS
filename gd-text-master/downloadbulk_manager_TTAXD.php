<?php
include('conn.php');
     $sql = "SELECT * FROM files WHERE restriction = 'Open to All' AND department = 'TTAXD' || restriction = 'Confidential' AND department = 'TTAXD'";
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
    header('Content-Disposition: attachment; filename="TTAXD FILES.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
	 fputcsv($fp, array('RECORD ID','FILE NAME','FOR','FROM', 'TO', 'RE', 'SUBJECT','DATE','DESCRIPTION','SIGNATORY', 'EXTENSION', 'RESTRICTION', 'DEPARTMENT'));
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}

?>