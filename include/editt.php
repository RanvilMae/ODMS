<?php
require 'conn.php';

if (isset($_POST['id'])) {

$productID = $_POST['id'];

$query = $conn->prepare('SELECT * FROM files WHERE id=:id');
$query->execute(array(':id' => $id));

if ($query->rowCount() > 0) {

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

        $data['forw'] = $row['forw'];
        $data['fromw'] = $row['fromw'];
        $data['tow'] = $row['tow'];
        $data['re'] = $row['re'];
        $data['subject'] = $row['subject'];
        $data['date'] = $row['date'];
        $data['description'] = $row['description'];
        $data['signatory'] = $row['signatory'];

}
    echo json_encode($data);

}else{
    echo "<h1>" . "Error 404 Page" . "</h1>";
}
}
?>