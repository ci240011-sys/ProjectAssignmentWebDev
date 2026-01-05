<?php
// admin_login.php
session_start();

// Simple admin login (for demo only)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Simple credentials check (change these in production!)
    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = 'Admin';
        header('Location: admin.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style_login.css">
    <style>
       
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="demo">
            <strong>Demo Login:</strong><br>
            Username: <strong>admin</strong><br>
            Password: <strong>admin123</strong>
        </div>
        
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>