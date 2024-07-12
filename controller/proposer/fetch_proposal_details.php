<?php
// Include your database connection file
include_once("../database.php");

// Check if the proposal ID is provided in the query string
if(isset($_GET['id'])) {
    // Get the proposal ID from the query string
    $proposal_id = $_GET['id'];

    // Connect to the database
    global $connection;

    // Query to fetch proposal details based on the ID
    $query = "SELECT * FROM submissions WHERE id = ?";

    // Prepare the statement
    $stmt = $connection->prepare($query);

    if($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $proposal_id);

        // Execute the query
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if proposal exists
        if($result->num_rows === 1) {
            // Fetch proposal details
            $proposal = $result->fetch_assoc();

            // Close statement
            $stmt->close();

            // Return proposal details as JSON if not requesting the document
            if (!isset($_GET['download'])) {
                echo json_encode($proposal);
            } else {
                // Send the document as a file download
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="document.pdf"'); // Change the filename if needed
                echo $proposal['document'];
            }
        } else {
            // Proposal not found
            echo json_encode(["error" => "Proposal not found"]);
        }
    } else {
        // Error in preparing statement
        echo json_encode(["error" => "Failed to prepare statement"]);
    }
} else {
    // Proposal ID not provided in the query string
    echo json_encode(["error" => "Proposal ID not provided"]);
}
?>
