<?php
    require "db.php";

    try {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $student_id = trim($_POST["student_id"]) ?? "";
            $full_name  = trim($_POST['name']) ?? "";
            $password   = trim($_POST['password']) ?? "";

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql  = "INSERT INTO students (student_id, full_name, password_hash) VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id, $full_name, $hashedPassword]);

            echo "Student Register!!";

            header("Refresh:3, url=login.php");

        }
    } catch (PDOException $e) {
        die("Database error" . $e->getMessage());
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>

	<form action="register.php" method="POST">
		<label for="student_id">student_id</label>
		<input type="text" name="student_id" id="student_id" required>

		<label for="name">full name</label>
		<input type="text" id="name" name="name" required>

		<label for="password">password</label>
		<input type="password" id="password" name="password" required>

		<button type="submit">Register</button>
	</form>



</body>
</html>
