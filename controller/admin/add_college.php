<?php
include("./database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $college_name = $_POST['college_name'];
    $campus_id = $_POST['campus_id'];

    // Generate new college ID
    $result = $conn->query("SELECT COUNT(*) AS count FROM college");
    $row = $result->fetch_assoc();
    $new_id = 'co' . str_pad($row['count'] + 1, 3, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO college (college_id, college_name, campus_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $new_id, $college_name, $campus_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'id' => $new_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
