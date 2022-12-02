<?php
require("helper.php");
if (isset($_POST["logout"])) {
    unset($_SESSION["username"]);
    unset($_SESSION["fullname"]);
    header("location:catalogue.php");
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

$result = mysqli_query($con, "SELECT * FROM h_trans where user_id='$iduser' ORDER BY ht_id desc;");

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
    <link rel="stylesheet" href="stylehistory.css">
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
    <br>
    <h1 style="color:white; margin-left:50px; ">History Transaction</h1><br>
    <?php
    setlocale(LC_MONETARY, "id_ID");
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card mb-3" class="" style="padding-left:10%; padding-right:10%; background-color:#212529;">
            <div class="row g-0" style="background-color:green;">
                <div class="col-md-6">
                    <div class="card-body w-100" style="background-color:green;">
                        <h5 class="card-title">HT00<?= $row["ht_id"] ?></h5>
                        <p class="card-text fw-bold mt-3">Subtotal : <?php echo rupiah($row["total"] - 19000); ?></p>
                        <p class="card-text fw-bold mt-3">Grand Total : <?php echo rupiah($row["total"]); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body w-100" style="background-color:green;">
                        <h5 class="card-title">Detail Transaction</h5>
                        <?php
                        if ($row["Stat"] == 1) { ?>
                            <h5>Paid</h5>
                        <?php
                        } else if ($row["Stat"] == 2) { ?>
                            <h5>Delivered</h5>
                        <?php
                        } else if ($row["Stat"] == 3) { ?>
                            <h5>Finished</h5>
                        <?php
                        }
                        ?>
                        <div class="fw-bold mx-3 text-dark login-register"><a href="dtrans.php?htransid=<?= $row['ht_id'] ?>" class="btn text-decoration-none">See Detail</a></div>
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