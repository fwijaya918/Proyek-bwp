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
    </style>
</head>

<body class="bg-dark">
    <nav class="navbar bg-white">
        <div class="container-fluid" style="">
            <a class="navbar-brand" href="">
                <img src="logo/Somethinc_Logo.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="mx-3 mt-2"><a href="cart.php"><img src="logo/shopping_cart_FILL0_wght400_GRAD0_opsz48.png" height="25px" alt=""></a></div>
                <div class="mx-3 mt-2"><a href="history.php"><img src="logo/history.png" height="25px" alt=""></a></div>
                <?php
                if (!isset($_SESSION["username"])) :
                ?>
                    <div class="fw-bold mx-5 text-dark login-register"><a href="login.php" class="btn text-decoration-none">Login</a></div>
                <?php else : ?>
                    <form method="POST" action="" class="fw-bold mx-5 text-dark login-register"><button class="btn" type="submit" name="logout" class="btnnav">Logout</button></form>
                <?php endif; ?>
                <div class="mx-3 mt-2"><a href="index.php"><img src="logo/profileicon.png" height="25px" alt=""></a></div>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-5">
        <form action="" method="post">
            <input type="text" name="postquery" class="mb-5" placeholder="Search:" value="<?php if (isset($_GET["query"])) {
                                                                                                echo $_GET["query"];
                                                                                            } ?>" id="">
            <button type="submit" class="rounded btn-primary" name="performsearch">Search</button>
        </form>
        <div class="row">
            <div class="col-2">
                <div class="w100 rounded bg-white p-2">
                    <!-- <h3 class="">Filter:</h3> -->
                    <h5>Category:</h5>
                    <?php
                    $res = mysqli_query($con, "SELECT * FROM category;");
                    while ($row = mysqli_fetch_assoc($res)) :
                    ?>
                        <a class="<?php if (isset($_GET["category"])) {
                                        if ($_GET["category"] == $row["id_category"]) {
                                            echo "fw-bold";
                                        }
                                    } ?>" href="catalogue.php?category=<?php echo $row["id_category"] ?><?php if (isset($_GET["query"])) {
                                                                                                            $tempq = $_GET["query"];
                                                                                                            echo "&query=$tempq";
                                                                                                        } ?>"><?= $row["nama_category"] ?></a>
                        <br>
                    <?php endwhile; ?>
                    <br>
                    <a href="catalogue.php"><button class="btn btn-primary">Reset Filter</button></a>
                </div>
            </div>
            <div class="col-10">
                <h5 style="color:white;">Halaman</h5>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <?php
                            if ($halamanAktif == 1) { ?>
                            <?php
                            } else { ?>
                                <a class="page-link" href="catalogue.php<?php if (isset($_GET["query"])) {
                                                                            $tempq = $_GET["query"];
                                                                            echo "?query=$tempq";
                                                                        } ?>">
                                    << </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq";
                                                                                        } ?>">&lt;</a>
                        </li>
                    <?php
                            }
                    ?>
                    </li>
                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <li class="page-item active">
                                <b><a class="page-link" href="?halaman=<?= $i; ?><?php if (isset($_GET["query"])) {
                                                                                        $tempq = $_GET["query"];
                                                                                        echo "&amp;query=$tempq";
                                                                                    } ?>"><?= $i ?></a></b>
                            </li>
                        <?php else : ?>
                            <li class="page-item">

                                <a class="page-link" href="?halaman=<?= $i; ?><?php if (isset($_GET["query"])) {
                                                                                    $tempq = $_GET["query"];
                                                                                    echo "&amp;query=$tempq";
                                                                                } ?>"><?= $i ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php
                    if ($halamanAktif < $jumlahHalaman) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq";
                                                                                        } ?>">&gt;</a>
                        </li>
                        <li class="page-item">

                            <a class="page-link" href="?halaman=<?= $jumlahHalaman ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq";
                                                                                        } ?>">>></a>
                        </li>
                    <?php
                    } ?>
                    </ul>

                </nav>
                <div class="row row-cols-4 gy-3">
                    <?php
                    //pagination intinya limit startingIdx, sampai berapa
                    $products = mysqli_query($con, "$base LIMIT $awalData, $jumlahDataPerHalaman;");

                    while ($row = mysqli_fetch_assoc($products)) {
                        echo '<div class="col">';
                        echo '<a href="detail.php?productid= ' . $row['id'] . '" class="text-decoration-none text-dark">';
                        echo '<div class="card p-2 mb-5 h-100">';
                        echo '<img src="product/' . $row["thumbnail"] . '" style="width:250px; height:250px; margin-left:20px;" class="card-img-top border border-2 border-dark rounded" alt="' . $row["title"] . '">';
                        echo '<div class="card-body text-center">';
                        echo '<h5 class="card-title fixheight mb-3">';
                        echo $row["title"];
                        echo '</h5>';
                        echo '<p class="card-text">';
                        echo $row["price"];
                        echo '</p>';
                        echo "</div>";
                        echo "</div>";
                        // echo '</a>';
                        echo "</div>";
                        flush();
                        ob_flush();
                    }
                    ?>
                    <!-- navigasi -->

                </div>
                <br>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <?php
                            if ($halamanAktif == 1) { ?>
                            <?php
                            } else { ?>
                                <a class="page-link" href="catalogue.php<?php if (isset($_GET["query"])) {
                                                                            $tempq = $_GET["query"];
                                                                            echo "?query=$tempq&amp;performsearch=";
                                                                        } ?>">
                                    << </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq&amp;performsearch=";
                                                                                        } ?>">&lt;</a>
                        </li>
                    <?php
                            }
                    ?>
                    </li>
                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <li class="page-item active">
                                <b><i><a class="page-link" href="?halaman=<?= $i; ?><?php if (isset($_GET["query"])) {
                                                                                        $tempq = $_GET["query"];
                                                                                        echo "&amp;query=$tempq&amp;performsearch=";
                                                                                    } ?>"><?= $i ?></a></i></b>
                            </li>
                        <?php else : ?>
                            <li class="page-item">

                                <a class="page-link" href="?halaman=<?= $i; ?><?php if (isset($_GET["query"])) {
                                                                                    $tempq = $_GET["query"];
                                                                                    echo "&amp;query=$tempq&amp;performsearch=";
                                                                                } ?>"><?= $i ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php
                    if ($halamanAktif < $jumlahHalaman) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq&amp;performsearch=";
                                                                                        } ?>">&gt;</a>
                        </li>
                        <li class="page-item">

                            <a class="page-link" href="?halaman=<?= $jumlahHalaman ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq&amp;performsearch=";
                                                                                        } ?>">>></a>
                        </li>
                    <?php
                    } ?>
                    </ul>

                </nav>
            </div>

        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>