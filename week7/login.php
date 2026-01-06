<?php
    require "db.php";

    try {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $student_id = trim($_POST["student_id"]) ?? "";
            $password   = trim($_POST['password']) ?? "";

            $sql  = "SELECT * FROM students WHERE student_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id]);

            $student = $stmt->fetch();

            if (! $student) {
                echo "Register First!. Student not found";
                header("Refresh:2, url=register.php");
                exit;
            }

            $hashedPassword  = $student["password_hash"];
            $isPasswordValid = password_verify($password, $hashedPassword);

            if (! $isPasswordValid) {
                echo "Invalid Password! Please Try again";
                exit;
            }

            echo "Successfully logged In!";
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username']  = $student["full_name"];
            header("Refresh:5, url=dashboard.php");

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
	<title>Login form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            padding: 25px 30px;
            width: 320px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #28a745;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1e7e34;
        }
    </style>

</head>
<body>

	<form action="login.php" method="POST">
		<label for="stIn login.php page create a form with student_id audent_id">student_id</label>
		<input type="text" name="student_id" id="student_id" required>

		<label for="password">password</label>
		<input type="password" id="password" name="password" required>

		<button type="submit">Login</button>
	</form>

</body>
</html>
