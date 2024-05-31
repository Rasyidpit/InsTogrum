<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
$id = $_SESSION['user_id'];

require_once './functions/db.php';

$categories = mysqli_query($conn, "SELECT * FROM categories");
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $query = mysqli_query($conn, "INSERT INTO articles (title, content, user_id, category_id) VALUES ('$title', '$content', '$id', '$category_id')");
    header('Location:profile.php');
}

$query = mysqli_query($conn, "SELECT articles.id, articles.title, articles.content, users.username FROM articles INNER JOIN users ON articles.user_id = users.id WHERE users.id = '$id'");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InsTogruM | Posts</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="header">
            <h1><a class="logo" href="index.php">InsTogruM </a>| Share Your Exprerience To Others Now!</h1>
        </div>
        <!-- end header -->
        <hr>
        <br>
        <!-- content -->
        <div class="content">
            <div class="posts2">
                <div class="buttons">
                    <a href="index.php"><button>BACK TO FEEDS</button></a>
                    <a href="logout.php"><button>LOGOUT</button></a>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <br>
                    <hr>
                    <div class="form-group">
                        <?php

                        if (isset($_SESSION['username'])) {
                            echo "Your Are Posting As " . $_SESSION['username'];
                            $users = $_SESSION['username'];
                        } else {
                            echo "NOT LOGGED IN !";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="title" placeholder="e.g John Doe">
                    </div>
                    <div class="form-group">
                        <label>Description :</label>
                        <input type="text" name="content" placeholder="Heewwloow !">
                    </div>
                    <div class="form-group">
                        <label>Categories :</label>
                        <select name="category_id" required>
                            <option disabled selected>SELECT TAGS</option>
                            <?php while ($row = mysqli_fetch_array($categories)) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button class="btn1" type="submit" name="submit">POST</button>
                </form>
            </div>
        </div>
        <hr>
        <table class="table">
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)) : ?>
                    <tr>
                        <td class="userid"><?= $row['username'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['content'] ?></td>
                        <td><button class="btn1"><a href="delete.php?id=<?= $row['id'] ?>">DELETE</a></button></td>
                        <td><button class="btn1"><a href="update.php?id=<?= $row['id'] ?>">EDIT YOUR POST</a></button></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
        <!-- end content -->

        <!-- footer -->
        <div class="footer">

        </div>
        <!-- end footer -->
    </div>
</body>

</html>