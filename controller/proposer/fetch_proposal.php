<?php
// Include your database connection file
include_once("../database.php");

function fetch_proposals() {
    // Start the session
    session_start();

    // Check if user is logged in and user ID is set in session
    if(isset($_SESSION['user_id'])) {
        // Get user ID from session
        $session_user_id = $_SESSION['user_id'];

        // Connect to the database
        global $connection;

        // Query to fetch data from submissions table for the specific user
        $query = "SELECT id, proposer_id, title, proponent_name, office, description, submitted_at, status FROM submissions WHERE proposer_id = ?";

        // Prepare the statement
        $stmt = $connection->prepare($query);

        if($stmt) {
            // Bind parameters
            $stmt->bind_param("i", $session_user_id);

            // Execute the query
            $stmt->execute();

            // Get result
            $result = $stmt->get_result();

            if($result) {
                // Initialize an empty array to store proposal data
                $proposals = [];

                // Fetch data and format into associative array
                while ($row = $result->fetch_assoc()) {
                    $proposals[] = [
                        "id" => $row['id'],
                        "proposer_id" => $row['proposer_id'],
                        "title" => $row['title'],
                        "proponent_name" => $row['proponent_name'],
                        "office" => $row['office'],
                        "description" => $row['description'],
                        // "document" => $row['document'],
                        "submitted_at" => $row['submitted_at'],
                        "status" => $row['status']
                    ];
                }

                // Free result set
                $result->free();

                // Close statement
                $stmt->close();

                // Return proposal data
                return $proposals;
            } else {
                // Handle query execution error
                return ["error" => "Failed to execute query"];
            }
        } else {
            // Handle statement preparation error
            return ["error" => "Failed to prepare statement"];
        }
    } else {
        // Handle user not logged in
        return ["error" => "User not logged in"];
    }
}

// Usage example:
$proposals = fetch_proposals();
echo json_encode($proposals);
?>
