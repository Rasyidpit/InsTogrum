<?php
session_start();
require './functions/db.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "DELETE FROM articles WHERE id = '$id' ");
if($query) {
    header('location: profile.php');
}
