<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $student_id = trim($_POST['student_id']);
    $password   = $_POST['password'];

    try {
        $sql = "SELECT student_id, full_name, password_hash
                FROM students
                WHERE student_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$student_id]);

        $student = $stmt->fetch();

        if ($student) {
            if (password_verify($password, $student['password_hash'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['username'] = $student['full_name'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Invalid Student ID.";
        }

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= ($_COOKIE['theme'] ?? 'light') === 'dark' ? 'dark-mode' : '' ?>">
<div class="container">
<h2>Student Login</h2>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    Student Id:
    <input type="text" name="student_id" required>

    Password:
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
