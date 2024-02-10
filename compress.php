<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file'])) {
        die('No file uploaded.');
    }
    $uploadedFile = $_FILES['file']['tmp_name'];
    if (!is_uploaded_file($uploadedFile)) {
        die('File upload failed.');
    }
    $compressedDirectory = 'compressed';
    if (!file_exists($compressedDirectory)) {
        mkdir($compressedDirectory);
    }

    $compressedFile = $compressedDirectory . '/' . basename($_FILES['file']['name']) . '.zip';

    $zip = new ZipArchive();
    if ($zip->open($compressedFile, ZipArchive::CREATE) !== true) {
        die('Cannot create zip archive');
    }
    if (filesize($uploadedFile) > 0) {
        $zip->addFile($uploadedFile, basename($_FILES['file']['name']));
    } else {
        die('Uploaded file is empty.');
    }
    $zip->close();

    echo '<p>File compressed successfully. <a href="' . $compressedFile . '" download>Download Compressed File</a></p>';
} else {
    echo 'Invalid request method.';
}
?>
