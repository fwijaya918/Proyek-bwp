<?php
require('helper.php');

$result = mysqli_query($con, "SELECT * FROM h_trans;");
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
    <br>
    <h1 style="color:white;">History Transaction</h1><br>
    <?php
    setlocale(LC_MONETARY, "id_ID");
    while ($row = mysqli_fetch_assoc($result)) {
        $ambilUser = mysqli_query($con, "SELECT * FROM users WHERE id= $row[user_id];");
        $fetchUser = mysqli_fetch_assoc($ambilUser);
        $nameUser = $fetchUser['username'];
    ?>
        <div class="card mb-3" class="" style="padding-left:10%; padding-right:10%; background-color:#212529;">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body w-100" style="background-color:green; height:150px;">
                        <h5 class="card-title">HT00<?= $row["ht_id"] ?></h5>
                        <p class="card-text fw-bold mt-3"><?php echo rupiah($row["total"]); ?></p>
                        <p class="card-text fw-bold mt-3"><?php echo ($nameUser); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body w-100" style="background-color:green;height:150px;">
                        <h5 class="card-title">Detail Transaction</h5>
                        <h5>Status : Done</h5>
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