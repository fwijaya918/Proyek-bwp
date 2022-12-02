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
    $subtotal = $rowUang["Total"] + 19000;

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
if (mysqli_num_rows($result) > 0) {
    $snapToken = updateSubtotal($con, $usernameActive);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .thumb {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body class="bg-dark" onload="load_ajax()">
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
    <div class="container-fluid p-4">
        <?php
        if (mysqli_num_rows($result) > 0) :
        ?>
            <h3 style="color:white;" class="mb-4"> Your Cart</h3>
            <div class="row justify-content-between">

                <div class="col-md-8">
                    <div class="thumbnail" id="thumbnail">

                    </div>
                </div>
                <div class="col-md-4 bg-success p-3 rounded" id="kanan" style="color:white;">

                </div>
            <?php else :  ?>
                <div class="w-50 bg-white text-center rounded m-auto p-5">
                    <h3 class="text-dark">YOUR CART IS EMPTY</h3>
                    <img src="logo/production_quantity_limits_FILL0_wght400_GRAD0_opsz48.svg" alt="" class="w-25 my-3">
                    <div class="text-muted">Looks like you have not added anything to your cart. Go ahead and explore our products.</div>
                    <a href="catalogue.php"><button class="btn btn-outline-primary mt-4">Shop Now</button></a>
                </div>
            <?php endif;  ?>
            </div>
    </div>
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>

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