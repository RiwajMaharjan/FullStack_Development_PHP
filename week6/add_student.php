<?php
    require "db.php";

    $errors = [
        'name'   => '',
        'email'  => '',
        'course' => '',
    ];
    $name = $email = $course = "";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = isset($_POST['name']) ?? "";
        $name = isset($_POST['email']) ?? "";
        $name = $_POST['course'] ?? "";

        //Validating name
        if ($name === "") {
            $errors["name"] = "Name is required";
        }

        //Validating email
        if ($email === "") {
            $error["email"] = "Email is required";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Invalid Email Address";
        }

        //Validating course
        if ($course === "") {
            $errors["course"] = "Please select a course";
        }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>


	<form method="POST" action="add_student.php">
		<input type="text" name="name" placeholder="Enter your name...">
		<input type="email" name="email" placeholder="Enter your email...">
		<select name="course">
			<option value="">Select course</option>
			<option value="Mathematics">Mathematics</option>
	        <option value="Physics">Physics</option>
	        <option value="Chemistry">Chemistry</option>
	        <option value="Biology">Biology</option>
	        <option value="Computer Science">Computer Science</option>
		</select>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
