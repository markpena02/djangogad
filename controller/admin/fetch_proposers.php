<?php
// Include your database connection file
include_once("../database.php");

function fetch_evaluator() {
    // Connect to the database
    global $connection;

    // Query to fetch all columns from the evaluator table
    $query = "SELECT * FROM proponents";

    // Execute the query
    $result = $connection->query($query);

    if($result) {
        // Initialize an empty array to store document data
        $evaluator = [];

        // Fetch data and format into associative array
        while ($row = $result->fetch_assoc()) {
            $evaluator[] = [
                "id" => $row['id'],
                "name" => $row['full_name'],
                "college_office" => $row['college_office'],
                "university_email" => $row['university_email']
            ];
        }

        // Free result set
        $result->free();

        // Return document data
        return $evaluator;
    } else {
        // Handle query execution error
        return ["error" => "Failed to execute query"];
    }
}

// Usage example:
$evaluator = fetch_evaluator();
echo json_encode($evaluator);
?>
