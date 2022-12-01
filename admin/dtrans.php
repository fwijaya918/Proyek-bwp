<?php
require('helper.php');
if (isset($_POST["logout"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["fullname"]);
}
if (!isset($_SESSION['username'])) {
    // header('Location: ./index.php');
} else {
    $fullnameActive = $_SESSION['fullname'];
    $usernameActive = $_SESSION['username'];
}
if (isset($_GET["htransid"])) {
    $ht_id = $_GET["htransid"];
    $result = mysqli_query($con, "SELECT * FROM d_trans WHERE dt_ht_id= $ht_id;");
}
// $ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
// $fetchUser = mysqli_fetch_assoc($ambilUser);
// $iduser = $fetchUser['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantique</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container" style="">
            <a class="navbar-brand" href="admin.php">
                <img src="../logo/cantique.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterUser.php" class="btn text-decoration-none">Master User</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterBarang.php" class="btn text-decoration-none">Master Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="editBarang.php" class="btn text-decoration-none">Edit Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterTransaksi.php" class="btn text-decoration-none">Master Transaksi</a></div>
            </div>
        </div>
    </nav>
    <?php
    setlocale(LC_MONETARY, "id_ID");
    while ($row = mysqli_fetch_assoc($result)) {
        $ambilProduct = mysqli_query($con, "SELECT * FROM product WHERE id= $row[product_id];");
        $fetchProduct = mysqli_fetch_assoc($ambilProduct);
        $fotoProduct = $fetchProduct['thumbnail'];
        $hargaProduct = $fetchProduct['price'];
        $totalPrice = $hargaProduct * $row['product_qty'];
    ?>
        <br>
        <div class="card mb-3 w-75 m-auto" style="background-color:#212529;">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body rounded w-100" style="background-color:green; height:350px;">
                        <h5 class="card-title"><?= $fetchProduct["title"] ?></h5>
                        <p class="card-text fw-bold mt-3"><img src="../product/<?= $fotoProduct ?>" alt="" style="width:200px;height:200px;"></p>
                        <p class="card-text fw-bold mt-3"><?php echo rupiah($hargaProduct); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body w-100" style="background-color:green; height:350px;">
                        <h5 class="card-title">Quantity</h5>
                        <p class="card-text fw-bold mt-3"><?php echo ($row['product_qty']); ?></p>
                        <h5 class="card-title">Total Price</h5>
                        <p class="card-text fw-bold mt-3"><?php echo rupiah($totalPrice); ?></p>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }
    ?>
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>