<?php
class Student {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM students");
        return $stmt->fetchAll();
    }

    public function find(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(string $name, string $email, string $course) {
        $stmt = $this->pdo->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $course]);
    }

    public function update(int $id, string $name, string $email, string $course) {
        $stmt = $this->pdo->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $course, $id]);
    }

    public function delete(int $id) {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
}