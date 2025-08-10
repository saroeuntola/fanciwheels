<?php
// upload_image.php

header('Content-Type: application/json');

$uploadDir = 'game_image/';

if (!empty($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Sanitize file name and create unique name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // Allowed file extensions
    $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($fileExtension, $allowedfileExtensions)) {
        $dest_path = $uploadDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            // Return the URL to the uploaded image (adjust base URL as needed)
            $imageURL = '/' . $dest_path;
            echo json_encode(['url' => $imageURL]);
            exit;
        }
    }
}

echo json_encode(['error' => 'Upload failed']);
exit;
