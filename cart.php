<?php
require('helper.php');
if (isset($_POST["logout"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["fullname"]);
}
if (!isset($_SESSION["username"])) {
    header("location:login.php");
}

if (!isset($_SESSION['username'])) {
    // header('Location: ./index.php');
} else {
    $fullnameActive = $_SESSION['fullname'];
    $usernameActive = $_SESSION['username'];
}

$ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
$fetchUser = mysqli_fetch_assoc($ambilUser);
$iduser = $fetchUser['id'];
// alert($iduser);
$result = mysqli_query($con, "SELECT * FROM `cart` WHERE `id_user`= '$iduser';");

require_once('Veritrans.php');

//Set Your server key
Veritrans_Config::$serverKey = "SB-Mid-server-MMmoT6SLju9dDUEjhC-MfElB";

// Uncomment for production environment
// Veritrans_Config::$isProduction = true;

// Enable sanitization
Veritrans_Config::$isSanitized = true;

// Enable 3D-Secure
Veritrans_Config::$is3ds = true;

function updateSubtotal($con, $usernameActive)
{
    $ambilUser = mysqli_query($con, "SELECT * FROM `users` WHERE `username`= '$usernameActive';");
    $fetchUser = mysqli_fetch_assoc($ambilUser);
    $iduser = $fetchUser['id'];
    $resultUang = mysqli_query($con, "SELECT SUM(product.price*cart.qty) as 'Total'
    FROM `cart` 
    LEFT JOIN `product` ON `cart`.`id_barang` = `product`.`id`
    WHERE cart.id_user='$iduser';");
    $resultQty = mysqli_query($con, "SELECT SUM(cart.qty) AS QTY
    FROM `cart` 
    WHERE cart.id_user='$iduser';");
    $rowQty = mysqli_fetch_assoc($resultQty);
    $rowUang = mysqli_fetch_assoc($resultUang);
    $TOTAL = $rowUang["Total"];
    $subtotal = $rowUang["Total"];

    // Required
    $transaction_details = array(
        'order_id' => rand(),
        'gross_amount' => $subtotal, // no decimal allowed for creditcard
    );


    // Optional, remove this to display all available payment methods
    // $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');
    // $enable_payments = array(); 

    // Fill transaction details
    $transaction = array(
        'transaction_details' => $transaction_details,
        // 'enabled_payments' => $enable_payments,
    );

    $snapToken = Veritrans_Snap::getSnapToken($transaction);
    return $snapToken;
}
$snapToken = updateSubtotal($con, $usernameActive);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylecart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="bg-dark" onload="load_ajax()">
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
        <?php
        if (mysqli_num_rows($result) > 0) :
        ?>
            <div class="kiri">
                <h1 style="color:white;">Keranjang <?= $usernameActive ?></h1>
                <br>
                <div class="thumbnail" id="thumbnail">

                </div>
            </div>
            <div class="kanan" id="kanan" style="color:white;">

            </div>
        <?php else :  ?>
            <h1 class="text-white">YOUR CART IS EMPTY</h1>
        <?php endif;  ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<script>
    function load_ajax() {

        // fetch_like();
        fetch_cart();
        fetch_kanan();
    }

    function ajax_func(method, url, callback, data = "") {
        r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            callback(this);
        }
        r.open(method, url);
        if (method.toLowerCase() == "post") r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        r.send(data);
    }

    function refresh_table(xhttp) {
        if ((xhttp.readyState == 4) && (xhttp.status == 200)) {
            // console.log(xhttp.responseText);
            fetch_cart();
            fetch_kanan();
        }
    }

    function tambah(obj) {

        update_title = obj.value;
        ajax_func('GET', `tambah.php?update_title=${update_title}`, refresh_table);
    }

    function kurang(obj) {

        update_title = obj.value;
        ajax_func('GET', `kurang.php?update_title=${update_title}`, refresh_table);
    }

    function drop(obj) {
        update_title = obj.value;
        ajax_func('GET', `drop.php?update_title=${update_title}`, refresh_table);
        location.reload();
    }

    function fetch_cart() {
        r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if ((this.readyState == 4) && (this.status == 200)) {
                thumbnail.innerHTML = this.responseText;
            }
        }
        r.open('GET', 'cart_fetch.php');
        r.send();
    }

    function fetch_kanan() {
        r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if ((this.readyState == 4) && (this.status == 200)) {
                kanan.innerHTML = this.responseText;
            }
        }
        r.open('GET', 'kanan_fetch.php');
        r.send();
        // <?php $snapToken = updateSubtotal($con, $usernameActive); ?>

    }
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Dogh6FNj-DzvrdQk"></script>
<script type="text/javascript">
    function cekout() {
        // SnapToken acquired from previous step
        snap.pay('<?= $snapToken ?>', {
            // Optional
            onSuccess: function(result) {
                console.log("success bayar ");
                alert('success bayar midtrans');
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // document.getElementById('result-json').innerHTML = "masuk sukses";
                pindah();
                // alert('aaaaa');
                /* You may add your own js here, this is just example */
                // $.post("ajax.php",
                //   { jenis: 'midtranspayment' },
                //   function(result) {
                //     alert(result); 
                //     window.location = "thanks.php"; 
                //   }
                // );
            },
            // Optional
            onPending: function(result) {
                document.getElementById('result-json').innerHTML = "masuk pending";
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                /* You may add your own js here, this is just example */
            },
            // Optional
            onError: function(result) {
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                /* You may add your own js here, this is just example */
            }
        });
    };

    function pindah() {
        window.location = "checkout.php";
    };
</script>

</html>