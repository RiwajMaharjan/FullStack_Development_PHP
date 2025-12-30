<?php
require "db.php";
require "allFunctions.php";
$errors = [
    'name'   => '',
    'email'  => '',
    'course' => '',
];
$name = $email = $course = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name   = $_POST['name'] ?? '';
    $email  = $_POST['email'] ?? '';
    $course = $_POST['course'] ?? '';

    // Validate the input
    $data = [
        'name' => $name,
        'email' => $email,
        'course' => $course
    ];
    $errors = validate_student($data);
    
    // Check if there are no errors
    if (!array_filter($errors)) {
        addStudent($name, $email, $course);
    }
}
?>

<?php include "header.php";?>
<div class="form-container">
    <?php if (!array_filter($errors) && $_SERVER['REQUEST_METHOD'] === "POST"): ?>
        <p class="success">Student added successfully!</p>
    <?php endif; ?>

    <form method="POST" action="add_student.php">
        <div class="form-group">
            <input type="text" name="name" placeholder="Enter your name..." value="<?= htmlspecialchars($name) ?>" class="<?= $errors['name'] ? 'error' : '' ?>">
            <small style="color:red"><?= $errors['name'] ?></small>
        </div>

        <div class="form-group">
            <input type="text" name="email" placeholder="Enter your email..." value="<?= htmlspecialchars($email) ?>" class="<?= $errors['email'] ? 'error' : '' ?>">
            <small style="color:red"><?= $errors['email'] ?></small>
        </div>

        <div class="form-group">
            <select name="course" class="<?= $errors['course'] ? 'error' : '' ?>">
                <option value="">Select course</option>
                <option value="Mathematics" <?= $course=="Mathematics"?"selected":"" ?>>Mathematics</option>
                <option value="Physics" <?= $course=="Physics"?"selected":"" ?>>Physics</option>
                <option value="Chemistry" <?= $course=="Chemistry"?"selected":"" ?>>Chemistry</option>
                <option value="Biology" <?= $course=="Biology"?"selected":"" ?>>Biology</option>
                <option value="Computer Science" <?= $course=="Computer Science"?"selected":"" ?>>Computer Science</option>
            </select>
            <small style="color:red"><?= $errors['course'] ?></small>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
