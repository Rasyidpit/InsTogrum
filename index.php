<?php
session_start();

    if(isset($_POST['post'])) {
        $title = $_POST['title'];
        $desc = $_POST['content'];
        $id = $_POST['user_id'];
        header('location: login.php'); 
    }
    require_once './functions/db.php';
    $query = mysqli_query($conn, 'SELECT articles.title, articles.id, articles.content, users.username FROM articles INNER JOIN users ON articles.user_id = users.id');
    $category_q = mysqli_query($conn, 'SELECT * FROM categories');

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
        
        <!-- content -->
        <div class="content">
            <div class="posts2">
                <form action="" method="post" enctype="multipart/form-data">
                    <br>
                    <hr>
                    <div class="form-group">
                        <?php 
                            if(isset($_SESSION['username'])) {
                                echo "Your Are Posting As " . $_SESSION['username'];
                                $users = $_SESSION['username'];
                            } else {
                                    echo "NOT LOGGED IN !";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?= $id ?>">
                    </div>
                        <a href="profile.php"><button name="post">ADD NEW ARTICLES</button></a>
                </form>
                    <a href="add_category.php"><button>ADD NEW CATEGORY</button></a>
            </div>

            <hr>
        
            <table class="table">
                <tbody>
                    <h1>All Topics</h1>
                    <hr>
                    <?php while ($row = mysqli_fetch_array($query)) : ?>
                        <tr>
                            <td class="userid">
                                <?php 
                                    echo $row['username'];
                                ?>
                            </td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['content'] ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <div class="category">
                <h1>Find Your Topics Here!</h1>
                <hr>
                <select onChange="window.location.href=this.value">
                    <option disabled selected>SELECT YOUR TOPICS!</option>
                    <?php while ($row = mysqli_fetch_array($category_q)) : ?>
                    <option value="categories.php?cat=<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div>
        </div>
        <!-- end content -->

        <!-- footer -->
            <div class="footer">
                
            </div>
        <!-- end footer -->
    </div>
</body>
</html>