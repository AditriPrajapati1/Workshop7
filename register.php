<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $student_id = trim($_POST['student_id']);
    $name       = trim($_POST['name']);
    $password   = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $sql = "INSERT INTO students (student_id, full_name, password_hash)
                VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id, $name, $hashedPassword]);

        header("Location: login.php");
        exit();

    } catch (PDOException $e) {
        echo "Registration failed. Student ID may already exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= ($_COOKIE['theme'] ?? 'light') === 'dark' ? 'dark-mode' : '' ?>">
<div class="container">
<h2>Student Registration</h2>

<form method="POST">
    Student Id:
    <input type="text" name="student_id" required>

    Name:
    <input type="text" name="name" required>

    Password:
    <input type="password" name="password" required>

    <button type="submit">Register</button>
</form>

<p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>
