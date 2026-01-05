<?php
// view_file.php - Simple file viewer
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT file_name, file_path FROM reports WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $file_path = $row['file_path'];
        $file_name = $row['file_name'];
        
        if (file_exists($file_path)) {
            // Display PDFs inline, others as download
            $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            
            if ($extension == 'pdf') {
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . $file_name . '"');
            } else {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
            }
            
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            echo "<h3>File not found!</h3>";
        }
    } else {
        echo "<h3>Report not found!</h3>";
    }
}
?>