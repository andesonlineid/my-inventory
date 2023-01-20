<?php
require("../controller/functions.php");

$datas = queryData("SELECT * FROM wealth");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>data wealth page</title>
    <link rel="stylesheet" href="../../public/assets/css/wealth.css">
</head>

<body>
    <main>
        <div id="content">
            <section class="wealth-container">

                <section class="left-content">
                    <a href="index.php">
                        <h1>🏠</h1>
                    </a>
                </section>

                <table>
                    <thead>
                        <th>
                            No
                        </th>
                        <th>
                            Date & Time
                        </th>
                        <th>
                            Total Wealth
                        </th>
                    </thead>
                    <?php $i = 1; ?>

                    <?php foreach ($datas as $data) : ?>
                    <tr>
                        <td>
                            <?= $i++; ?>
                        </td>
                        <td>
                            <?= $data["created_at"]; ?>
                        </td>
                        <td>
                            Rp. <?= $data["wealth_now"]; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </table>

            </section>
        </div>
    </main>


</body>

</html>