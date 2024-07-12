<?php

// Assuming the filenames are passed via GET method
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    // Directory where files are stored (adjust path as needed)
    $directory = '../../resources/';

    // Check if the file exists
    if (file_exists($directory . $filename)) {
        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($directory . $filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($directory . $filename));
        readfile($directory . $filename);
        exit;
    } else {
        // File does not exist
        echo json_encode(['status' => 'error', 'message' => 'File not found.']);
    }
} else {
    // No filename provided
    echo json_encode(['status' => 'error', 'message' => 'No filename provided.']);
}

?>
