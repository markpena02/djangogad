<?php
// Start the session
session_start();

// Include your database connection file
include_once("../database.php");

// Function to get ZIP file contents
function getZIPContents($proposalId) {
    // Define the directory where ZIP files are stored
    $zipDir = '../resources';

    // Construct the ZIP file path based on proposal ID
    $zipFilePath = "{$zipDir}/resources-{$proposalId}-1.zip";

    // Check if the ZIP file exists
    if (file_exists($zipFilePath)) {
        // Initialize an array to store file names
        $files = array();

        // Open the ZIP file
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath) === TRUE) {
            // Extract each file name from the ZIP archive
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                // Add file name to the array
                $files[] = $filename;
            }
            // Close the ZIP file
            $zip->close();

            // Return the list of files as JSON
            return json_encode(["status" => "success", "files" => $files]);
        } else {
            // Unable to open ZIP file
            return json_encode(["status" => "error", "message" => "Failed to open ZIP file."]);
        }
    } else {
        // ZIP file does not exist
        return json_encode(["status" => "error", "message" => "ZIP file not found."]);
    }
}

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if proposal ID is provided in the URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $proposalId = $_GET['id'];

        // Call function to get ZIP file contents
        $response = getZIPContents($proposalId);

        // Output the JSON response
        echo $response;
    } else {
        // Proposal ID is missing
        echo json_encode(["status" => "error", "message" => "Proposal ID not provided"]);
    }
} else {
    // Invalid request method
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>
