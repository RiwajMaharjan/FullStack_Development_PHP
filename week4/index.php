<?php
session_start();

$name = $email = "";
$errors = [];
$success = false;

function formValidationCheck(array $data) {
    $errors = [];
    $labels = [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password-confirm' => 'Confirm Password'
    ];

    foreach ($data as $key => $value) {
        if (trim($value) === '') {
            $errors[$key] = $labels[$key] . " is required!";
        }
    }

    if (!isset($errors['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format!";
    }

    if (!isset($errors['password'])) {
        $password = $data['password'];
        if (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters!";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors['password'] = "Password must contain an uppercase letter!";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $errors['password'] = "Password must contain a lowercase letter!";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $errors['password'] = "Password must contain a number!";
        } elseif (!preg_match('/[\W_]/', $password)) {
            $errors['password'] = "Password must contain a special character!";
        }
    }

    if (!isset($errors['password-confirm']) && $data['password'] !== $data['password-confirm']) {
        $errors['password-confirm'] = "Passwords do not match!";
    }

    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordConfirm = $_POST['password-confirm'] ?? '';

    $data_arr = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password-confirm' => $passwordConfirm
    ];

    $errors = formValidationCheck($data_arr);

    $file = "users.json";
    $users = [];

    if (file_exists($file)) {
        $json_data = file_get_contents($file);
        $users = json_decode($json_data, true) ?: [];

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $errors['email'] = "This email is already registered!";
            }
            if ($user['name'] === $name) {
                $errors['name'] = "This username is already taken!";
            }
        }
    }

    if (empty($errors)) {
        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data_arr;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
    $name = $old['name'] ?? '';
    $email = $old['email'] ?? '';
    unset($_SESSION['old']);
}

if (isset($_GET['success'])) {
    $success = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>User Registration</h1>

    <?php if ($success): ?>
        <p class="success">Data saved successfully!</p>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (isset($errors['name'])) echo "<p class='error'>{$errors['name']}</p>"; ?>

        <input type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>"; ?>

        <input type="password" name="password" placeholder="Enter your password">
        <?php if (isset($errors['password'])) echo "<p class='error'>{$errors['password']}</p>"; ?>

        <input type="password" name="password-confirm" placeholder="Confirm your password">
        <?php if (isset($errors['password-confirm'])) echo "<p class='error'>{$errors['password-confirm']}</p>"; ?>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
