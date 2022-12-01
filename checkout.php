<?php
require("helper.php");
if (isset($_POST["logout"])) {
    // unset($_SESSION["username"]);
    // unset($_SESSION["fullname"]);
    // header("location:login.php");
}
if (!isset($_SESSION["username"])) {
    // header("location:login.php");
} else {
    $fullnameActive = $_SESSION['fullname'];
    $usernameActive = $_SESSION['username'];
}

$ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
$fetchUser = mysqli_fetch_assoc($ambilUser);
$iduser = $fetchUser['id'];
// alert($iduser);
$result = mysqli_query($con, "SELECT * FROM `cart` WHERE `id_user`= '$iduser';");
$resultUang = mysqli_query($con, "SELECT SUM(product.price*cart.qty) as 'Total'
    FROM `cart` 
    LEFT JOIN `product` ON `cart`.`id_barang` = `product`.`id`
    WHERE cart.id_user='$iduser';");
// $resultQty = mysqli_query($con, "SELECT SUM(cart.qty) AS QTY
//     FROM `cart` 
//     WHERE cart.id_user='$iduser';");
// $rowQty = mysqli_fetch_assoc($resultQty);
$rowUang = mysqli_fetch_assoc($resultUang);
$TOTAL = $rowUang["Total"] + 19000;
// $subtotal = $rowUang["Total"];
// var_dump($snapToken);
// $ALLQTY = $rowQty["QTY"];

mysqli_query($con, "insert into h_trans values('','" . $iduser . "', '" . $TOTAL . "')");

$ambilHtransNow = mysqli_query($con, "SELECT MAX(ht_id) AS ht_id FROM `h_trans`");
$fetchHtransNow = mysqli_fetch_assoc($ambilHtransNow);
$idHtransNow = $fetchHtransNow['ht_id'];
while ($row = mysqli_fetch_assoc($result)) {
    $curBar = $row["id_barang"];
    $curQty = $row["qty"];
    mysqli_query($con, "UPDATE `product` SET `stok` = stok - $curQty WHERE `product`.`id` = '$curBar'");

    mysqli_query($con, "insert into d_trans values('','" . $idHtransNow . "', '" . $row['id_barang'] . "', '" . $row['qty'] . "')");
}
mysqli_query($con, "DELETE from cart  WHERE id_user='$iduser'");
// if (isset($_REQUEST['btnAdd'])) {
//     if (!isset($_SESSION["username"])) {
//         $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);
//         header("location:login.php");
//     }
//     $selectedItem = $_GET["productid"];

//     $ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
//     $row = mysqli_fetch_assoc($ambilUser);
//     $idUser = $row['id'];

//     $qty = $_REQUEST['qty'];
//     mysqli_query($con, "insert into cart values('','" . $idUser . "', '" . $selectedItem . "','" . $qty . "')");
// }
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
        <div class="container-fluid" style="">
            <a class="navbar-brand" href="welcome.php">
                <img src="logo/cantique.png" width="100vw" height="auto">
            </a>
            <div class="d-flex" role="search">
                <div class="mx-3 mt-2"><a href="catalogue.php"><img src="logo/menu_book_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                <?php if (isset($_SESSION["username"])) : ?>
                    <div class="mx-3 mt-2"><a href="cart.php"><img src="logo/shopping_cart_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                    <div class="mx-3 mt-2"><a href="history.php"><img src="logo/history.png" height="30px" alt=""></a></div>
                <?php endif; ?>
                <?php
                if (!isset($_SESSION["username"])) :
                ?>
                    <div class="fw-bold mx-3 mt-2 text-dark login-register">
                        <a href="login.php" class="btn p-0 py-0 ps-3 pe-2 d-flex bg-primary text-decoration-none">
                            <div>Sign In</div>
                            <img src="logo/login_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt="">
                        </a>
                    </div>
                <?php else : ?>
                    <form method="POST" action="" class="mx-3 mt-2 d-flex fw-bold h-auto align-center text-dark login-register bg-primary rounded">
                        <button type="submit" name="logout" class="btn py-0 ps-3 pe-2 d-flex justify-content-between">
                            <div class="me-2">Sign Out</div>
                            <div>
                                <img src="logo/logout_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt="">
                            </div>
                        </button>
                    </form>
                <?php endif; ?>
                <!-- <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div> -->
            </div>
        </div>
    </nav>
    <div class="bg-dark">
        <br>
        <div class="text-center">
            <img src="logo/clipart2707415.png" alt="" style="width:250px; height:auto;">
        </div>
        <br>
        <br>
        <div class="text-center" style="color:white;">
            <h3>YOUR TRANSACTION SUCCESS</h1>
                <h5>THANK YOU FOR YOUR PATRONAGE
            </h3>
            <h5>YOUR RECEIPT NUMBER HT00<?= $idHtransNow ?></h3>
                <div class=" lead">Contact Us</div>
                <div class="lead">+6288-885151</div>
        </div>
    </div>
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    document.getElementById("empty").style.display = "block";
                    document.getElementById("error").style.display = "none";
                }
                form.classList.add('was-validated');
            }, false)
        })
    })()
</script>

</html>