<?php
session_start();

// Include your database connection file
include_once("../database.php");

// Set response header to JSON
header('Content-Type: application/json');

try {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Add validation checks here if needed

        // Fetch user from the database based on email
        $stmt = $connection->prepare("SELECT * FROM evaluators WHERE university_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            // User found, verify password
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, set the session user ID
                $_SESSION['user_id'] = $user['id'];

                // Redirect to dashboard
                echo json_encode([
                    "status" => "success", 
                    "message" => "Login successful", 
                    "redirect_url" => "dashboard.html",
                    "auth_id" => $_SESSION['user_id']
                ]);
                exit();
            }
        }

        // If user is not found or password is incorrect, return error message
        echo json_encode(["status" => "error", "message" => "Incorrect email or password"]);
        exit();
    }
} catch (Exception $e) {
    // Return a JSON error response
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    exit();
}

// Close the database connection
$connection->close();
?>
