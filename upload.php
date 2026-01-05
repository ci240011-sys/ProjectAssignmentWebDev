<?php
// upload.php - Handle file uploads
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['report_file'])) {
    $report_id = $_POST['report_id'];
    
    // Create uploads directory if it doesn't exist
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }
    
    $filename = uniqid() . '_' . $_FILES['report_file']['name'];
    $target_file = 'uploads/' . $filename;
    
    if (move_uploaded_file($_FILES['report_file']['tmp_name'], $target_file)) {
        $sql = "UPDATE reports SET file_path = '$target_file' WHERE id = $report_id";
        mysqli_query($conn, $sql);
        echo "File uploaded successfully!";
    } else {
        echo "Error uploading file.";
    }
}
?>

<!-- Add this form in index.php for file upload -->
<h3>Upload Report File</h3>
<form method="POST" action="upload.php" enctype="multipart/form-data">
    <div class="form-group">
        <label>Select Report:</label><br>
        <select name="report_id">
            <?php
            $result = mysqli_query($conn, "SELECT id, report_no FROM reports");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id']}'>{$row['report_no']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Choose File:</label><br>
        <input type="file" name="report_file" required>
    </div>
    <button type="submit">Upload File</button>
</form>