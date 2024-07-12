<?php
// Include your database connection file
include_once("../database.php");

function fetch_evaluators() {
    // Connect to the database
    global $connection;

    // Query to fetch all columns from the evaluators table
    $query = "SELECT id, full_name, university_email, created_at FROM evaluators";

    // Execute the query
    $result = $connection->query($query);

    if($result) {
        // Initialize an empty array to store evaluator data
        $evaluators = [];

        // Fetch data and format into associative array
        while ($row = $result->fetch_assoc()) {
            $evaluators[] = [
                "id" => $row['id'],
                "name" => $row['full_name'],
                "university_email" => $row['university_email'],
                "created_at" => $row['created_at']
            ];
        }

        // Free result set
        $result->free();

        // Return evaluator data
        return $evaluators;
    } else {
        // Handle query execution error
        return ["error" => "Failed to execute query"];
    }
}

// Usage example:
$evaluators = fetch_evaluators();
echo json_encode($evaluators);
?>
