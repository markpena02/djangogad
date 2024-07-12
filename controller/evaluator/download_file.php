<?php
    // Include your database connection file
    include_once("../database.php");

    // Get the file ID from the URL (or other method of identifying the file)
    $file_id = $_GET['file_id'];

    // Prepare and execute the query
    $stmt = $connection->prepare("SELECT document, document_content FROM submissions WHERE id = ?");
    $stmt->bind_param("i", $file_id);
    $stmt->execute();
    $stmt->bind_result($document_name, $document_content);
    $stmt->fetch();
    $stmt->close();

    // Set headers to download the file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($document_name) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($document_content));

    // Clean output buffer
    ob_clean();
    flush();

    // Output the file content
    echo $document_content;

    // Close the database connection
    $connection->close();
?>
