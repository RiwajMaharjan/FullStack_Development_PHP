<?php
session_start();

// Redirect to login if not logged in
if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}


$full_name = $_SESSION['username'];

// Check theme cookie, default to 'light' if not set
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';


// logout hadnling
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$background_color = $theme === 'dark' ? '#000000' : '#ffffff';
$text_color = $theme === 'dark' ? '#ffffff' : '#000000';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
    body {
        background-color: <?php echo $background_color; ?>;
        color: <?php echo $text_color; ?>;
        font-family: Arial, sans-serif;
        text-align: center;
        padding-top: 50px;
    }

    button {
        padding: 10px 20px;
        margin-top: 20px;
        cursor: pointer;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: <?php echo $text_color; ?>;
        font-weight: bold;
    }
</style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($full_name); ?>!</h1>
    
    <!-- Link to theme preference page -->
    <a href="preference.php">Change Theme</a>

    <!-- Logout button -->
    <form method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
