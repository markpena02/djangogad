<?php
// Assuming you have included necessary database connection and functions
include_once("../database.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the ID parameter is set
    if (isset($_POST["id"])) {
        $userId = $_POST["id"];
        
        // Prepare and execute the SQL query to delete the proposer
        $stmt = $connection->prepare("DELETE FROM proponents WHERE id = ?");
        $stmt->bind_param("i", $userId); // Assuming "id" is an integer, change the "i" if it's a different type
        $success = $stmt->execute();

        if ($success) {
            // Send a success response
            echo json_encode(["success" => true, "message" => "Proposer deleted successfully."]);
        } else {
            // Send an error response
            echo json_encode(["success" => false, "message" => "Error deleting proposer."]);
        }
    } else {
        // Send an error response if ID parameter is not set
        echo json_encode(["success" => false, "message" => "ID parameter is missing."]);
    }
} else {
    // Send an error response if the request method is not POST
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
