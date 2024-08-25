<?php
header('Content-Type: application/json');

$action = isset($_POST['action']) ? $_POST['action'] : '';
$uploadDir = 'photos';
$response = ['success' => false];

switch ($action) {
    case 'list':
        $files = array_diff(scandir($uploadDir), ['..', '.']);
        $urls = array_map(function($file) use ($uploadDir) {
            return $uploadDir .'/'. $file;
        }, $files);

        $response = ['url' => array_values($urls)];
        break;
    
    case 'delete':
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $filePath = str_replace($uploadDir, '', $url);
        $fullPath = $uploadDir .'/'. $filePath;

        if (file_exists($fullPath)) {
            if (unlink($fullPath)) {
                $response = ['success' => true];
            }
        }
        break;
    
    default:
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['photo'];
            $filePath = $uploadDir .'/'. basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $response = ['success' => true, 'filename' => $file['name']];
            }
        }
        break;
}

echo json_encode($response);
?>
