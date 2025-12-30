<?php
require "db.php";

// Fetch all students
$stmt = $pdo->query("SELECT * FROM students ORDER BY id ASC");
$students = $stmt->fetchAll();
?>


<?php include "header.php";?>
<h1>All Students</h1>

<?php if (count($students) > 0): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['id'] ?></td>
        <td><?= htmlspecialchars($student['name']) ?></td>
        <td><?= htmlspecialchars($student['email']) ?></td>
        <td><?= htmlspecialchars($student['course']) ?></td>
        <td>
            <!--Update link -->
            <a href="edit_student.php?id=<?= $student['id'] ?>">Edit</a>

            <!--delete link -->
            <a href="delete_student.php?id=<?= $student['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No students found. <a href="add_student.php">Add one now</a></p>
<?php endif; ?>

</body>
</html>
