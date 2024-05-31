<?php
session_start();
if( ! isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}
    require_once './functions/db.php';

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $query = mysqli_query($conn, "SELECT * FROM articles WHERE id = '$id' ");
    $data = mysqli_fetch_array($query);
    if ($data['user_id'] != $user_id) {
        echo '<script>TEST</script>';
        header('Location: index.php');
    }
    
    if (isset($_POST['submit'])) {
        var_dump($_FILES);
        $content = $_POST['content'];
        $query = mysqli_query($conn, "UPDATE articles SET description='$content'");
        header('Location:index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InsTogruM | Edit Post</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
<div class="container">
        <!-- header -->
            <div class="header">
                <h1><a class="logo" href="index.php">InsTogruM </a>| Wrong? Just Edit Them!</h1>
            </div>
        <!-- end header -->
            <hr>
            <br>
        <!-- content -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="buttons">
                    <button class="btn2"><a href="index.php">BACK TO FEEDS</a></button>
                    <button class="btn2"><a href="logout.php">LOGOUT</a></button>
                </div>
                <br>
                <hr>
                <div class="form-group">
                    <?php 
                        $id = $_SESSION['user_id'];
                        if(isset($_SESSION['username'])) {
                            echo "Your Are Posting As " . $_SESSION['username'];
                            $users = $_SESSION['username'];
                        } else {
                                echo "NOT LOGGED IN !";
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="desc" placeholder="Heewwloow !" value="<?= $data['content']; ?>" class="form-control">
                </div><br>
                <div class="form-group">
                    <input type="hidden" name="user_id" value="<?= $id ?>">
                </div>
                    <button class="btn1" type="submit" name="submit">POST</button>
            </form>
        <!-- end content -->

        <!-- footer -->
            <div class="footer">
                
            </div>
        <!-- end footer -->
    </div>
</body>
</html>