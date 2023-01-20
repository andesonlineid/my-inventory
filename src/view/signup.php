<?php
require("../controller/functions.php");
if (isset($_POST["btn-signup"])) {
    if (signupFunct($_POST) > 0) {
        echo "
        <script> 
        alert('Sign up successfuly !!!')
        location.href= 'login.php';
        </script>
        ";
    } else {
        echo "
        <script> 
        alert('Failed sign up please check again !!!');
        </script>
        ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup page</title>
    <link rel="stylesheet" href="../../public/assets/css/signup.css">
</head>

<body>

    <main>
        <div id="content">

            <div class="signup-container">
                <section class="left-content">
                    <h1>Desainer Gratis</h1>
                    <p>Streamer | Programmer</p>
                </section>
                <section class="right-content">
                    <form action="" method="POST">
                        <ul>
                            <li>
                                <input type="text" name="email" class="email-input" placeholder="Email user" required>
                            </li>
                            <li>
                                <input type="text" name="username" class="username-input" placeholder="Username user"
                                    required>
                            </li>
                            <li>
                                <input type="password" name="password" class="password-input" autocomplete="off"
                                    placeholder="Password user" required>
                            </li>
                            <li>
                                <a href="login.php">
                                    <p>if do you have an account ?! click here</p>
                                </a>
                            </li>

                            <li>
                                <button type="submit" class="btn-signup" name="btn-signup">Sign up</button>
                            </li>

                        </ul>
                    </form>

                </section>
            </div>

        </div>
    </main>


</body>

</html>