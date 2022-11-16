<?php
require('helper.php');

if (isset($_REQUEST['btnRegis'])) {

    $username = $_REQUEST['inUser'];
    $fullname = $_REQUEST['inFullname'];
    $password = $_REQUEST['inPass'];
    $cpassword = $_REQUEST['conPass'];


    if ($username != "" && $password != "" && $cpassword != "" && $fullname != "") {
        if ($password == $cpassword) {
            $kembar = false;
            $result = mysqli_query($con, "select username from users");
            while ($row = mysqli_fetch_array($result)) {
                if ($row['username'] == $username) {
                    $kembar = true;
                    break;
                }
            }
            if ($kembar) {
                alert("User sudah terdaftar");
            } else {
                $daftar = mysqli_query($con, "insert into users values('','" . $username . "', '" . $fullname . "','" . $password . "')");
                alert("Registrasi berhasil");
            }
        } else {
            alert("Confirm password tidak cocok");
        }
    } else {
        alert("Inputnya ada yang kosong");
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
    <style>

    </style>
</head>

<body>
    <nav class="navbar bg-white">
        <div class="container">
            <a class="navbar-brand" href="catalogue.php">
                <img src="logo/Somethinc_Logo.png" width="150">
            </a>
            <div class="d-flex" role="search">
                <div class="fw-bold mx-5 login-register"><a href="login.php" class="btnnav">Login</a></div>
                <div class="fw-bold mx-5 login-register"><a href="register.php " class="btnnav">Register</a></div>
            </div>
        </div>
    </nav>
    <div class="formRegis">
        <h1>Register</h1>
        <form action="./register.php" method="post" style="">
            <div class="inputan">
                <input type="text" name="inUser" placeholder="username" style="background:transparent; border:none; color:black;"><br>
            </div>
            <div class="inputan">
                <input type="text" name="inFullname" placeholder="full name" style="background:transparent; border:none; color:black;"><br>
            </div>

            <div class="inputan">
                <input type="text" name="inPass" placeholder="password" style="background:transparent; border:none; color:black;"><br>
            </div>
            <div class="inputan">
                <input type="text" name="conPass" placeholder="confirmation password" style="background:transparent; border:none; color:black;"><br>
            </div>
            <button type="submit" name="btnRegis" id="btnRegis" style="margin-top:50px; background-color: pink;">Register</button>

        </form>
        <p style=" text-align:center; ">Have an Account? <a href="./index.php" style="">Login</a></p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</body>

</html>