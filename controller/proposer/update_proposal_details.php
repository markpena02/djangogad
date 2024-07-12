<?php
include_once("../database.php");

// Get the JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'], $data['title'], $data['proponent_name'], $data['office'], $data['description'])) {
    $id = $data['id'];
    $title = $data['title'];
    $proponent_name = $data['proponent_name'];
    $office = $data['office'];
    $description = $data['description'];

    // Prepare the SQL query
    $sql = "UPDATE submissions SET title = ?, proponent_name = ?, office = ?, description = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $title, $proponent_name, $office, $description, $id);

    if ($stmt->execute()) {
        $response = array("status" => "success", "message" => "Proposal details updated successfully");
    } else {
        $response = array("status" => "error", "message" => "Error updating proposal details");
    }

    $stmt->close();
} else {
    $response = array("status" => "error", "message" => "Invalid input");
}

// Close the database connection
$connection->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
