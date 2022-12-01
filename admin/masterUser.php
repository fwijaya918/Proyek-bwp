<?php
require('helper.php');
if (isset($_REQUEST['deleteBtn'])) {
    $hapusID = $_REQUEST['deleteID'];
    mysqli_query($con, "DELETE from users  WHERE id='$hapusID'");
    alert("berhasil delete user");
}
$ambilUser = mysqli_query($con, "SELECT * FROM `users`;");

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
    <link rel="stylesheet" href="styleMU.css">
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
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <div class="hiasan">
            <h3>Menu Master User</h3>

        </div>
        <table id="tableUser">
            <thead>
                <th>Nomor</th>
                <th>ID User</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Password</th>
            </thead>
            <?php
            $nomor = 0;
            while ($row = mysqli_fetch_array($ambilUser)) {
                $nomor++;
                echo "<tr>
                <td>" . ($nomor) . "</td>
                <td>US" . $row['id'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>" . $row['fullname'] . "</td>
                <td>" . $row['password'] . "</td>
                <td>
                    <form action='./masterUser.php' method='post'>
                    <input type='hidden' name='deleteID' value=" . $row['id'] . ">
                    <button type='submit' name='deleteBtn'>Delete</button></form>
                </td>
                </tr>";
            }
            ?>
        </table>

    </div>
    <div class="container-fluid bg-white px-4 py-2 fixed-bottom">&copy; 2022 Cantique. All Rights Reserved</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>