<?php 
    require "db.php";

    require "allFunctions.php";

    $errors = [
    'name' => '',
    'email' => '',
    'course' => ''
    ];

    // Get the student ID from the URL
    $id = $_GET['id'] ?? null;

    if (!$id) {
        die("No student ID provided.");
    }

    $student = fetchStudent($id);
    if(!$student) {
        die("Student not found.");
    }

    $name = $student['name'];
    $email = $student['email'];
    $course = $student['course'];

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $name   = $_POST['name'] ?? '';
        $email  = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';

        // Validate the input
        $data = [
            'name' => $name,
            'email' => $email,
            'course' => $course
        ];
        $errors = validate_student($data, $id);
        
        // Check if there are no errors
        if (!array_filter($errors)) {

            updateStudent($id, $name, $email, $course);
            echo "<p style='color:green'>Form submitted successfully!</p>";
            
        }
    }
?>
<?php include "header.php"?>
<form method="POST" action="edit_student.php?id=<?= $id ?>" class="form-container">
    <input type="text" name="name" placeholder="Enter your name..." value="<?= htmlspecialchars($name) ?>">
    <small style="color:red"><?= $errors['name'] ?></small>

    <input type="text" name="email" placeholder="Enter your email..." value="<?= htmlspecialchars($email) ?>">
    <small style="color:red"><?= $errors['email'] ?></small>

    <select name="course">
        <option value="">Select course</option>
        <option value="Mathematics" <?= $course=="Mathematics"?"selected":"" ?>>Mathematics</option>
        <option value="Physics" <?= $course=="Physics"?"selected":"" ?>>Physics</option>
        <option value="Chemistry" <?= $course=="Chemistry"?"selected":"" ?>>Chemistry</option>
        <option value="Biology" <?= $course=="Biology"?"selected":"" ?>>Biology</option>
        <option value="Computer Science" <?= $course=="Computer Science"?"selected":"" ?>>Computer Science</option>
    </select>
    <small style="color:red"><?= $errors['course'] ?></small>

    <button type="submit">Submit</button>
</form>