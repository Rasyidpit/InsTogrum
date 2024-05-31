<?php 
require './functions/db.php';

    if( isset($_POST["register"]) ) {
        if( registrasi($_POST) > 0 ) {
            echo " <script> 
                alert('register success !');
            </script> ";
            header("location: login.php");
        } else {
            echo mysqli_error($conn);
        }
    }

    function registrasi($data) {
        global $conn;
        
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);
        $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' ");
                if(mysqli_fetch_assoc($result) ) {
                    echo "<script> 
                            alert('username $username already registered !');
                         </script>";
                    return false;
                }

            if( $password !== $password2 ) {
                echo "<script> 
                        alert('register failed !');
                     </script>";
                return false;
            }
                $password = password_hash($password, PASSWORD_DEFAULT);
                
                mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
                    return mysqli_affected_rows($conn);
    }           

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InsTogruM | Register</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <div class="container-register">
        <!-- header -->
            <div class="header-register">
                <h1>InsTogruM</h1>
            </div>
        <!-- end header -->
            <hr>
            <br>
        <!-- form -->
            <div class="form-register">
                <h2>InsTogruM</h2>
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
                            <label for="password2">CONFIRM PASSWORD :</label>
                            <input type="password" name="password2" id="password2" placeholder="e.g Secret123!">
                        </li>
                        <li>
                            <button type="sumbit" name="register">REGISTER NOW</button>
                        </li><br>
                        <li>
                            <h3>Already Have An Account? Login Here!</h3>
                            <button><a href="login.php">Login</a></button>
                        </li>
                    </ul>
                </form>
            </div>
        <!-- end form -->

        <!-- footer -->
            <div class="footer-register"></div>
        <!-- end footer -->
    </div>
</body>
</html>