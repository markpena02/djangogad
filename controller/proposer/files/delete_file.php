<?php
$fileUrl = $_POST['fileUrl']; // Assuming you sanitize and validate $fileUrl

// Add ../ to the beginning of the fileUrl
$fileUrl = '../..' . $fileUrl;

if (is_file($fileUrl)) {
    if (unlink($fileUrl)) {
        echo "File $fileUrl has been deleted.";
    } else {
        echo "Unable to delete $fileUrl.";
    }
} else {
    echo "File $fileUrl does not exist.";
}
?>
