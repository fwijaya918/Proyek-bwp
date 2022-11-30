<?php
require('helper.php');
$listProduct = mysqli_query($con, "select * from product ");


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
            <img src="logo/cantique.png" width="100vw" height="auto">
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
    <div class="container-fluid p-5">
        <form action="" method="post">
            <input type="text" name="postquery" class="mb-5" placeholder="Search:" value="<?php if (isset($_GET["query"])) {
                                                                                                echo $_GET["query"];
                                                                                            } ?>" id="">
            <button type="submit" class="rounded btn-primary" name="performsearch">Search</button>
        </form>
        <div class="row">
            <div class="col-md-2">
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
            <div class="col-md-10">
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
                                                                        } ?><?php if (isset($_GET["category"])) {
                                                                                $tempcat = $_GET["category"];
                                                                                echo "&amp;category=$tempcat";
                                                                            } ?>">
                                    << </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq";
                                                                                        } ?><?php if (isset($_GET["category"])) {
                                                                                                $tempcat = $_GET["category"];
                                                                                                echo "&amp;category=$tempcat";
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
                                                                                    } ?><?php if (isset($_GET["category"])) {
                                                                                            $tempcat = $_GET["category"];
                                                                                            echo "&amp;category=$tempcat";
                                                                                        } ?>"><?= $i ?></a></b>
                            </li>
                        <?php else : ?>
                            <li class="page-item">

                                <a class="page-link" href="?halaman=<?= $i; ?><?php if (isset($_GET["query"])) {
                                                                                    $tempq = $_GET["query"];
                                                                                    echo "&amp;query=$tempq";
                                                                                } ?><?php if (isset($_GET["category"])) {
                                                                                        $tempcat = $_GET["category"];
                                                                                        echo "&amp;category=$tempcat";
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
                                                                                        } ?><?php if (isset($_GET["category"])) {
                                                                                                $tempcat = $_GET["category"];
                                                                                                echo "&amp;category=$tempcat";
                                                                                            } ?>">&gt;</a>
                        </li>
                        <li class="page-item">

                            <a class="page-link" href="?halaman=<?= $jumlahHalaman ?><?php if (isset($_GET["query"])) {
                                                                                            $tempq = $_GET["query"];
                                                                                            echo "&amp;query=$tempq";
                                                                                        } ?><?php if (isset($_GET["category"])) {
                                                                                                $tempcat = $_GET["category"];
                                                                                                echo "&amp;category=$tempcat";
                                                                                            } ?>">>></a>
                        </li>
                    <?php
                    } ?>
                    </ul>

                </nav>
                <h5 class="text-white"><?= $jumlahData ?> Results</h5>

                <div class="row row-cols-md-4 gy-3">
                    <?php
                    //pagination intinya limit startingIdx, sampai berapa
                    $products = mysqli_query($con, "$base LIMIT $awalData, $jumlahDataPerHalaman;");
                    while ($row = mysqli_fetch_assoc($products)) {
                        echo '<div class="col">';
                        echo '<a href="detailEdit.php?productid= ' . $row['id'] . '" class="text-decoration-none text-dark">';
                        echo '<div class="card position-relative p-2 mb-2 h-100">';
                        echo '<img src="product/' . urlencode($row["thumbnail"]) . '" class="card-img-top border border-2 border-dark rounded" alt="' . $row["title"] . '">';
                        echo '<div class="card-body text-center">';
                        echo '<h5 class="card-title ellipsis fixheight mb-3">';
                        echo $row["title"];
                        echo '</h5>';
                        echo '<p class="mt-4 py-2 text-white rounded bg-primary">';
                        echo rupiah($row["price"]);
                        echo '</p>';
                        echo "</div>";
                        echo "</div>";
                        // echo '</a>';
                        echo "</div>";
                        flush();
                        ob_flush();
                    }
                    ?>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>