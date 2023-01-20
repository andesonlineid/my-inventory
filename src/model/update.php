<?php
session_start();
require("../controller/functions.php");

if (!isset($_SESSION["username"])) {
    header("Location: ../view/login.php");
}

$id = $_GET["ID"];
// return array can access index number
$datasOld = queryData("SELECT * FROM products WHERE id = $id")[0];


if (isset($_POST["btn-update"])) {

    if (updateProduct($_POST) > 0) {
        echo "
        <script> alert('update data successfuly');
        location.href = '../view/index.php';
        </script>
       ";
    } else {
        echo "
        <script>
        alert('Failed data update !!!');
        </script>";
    }
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update page</title>
    <link rel="stylesheet" href="../../public/assets/css/update.css">
</head>

<body>


    <main>

        <div id="content">

            <section class="update-container">
                <section class="left-content">
                    <a href="../view/index.php">
                        <h1>
                            🏠
                        </h1>
                    </a>
                </section>

                <form action="" method="POST" enctype="multipart/form-data">
                    <ul>

                        <li>
                            <input type="hidden" name="id" value="<?= $datasOld["id"]; ?>"
                                placeholder=" input update product name">
                        </li>
                        <li>
                            <input type="hidden" name="old-image" value="<?= $datasOld["image"]; ?>"
                                placeholder=" input update product name">
                        </li>

                        <li>
                            <input type="text" name="product-name" value="<?= $datasOld["name"]; ?>"
                                placeholder=" input update product name">
                        </li>
                        <li>
                            <input type="number" name="product-price" min="0" value="<?= $datasOld["price"]; ?>"
                                placeholder=" input update product price">
                        </li>
                        <li>
                            <input type="number" name="product-qty" min="0" value="<?= $datasOld["quantity"]; ?>"
                                placeholder=" input update product quantity">
                        </li>
                        <li>
                            <input type="file" name="product-image">
                        </li>
                        <li>
                            <input type="text" name="product-desc" value="<?= $datasOld["description"]; ?>"
                                placeholder=" input update product description">
                        </li>


                    </ul>
                    <button type="submit" class="btn-update btn-cta" name="btn-update">
                        update product
                    </button>
                </form>

            </section>

        </div>
    </main>


</body>

</html>