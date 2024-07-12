<?php
session_start();
include_once("../database.php");

// Set response header to JSON
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id']) && !is_null($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate the new password
        if ($new_password !== $confirm_password) {
            echo json_encode(["status" => "error", "message" => "New passwords do not match."]);
            exit();
        }

        // Fetch the current password from the database
        $stmt = $connection->prepare("SELECT password FROM proponents WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($old_password, $user['password'])) {
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password in the database
                $update_stmt = $connection->prepare("UPDATE proponents SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $user_id);

                if ($update_stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "Password changed successfully."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to update password. Please try again later."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Old password is incorrect."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "User not found."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request method or user not logged in."]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

// Close the database connection
$connection->close();
?>
