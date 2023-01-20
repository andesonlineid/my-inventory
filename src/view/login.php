<?php
session_start();
require("../controller/functions.php");

if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $cookieId = $_COOKIE["id"];
    $cookieKey = $_COOKIE["key"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $cookieId");
    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        if ($cookieKey == hash("sha256", $data["username"])) {
            $_SESSION["username"] = $data["username"];
        }
    }
}


if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["btn-login"])) {
    if (!loginFunct($_POST)) {
        echo
        "
            <script>alert('Login failed wrong username or password !!');
            </script>
            ";
    }
}

// echo die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
</head>

<body>

    <main>
        <div id="content">

            <div class="login-container">
                <section class="left-content">
                    <h1>Desainer Gratis</h1>
                    <p>Streamer | Web Developer</p>
                </section>

                <section class="right-content">
                    <form action="" method="POST">
                        <ul>
                            <li>
                                <input class="username-input" type="text" autocomplete="off" name="username"
                                    placeholder="Email address or username" required>
                            </li>
                            <li>
                                <input name="password" class="password-input" autocomplete="off" type="password"
                                    placeholder="Password" required>
                            </li>
                            <li>
                                <input type="checkbox" id="remember" name="remember"> <label for="remember">remember
                                    me</label>
                            </li>
                        </ul>

                        <button type="submit" name="btn-login" class="btn-login btn-cta">Log in</button>
                    </form>

                    <section class="link-container">

                        <a href="identify.php">
                            Forgotten password ?
                        </a>
                        <a href="signup.php">
                            <button type="submit" class="register-button">
                                Create New Account
                            </button>
                        </a>
                    </section>
                </section>

            </div>


        </div>
    </main>

</body>

</html>