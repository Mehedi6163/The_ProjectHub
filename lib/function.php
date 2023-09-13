<?php

/**
 * Check user is auth or not
 */
function auth_check()
{
    if (!isset($_SESSION['is_auth'])) {
        header('location: login.php');
        exit;
    }
}
/**
 * validate user data
 */
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * upload file
 */
function upload($file, $dir, $type = null)
{
    $allowedExtensions = ['jpg', 'png', 'gif'];

    if (!is_null($type) && $type == 'file') {
        $allowedExtensions = array_merge($allowedExtensions, ['pdf', 'excel']);
    }

    if ($file['error'] === UPLOAD_ERR_OK) {
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($extension, $allowedExtensions)) {
            $uniqueFilename = uniqid() . '.' . $extension;
            $uploadPath = $dir . '/' . $uniqueFilename;
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                return [
                    'filename' => $uniqueFilename
                ];
            } else {
                return "Failed to move the uploaded file.";
            }
        } else {
            return "File type not allowed. Allowed types: " . implode(', ', $allowedExtensions);
        }
    } else {
        return "File upload error: " . $file['error'];
    }
}
