<?php
include("../database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campus_name = $_POST['campus_name'];
    $campus_address = $_POST['campus_address'];

    // Generate new campus ID
    $result = $conn->query("SELECT COUNT(*) AS count FROM campus");
    $row = $result->fetch_assoc();
    $new_id = 'ca' . str_pad($row['count'] + 1, 2, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO campus (campus_id, campus_name, campus_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $new_id, $campus_name, $campus_address);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $new_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
