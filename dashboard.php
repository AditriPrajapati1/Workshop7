<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? "light";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= ($theme === 'dark') ? 'dark-mode' : '' ?>">
<div class="container">
<h2>Welcome, <?= $_SESSION['username']; ?></h2>

<nav>
    <a href="preference.php">Change Theme</a>
    <a href="logout.php">Logout</a>
</nav>

<p>This is the student dashboard. Use the navigation above to move between pages.</p>
</div>
</body>
</html>
