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
    <div class="container-fluid">
        <div class="row px-5 py-5 justify-content-between">
            <div class="col-8 bg-dark rounded-end p-0">
                <div class="d-flex justify-content-start"><?php
                                                            $row = mysqli_fetch_assoc($result); ?>
                    <img src="product/<?= $row["thumbnail"]  ?>" style="height: 50vh;" class="w-auto rounded" alt="'<?= $row["title"]  ?>'">
                    <?php
                    $tempDesc =  $row['description'];
                    $tempHarga =  $row['price'];
                    $tempThumb = $row['thumbnail'];
                    $tempTitle = $row['title'];
                    ?>
                    <div class="bg-white ms-3 rounded misc px-4">
                        <h4 class="fw-bold"><?= $tempTitle ?></h4>
                        <h3><?= rupiah($tempHarga) ?></h3>
                        <div class="">
                            <h6 class="">Description</h6>
                            <p><?= $tempDesc ?></p>
                        </div>
                        <div class="">
                            <h6 class="">Shipping</h6>
                            <p>Ongkir Reguler 19 rb</p>
                            <?php
                            $DateStart = date_create("now", new DateTimeZone('Asia/Jakarta'));
                            $DateEnd = date_create("now", new DateTimeZone('Asia/Jakarta'));
                            date_add($DateStart, date_interval_create_from_date_string("3 days"));
                            date_add($DateEnd, date_interval_create_from_date_string("5 days"));
                            ?>
                            <p class="text-muted">Estimasi Tiba <?= date_format($DateStart, "d M"); ?> - <?= date_format($DateEnd, "d M"); ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 bg-danger">
                <form action="" method="post">
                    <h5>Jumlah Barang :</h5>
                    <input type="number" name="qty" id=""> Pcs <br><br>
                    <button type="submit" style="" name="btnAdd">Add to Cart</button>
                </form>
            </div>
        </div>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>