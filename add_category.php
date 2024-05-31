<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
require_once './functions/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $query = "INSERT INTO categories (name) VALUES ('$category_name')";
    mysqli_query($conn, $query);
    header('Location: add_category.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <form action="add_category.php" method="post">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required>
        <button type="submit">Add Category</button>
    </form>
</body>
</html>
