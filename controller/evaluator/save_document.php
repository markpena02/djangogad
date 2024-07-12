<?php
// Start the session
session_start();

// Include your database connection file
include_once("../database.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $proposer_id = $_POST['proposer_id'];
    $evaluator_id = $_POST['evaluator_id'];
    $document_file_json = json_encode($_POST['document_file']); // Encode document_file as JSON
    $resources_file = $_POST['resources_file'];
    $date_received = NULL; // Set date_received to NULL
    $date_reviewed = NULL; // Set date_reviewed to NULL
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $description = $_POST['description'];
    $college_office = $_POST['college_office'];

    // Insert data into the documents table
    $stmt = $connection->prepare("INSERT INTO documents (proposer_id, evaluator_id, document_file, resources_file, date_received, date_reviewed, status, remarks, description, college_office) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssssss", $proposer_id, $evaluator_id, $document_file_json, $resources_file, $date_received, $date_reviewed, $status, $remarks, $description, $college_office);

    if ($stmt->execute()) {
        // Document submission successful, now update the submission status
        $stmt->close(); // Close the previous statement

        $new_status = 'Completed';
        $stmt = $connection->prepare("UPDATE submissions SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $proposer_id);

        if ($stmt->execute()) {
            // Both operations successful
            $response = ["status" => "success", "message" => "Document saved and submission updated successfully!", "document_file_json" => $document_file_json];
        } else {
            // Failed to update submission status
            $response = ["status" => "error", "message" => "Failed to update submission status."];
        }
    } else {
        // Document submission failed
        $response = ["status" => "error", "message" => "Failed to save document."];
    }

    // Close the statement
    $stmt->close();
    echo json_encode($response);
} else {
    // If the request method is not POST
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

// Close the database connection
$connection->close();
?>
