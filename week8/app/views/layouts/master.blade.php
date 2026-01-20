<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-add { background: green; color: white; }
        .btn-edit { background: blue; color: white; }
        .btn-delete { background: red; color: white; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>