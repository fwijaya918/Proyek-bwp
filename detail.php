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
    $cekexist = mysqli_query($con, "Select * from cart WHERE id_user='$idUser' AND id_barang='$selectedItem'");
    if (mysqli_num_rows($cekexist) > 0) {
        $oldcart = mysqli_fetch_assoc($cekexist);
        $oldid = $oldcart["id_cart"];
        mysqli_query($con, "UPDATE `cart` SET `qty` = qty+$qty WHERE `cart`.`id_cart` = $oldid");
    } else {
        mysqli_query($con, "insert into cart values('','" . $idUser . "', '" . $selectedItem . "','" . $qty . "')");
    }
    header("location:cart.php");
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
<style>
    icon-shape {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        vertical-align: middle;
    }

    .icon-sm {
        width: 2rem;
        height: 2rem;

    }
</style>

<body class="bg-dark" onload="init()">
    <nav class="navbar bg-white">
        <div class="container-fluid" style="">
            <a class="navbar-brand" href="welcome.php">
                <img src="logo/Somethinc_Logo.png" width="150">
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
                <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <?php
        $row = mysqli_fetch_assoc($result); ?>
        <div class="row px-5 py-5 justify-content-between">
            <div class="col-md-2 rounded p-0">
                <img draggable="false" src="product/<?= urlencode($row["thumbnail"]) ?>" style="width: 100%;" class="rounded" alt="'<?= $row["title"]  ?>'">

            </div>
            <div class="col-md-6 bg-dark rounded p-0">
                <div class="d-flex justify-content-start">
                    <?php
                    $tempDesc =  $row['description'];
                    $tempHarga =  $row['price'];
                    $tempThumb = $row['thumbnail'];
                    $tempTitle = $row['title'];
                    ?>
                    <div class="bg-white rounded misc p-4">
                        <h4 class="fw-bold"><?= $tempTitle ?></h4>
                        <h3 id="satuan" class="fw-bold"><?= rupiah($tempHarga) ?></h3>
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
            <div class="col-md-3 p-3 bg-primary rounded">
                <form action="" method="post">
                    <h5>Quantity :</h5>
                    <div class="input-group mb-4 w-50">
                        <button class="btn fw-bold btn-dark w-25 text-center" id="kurang" onclick="decrement()" type="button">-</button>
                        <input type="text" onchange="updateTotal()" readonly class="bg-white form-control w-50 text-center" name="qty" value="1" id="qty"><br><br>
                        <button id="tambah" class="btn fw-bold btn-dark w-25 text-center" onclick="increment()" type="button">+</button>
                    </div>
                    <div class="h5 d-flex">Subtotal:&nbsp;
                        <div id="subtotal">Rp 119.000,00</div>
                        </h5>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-5" name="btnAdd">Add to Cart</button>
                </form>
            </div>
        </div>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function init() {
        if (parseInt(document.getElementById("qty").value) <= 1) {
            document.getElementById("kurang").disabled = true;
            updateTotal();
        }
    }

    function increment() {
        document.getElementById("qty").value = parseInt(document.getElementById("qty").value) + 1;
        document.getElementById("kurang").disabled = false;
        updateTotal();
    }

    function decrement() {
        if (parseInt(document.getElementById("qty").value) > 1) {
            document.getElementById("qty").value -= 1;
            if (parseInt(document.getElementById("qty").value) <= 1) {
                document.getElementById("kurang").disabled = true;
            }
        }
        updateTotal();
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateTotal() {
        let qty = parseInt(document.getElementById("qty").value);
        let satuan = document.getElementById("satuan").innerText;
        satuan = satuan.substring(0, satuan.indexOf(","));
        satuan = parseInt(satuan.replace(/\D/g, ""));
        let subtotal = qty * satuan;
        document.getElementById("subtotal").innerText = "Rp " + numberWithCommas(subtotal) + ",00";
        console.log(subtotal);

    }
</script>

</html>