<?php
// Include your database connection file
include_once("../database.php");

function fetch_documents() {
    // Connect to the database
    global $connection;

    // Query to fetch all columns from the documents table
    $query = "SELECT * FROM documents";

    // Execute the query
    $result = $connection->query($query);

    if($result) {
        // Initialize an empty array to store document data
        $documents = [];

        // Fetch data and format into associative array
        while ($row = $result->fetch_assoc()) {
            $documents[] = $row; // Simply push the row as it contains all columns
        }

        // Free result set
        $result->free();

        // Return document data
        return $documents;
    } else {
        // Handle query execution error
        return ["error" => "Failed to execute query"];
    }
}

// Usage example:
$documents = fetch_documents();
echo json_encode($documents);
?>
