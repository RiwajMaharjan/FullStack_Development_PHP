<?php
    $host = "localhost";
    $databaseName = "school_db";
    $username = "root";
    $password = "";

    try {
        //creating a db connection object and establising connection.
        $pdo = new PDO("mysql:host=$host", $username, $password);
        //selects which kinda error mode and second throws the exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("CREATE DATABASE IF NOT EXISTS $databaseName");
        $pdo->exec("USE $databaseName");
        $pdo->exec("CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        course VARCHAR(50) NOT NULL
        );");

        // echo "successfully connected.";

    } catch (PDOException $e) {
        //dies the whole thing
        die("connection failed:" . $e->getMessage());
    }
?>