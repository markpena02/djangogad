<?php
include("./database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $office_name = $_POST['office_name'];
    $campus_id = $_POST['campus_id'];
    $college_id = $_POST['college_id'];

    // Generate new office ID
    $result = $conn->query("SELECT COUNT(*) AS count FROM office");
    $row = $result->fetch_assoc();
    $new_id = 'of' . str_pad($row['count'] + 1, 4, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO office (office_id, office_name, campus_id, college_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $new_id, $office_name, $campus_id, $college_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $new_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
