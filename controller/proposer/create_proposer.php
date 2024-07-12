<?php
// Include your database connection file
include_once("../database.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $college_office = $_POST['college_office'];
    $university_email = $_POST['university_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $is_employee = isset($_POST['employee']) ? 1 : 0;

    // Add validation checks here if needed
    if ($password !== $confirm_password) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $stmt = $connection->prepare("INSERT INTO proponents (full_name, college_office, university_email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $college_office, $university_email, $hashed_password);

    if ($stmt->execute()) {
        // Retrieve the auto-generated id
        $proposer_id = $stmt->insert_id;

        // Format the proposer_id as "p-000001"
        // $formatted_proposer_id = "p-" . str_pad($proposer_id, 6, '0', STR_PAD_LEFT);
        if ($is_employee) {
            $formatted_proposer_id = "i-" . str_pad($proposer_id, 6, '0', STR_PAD_LEFT);
        } else {
            $formatted_proposer_id = "o-" . str_pad($proposer_id, 6, '0', STR_PAD_LEFT);
        }

        // Update the proposer_id in the database
        $update_stmt = $connection->prepare("UPDATE proponents SET proposer_id = ? WHERE id = ?");
        $update_stmt->bind_param("si", $formatted_proposer_id, $proposer_id);
        $update_stmt->execute();

        echo json_encode(["success" => true, "message" => "Registration successful!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Registration failed. Please try again later."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

// Close the database connection
$connection->close();
?>
