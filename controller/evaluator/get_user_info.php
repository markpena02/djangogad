<?php
session_start();
include_once("../database.php");

// Set response header to JSON
header('Content-Type: application/json');

try {
    if (isset($_SESSION['user_id']) && !is_null($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Fetch user information from the evaluators table
        $stmt = $connection->prepare("SELECT full_name, university_email FROM evaluators WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            echo json_encode([
                "status" => "success",
                "data" => $user
            ]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "User not found.", 
                "debug" => "user_id: $user_id, num_rows: " . $result->num_rows
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "User not logged in.", 
            "debug" => "session user_id not set"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "debug" => "Exception"
    ]);
}

$connection->close();
?>
