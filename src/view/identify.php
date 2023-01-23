<?php
require("../controller/functions.php");

if (isset($_POST["btn-check-email"])) {
    if (!identifyEmail($_POST)) {
        echo " 
        <script>alert('Your email incorrect!! '); </script>
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
    <title>Identify User</title>
    <link rel="stylesheet" href="../../public/assets/css/identify.css">
</head>

<body>

    <main>
        <div id="content">

            <form action="" method="post">
                <ul>
                    <li>
                        <a href="login.php">
                            <h1>🔙</h1>
                        </a>
                    </li>

                    <li><label for="email"> Your email address</label></li>
                    <li>
                        <input type="text" id="email" name="email-identify" placeholder="Email address">
                    </li>
                    <li>
                        <button type="submit" name="btn-check-email">check email</button>
                    </li>

                </ul>

            </form>
        </div>
    </main>

</body>

</html>