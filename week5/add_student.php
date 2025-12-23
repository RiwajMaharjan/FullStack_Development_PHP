<?php
include "header.php";
require "functions.php";

$nameErr = $emailErr = $skillsErr = "";
$nameVal = $emailVal = $skillsVal = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hasError = false;

    $nameVal = trim($_POST["name"]);
    $emailVal = trim($_POST["email"]);
    $skillsVal = trim($_POST["skills"]);

    if (empty($nameVal)) {
        $nameErr = "Name is required";
        $hasError = true;
    }

    if (empty($emailVal)) {
        $emailErr = "Email is required";
        $hasError = true;
    } elseif (!validateEmail($emailVal)) {
        $emailErr = "Invalid email format";
        $hasError = true;
    } elseif (isEmailDuplicate($emailVal)) {
        $emailErr = "Email already exists";
        $hasError = true;
    }

    if (empty($skillsVal)) {
        $skillsErr = "Skills are required";
        $hasError = true;
    }

    if (!$hasError) {
        try {
            $name = formatName($nameVal);
            $skillsArray = cleanSkills($skillsVal);
            saveStudent($name, $emailVal, $skillsArray);
            $message = "Student saved successfully";

            // Clear form
            $nameVal = $emailVal = $skillsVal = "";
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
    }
}
?>

<form method="post">
    <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($nameVal); ?>">
    <span class="error"><?php echo $nameErr; ?></span>

    <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($emailVal); ?>">
    <span class="error"><?php echo $emailErr; ?></span>

    <input type="text" name="skills" placeholder="Skills (comma separated)" value="<?php echo htmlspecialchars($skillsVal); ?>">
    <span class="error"><?php echo $skillsErr; ?></span>

    <button type="submit">Save Student</button>
</form>

<?php
if (!empty($message)) {
    echo "<p class='message'>$message</p>";
}
?>

<?php include "footer.php"; ?>
