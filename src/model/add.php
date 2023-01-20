<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../view/login.php");
}


require "../controller/functions.php";

if (isset($_POST["btn-add"])) {
    if (addProduct($_POST) > 0) {
        echo
        "
        <script> alert('Data product add succesfully !!!'); 
        location.href= '../view/index.php';
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
    <title>add product page</title>
    <link rel="stylesheet" href="../../public/assets/css/add.css">
</head>

<body>

    <main>
        <div id="content">
            <section class="add-data-container">

                <header>
                    <a href="../view/index.php">
                        <h1>🏡</h1>
                    </a>
                </header>
                <form action="" method="POST" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <input type="text" name="product-name" placeholder="input product name" required>
                        </li>
                        <li>
                            <input type="number" name="product-price" placeholder="input product price" min="0"
                                required>
                        </li>
                        <li>
                            <input type="number" name="product-qty" placeholder="input product quantity" min="0"
                                required>
                        </li>
                        <li>
                            <input type="file" name="product-image" placeholder="input product image">
                        </li>
                        <li>
                            <input type="text" name="product-desc" placeholder="input product description" required>
                        </li>
                        <li>
                            <button name="btn-add" class="btn-cta">add product</button>
                        </li>
                    </ul>


                </form>
            </section>
        </div>
    </main>

</body>

</html>