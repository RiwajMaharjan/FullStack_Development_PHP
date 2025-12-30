<?php 
    require "db.php";

    $id = $_GET["id"] ?? null;

    if(!$id) {
        die("No student ID provided");
    }

    try {
        $deleteStudent = $pdo->prepare("DELETE FROM students WHERE id = ?");
        $deleteStudent->execute([$id]);

        header("Location: viewStudents.php");
        exit;
    }catch (PDOException $e) {
        die("Error deleting student: " . $e->getMessage());
    }       
?>