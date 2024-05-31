<?php 
session_start();

if(isset($_COOKIE['login']) ) {
    if($_COOKIE['login'] == 'true') {
      $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"]) ) {
    header("location: profile.php");
}


require './functions/db.php';
if(isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");

            if(mysqli_num_rows($result) === 1 ) {

                $row = mysqli_fetch_assoc($result);
                    if(password_verify($password, $row["password"]) ) {

                        $_SESSION["login"] = true;
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['user_id'] = $row['id'];

                        if(isset($_POST['remember'])) {
                            setcookie('login', 'true', time() + 10000);
                        }


                        header("location: profile.php");
                        exit;
                    }
            }
            $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InsTogruM | Login</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <!-- warnings -->
    <?php if(isset($error) ) : ?>
        <p> login failed password or username incorrect </p>
    <?php endif; ?>
    <!-- end warnings -->

    <div class="container">
        <!-- header -->
            <div class="header-login">
                <h1><a href="index.php">InsTogruM</a></h1>
            </div>
        <!-- end header -->
            <hr>
            <br>
        <!-- form -->
        <div class="form-login">
                <br>
                <form action="" method="post">
                    <ul>
                        <li>
                            <label for="username">USERNAME :</label>
                            <input type="text" name="username" id="username" placeholder="e.g John Doe">
                        </li>
                        <li>
                            <label for="password">PASSWORD :</label>
                            <input type="password" name="password" id="password" placeholder="e.g Secret123!">
                        </li>
                        <li>
                            <button type="sumbit" name="login">LOGIN NOW</button>
                        </li><br>
                        <li>
                            <h3>No Account? Register Here!</h3>
                            <button><a href="register.php">Register Now!</button>
                        </li>
                    </ul>
                </form>
            </div>
        <!-- end form -->

        <!-- footer -->
            <div class="footer"></div>
        <!-- end footer -->
    </div>
</body>
</html>