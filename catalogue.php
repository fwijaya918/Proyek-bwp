<?php
require_once("helper.php") ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Somethinc</title>
    <style>
    </style>
</head>

<body class="bg-dark">
    <div class="container-fluid p-5">
        <form action="" method="get">
            <input type="text" name="query" class="mb-5" placeholder="Search:" id="">
            <button type="submit" class="rounded btn-primary" name="performsearch">Search</button>
        </form>
        <div class="row row-cols-4 gy-3">
            <?php
            if (isset($_GET["performsearch"])) {
                $query = mysqli_real_escape_string($con, htmlspecialchars($_GET["query"]));
                $products = mysqli_query($con, "SELECT * FROM `product` WHERE `title` LIKE '%$query%';");
            } else {
                $products = mysqli_query($con, "SELECT * FROM `product`;");
            }
            while ($row = mysqli_fetch_assoc($products)) {
                echo '<div class="col">';
                $link = $row["link"];
                echo '<a href="' . $link . '" class="text-decoration-none text-dark">';
                echo '<div class="card p-2 mb-5 h-100">';
                echo '<img src="' . $row["thumbnail"] . '" class="card-img-top border border-2 border-dark rounded" alt="' . $row["title"] . '">';
                echo '<div class="card-body text-center">';
                echo '<h5 class="card-title fixheight mb-3">';
                echo $row["title"];
                echo '</h5>';
                echo '<p class="card-text">';
                echo $row["price"];
                echo '</p>';
                echo "</div>";
                echo "</div>";
                echo '</a>';
                echo "</div>";
                flush();
                ob_flush();
            }
            ?>
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