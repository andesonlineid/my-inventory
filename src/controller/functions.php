<?php

$conn = mysqli_connect("localhost", "root", "", "myinventory");

function queryData($sqlQuery)
{
    global $conn;
    $result = mysqli_query($conn, $sqlQuery);
    $datas = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $datas[] = $data;
    }
    return $datas;
}

function addProduct($data)
{

    global $conn;

    $product_name = htmlspecialchars($data["product-name"]);
    $product_price = htmlspecialchars($data["product-price"]);
    $product_qty = htmlspecialchars($data["product-qty"]);
    $product_desc = htmlspecialchars($data["product-desc"]);
    $uploadImage = uploadFile();

    if (!$uploadImage) {
        return false;
    }

    $query = "INSERT INTO products (name,price,quantity,image,description)
    VALUES ('$product_name',$product_price,$product_qty,'$uploadImage',
    '$product_desc')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function uploadFile()
{
    $product_image_upload = $_FILES["product-image"];

    $error_image_upload = $product_image_upload["error"];
    $name_image_upload = $product_image_upload["name"];
    $size_image_upload = $product_image_upload["size"];
    $tmp_image_upload = $product_image_upload["tmp_name"];

    if ($error_image_upload === 4) {
        echo "
    <script>alert('File cannot be empty !!'); </script>
    ";
        return false;
    }

    $validExtentions  = ["jpg", "png", "jpeg"];
    $userFile  = explode(".", $name_image_upload);
    $userExtention = strtolower(end($userFile));


    if (!in_array($userExtention, $validExtentions)) {
        echo "
    <script>alert('Your file extention cannot be upload to our system !!'); </script>
    ";
        return false;
    }



    if ($size_image_upload > 1000000) {
        echo "
    <script>
    alert('Your file size cannot be upload to our system !!'); </script>
    ";
        return false;
    }

    // changes name
    $hashImageName = uniqid();

    $newFileName = $hashImageName;
    $newFileName .= ".";
    $newFileName .= $userExtention;

    move_uploaded_file($tmp_image_upload, "../../public/assets/img/" . "$newFileName");
    return $newFileName;
}

function updateProduct($datasUpdate)
{
    global $conn;

    $id = htmlspecialchars($datasUpdate["id"]);
    $name = htmlspecialchars($datasUpdate["product-name"]);
    $price = htmlspecialchars($datasUpdate["product-price"]);
    $qty = htmlspecialchars($datasUpdate["product-qty"]);
    $image = htmlspecialchars($datasUpdate["old-image"]);
    $desc = htmlspecialchars($datasUpdate["product-desc"]);

    if ($_FILES["product-image"]["error"] === 4) {
        $productImage = $image;
    } else {
        $productImage = uploadFile();
    }


    $query = "UPDATE products SET 
    name = '$name',
    price = $price,
    quantity = $qty,
    image = '$productImage',
    created_at = CURRENT_TIMESTAMP,
    description = '$desc' 
    WHERE id = $id
     ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function signupFunct($dataUser)
{
    global $conn;
    $username = htmlspecialchars(htmlentities(stripslashes((strtolower($dataUser["username"])))));
    $email = htmlspecialchars(htmlentities(stripslashes(strtolower($dataUser["email"]))));
    $password = htmlspecialchars(htmlentities($dataUser["password"]));


    if (!empty($username) && !empty($email) && !empty($password)) {

        $resultCheck = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'  OR  email = '$email'");

        if (mysqli_num_rows($resultCheck) > 0) {
            echo "
            <script> 
            alert('Failed !!! Username Or Email cannot same inside database !!');
            </script>
            ";
            return false;
        } else {

            $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$hashPassword')";

            mysqli_query($conn, $query);
            return mysqli_affected_rows($conn);
        }
    }
}


function loginFunct($userDatas)
{
    global $conn;
    $username = htmlspecialchars(htmlentities(stripslashes(strtolower($userDatas["username"]))));
    $password = htmlspecialchars(htmlentities($userDatas["password"]));


    $result = mysqli_query($conn, "SELECT * FROM users WHERE username  = '$username'");


    if (mysqli_num_rows($result) === 1) {
        $datas = mysqli_fetch_assoc($result);
        if (password_verify($password, $datas["password"])) {
            session_start();
            $_SESSION["username"] = $username;

            if (isset($userDatas["remember"])) {
                setcookie('id', $datas['id'], time() + 60 * 5);
                $hashUsername = hash("sha256", $datas["username"]);
                setcookie('key', $hashUsername, time() + 60 * 5);
            }

            header("Location: ../view/index.php");
            exit;
        }
    }
    return false;
}



function searchProducts($data, $firstData, $dataPerPage)
{


    $query = "SELECT * FROM products WHERE  name LIKE '%$data%'
    OR description LIKE '%$data%' ORDER BY id ASC LIMIT $firstData,$dataPerPage
    ";

    return queryData($query);
}



// Still wrong function and have to maintenance this
function addWealth()
{
    global $conn;
    $datas = queryData("SELECT price, quantity FROM products");
    $myWealth = 0;

    foreach ($datas as $data) {
        $myWealth = $myWealth + ($data["price"] * $data["quantity"]);
    }

    $sqlQuery = "INSERT INTO wealth (wealth_now) values ($myWealth)";
    mysqli_query($conn, $sqlQuery);
}