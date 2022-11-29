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

if (isset($_REQUEST['btnEdit'])) {
    // if (!isset($_SESSION["username"])) {
    //     $_SESSION["redirect"] = basename($_SERVER['REQUEST_URI']);
    //     header("location:login.php");
    // }
    $selectedItem = $_GET["productid"];
    $namabaru = $_REQUEST["nama"];
    $hargabaru = $_REQUEST["harga"];
    $deskripsibaru = $_REQUEST["deskripsi"];
    $qty = $_REQUEST["qty"];
    if ($namabaru == "" || $hargabaru == "" || $deskripsibaru == "") {
        alert("ada yang kosong datanya");
    } else {
        mysqli_query($con, "UPDATE product SET title='$namabaru', price='$hargabaru', description='$deskripsibaru', stok = '$qty' where id='$productID'");
        alert("berhasil update barang");
        header('Location: ./editBarang.php');
    }
    // $add = mysqli_query($con, "SELECT * FROM `product` WHERE `id`= '$selectedItem';");
    // $ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
    // $row = mysqli_fetch_assoc($ambilUser);
    // $idUser = $row['id'];
    // $row = mysqli_fetch_assoc($add);
    // $idbarang = $row['id'];
    // $qty = $_REQUEST['qty'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        a {
            /* color: white; */
            text-decoration: none;
        }

        .ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container" style="">
            <a class="navbar-brand" href="">
                <img src="logo/Somethinc_Logo.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterUser.php" class="btn text-decoration-none">Master User</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterBarang.php" class="btn text-decoration-none">Master Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="editBarang.php" class="btn text-decoration-none">Edit Barang</a></div>
                <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div>

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
                    <h5>Nama Baru :</h5>
                    <input type="text" name="nama" id=""> <br><br>
                    <h5>Harga Baru :</h5>
                    <b>Rp </b> <input type="number" name="harga" id=""><br><br>
                    <h5>Deskripsi Baru :</h5>
                    <textarea name="deskripsi" id="" cols="40" rows="10" placeholder="deskripsi baru"></textarea><br>
                    <h5>Quantity :</h5>
                    <div class="input-group mb-4 w-50">
                        <button class="btn fw-bold btn-dark w-25 text-center" id="kurang" onclick="decrement()" type="button">-</button>
                        <input type="text" onchange="updateTotal()" readonly class="bg-white form-control w-50 text-center" name="qty" value="1" id="qty"><br><br>
                        <button id="tambah" class="btn fw-bold btn-dark w-25 text-center" onclick="increment()" type="button">+</button>
                    </div>


                    <button type="submit" style="" name="btnEdit">Edit</button>
                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
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