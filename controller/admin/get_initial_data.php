<?php
include("../database.php");

$data = [];

$result = $conn->query("SELECT * FROM campus");
$data['campus'] = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM college");
$data['college'] = $result->fetch_all(MYSQLI_ASSOC);

$result = $conn->query("SELECT * FROM office");
$data['office'] = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($data);

$conn->close();
?>
