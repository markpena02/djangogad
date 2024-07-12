<?php
// Start the session
session_start();

// Set response header to JSON
header('Content-Type: application/json');

// Include database connection details
include("./database.php");

// Check if user is logged in
if (isset($_SESSION['user_id']) && !is_null($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch user's name from the database
    $stmt = $connection->prepare("SELECT full_name FROM evaluators WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode([
            "status" => "success",
            "message" => "User is logged in",
            "user_name" => $user['full_name']
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "User not found"
        ]);
    }
} else {
    // If not logged in, return JSON indicating user is not logged in
    echo json_encode([
        "status" => "error",
        "message" => "User is not logged in"
    ]);
}
?>
