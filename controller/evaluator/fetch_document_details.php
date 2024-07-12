<?php
// Include the database connection file
include_once('../database.php');

header('Content-Type: application/json');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    // Fetch data from the database based on the provided ID
    $sql = "SELECT * FROM documents WHERE id = $id";
} else {
    // Fetch all data from the database if 'id' is not set
    $sql = "SELECT * FROM documents";
}

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $documents = [];

    while ($row = $result->fetch_assoc()) {
        $documents[] = $row;
    }

    // Close connection
    $connection->close();

    // Output JSON data
    echo json_encode($documents);
} else {
    echo json_encode(["message" => "No data found"]);
}
?>
