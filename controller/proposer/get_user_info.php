<?php
session_start();
include_once("../database.php");

// Set response header to JSON
header('Content-Type: application/json');

try {
    if (isset($_SESSION['user_id']) && !is_null($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Fetch user information from the database
        $stmt = $connection->prepare("SELECT full_name, college_office, university_email FROM proponents WHERE id = ?");
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
            echo json_encode(["status" => "error", "message" => "User not found."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "User not logged in."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close the database connection
$connection->close();
?>
