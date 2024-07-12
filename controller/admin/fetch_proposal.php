<?php
// Include your database connection file
include_once("../database.php");

function fetch_proposals() {
    // Connect to the database
    global $connection;

    // Query to fetch specific columns from submissions table where status is pending
    $query = "SELECT * FROM submissions WHERE status = 'pending'";

    // Execute the query
    $result = $connection->query($query);

    if($result) {
        // Initialize an empty array to store proposal data
        $proposals = [];

        // Fetch data and format into associative array
        while ($row = $result->fetch_assoc()) {
            $proposals[] = [
                "title" => $row['title'],
                "proponent_name" => $row['proponent_name'],
                "description" => $row['description'],
                "id" => $row['id'],
                "proposer_id" => $row['proposer_id'],
                "evaluator_id" => $row['evaluator_id']
            ];
        }

        // Free result set
        $result->free();

        // Return proposal data
        return $proposals;
    } else {
        // Handle query execution error
        return ["error" => "Failed to execute query"];
    }
}

// Usage example:
$proposals = fetch_proposals();
echo json_encode($proposals);

?>
