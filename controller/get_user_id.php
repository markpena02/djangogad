<?php
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    // Return user ID as JSON
    echo json_encode(["status" => "success", "user_id" => $_SESSION['user_id']]);
    exit();
} else {
    // Return error message if user is not logged in
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}
?>
