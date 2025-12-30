<?php 
require "db.php";
function validate_student($data, $id = null) {
    $errors = [
        'name'   => '',
        'email'  => '',
        'course' => '',
    ];

    // Name
    if (empty(trim($data['name'] ?? ''))) {
        $errors['name'] = "Name is required";
    }

    // Email
    $email = trim($data['email'] ?? '');
    if ($email === '') {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address";
    }elseif (emailExist($email, $id)) {
        $errors["email"] = "Email already taken";
    }

    // Course
    if (empty($data['course'] ?? '')) {
        $errors['course'] = "Please select a course";
    }

    return $errors;
}

function addStudent($name, $email, $course) {
    global $pdo;
    $addPrepare =  $pdo->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
    $addPrepare->execute([$name, $email, $course]);
}

function fetchStudent($id) {
    global $pdo;
    $updatePrepare = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $updatePrepare->execute([$id]);
    $student = $updatePrepare->fetch();

    if($student) {
        return $student;
    }

}

function updateStudent($id, $name, $email, $course) {
    global $pdo;
    $update = $pdo->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
    $update->execute([$name, $email, $course, $id]);

    echo "<p style='color:green'>Student updated successfully!</p>";
}

function emailExist($email, $ignoreId = null) {
    global $pdo;
    if($ignoreId) {
        $emailCheck = $pdo->prepare("SELECT id FROM students WHERE email = ? AND id != ? LIMIT 1");
        $emailCheck->execute([$email, $ignoreId]);
    }else {
        $emailCheck = $pdo->prepare(
            "SELECT id FROM students WHERE email = ? LIMIT 1"
        );
        $emailCheck->execute([$email]);
    }
    
    
    $row = $emailCheck->fetch();
    
    if(!$row) {
        return false;
    }

    return true;
}
?>