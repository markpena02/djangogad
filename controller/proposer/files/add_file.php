<?php

// Check if files were sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['files']) && isset($_POST['url'])) {
    $fileUrl = $_POST['url']; // Get the fileUrl from the POST request
    $uploadDirectory = "../../controller/" . $fileUrl . "/";

    // Ensure the directory exists
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Process each file
    $response = [];
    foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
        $fileName = basename($_FILES['files']['name'][$index]);
        $targetPath = $uploadDirectory . $fileName;

        // Move the uploaded file to the target path
        if (move_uploaded_file($tmpName, $targetPath)) {
            $response[] = [
                "status" => "success",
                "message" => "File {$fileName} uploaded successfully.",
                "file_path" => $targetPath
            ];
        } else {
            $response[] = [
                "status" => "error",
                "message" => "Failed to upload file {$fileName}."
            ];
        }
    }

    // Send JSON response
    echo json_encode($response);
} else {
    // Invalid request
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

?>
