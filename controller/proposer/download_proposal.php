<?php
// Include your database connection file
include_once("../database.php");

// Check if the proposal ID is provided
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $proposalId = $_GET['id'];

    // Prepare and execute query to fetch folder path based on ID
    $stmt = $connection->prepare("SELECT document FROM submissions WHERE id = ?");
    $stmt->bind_param("i", $proposalId);
    $stmt->execute();
    $stmt->store_result();

    // Check if a folder path is found
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($folderPath);
        $stmt->fetch();

        // Check if the folder exists
        if (is_dir($folderPath)) {
            // Create a zip file
            $zip = new ZipArchive();
            $zipFileName = tempnam(sys_get_temp_dir(), 'zip');
            if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
                exit("Cannot open <$zipFileName>\n");
            }

            // Add files to the zip file
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($folderPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Skip directories (they would be added automatically)
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            // Close the zip file
            $zip->close();

            // Set headers for file download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($folderPath) . '.zip"');
            header('Content-Length: ' . filesize($zipFileName));

            // Output the zip file content
            readfile($zipFileName);

            // Delete the temporary zip file
            unlink($zipFileName);
            exit;
        } else {
            // Folder not found
            echo "Folder not found.";
        }
    } else {
        // Proposal not found
        echo "Proposal not found.";
    }

    // Close statement and database connection
    $stmt->close();
    $connection->close();
} else {
    // Proposal ID not provided
    echo "Proposal ID not provided.";
}
?>
