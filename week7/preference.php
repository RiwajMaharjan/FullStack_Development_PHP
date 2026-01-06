<?php
session_start();

// Redirect if not logged in
if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if (isset($_POST['theme'])) {
    $selected_theme = $_POST['theme'];
    setcookie('theme', $selected_theme, time() + 86400*30, "/"); // expires in 30 days
    $_COOKIE['theme'] = $selected_theme; 
    header("Location: dashboard.php"); 
    exit();
}

// Current theme
$current_theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Theme Preference</title>
</head>
<body>
    <h2>Select Theme</h2>
    <form method="POST">
        <label>
            <input type="radio" name="theme" value="light" <?php if($current_theme=='light') echo 'checked'; ?>> Light Mode
        </label><br>
        <label>
            <input type="radio" name="theme" value="dark" <?php if($current_theme=='dark') echo 'checked'; ?>> Dark Mode
        </label><br><br>
        <button type="submit">Save Preference</button>
    </form>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
