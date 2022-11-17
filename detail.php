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
if (isset($_GET["productid"])) {
    $productID = $_GET["productid"];

    $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id`= '$productID';");
}
if (!isset($tempTitle)) {
    $tempDesc = "";
    $tempHarga = "";
    $tempThumb = "";
    $tempTitle = "";
}


if (isset($_REQUEST['btnAdd'])) {
    if (!isset($_SESSION["username"])) {
        $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);
        header("location:login.php");
    }
    $selectedItem = $_GET["productid"];
    // $add = mysqli_query($con, "SELECT * FROM `product` WHERE `id`= '$selectedItem';");
    $ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
    $row = mysqli_fetch_assoc($ambilUser);
    $idUser = $row['id'];
    // $row = mysqli_fetch_assoc($add);
    // $idbarang = $row['id'];
    $qty = $_REQUEST['qty'];
    mysqli_query($con, "insert into cart values('','" . $idUser . "', '" . $selectedItem . "','" . $qty . "')");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styledetail.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container" style="">
            <a class="navbar-brand" href="catalogue.php">
                <img src="logo/Somethinc_Logo.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="mx-3 mt-2"><a href="cart.php"><img src="logo/shopping_cart_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                <?php
                if (!isset($_SESSION["username"])) :
                ?>
                    <div class="fw-bold mx-5 text-dark login-register"><a href="login.php" class="btn text-decoration-none">Login</a></div>
                <?php else : ?>
                    <form method="POST" action="" class="fw-bold mx-5 text-dark login-register"><button class="btn" type="submit" name="logout" class="btnnav">Logout</button></form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="isi">
        <div class="kiri">
            <div class="thumbnail">
                <?php
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <img src="product/<?= $row["thumbnail"]  ?>" class="card-img-top border border-2 border-dark rounded" alt="'<?= $row["title"]  ?>'">
                <?php
                    $tempDesc =  $row['description'];
                    $tempHarga =  $row['price'];
                    $tempThumb = $row['thumbnail'];
                    $tempTitle = $row['title'];
                }
                ?>
            </div>
        </div>
        <div class="kanan">
            <form action="" method="post">
                <h3>Atur jumlah</h3>
                <img src="product/<?= $tempThumb ?>" alt=""><br><br>
                <h5>Nama Barang :</h5>
                <p style="color:white;"><?= $tempTitle ?></p>
                <h5>Harga :</h5>
                <p style="color:white;"> Rp <?= $tempHarga ?></p>
                <h5>Jumlah Barang :</h5>
                <input type="number" name="qty" id=""> Pcs <br><br>
                <button type="submit" style="background-color:green; width:280px;  " name="btnAdd">Add to Cart</button>
            </form>

        </div>
    </div>
    <div class="description">
        <h3>Description</h3>
        <div class="containerdesc">
            <p><?= $tempDesc ?></p>
        </div>


    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>