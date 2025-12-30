<?php
$host         = "localhost";
$databaseName = "StudentListDB";
$username     = "root";
$password     = "";

try {
    //creating a db connection object and establising connection.
    $pdo = new PDO("mysql:host=localhost;dbname=StudentListDB;charset=utf8mb4", $username, $password);

    //selects which kinda error mode and second throws the exception
    pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "successfully connected.";

} catch (PDOException $e) {
    //kills th
    die("connection failed:" . $e->getMessage());
}
