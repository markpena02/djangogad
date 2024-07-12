<?php
// Include your database connection file
include_once("../database.php");

// Disable error reporting or set it to log errors to a file
error_reporting(0); // Or use ini_set('display_errors', 0);
header('Content-Type: application/json');

/**
 * Update an evaluator's details in the database.
 *
 * @param int $proposalId
 * @param int $evaluator_id
 * @return array
 */
function update_evaluator($proposalId, $evaluator_id) {
    // Connect to the database
    global $connection;

    // Prepare and bind the update statement
    $stmt = $connection->prepare("UPDATE submissions SET evaluator_id = ? WHERE id = ?");
    $stmt->bind_param("ii", $evaluator_id, $proposalId);

    // Execute the statement
    $stmt->execute();

    // Check if any row was actually updated
    if ($stmt->affected_rows > 0) {
        return ["success" => "Evaluator updated successfully"];
    } else {
        return ["error" => "No submission found with the provided proposal ID"];
    }

    // Close the statement
    $stmt->close();
}

// Get the data from the POST request
$proposalId = intval($_POST['proposal_id']);
$evaluator_id = intval($_POST['evaluator_id']);

// Call the function to update the evaluator
$update_response = update_evaluator($proposalId, $evaluator_id);

// Return the response as JSON
echo json_encode($update_response);
?>
