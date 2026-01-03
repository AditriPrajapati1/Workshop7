<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    setcookie("theme", $_POST['theme'], time() + (86400 * 30));
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Theme Preference</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= ($_COOKIE['theme'] ?? 'light') === 'dark' ? 'dark-mode' : '' ?>">
<div class="container">
<h2>Select Theme</h2>

<form method="POST">
    <select name="theme">
        <option value="light">Light Mode</option>
        <option value="dark">Dark Mode</option>
    </select>
    <button type="submit">Save Preference</button>
</form>
</div>
</body>
</html>
