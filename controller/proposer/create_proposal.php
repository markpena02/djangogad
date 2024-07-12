<?php
// Start the session
session_start();

// Include your database connection file
include_once("../database.php");

// Function to log errors
function log_error($message) {
    error_log($message, 3, '../error_log.log');
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user_id is set in the session
    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        // Retrieve form data
        $title = $_POST['title'];
        $proponent_name = $_POST['proponent_name'];
        $office = $_POST['office'];
        $description = $_POST['description'];
        $user_id = $_SESSION['user_id']; // Get the user ID from the session

        // Set default status to "pending"
        $status = "pending";

        // Insert data into the database without document content
        $stmt = $connection->prepare("INSERT INTO submissions (title, proponent_name, office, description, proposer_id, status, document) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            log_error("Prepare failed: (" . $connection->errno . ") " . $connection->error);
            echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
            exit();
        }
        $stmt->bind_param("sssssss", $title, $proponent_name, $office, $description, $user_id, $status, $proposalDir);

        if ($stmt->execute()) {
            // Get the last inserted ID
            $proposalId = $stmt->insert_id;

            // Define the directory for the proposal
            $proposalDir = "../resources/proposal_{$proposalId}";

            // Ensure the proposal directory exists
            if (!is_dir($proposalDir)) {
                if (!mkdir($proposalDir, 0777, true)) {
                    log_error("Failed to create directory: " . $proposalDir);
                    echo json_encode(["status" => "error", "message" => "Failed to create directory for proposal files."]);
                    exit();
                }
            }

            // Process each uploaded file
            foreach ($_FILES['document']['name'] as $index => $document_name) {
                $document_tmp_name = $_FILES['document']['tmp_name'][$index];

                // Define the new file path inside the proposal directory
                $newFilePath = "{$proposalDir}/" . basename($document_name);

                // Move the uploaded file to the proposal directory
                if (move_uploaded_file($document_tmp_name, $newFilePath)) {
                    // File uploaded successfully
                } else {
                    log_error("Failed to move uploaded file: " . $document_name);
                    echo json_encode(["status" => "error", "message" => "Failed to save document."]);
                    exit();
                }
            }

            // Update the document path in the database
            $updateStmt = $connection->prepare("UPDATE submissions SET document = ? WHERE id = ?");
            if (!$updateStmt) {
                log_error("Prepare failed: (" . $connection->errno . ") " . $connection->error);
                echo json_encode(["status" => "error", "message" => "Failed to prepare statement for updating document path."]);
                exit();
            }
            $updateStmt->bind_param("si", $proposalDir, $proposalId);
            $updateStmt->execute();
            $updateStmt->close();

            // Submission successful
            echo json_encode(["status" => "success", "message" => "Proposal submitted successfully!"]);
        } else {
            log_error("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            // Submission failed
            echo json_encode(["status" => "error", "message" => "Failed to submit proposal. Please try again later."]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If user_id is not set in the session
        echo json_encode(["status" => "error", "message" => "Session proposer ID not found."]);
    }
}

// Close the database connection
$connection->close();
?>
