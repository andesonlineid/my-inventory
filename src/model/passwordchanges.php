<?php
session_start();
require("../controller/functions.php");
if (!isset($_SESSION["email"])) {
    header("Location: ../view/identify.php");
    exit;
}



if (isset($_POST["btn-changes-password"])) {
    $emailUser = $_SESSION["email"];
    if (!passwordChanges($_POST, $emailUser)) {
        echo "
            <script>alert('You have to input same password !!!'); </script>
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
    <title>password changes feature</title>
    <link rel="stylesheet" href="../../public/assets/css/passwordchanges.css">
</head>

<body>

    <main>
        <div id="content">

            <form action="" method="post">
                <ul>
                    <li>
                        <a href="../view/login.php">
                            home
                        </a>
                    </li>
                    <li>
                        <label for="">Input your new password</label>
                    </li>
                    <li>
                        <input type="password" name="new-password" placeholder="new password">
                    </li>
                    <li>
                        <input type="password" name="new-confirm-password" placeholder="confirm new password">
                    </li>
                    <li>
                        <button type="submit" name="btn-changes-password">
                            changes password
                        </button>
                    </li>
                </ul>
            </form>

        </div>
    </main>

</body>

</html>