<?php
session_start();
require '../controller/functions.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$totalData = count(queryData("SELECT * FROM products"));
$dataPerPage = 2;
$page = ceil($totalData / $dataPerPage);


// if (isset($_GET["pageClicked"])) {
//     $pageClicked = $_GET["pageClicked"];
// } else {
// }



if (isset($_POST["btn-search"])) {
    $pageClicked = 1;
    $firstData = ($pageClicked * $dataPerPage) - $dataPerPage;
    $_SESSION["save-data-search"] = $_POST["search"];
    $data = $_POST["search"];
    $queryTotalData = "SELECT * FROM products WHERE  name LIKE '%$data%'
    OR description LIKE '%$data%' ORDER BY id ASC
    ";
    $totalData = count(queryData($queryTotalData));
    $page = ceil($totalData / $dataPerPage);
    $products = searchProducts($data, $firstData, $dataPerPage);
} else {
    $pageClicked = 1;
    $firstData = ($pageClicked * $dataPerPage) - $dataPerPage;
    $products = queryData("SELECT * FROM products ORDER BY id ASC LIMIT $firstData, $dataPerPage");
}

if (isset($_GET["pageClicked"])) {
    $pageClicked = $_GET["pageClicked"];

    // If saved data search undefined
    if (!isset($_SESSION["save-data-search"])) {
        $_SESSION["save-data-search"] = "";
        $data =  $_SESSION["save-data-search"];
        $queryTotalData = "SELECT * FROM products WHERE  name LIKE '%$data%'
        OR description LIKE '%$data%' ORDER BY id ASC
        ";
        $firstData = ($pageClicked * $dataPerPage) - $dataPerPage;
        $totalData = count(queryData($queryTotalData));
        $page = ceil($totalData / $dataPerPage);
        $products = queryData("SELECT * FROM products ORDER BY id ASC LIMIT $firstData, $dataPerPage");
    } else {
        $data = $_SESSION["save-data-search"];
        $firstData = ($pageClicked * $dataPerPage) - $dataPerPage;
        $queryTotalData = "SELECT * FROM products WHERE  name LIKE '%$data%'
        OR description LIKE '%$data%' ORDER BY id ASC
        ";
        $totalData = count(queryData($queryTotalData));
        $page = ceil($totalData / $dataPerPage);
        $products = searchProducts($data, $firstData, $dataPerPage);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="../../public/assets/css/index.css">
</head>

<body>

    <header>
        <section class="left-content">
            <h1>Welcome <?= $_SESSION["username"]; ?>
                &#128151;
            </h1>
        </section>


        <nav>
            <ul>
                <li>
                    <a href="logout.php">
                        <p> Log out </p>
                    </a>
                </li>

            </ul>
        </nav>
    </header>

    <main>
        <div id="content">


            <form action="?" method="post">
                <input type="text" name="search" autocomplete="off" autofocus>
                <button type="submit" name="btn-search">search</button>
            </form>


            <?php if ($totalData == 0) : ?>
                <section class="product-container">
                    <p style="text-align: center;">Data could not found !!!</p>
                </section>


            <?php else : ?>
                <?php $i = 1; ?>
                <?php foreach ($products as $product) : ?>
                    <section class="product-container">
                        <section class="left-content">
                            <figure>
                                <img src="../../public/assets/img/<?= $product['image']; ?>" alt="<?= $product['image']; ?>" title="<?= $product['image'] ?>">
                            </figure>
                        </section>

                        <section class="right-content">
                            <section class="list-product">
                                <ul>
                                    <li>
                                        <p>No: <?= $i + $firstData++ ?> </p>
                                    </li>
                                    <li>
                                        <p>Name: <?= $product["name"]; ?> </p>
                                    </li>
                                    <li>
                                        <p>Price: <?= $product["price"]; ?> </p>
                                    </li>
                                    <li>
                                        <p>Quantity: <?= $product["quantity"]; ?> </p>
                                    </li>

                                    <li>
                                        <p>Description: <?= $product["description"] ?> </p>
                                    </li>
                                </ul>

                                <section class="btn-cta-container">

                                    <a href="../model/update.php?ID=<?= $product['id']; ?>">
                                        <button type="submit" class="btn-cta btn-update">
                                            update
                                        </button>
                                        <a href="../model/delete.php?ID=<?= $product['id']; ?>">
                                            <button type="submit" class="btn-cta btn-delete">
                                                delete
                                            </button>
                                        </a>
                                    </a>

                                </section>
                            </section>

                        </section>

                    </section>

                <?php endforeach; ?>

            <?php endif; ?>

            <div class="pagination-container">

                <?php if ($pageClicked != 1) : ?>
                    <a href="?pageClicked=<?= $pageClicked - 1 ?>">
                        < </a>
                        <?php endif; ?>


                        <section class="center-content">
                            <?php for ($i = 1; $i <= $page; $i++) : ?>

                                <?php if ($i == $pageClicked) : ?>
                                    <a href="?pageClicked=<?= $i ?>">
                                        <p style="color:white; font-weight:bolder;"> <?= $i  ?>
                                        </p>
                                    </a>
                                <?php else : ?>

                                    <a href="?pageClicked=<?= $i ?>">
                                        <p> <?= $i  ?>
                                        </p>
                                    </a>

                                <?php endif; ?>

                            <?php endfor; ?>
                        </section>

                        <?php if ($pageClicked <  $page) : ?>
                            <a href="?pageClicked=<?= $pageClicked + 1 ?>">
                                >
                            </a>
                        <?php endif; ?>

            </div>

            <section class="action-container">

                <a href="../model/add.php">
                    <button type="submit" class="btn-cta btn-add">
                        add product
                    </button>
                </a>


                <a href="wealth.php">
                    <button name="btn-wealth" type="submit" class="btn-cta btn-wealth">
                        wealth check
                    </button>
                </a>

            </section>



        </div>
    </main>
</body>

</html>