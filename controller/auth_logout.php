<?php
// Start the session
session_start();

// Initialize response array
$response = array();

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Set response status
    $response['status'] = 'success';
    $response['message'] = 'Logout complete';
} else {
    // Set response status
    $response['status'] = 'error';
    $response['message'] = 'User not logged in';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
