<?php
// Start the session (if required)
// session_start();

// Include your database connection file
include_once("../database.php");

// Function to log errors
function log_error($message) {
    error_log($message, 3, '../error_log.log');
}

// Check if proposal ID is provided via GET parameter
if (!isset($_GET['id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["status" => "error", "message" => "Proposal ID is required."]);
    exit();
}

$proposalId = $_GET['id'];

// Fetch document path and filename from submissions table
$stmt = $connection->prepare("SELECT document FROM submissions WHERE id = ?");
if (!$stmt) {
    log_error("Prepare failed: (" . $connection->errno . ") " . $connection->error);
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
    exit();
}
$stmt->bind_param("i", $proposalId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404); // Not Found
    echo json_encode(["status" => "error", "message" => "Proposal not found."]);
    exit();
}

$row = $result->fetch_assoc();
$documentPath = $row['document']; // Assuming this is the document path ("resources/proposal_{id}")

$stmt->close();

// Initialize an array to store filenames with document paths
$filesData = [];

// Check if the documentPath exists
if (is_dir($documentPath)) {
    // Scan the documentPath for files
    $files = scandir($documentPath);
    
    // Remove . and .. from the list
    $files = array_diff($files, array('.', '..'));
    
    // Add filenames with document paths to the array
    foreach ($files as $file) {
        $filesData[] = [
            "filename" => $file,
            "documentPath" => $documentPath
        ];
    }
} else {
    log_error("documentPath not found: " . $documentPath);
    echo json_encode(["status" => "error", "message" => "documentPath not found."]);
    exit();
}

// Return the list of filenames with document paths as JSON response
header('Content-Type: application/json');
echo json_encode($filesData);

// Close the database connection
$connection->close();
?>
