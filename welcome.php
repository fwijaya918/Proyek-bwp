<?php
require("helper.php");
if (isset($_SESSION["redirect"])) {
    $redirectlink = $_SESSION["redirect"];
    unset($_SESSION["redirect"]);
    header("location:$redirectlink");
}
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

$jumlahDataPerHalaman = 12;
$filters = [];
if (isset($_GET["category"])) {
    $idCat = $_GET["category"];
    $filters[] = "`product_category_id`='$idCat'";
}
if (isset($_POST["performsearch"])) {
    $pq = $_POST["postquery"];
    $link = "catalogue.php?query=$pq";
    if (isset($_GET["category"])) {
        $idCat = $_GET["category"];
        $link .= "&category=$idCat";
    }
    header("location:" . $link);
}
if (isset($_GET["query"])) {
    $query = mysqli_real_escape_string($con, htmlspecialchars($_GET["query"]));
    $filters[] = "`title` LIKE '%$query%'";
}
$wheres = implode(" AND ", $filters);
$generatedWHERE = "";
if ($wheres != "") {
    $generatedWHERE .= "WHERE " . $wheres;
}
$base = "SELECT * FROM `product` $generatedWHERE";
$result = mysqli_query($con, "$base;");

$jumlahData = mysqli_num_rows($result);
//pembulatan halaman
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
//ngecekin halaman aktif yang keberapa
if (isset($_GET["halaman"])) {
    $halamanAktif = $_GET["halaman"];
} else {
    $halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;





?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Somethinc</title>
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

        .align-center {
            align-items: center;
        }

        .card-body {
            min-height: 300px;
            min-width: 300px;
            margin-right: 5px;
        }

        .mh-100 {
            max-width: 100%;
            min-width: 100%;
        }
    </style>
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
    <div class="container-fluid p-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="detail.php?productid=36"><img src="product/KV_Syahrini-Ceramic-10x_1240x400_1240.jpg" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                    <a href="detail.php?productid=1"> <img src="product/KV-Syahrini-Website_-1240-x-400_No-Harga_1240.jpg" class="d-block w-100" alt=""></a>
                </div>
                <div class="carousel-item">
                    <a href="catalogue.php?category=C0002"> <img src="product/1240x4001_1240.jpg" class="d-block w-100" alt=""></a>
                </div>
                <div class="carousel-item">
                    <a href="detail.php?productid=60"> <img src="product/Final_KV_Sunscreen_Gel_1240x400_copy1_1240.jpg" class="d-block w-100" alt=""></a>
                </div>
                <div class="carousel-item">
                    <a href="catalogue.php?category=C0001"> <img src="product/00_WEB_BANNER_-_DESKTOP_1240.jpg" class="d-block w-100" alt=""></a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container-fluid py-2 overflow-auto">
            <h2 class="font-weight-light text-white">New Arrival</h2>
            <div class="d-flex flex-row flex-nowrap">
                <?php
                $result = mysqli_query($con, "SELECT * FROM product LIMIT 10");
                while ($newArr = mysqli_fetch_assoc($result)) :
                ?>
                    <div class="card card-body">
                        <img src="product/<?php echo urlencode($newArr["thumbnail"]); ?>" class="card-img-top border border-2 border-dark rounded" alt="" />
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>
</body>

</html>