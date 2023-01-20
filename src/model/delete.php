<?php
require("../controller/functions.php");

$id = $_GET["ID"];

mysqli_query($conn, "DELETE FROM products WHERE id = $id");

if (mysqli_affected_rows($conn) > 0) {
    echo
    "<script>
        alert('data delete successfully !!!');
        location.href = '../view/index.php';
    </script>
        ";
}