<?php
include_once("../database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $university_email = $_POST['university_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into evaluators table
    $stmt = $connection->prepare("INSERT INTO evaluators (full_name, university_email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $university_email, $hashed_password);

    if ($stmt->execute()) {
        // Retrieve the auto-generated id
        $evaluator_id = $stmt->insert_id;

        // Format the evaluator_id as "e-000001"
        $formatted_evaluator_id = "e-" . str_pad($evaluator_id, 6, '0', STR_PAD_LEFT);

        // Update the evaluator_id in the database
        $update_stmt = $connection->prepare("UPDATE evaluators SET evaluator_id = ? WHERE id = ?");
        $update_stmt->bind_param("si", $formatted_evaluator_id, $evaluator_id);
        $update_stmt->execute();

        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registration failed. Please try again later."]);
    }

    $stmt->close();
}

$connection->close();
?>
