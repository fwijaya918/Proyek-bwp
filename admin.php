<?php
require('helper.php');

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
    <link rel="stylesheet" href="styleadmin.css">
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container" style="">
            <a class="navbar-brand" href="">
                <img src="logo/cantique.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterUser.php" class="btn text-decoration-none">Master User</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterBarang.php" class="btn text-decoration-none">Master Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="editBarang.php" class="btn text-decoration-none">Edit Barang</a></div>
                <div class="fw-bold mx-5 text-dark login-register"><a href="masterTransaksi.php" class="btn text-decoration-none">Master Transaksi</a></div>

                <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Welcome, Admin!</h1>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>